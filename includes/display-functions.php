<?php
// no direct access!
defined('ABSPATH') or die("No direct access");

global $wpdb;
global $wpcfg_token;
global $wpcfg_field_index;
global $wpcfg_section_width;
global $wpcfg_section_id;
global $wpcfg_heading_text_font_effect;
$wpcfg_token = '';
$wpcfg_field_index = 1;
$wpcfg_section_width = '';
$wpcfg_section_id = 1;
$wpcfg_heading_text_font_effect = '';

function cfg_getBrowser() { 
	    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
	    $bname = 'Unknown';
	    $platform = 'Unknown';
	    $version= "";

	    //First get the platform?
	    if (preg_match('/linux/i', $u_agent)) {
	        $platform = 'linux';
	    }
	    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
	        $platform = 'mac';
	    }
	    elseif (preg_match('/windows|win32/i', $u_agent)) {
	        $platform = 'windows';
	    }
	    
	    // Next get the name of the useragent yes seperately and for good reason
	    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
	    { 
	        $bname = 'Internet Explorer'; 
	        $ub = "MSIE"; 
	    } 
	    elseif(preg_match('/Firefox/i',$u_agent)) 
	    { 
	        $bname = 'Mozilla Firefox'; 
	        $ub = "Firefox"; 
	    } 
	    elseif(preg_match('/Chrome/i',$u_agent)) 
	    { 
	        $bname = 'Google Chrome'; 
	        $ub = "Chrome"; 
	    } 
	    elseif(preg_match('/Safari/i',$u_agent)) 
	    { 
	        $bname = 'Apple Safari'; 
	        $ub = "Safari"; 
	    } 
	    elseif(preg_match('/Opera/i',$u_agent)) 
	    { 
	        $bname = 'Opera'; 
	        $ub = "Opera"; 
	    } 
	    elseif(preg_match('/Netscape/i',$u_agent)) 
	    { 
	        $bname = 'Netscape'; 
	        $ub = "Netscape"; 
	    } 
	    
	    // finally get the correct version number
	    $known = array('Version', $ub, 'other');
	    $pattern = '#(?<browser>' . join('|', $known) .
	    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	    if (!preg_match_all($pattern, $u_agent, $matches)) {
	        // we have no matching number just continue
	    }
	    
	    // see how many we have
	    $i = count($matches['browser']);
	    if ($i != 1) {
	        //we will have two since we are not using 'other' argument yet
	        //see if version is before or after the name
	        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
	            $version= $matches['version'][0];
	        }
	        else {
	            $version= $matches['version'][1];
	        }
	    }
	    else {
	        $version= $matches['version'][0];
	    }
	    
	    // check if we have a number
	    if ($version==null || $version=="") {$version="?";}
	    
	    return array(
	        'userAgent' => $u_agent,
	        'name'      => $bname,
	        'version'   => $version,
	        'platform'  => $platform,
	        'pattern'    => $pattern
	    );
	}

function cfg_getOS() { 
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform    =   "Unknown OS Platform";
    $os_array       =   array('/windows nt 6.3/i'     =>  'Windows 8.1', '/windows nt 6.2/i'     =>  'Windows 8', '/windows nt 6.1/i'     =>  'Windows 7', '/windows nt 6.0/i'     =>  'Windows Vista', '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64', '/windows nt 5.1/i'     =>  'Windows XP', '/windows xp/i'         =>  'Windows XP', '/windows nt 5.0/i'     =>  'Windows 2000', '/windows me/i'         =>  'Windows ME', '/win98/i'              =>  'Windows 98', '/win95/i'              =>  'Windows 95', '/win16/i'              =>  'Windows 3.11', '/macintosh|mac os x/i' =>  'Mac OS X', '/mac_powerpc/i'        =>  'Mac OS 9', '/linux/i'              =>  'Linux', '/ubuntu/i'             =>  'Ubuntu', '/iphone/i'             =>  'iPhone', '/ipod/i'               =>  'iPod', '/ipad/i'               =>  'iPad', '/android/i'            =>  'Android', '/blackberry/i'         =>  'BlackBerry', '/webos/i'              =>  'Mobile');
    foreach ($os_array as $regex => $value) { 
        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }
    }   
    return $os_platform;
}


function wpcfg_shortcode_function( $atts ) {
	global $wpcfg_token;
	
	extract( shortcode_atts( array(
			'id' => 0,
	), $atts ) );
	
	//set token
	if($wpcfg_token == '') {
		$wpcfg_token = bin2hex(random_bytes(32));
		$_SESSION['contactformgenerator_token'] = $wpcfg_token;
	}

	wpcfg_enqueue_front_scripts($id);
	return wpcfg_render_html($id);

}
add_shortcode( 'contactformgenerator', 'wpcfg_shortcode_function' );

//add_action('template_redirect','wpcfg_my_shortcode_head');
function wpcfg_my_shortcode_head(){
	global $posts;
	global $wpcfg_token;
	$pattern = get_shortcode_regex();
	preg_match('/(\[(contactformgenerator) id="([0-9]+)"\])/s', $posts[0]->post_content, $matches);
	if (is_array($matches) && $matches[2] == 'contactformgenerator') {
		$form_id = (int) $matches[3];
		wpcfg_enqueue_front_scripts($form_id);
		
		//set token
		$wpcfg_token = bin2hex(random_bytes(32));
		$_SESSION['contactformgenerator_token'] = $wpcfg_token;
	}
}

function wpcfg_enqueue_front_scripts($form_id) {
	global $wpdb;
	global $plugin_version;
	$version = $plugin_version;
	$db_version = $plugin_version;
	
	//get field types array
	$types_array = cfg_get_types_array($form_id);

	$cssFile = plugin_dir_url( __FILE__ ).'/assets/css/main.css?version='.$version;
	wp_enqueue_style('wpcfg-styles1', $cssFile);

	$cssFile = plugin_dir_url( __FILE__ ).'/assets/css/cfg-css-ui.css';
	wp_enqueue_style('wpcfg-styles2', $cssFile);

	$cssFile = plugin_dir_url( __FILE__ ).'/assets/css/cfg-scroll.css';
	wp_enqueue_style('wpcfg-styles3', $cssFile);

	$cssFile = plugin_dir_url( __FILE__ ).'/assets/css/template.css';
	wp_enqueue_style('wpcfg-styles4', $cssFile);

	$cssFile = plugin_dir_url( __FILE__ ).'/assets/css/cfg-tooltip.css';
	wp_enqueue_style('wpcfg-styles5', $cssFile);

	$jsFile = plugin_dir_url( __FILE__ ).'/assets/js/cfg-mousewheel.js';
	wp_enqueue_script('wpcfg-script1', $jsFile, array('jquery','jquery-ui-core','jquery-ui-widget','jquery-ui-draggable'));

	$jsFile = plugin_dir_url( __FILE__ ).'/assets/js/cfg-scroll.js';
	wp_enqueue_script('wpcfg-script2', $jsFile, array('jquery','jquery-ui-core','jquery-ui-widget','jquery-ui-draggable'));

	wp_enqueue_script('wpcfg-script7' . $form_id, admin_url() . 'admin.php?page=cfg_forms&act=cfg_submit_data&holder=generate_js&id_form='.$form_id, array('jquery'));

	$jsFile = plugin_dir_url( __FILE__ ).'/assets/js/contactformgenerator.js?version='.$version;
	wp_enqueue_script('wpcfg-script8', $jsFile, array('jquery','jquery-ui-core','jquery-effects-core','jquery-ui-datepicker'));

}

function cfg_get_types_array($form_id) {
	global $wpdb;

	//get field types array
	$query = "
				SELECT
				sp.id,
				st.name as type
				FROM
				`".$wpdb->prefix."cfg_fields` sp
				JOIN `".$wpdb->prefix."cfg_field_types` st ON st.id = sp.id_type
				WHERE sp.published = '1'
				AND sp.id_form = '".$form_id."'
				ORDER BY sp.ordering,sp.id
			";
	$types_array_data = $wpdb->get_results($query);
	$types_array_index = 1;
	$types_array = array();
	if(is_array($types_array_data)) {
		for($i=0; $i < count( $types_array_data ); $i++) {
			$type = $types_array_data[$i];
			$type_formated = strtolower(str_replace(' ','-',str_replace('-','',$type->type)));
			if(!in_array($type_formated, $types_array)) {
				$types_array[$types_array_index] = $type_formated;
				$types_array_index ++;
			}
		}
	}
	return $types_array;
}


function cfg_get_form_data($form_id) {
	global $wpdb;

	//get form data/////////////////////////////////////////////////////////////////////////////////////////////////
	$query = "
				SELECT
					sp.`id_template`, sp.name, sp.published, sp.top_text, sp.pre_text, sp.thank_you_text, sp.send_text, sp.send_new_text, sp.close_alert_text, sp.form_width, sp.redirect, sp.redirect_itemid, sp.redirect_url, sp.redirect_delay, sp.shake_count, sp.shake_distanse, sp.send_copy_enable, sp.send_copy_text, sp.shake_duration, sp.custom_css, st.styles 
				FROM
					`".$wpdb->prefix."cfg_forms` sp
				LEFT JOIN 
					`".$wpdb->prefix."cfg_templates` st ON st.id = sp.id_template
				WHERE 
					sp.published = '1'
				AND 
					sp.id = '".$form_id."'";

	$form_data = $wpdb->get_row($query,'ARRAY_A');

	return $form_data;

}

function cfg_get_field_data($form_id) {
	global $wpdb;

	//get fields data/////////////////////////////////////////////////////////////////////////////////////////////////
	$query = "
				SELECT
					sp.id, sp.name, sp.tooltip_text, sp.required, sp.ordering_field, sp.select_default_text, sp.show_parent_label, sp.select_no_match_text, sp.width, sp.field_margin_top, sp.select_show_scroll_after, sp.select_show_search_after, sp.upload_button_text, sp.upload_minfilesize, sp.upload_maxfilesize, sp.upload_acceptfiletypes, sp.upload_minfilesize_message, sp.upload_maxfilesize_message, sp.upload_acceptfiletypes_message, sp.captcha_wrong_message, sp.datepicker_date_format, sp.datepicker_animation, sp.datepicker_style, sp.datepicker_icon_style, sp.datepicker_show_icon, sp.datepicker_input_readonly, sp.datepicker_number_months, sp.datepicker_mindate, sp.datepicker_maxdate, sp.datepicker_changemonths, sp.datepicker_changeyears, sp.column_type, sp.custom_html, sp.google_maps, sp.heading, sp.recaptcha_site_key, sp.recaptcha_wrong_message, sp.recaptcha_theme, sp.recaptcha_type, sp.contact_data, sp.contact_data_width, sp.creative_popup, sp.creative_popup_embed, st.name as type 
				FROM
					`".$wpdb->prefix."cfg_fields` sp
				JOIN 
					`".$wpdb->prefix."cfg_field_types` st ON st.id = sp.id_type
				WHERE 
					sp.published = '1'
				AND 
					sp.id_form = '".$form_id."'
				ORDER BY 
					sp.ordering,sp.id
			";
	$field_data = $wpdb->get_results($query);
	return $field_data;
}

function cfg_get_ip() {

	$REMOTE_ADDR = null;
	if(isset($_SERVER['REMOTE_ADDR'])) {
		$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
	}
	elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$REMOTE_ADDR = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
		$REMOTE_ADDR = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif(isset($_SERVER['HTTP_VIA'])) {
		$REMOTE_ADDR = $_SERVER['HTTP_VIA'];
	}
	else { $REMOTE_ADDR = 'Unknown';
	}
	return $REMOTE_ADDR;
}

function get_rule_from_row($key,$row) {
	preg_match('/'.$key.'~([^\|]+)\|/',$row,$m);
	if(isset($m[1]))
		return $m[1];
	else
		return '';
}	
function get_last_rule_from_row($key,$row) {
	preg_match('/'.$key.'~([^\|]+)$/',$row,$m);
	if(isset($m[1]))
		return $m[1];
	else
		return '';
}
function cfg_process_sections($matched_sections) {
	global $wpcfg_section_width;
	global $wpcfg_section_id;
	$sections_width = (int)$wpcfg_section_width == 0 ? 110 : $wpcfg_section_width;
	$section_type = $matched_sections[1];
	$section_label = $matched_sections[2];
	$section_content = $matched_sections[3];

	$section_id = $wpcfg_section_id;

	$contact_data = '<div class="cfg_content_element cfg_content_element_'.$section_id.'">';
		$contact_data .= '<div class="cfg_content_element_content_wrapper">';
			$contact_data .= '<div style="margin-left: '.$sections_width.'px;" class="cfg_section_margin_control_'.$section_id.'">';
				$contact_data .= '<span>';
					$contact_data .= $section_content;
				$contact_data .= '</span>';
			$contact_data .= '</div>';
		$contact_data .= '</div>';
		$contact_data .= '<div class="cfg_content_element_icon_wrapper cfg_section_width_control_'.$section_id.'" style="width: '.$sections_width.'px;" >';
			$contact_data .= '<span class="cfg_content_icon cfg_content_icon_'.$section_type.'"></span>';
			$contact_data .= '<span class="cfg_content_element_label">'.$section_label.'</span>';
		$contact_data .= '</div>';
	$contact_data .= '</div>';

	$wpcfg_section_id ++;

	return $contact_data;
}

function cfg_process_txt($txt,$process_types_array) {
	global $wpcfg_heading_text_font_effect;
	if(in_array('sections',$process_types_array)) {
		$txt = preg_replace_callback('/{section icon=\"([a-zA-Z]*)\" label=\"(.*?)\"}(.*?){\/section}/s', 'cfg_process_sections', $txt);

	}
	if(in_array('num',$process_types_array)) {
		$txt = preg_replace('/{num}(.*?){\/num}/s','<span class="cfg_content_styling">$1</span>', $txt);
	}
	if(in_array('popup',$process_types_array)) {
		$txt = preg_replace('/{creative_popup id="(.*?)" size="(\d+)X(\d+)"}(.*?){\/creative_popup}/s','<span class="cfg_popup_link" popup_id="$1" w="$2" h="$3">$4</span>', $txt);
	}
	if(in_array('heading',$process_types_array)) {
		$txt = preg_replace('/{heading}(.*?){\/heading}/s','<div class="contactformgenerator_heading '.$wpcfg_heading_text_font_effect.'"><div class="contactformgenerator_heading_inner">$1</div></div>', $txt);
	}

	return $txt;
}
function cfg_print_fields_array_html($field_data,$form_id) {
	global $wpdb;
	global $wpcfg_field_index;
	global $wpcfg_section_width;
	global $wpcfg_heading_text_font_effect;

	$types_array = cfg_get_types_array($form_id);
	$form_data = cfg_get_form_data($form_id);
	
	//Get variables////////////////////////////////////////////////////////////////////////////////////////////////////

	$module_id = 0;
	$templateid = $form_data["id_template"];
	$styles_row = $form_data["styles"];
	
	$tooltip_style = get_rule_from_row(505,$styles_row);
	$tooltip_style = $tooltip_style == '' ? 'white' : $tooltip_style;

	$cfg_datepicker_style = get_rule_from_row(562,$styles_row);
	$cfg_datepicker_icon_style = get_rule_from_row(563,$styles_row);
	$cfg_global_icons_style = get_rule_from_row(589,$styles_row);


	$top_text_font_effect = get_rule_from_row(510,$styles_row);
	$wpcfg_heading_text_font_effect = get_rule_from_row(530,$styles_row);
	$pre_text_font_effect = get_rule_from_row(511,$styles_row);
	$label_text_font_effect = get_rule_from_row(512,$styles_row);
	$label_hover_text_font_effect = get_rule_from_row(513,$styles_row);
	$label_error_text_font_effect = get_rule_from_row(514,$styles_row);
	$send_font_effect = get_rule_from_row(515,$styles_row);
	$send_hover_font_effect = get_rule_from_row(516,$styles_row);

	// heading_text_font_effect = $heading_text_font_effect;


	$focus_anim_enabled = $label_text_font_effect == $label_hover_text_font_effect ? 0 : 1;
	$error_anim_enabled = $label_text_font_effect == $label_error_text_font_effect ? 0 : 1;

	//get user info
	global $current_user;
	$userRegistered =  $current_user->ID == 0 ? 0 : 1;
	wp_get_current_user();
	
	$wpcfg_username =  $current_user->user_login;
	$wpcfg_realname = $current_user->display_name;
	$wpcfg_user_email = $current_user->user_email;

	$is_textarea_exist = false;
	foreach($field_data as $field) {
		$field_f = array();
		foreach($field as $k => $f) {
			$field_f[$k] = $f;
		}
		$field = $field_f;
		$field_index = $wpcfg_field_index;

		$field_width = $field['width'] != '' ? 'style="width: '.$field['width'].' !important"' : '';
		$field_width_select = $field['width'] != '' ? $field['width'] : '';
		$field_margin = $field['field_margin_top'] != '' ? 'style="margin: '.$field['field_margin_top'].' !important"' : '';
		
		$field_name = stripslashes($field['name']);
		$field_name = cfg_process_txt($field_name,array('num','popup'));
		
		$field_tooltip_text = stripslashes($field['tooltip_text']);
		$field_type = strtolower(str_replace(' ','-',str_replace('-','',$field['type'])));
		$element_id = $field_type.'_'.$module_id.'_'.$field['id'];
		$required_classname = $field['required'] == 1 ? 'contactformgenerator_required' : '';
		$required_symbol = $field['required'] == 1 ? ' <span class="contactformgenerator_field_required">*</span>' : '';
		$predefined_value = $field_type == 'name' ? $wpcfg_username : ($field_type == 'email' ? $wpcfg_user_email : '');
		
		
		if($field_type == 'text-area') 
			$is_textarea_exist = true;
		//input html
		$input_type_text_arrays = array('text-input','name','address','email','phone','number','url');
		if(in_array($field_type,$input_type_text_arrays)) {
			$input_html = '<div class="contactformgenerator_input_element '.$required_classname.'"><div class="cfg_input_dummy_wrapper">';
			$input_html .= '<input class="cfg_'.$field_type.' '.$required_classname.' cfg_input_reset" pre_value="'.str_replace('"','',$predefined_value).'" value="'.str_replace('"','',$predefined_value).'" type="text" id="'.$element_id.'" name="contactformgenerator_fields['.$field_index.'][0]"></div></div>';
		}
		elseif($field_type == 'text-area') {
			$input_html = '<div class="contactformgenerator_input_element cfg_textarea_wrapper '.$required_classname.'"><div class="cfg_textarea_dummy_wrapper">';
			$input_html .= '<textarea class="cfg_textarea cfg_'.$field_type.' '.$required_classname.' cfg_textarea_reset" value="'.$predefined_value.'" cols="30" rows="15" id="'.$element_id.'" name="contactformgenerator_fields['.$field_index.'][0]"></textarea></div></div>';
		}
		// elseif(false) {
		elseif($field_type == 'select' || $field_type == 'multiple-select' || $field_type == 'radio' || $field_type == 'checkbox') {
			//get child options
			$query = "
						SELECT
							spo.name,
							spo.id,
							spo.value,
							spo.selected
						FROM
							`".$wpdb->prefix."cfg_form_options` spo
						WHERE spo.id_parent = '".$field['id']."'
						AND spo.showrow = '1'
						ORDER BY ";
						if($field['ordering_field'] == 0)
							$query .= "spo.ordering";
						else
							$query .= "spo.name";
			$childs_array = $wpdb->get_results($query,'ARRAY_A');

			if (sizeof($childs_array) > 0)
			{
				$childs_length = sizeof($childs_array);
				if($field_type == 'select' || $field_type == 'multiple-select') {
					$selected_count = 0;
					foreach ($childs_array as $key => $value)
					{
						if($value['selected'] == 1) {
							$selected_count= 1;
							break;
						}
					}
					$def_selection = $selected_count == 0 ? 'selected="selected"' : '';
					
					$show_search = $childs_length >= $field["select_show_search_after"] ? 'show' : 'hide';
					$scroll_after = (int)$field["select_show_scroll_after"] > 3 ? (int)$field["select_show_scroll_after"] : 3;
					
					$multile_info = $field_type == 'multiple-select' ? 'multiple="multiple"' : '';
					$multile_info_val = $field_type == 'multiple-select' ? '[]' : '';
					$input_html = '<select show_search="'.$show_search.'" scroll_after="'.$scroll_after.'" special_width="'.$field_width_select.'" select_no_match_text="'.stripslashes(str_replace('"','',$field["select_no_match_text"])).'" class="will_be_cfg_select '.$required_classname.'" '.$multile_info.' name="contactformgenerator_fields['.$field_index.'][0]'.$multile_info_val.'">';
					$input_html .= '<option '.$def_selection.' class="def_value" value="cfg_empty">'.$field["select_default_text"].'</option>';
					$selected = '';
					$pre_val='';
					$seted_value = false;
					foreach ($childs_array as $key => $value)
					{
						if(!$seted_value && $field_type == 'select' && $value['selected'] == '1') {
							$selected = 'selected="selected"';
							$pre_val = 'pre_val="selected"';
							$seted_value = true;
						}
						elseif($field_type == 'multiple-select'  &&  $value['selected'] == '1') {
							$selected = 'selected="selected"';
							$pre_val = 'pre_val="selected"';
						}
						else {
							$selected = '';
							$pre_val = '';
						}
						
						$input_html .= '<option id="'.$module_id.'_'.$field["id"].'_'.$value["id"].'" value="'.stripslashes(str_replace('"','',$value["value"])).'" '.$selected.' '.$pre_val.'>'.stripslashes($value["name"]).'</option>';
					}
					$input_html .= '</select>';
				}
				elseif($field_type == 'radio' || $field_type == 'checkbox') {

					$input_html = '';
					$colors_array = array("black","blue","red","litegreen","yellow","liteblue","green","crimson","litecrimson");
					$selected = '';
					$pre_val='';
					$seted_value = false;
					foreach ($childs_array as $key => $value)
					{
						if($field_type == 'radio' && !$seted_value && $value['selected'] == '1') {
							$selected = 'checked="checked"';
							$pre_val = 'pre_val="checked"';
							$seted_value = true;
						}
						elseif($field_type == 'checkbox'  &&  $value['selected'] == '1') {
							$selected = 'checked="checked"';
						$pre_val = 'pre_val="checked"';	 											
						}
						else {
							$selected = '';
						$pre_val = '';	 											
						}
						
						$data_color_index = $key % 8;

						$current_label = stripslashes($value["name"]);
						$current_label = cfg_process_txt($current_label,array('num','popup'));
						
						$label_class = $field['show_parent_label'] == 0 ? 'without_parent_label' : '';
						$req_symbol = ($field['show_parent_label'] == 0 && $key == 0) ? $required_symbol : '';
						$input_html .= '<div class="cfg_checkbox_wrapper centered"><div class="answer_name"><label uniq_index="'.$module_id.'_'.$field["id"].'_'.$value["id"].'" class="cs_label '.$label_class.'"><span class="cfg_checkbox_label_wrapper">'.$current_label.' '.$req_symbol.'</span></label></div>';
						$input_html .= '<div class="answer_input">';
						
						if($field_type == 'radio')
							$input_html .= '<input '.$selected.' '.$pre_val.' id="'.$module_id.'_'.$field["id"].'_'.$value["id"].'" type="radio" class="cfg_ch_r_element cfgform_cs_styled elem_'.$module_id.'_'.$field["id"].'" value="'.stripslashes(str_replace('"','',$value["value"])).'" uniq_index="elem_'.$module_id.'_'.$field["id"].'" name="remove_this_partcontactformgenerator_fields['.$field_index.'][0]" data-color="'.$colors_array[$data_color_index].'" />';
						else
							$input_html .= '<input '.$selected.' '.$pre_val.' id="'.$module_id.'_'.$field["id"].'_'.$value["id"].'" type="checkbox" class="cfg_ch_r_element cfgform_cs_styled" value="'.stripslashes(str_replace('"','',$value["value"])).'" name="contactformgenerator_fields['.$field_index.'][0][]" data-color="'.$colors_array[$data_color_index].'" />';
						
						$input_html .= '</div></div><div class="cfg_clear"></div>';
					}
				}
			}
			else {
				$input_html = 'There are no options to be shown.';
			}
		}

		$hidden_field_types = array('file-upload','captcha','custom-html','heading','google-maps','google-recaptcha','contact-data','social-links','creative-popup');
		if(!in_array($field_type,$hidden_field_types)) {
			$input_html .= '<input type="hidden" name="contactformgenerator_fields['.$field_index.'][1]" value="'.stripslashes(str_replace('"','',$field_name)).'" />';
			$input_html .= '<input type="hidden" name="contactformgenerator_fields['.$field_index.'][2]" value="'.$field_type.'" />';
		}
		
		//start printing html
		$radio_checkbox_class = ($field_type == 'radio' || $field_type == 'checkbox' || $field_type == 'file-upload') ? 'cfg_'.$field_type : '';
		$radio_checkbox_req_class = ($field_type == 'radio' || $field_type == 'checkbox'  || $field_type == 'file-upload') ? $required_classname : '';

		if($field_type == 'radio' || $field_type == 'checkbox' || $field_type == 'file-upload' || $field_type == 'captcha') {
			$box_inner_class = $is_textarea_exist ? 'contactformgenerator_field_box_textarea_inner' : 'contactformgenerator_field_box_inner';
		}
		else {
			$box_inner_class = $field_type == 'text-area' ? 'contactformgenerator_field_box_textarea_inner' : 'contactformgenerator_field_box_inner';

		}

		//start printing boxes
		$wrapper_id = $field_type == 'google-recaptcha' ? $element_id : '';
		$field_box_style = $field_type == 'creative-popup' ? 'style="display: none"' : '';
			echo '<div '.$field_box_style.' id="'.$wrapper_id.'" '.$field_margin.' class="contactformgenerator_field_box cfg_hidden_animation_block_state1 cfg_timing_'.$field_index.' cfg_timing_'.$field_type.' '.$radio_checkbox_class.' '.$radio_checkbox_req_class.'"><div '.$field_width.' class="'.$box_inner_class.'">';
				$show_label = ($field['show_parent_label'] == 0 || $field_type == 'heading') ? 'style="display:none !important"' : '';
				echo '<label normal_effect_class="'.$label_text_font_effect.'" hover_effect_class="'.$label_hover_text_font_effect.'" error_effect_class="'.$label_error_text_font_effect.'" class="contactformgenerator_field_name '.$label_text_font_effect.'" for="'.$element_id.'" '.$show_label.'><span class="cfg_label_txt_wrapper">'.$field_name;
				if($field_type == 'captcha')
					echo ' <span class="contactformgenerator_field_required">*</span></label>';
				else	
					echo $required_symbol.'</span></label>';
				echo $input_html;
			echo '</div></div>';
		// echo '</div>';
		
		// $this->field_index ++;
		$wpcfg_field_index ++;
	}
}

function wpcfg_make_statistics() {
	if(!file_exists(ABSPATH.PLUGINDIR.'/contact-form-generator/wpcfg.log') and is_writable(ABSPATH.PLUGINDIR.'/contact-form-generator')) 
	{
		// send domain, for usage statistics 
		// this will run only once

		$domain = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		if (strpos($domain, '/wp-admin/') !== false || strpos($domain, '/wp-json/') !== false) 
		{
			return;
		}

		$context = stream_context_create(array('ssl'=>array(
		    'verify_peer' => false
		)));
		
		$fh = @fopen('https://creative-solutions.net/make-statistics?ext=cfg-wp&domain='.$domain, 'r', false, $context);
		@fclose($fh);

		$fh = fopen(ABSPATH.PLUGINDIR.'/contact-form-generator/wpcfg.log', 'a');
		fclose($fh);
	}
}

function wpcfg_render_html($form_id)
{
	global $wpdb;
	global $wpcfg_token;

	wpcfg_make_statistics();

	$browser_data = cfg_getBrowser();
	$browser = $browser_data["name"] . ' ' . $browser_data["version"];
	$op_s = cfg_getOS();

	$types_array = cfg_get_types_array($form_id);
	$form_data = cfg_get_form_data($form_id);
	$field_data = cfg_get_field_data($form_id);

	$module_id = 0;

	$templateid = $form_data["id_template"];
	$styles_row = $form_data["styles"];

	$tooltip_style = get_rule_from_row(505,$styles_row);
	$tooltip_style = $tooltip_style == '' ? 'white' : $tooltip_style;

	$scrollbar_popup_style = get_rule_from_row(629,$styles_row);
	$scrollbar_popup_style = $scrollbar_popup_style == '' ? 'inset-2-dark' : $scrollbar_popup_style;
	$scrollbar_content_style = get_rule_from_row(630,$styles_row);
	$scrollbar_content_style = $scrollbar_content_style == '' ? 'inset-2-dark' : $scrollbar_content_style;
	$custom_js = get_last_rule_from_row(628,$styles_row);

	$cfg_global_icons_style = get_rule_from_row(589,$styles_row);
	$cfg_sections_icons_style = get_rule_from_row(552,$styles_row);

	$top_text_font_effect = get_rule_from_row(510,$styles_row);
	$heading_text_font_effect = get_rule_from_row(530,$styles_row);
	$pre_text_font_effect = get_rule_from_row(511,$styles_row);
	$label_text_font_effect = get_rule_from_row(512,$styles_row);
	$label_hover_text_font_effect = get_rule_from_row(513,$styles_row);
	$label_error_text_font_effect = get_rule_from_row(514,$styles_row);
	$send_font_effect = get_rule_from_row(515,$styles_row);
	$send_hover_font_effect = get_rule_from_row(516,$styles_row);

	$focus_anim_enabled = $label_text_font_effect == $label_hover_text_font_effect ? 0 : 1;
	$error_anim_enabled = $label_text_font_effect == $label_error_text_font_effect ? 0 : 1;

	$cfg_google_link = '';

	$REMOTE_ADDR = cfg_get_ip();

	$toptxt = $form_data["top_text"];
	$pretxt = stripcslashes($form_data["pre_text"]);
	$pretxt = cfg_process_txt($pretxt,array('num','popup'));

	$form_width = $form_data["form_width"];
	$custom_css = $form_data["custom_css"];

	$thank_you_text = htmlspecialchars($form_data["thank_you_text"],ENT_QUOTES);
	$send_text = htmlspecialchars($form_data["send_text"],ENT_QUOTES);
	$send_new_text = htmlspecialchars($form_data["send_new_text"],ENT_QUOTES);
	$close_alert_text = htmlspecialchars($form_data["close_alert_text"],ENT_QUOTES);

	//send copy options
	$send_copy_enable= (int) $form_data["send_copy_enable"];
	$send_copy_text=htmlspecialchars($form_data["send_copy_text"],ENT_QUOTES);

	//strat rendering html///////////////////////////////////////////////////////////////////////////////////////////////
	ob_start();
	if(sizeof($field_data) > 0 && $form_data["published"] == 1) {
		?>
		<?php echo $cfg_google_link;?>
		<div class="contactformgenerator_wrapper cfg_wrapper_animation_state_1 cfg_form_<?php echo $form_id;?> cfg_icon_<?php echo $cfg_global_icons_style;?> cfg_sections_template_<?php echo $cfg_sections_icons_style;?>" <?php if($form_width != '') { echo 'style="width: '.$form_width.' !important"'; }?> focus_anim_enabled="<?php echo $focus_anim_enabled;?>" error_anim_enabled="<?php echo $error_anim_enabled;?>" scrollbar_popup_style="<?php echo $scrollbar_popup_style;?>"  scrollbar_content_style="<?php echo $scrollbar_content_style;?>">
			<div class="contactformgenerator_wrapper_inner">
			<div class="contactformgenerator_loading_wrapper"><table style="border: none;width: 100%;height: 100%"><tr><td align="center" style="text-align: center;" valign="middle"><img src="<?php echo plugin_dir_url( __FILE__ ).'/assets/images/ajax-loader.gif';?>" /></td></tr></table></div>
 			
 			<div class="contactformgenerator_header cfg_header_animation_state_1">
	 			<div class="contactformgenerator_title <?php echo $top_text_font_effect;?>"><?php echo $toptxt;?></div>
	 			<?php if($pretxt != '') {?><div class="contactformgenerator_pre_text <?php echo $pre_text_font_effect;?>"><?php echo $pretxt;?></div><?php }?>
 			</div>
				<form class="contactformgenerator_form">
	 			<div class="contactformgenerator_body cfg_body_animation_state_1">
				 		<?php 
		 				if(sizeof($field_data) > 0) {
		 				// if(false) {

	 						// split data
	 						$fields_final_array = array();
	 						$k = 0;
	 						$separate_col_0 = false;
	 						$separate_col_12 = false;
	 						foreach($field_data as $field) {
	 							$column_type = $field->column_type;
	 							if($column_type != 0) {
	 								if($separate_col_12) {
	 									$k ++;
	 									$separate_col_12 = false;
	 								}

	 								$fields_final_array[$k][$column_type][] = $field;
	 								$separate_col_0 = true;
	 							}
	 							else {
	 								if($separate_col_0) {
	 									$k ++;
	 									$separate_col_0 = false;
	 								}

	 								$fields_final_array[$k][$column_type][] = $field;
 									$separate_col_12 = true;

	 							}
	 						}
	 						foreach($fields_final_array as $k => $field_columns_array) {
	 							// print both columns
	 							if(isset($field_columns_array['0'])) {
		 							//print right column
		 							echo '<div class="contactformgenerator_clear"></div><div class="cfg_field_box_wrapper cfg_field_box_wrapper_0 cfg_field_box_animation_state_1">';
		 								if(isset($field_columns_array['0'])) {
		 									cfg_print_fields_array_html($field_columns_array['0'],$form_id);
		 								}
		 							echo '</div>';
		 						}
	 						}

		 				}
		 				
		 				?>
					<div class="cfg_clear"></div>
	 			</div>
	 			<div class="contactformgenerator_footer cfg_footer_animation_state_1">
		 			<div class="contactformgenerator_submit_wrapper cfg_button_animation_state_1">
		 				<input type="button" value="<?php echo $send_text;?>" class="contactformgenerator_send <?php echo $send_font_effect;?>" roll="<?php echo $form_id;?>" normal_effect_class="<?php echo $send_font_effect;?>" hover_effect_class="<?php echo $send_hover_font_effect;?>"/>
		 				<input type="button" value="<?php echo $send_new_text;?>" class="contactformgenerator_send_new contactformgenerator_hidden <?php echo $send_font_effect;?>"  roll="<?php echo $form_id;?>" normal_effect_class="<?php echo $send_font_effect;?>" hover_effect_class="<?php echo $send_hover_font_effect;?>"/>
		 				<div class="contactformgenerator_clear"></div>
		 			</div>
		 			<div class="contactformgenerator_clear"></div>
		 			<input type="hidden" name="contactformgenerator_token" class="contactformgenerator_token" value="<?php echo $wpcfg_token;?>" />
		 			<input type="hidden" value="<?php echo $REMOTE_ADDR;?>"  name="contactformgenerator_ip" />
		 			<input type="hidden" value="<?php echo the_permalink();?>"  name="contactformgenerator_referrer" />
		 			<input type="hidden" value="<?php echo get_the_title();?>"  name="contactformgenerator_page_title" />
		 			<input type="hidden" value="<?php echo $browser;?>"  name="contactformgenerator_browser" />
		 			<input type="hidden" value="<?php echo $op_s;?>"  name="contactformgenerator_operating_system" />
		 			<input type="hidden" value="" class="cfg_sc_res"  name="contactformgenerator_sc_res" />
		 			<input type="hidden" value="<?php echo $module_id;?>" class="contactformgenerator_module_id" name="contactformgenerator_module_id" />
		 			<input type="hidden" value="<?php echo $form_id;?>" class="contactformgenerator_form_id" name="contactformgenerator_form_id" />
	 			</div>
 			</form>
 		</div>
 		</div>

 		<?php		
		// custom js
		if($custom_js != '') {
			$custom_js = str_replace('FORM_ID', $form_id, $custom_js);
			echo '<script type="text/javascript">(function($) {$(document).ready(function() {'.$custom_js.'})})(jQuery);</script>';
		}

	}
	else {
		echo 'Contact Form Generator: There is nothing to show!';
	}
	return $render_html = ob_get_clean();


}
?>