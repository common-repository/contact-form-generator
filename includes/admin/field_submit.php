<?php 
// no direct access!
defined('ABSPATH') or die("No direct access");

global $wpdb;
$id = (int) $_POST['id'];
$task = isset($_REQUEST['task']) ? $_REQUEST['task'] : '';

// 2.5.0 fix, security check
$cfg_token = isset($_REQUEST['cfg_token']) ? $_REQUEST['cfg_token'] : '';
if($cfg_token == "" || $cfg_token != $_SESSION["cfg_token"]) {
	$redirect = "admin.php?page=cfg_fields&error=1";
	header("Location: ".$redirect);
	exit();
}

$sql = "SELECT COUNT(id) FROM ".$wpdb->prefix."cfg_fields";
$count_fields = $wpdb->get_var($sql);

if($count_fields >= 5 && $id == 0) {
	$redirect = "admin.php?page=cfg_fields&error=1";
	header("Location: ".$redirect);
	exit();
}

$cfg_id_form = isset($_REQUEST['id_form']) ? (int)$_REQUEST['id_form'] : 0;
$id_form = $cfg_id_form;
$cfg_name = isset($_REQUEST['name']) ? sanitize_text_field($_REQUEST['name']) : '';
$cfg_tooltip_text =  isset($_REQUEST['tooltip_text']) ? sanitize_text_field($_REQUEST['tooltip_text']) : '';
$cfg_id_type = isset($_REQUEST['id_type']) ? (int)$_REQUEST['id_type'] : 0;
$cfg_published = isset($_REQUEST['published']) ? (int)$_REQUEST['published'] : 1;
$cfg_ordering_field = isset($_REQUEST['ordering_field']) ? (int)$_REQUEST['ordering_field'] : 0;
$cfg_required = isset($_REQUEST['required']) ? (int)$_REQUEST['required'] : 0;
$cfg_width = isset($_REQUEST['width']) ? sanitize_text_field($_REQUEST['width']) : '';
$cfg_field_margin_top = isset($_REQUEST['field_margin_top']) ? sanitize_text_field($_REQUEST['field_margin_top']) : '';
$cfg_select_show_scroll_after = isset($_REQUEST['select_show_scroll_after']) ? (int)$_REQUEST['select_show_scroll_after'] : 10;
$cfg_select_show_search_after = isset($_REQUEST['select_show_search_after']) ? (int)$_REQUEST['select_show_search_after'] : 10;
$cfg_show_parent_label = isset($_REQUEST['show_parent_label']) ? (int)$_REQUEST['show_parent_label'] : 1;
$cfg_select_default_text = isset($_REQUEST['select_default_text']) ? sanitize_text_field($_REQUEST['select_default_text']) : '';
$cfg_select_no_match_text = isset($_REQUEST['select_no_match_text']) ? sanitize_text_field($_REQUEST['select_no_match_text']) : '';
$cfg_upload_button_text = isset($_REQUEST['upload_button_text']) ? sanitize_text_field($_REQUEST['upload_button_text']) : '';
$cfg_upload_minfilesize = isset($_REQUEST['upload_minfilesize']) ? sanitize_text_field($_REQUEST['upload_minfilesize']) : '';
$cfg_upload_maxfilesize = isset($_REQUEST['upload_maxfilesize']) ? sanitize_text_field($_REQUEST['upload_maxfilesize']) : '';
$cfg_upload_acceptfiletypes = isset($_REQUEST['upload_acceptfiletypes']) ? sanitize_text_field($_REQUEST['upload_acceptfiletypes']) : '';
$cfg_upload_minfilesize_message = isset($_REQUEST['upload_minfilesize_message']) ? sanitize_text_field($_REQUEST['upload_minfilesize_message']) : '';
$cfg_upload_maxfilesize_message = isset($_REQUEST['upload_maxfilesize_message']) ? sanitize_text_field($_REQUEST['upload_maxfilesize_message']) : '';
$cfg_upload_acceptfiletypes_message = isset($_REQUEST['upload_acceptfiletypes_message']) ? sanitize_text_field($_REQUEST['upload_acceptfiletypes_message']) : '';
$cfg_captcha_wrong_message = isset($_REQUEST['captcha_wrong_message']) ? sanitize_text_field($_REQUEST['captcha_wrong_message']) : '';
$cfg_datepicker_date_format = isset($_REQUEST['datepicker_date_format']) ? sanitize_text_field($_REQUEST['datepicker_date_format']) : '';
$cfg_datepicker_animation = isset($_REQUEST['datepicker_animation']) ? sanitize_text_field($_REQUEST['datepicker_animation']) : '';
$cfg_datepicker_style = isset($_REQUEST['datepicker_style']) ? (int)$_REQUEST['datepicker_style'] : 0;
$cfg_datepicker_icon_style = isset($_REQUEST['datepicker_icon_style']) ? (int)$_REQUEST['datepicker_icon_style'] : 0;
$cfg_datepicker_show_icon = isset($_REQUEST['datepicker_show_icon']) ? (int)$_REQUEST['datepicker_show_icon'] : 1;
$cfg_datepicker_input_readonly = isset($_REQUEST['datepicker_input_readonly']) ? (int)$_REQUEST['datepicker_input_readonly'] : 0;
$cfg_datepicker_number_months = isset($_REQUEST['datepicker_number_months']) ? (int)$_REQUEST['datepicker_number_months'] : 1;
$cfg_datepicker_mindate = isset($_REQUEST['datepicker_mindate']) ? sanitize_text_field($_REQUEST['datepicker_mindate']) : '';
$cfg_datepicker_maxdate = isset($_REQUEST['datepicker_maxdate']) ? sanitize_text_field($_REQUEST['datepicker_maxdate']) : '';
$cfg_datepicker_changemonths = isset($_REQUEST['datepicker_changemonths']) ? (int)$_REQUEST['datepicker_changemonths'] : 0;
$cfg_datepicker_changeyears = isset($_REQUEST['datepicker_changeyears']) ? (int)$_REQUEST['datepicker_changeyears'] : 0;
$cfg_column_type = isset($_REQUEST['column_type']) ? (int)$_REQUEST['column_type'] : 0;
$cfg_custom_html = isset($_REQUEST['wpcfg_custom_html']) ? sanitize_text_field($_REQUEST['wpcfg_custom_html']) : '';
$cfg_google_maps = isset($_REQUEST['google_maps']) ? sanitize_text_field($_REQUEST['google_maps']) : '';
$cfg_heading = isset($_REQUEST['heading']) ? sanitize_text_field($_REQUEST['heading']) : '';
$cfg_recaptcha_site_key = isset($_REQUEST['recaptcha_site_key']) ? sanitize_text_field($_REQUEST['recaptcha_site_key']) : '';
$cfg_recaptcha_security_key = isset($_REQUEST['recaptcha_security_key']) ? sanitize_text_field($_REQUEST['recaptcha_security_key']) : '';
$cfg_recaptcha_wrong_message = isset($_REQUEST['recaptcha_wrong_message']) ? sanitize_text_field($_REQUEST['recaptcha_wrong_message']) : '';
$cfg_recaptcha_theme = isset($_REQUEST['recaptcha_theme']) ? sanitize_text_field($_REQUEST['recaptcha_theme']) : '';
$cfg_recaptcha_type = isset($_REQUEST['recaptcha_type']) ? sanitize_text_field($_REQUEST['recaptcha_type']) : '';
$cfg_contact_data = isset($_REQUEST['contact_data']) ? sanitize_text_field($_REQUEST['contact_data']) : '';
$cfg_contact_data_width = isset($_REQUEST['contact_data_width']) ? (int)$_REQUEST['contact_data_width'] : 120;
$cfg_creative_popup = isset($_REQUEST['creative_popup']) ? sanitize_text_field($_REQUEST["creative_popup"]) : '';
$cfg_creative_popup_embed = isset($_REQUEST['creative_popup_embed']) ? sanitize_text_field($_REQUEST["creative_popup_embed"]) : '';


if($cfg_id_type == 13 || $cfg_id_type == 19) { // for captchas, set required to yes
	$cfg_required = 1;
}
if($cfg_id_type == 16 || $cfg_id_type == 17 || $cfg_id_type == 18 || $cfg_id_type == 20 || $cfg_id_type == 21) { // disable field name showing
	$cfg_show_parent_label = 0;
}

// if($id == 0 && $count_fields < 5 && $cfg_id_type != 13 && $cfg_id_type != 14) {
if($id == 0) {
	$sql = "SELECT MAX(`ordering`) FROM `".$wpdb->prefix."cfg_fields` WHERE `id_form` = ". (int) $_POST['id_form'];
	$max_order = $wpdb->get_var($sql) + 1;

	$wpdb->query( $wpdb->prepare(
			"
			INSERT INTO ".$wpdb->prefix."cfg_fields
			( 
				`ordering`, `ordering_field`, `id_form`, `name`, `tooltip_text`, `id_type`, `published`, `required`, `width`, `field_margin_top`, `select_show_scroll_after`, `select_show_search_after`, `show_parent_label`, `select_default_text`, `select_no_match_text`, `upload_button_text`, `upload_minfilesize`, `upload_maxfilesize`, `upload_acceptfiletypes`, `upload_minfilesize_message`, `upload_maxfilesize_message`, `upload_acceptfiletypes_message`, `captcha_wrong_message`, `datepicker_date_format`, `datepicker_animation`, `datepicker_style`, `datepicker_icon_style`, `datepicker_show_icon`, `datepicker_input_readonly`, `datepicker_number_months`, `datepicker_mindate`, `datepicker_maxdate`, `datepicker_changemonths`, `datepicker_changeyears`, `column_type`, `custom_html`, `google_maps`, `heading`, `recaptcha_site_key`, `recaptcha_security_key`, `recaptcha_wrong_message`, `recaptcha_theme`, `recaptcha_type`, `contact_data`, `contact_data_width`, `creative_popup`, `creative_popup_embed` 
			)
			VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s )
			",
			$max_order, $cfg_ordering_field, $cfg_id_form, $cfg_name, $cfg_tooltip_text, $cfg_id_type, $cfg_published, $cfg_required, $cfg_width, $cfg_field_margin_top, $cfg_select_show_scroll_after, $cfg_select_show_search_after, $cfg_show_parent_label, $cfg_select_default_text, $cfg_select_no_match_text, $cfg_upload_button_text, $cfg_upload_minfilesize, $cfg_upload_maxfilesize, $cfg_upload_acceptfiletypes, $cfg_upload_minfilesize_message, $cfg_upload_maxfilesize_message, $cfg_upload_acceptfiletypes_message, $cfg_captcha_wrong_message, $cfg_datepicker_date_format, $cfg_datepicker_animation, $cfg_datepicker_style, $cfg_datepicker_icon_style, $cfg_datepicker_show_icon, $cfg_datepicker_input_readonly, $cfg_datepicker_number_months, $cfg_datepicker_mindate, $cfg_datepicker_maxdate, $cfg_datepicker_changemonths, $cfg_datepicker_changeyears, $cfg_column_type, $cfg_custom_html, $cfg_google_maps, $cfg_heading, $cfg_recaptcha_site_key, $cfg_recaptcha_security_key, $cfg_recaptcha_wrong_message, $cfg_recaptcha_theme, $cfg_recaptcha_type, $cfg_contact_data, $cfg_contact_data_width, $cfg_creative_popup, $cfg_creative_popup_embed 
		) 
	);
	
	$insrtid = (int) $wpdb->insert_id;
	if($insrtid != 0) {
		if($task == 'save')
			$redirect = "admin.php?page=cfg_fields&act=edit&id=".$insrtid."&filter_form=".$id_form;
		elseif($task == 'save_new')
			$redirect = "admin.php?page=cfg_fields&act=new&filter_form=".$id_form;
		else
			$redirect = "admin.php?page=cfg_fields&filter_form=".$id_form;
	}
	else
		$redirect = "admin.php?page=cfg_forms&error=1&filter_form=".$id_form;
}


if($id != 0 && $task != 'save_copy') {
	
	$q = $wpdb->query( $wpdb->prepare(
			"
			UPDATE ".$wpdb->prefix."cfg_fields
			SET
				`id_form`= %s, `name`= %s, `tooltip_text`= %s, `id_type`= %s, `published`= %s, `ordering_field` = %s, `required`= %s, `width`= %s, `field_margin_top`= %s, `select_show_scroll_after`= %s, `select_show_search_after`= %s, `show_parent_label`= %s, `select_default_text`= %s, `select_no_match_text`= %s, `upload_button_text`= %s, `upload_minfilesize`= %s, `upload_maxfilesize`= %s, `upload_acceptfiletypes`= %s, `upload_minfilesize_message`= %s, `upload_maxfilesize_message`= %s, `upload_acceptfiletypes_message`= %s, `captcha_wrong_message`= %s, `datepicker_date_format`= %s, `datepicker_animation`= %s, `datepicker_style`= %s, `datepicker_icon_style`= %s, `datepicker_show_icon`= %s, `datepicker_input_readonly`= %s, `datepicker_number_months`= %s, `datepicker_mindate`= %s, `datepicker_maxdate`= %s, `datepicker_changemonths`= %s, `datepicker_changeyears`= %s, `column_type`= %s, `custom_html`= %s, `google_maps`= %s, `heading`= %s, `recaptcha_site_key`= %s, `recaptcha_security_key`= %s, `recaptcha_wrong_message`= %s, `recaptcha_theme`= %s, `recaptcha_type`= %s, `contact_data`= %s, `contact_data_width`= %s, `creative_popup`= %s, `creative_popup_embed`= %s 
			WHERE
				`id` = '".$id."'
			",
			$cfg_id_form, $cfg_name, $cfg_tooltip_text, $cfg_id_type, $cfg_published, $cfg_ordering_field, $cfg_required, $cfg_width, $cfg_field_margin_top, $cfg_select_show_scroll_after, $cfg_select_show_search_after, $cfg_show_parent_label, $cfg_select_default_text, $cfg_select_no_match_text, $cfg_upload_button_text, $cfg_upload_minfilesize, $cfg_upload_maxfilesize, $cfg_upload_acceptfiletypes, $cfg_upload_minfilesize_message, $cfg_upload_maxfilesize_message, $cfg_upload_acceptfiletypes_message, $cfg_captcha_wrong_message, $cfg_datepicker_date_format, $cfg_datepicker_animation, $cfg_datepicker_style, $cfg_datepicker_icon_style, $cfg_datepicker_show_icon, $cfg_datepicker_input_readonly, $cfg_datepicker_number_months, $cfg_datepicker_mindate, $cfg_datepicker_maxdate, $cfg_datepicker_changemonths, $cfg_datepicker_changeyears, $cfg_column_type, $cfg_custom_html, $cfg_google_maps, $cfg_heading, $cfg_recaptcha_site_key, $cfg_recaptcha_security_key, $cfg_recaptcha_wrong_message, $cfg_recaptcha_theme, $cfg_recaptcha_type, $cfg_contact_data, $cfg_contact_data_width, $cfg_creative_popup, $cfg_creative_popup_embed 
	) );

	if($q !== false) {
		if($task == 'save')
			$redirect = "admin.php?page=cfg_fields&act=edit&id=".$id."&filter_form=".$id_form;
		elseif($task == 'save_new')
			$redirect = "admin.php?page=cfg_fields&act=new&filter_form=".$id_form;
		else
			$redirect = "admin.php?page=cfg_fields&filter_form=".$id_form;
	}
	else {
		$redirect = "admin.php?page=cfg_fields&error=1&filter_form=".$id_form;
	}
}


if($id != 0 && $task == 'save_extra') {

    $q = $wpdb->query( $wpdb->prepare(
        "
			UPDATE ".$wpdb->prefix."cfg_fields
			SET
				`id_form`= %s, `name`= %s, `tooltip_text`= %s, `id_type`= %s, `published`= %s, `ordering_field` = %s, `required`= %s, `width`= %s, `field_margin_top`= %s, `select_show_scroll_after`= %s, `select_show_search_after`= %s, `show_parent_label`= %s, `select_default_text`= %s, `select_no_match_text`= %s, `upload_button_text`= %s, `upload_minfilesize`= %s, `upload_maxfilesize`= %s, `upload_acceptfiletypes`= %s, `upload_minfilesize_message`= %s, `upload_maxfilesize_message`= %s, `upload_acceptfiletypes_message`= %s, `captcha_wrong_message`= %s, `datepicker_date_format`= %s, `datepicker_animation`= %s, `datepicker_style`= %s, `datepicker_icon_style`= %s, `datepicker_show_icon`= %s, `datepicker_input_readonly`= %s, `datepicker_number_months`= %s, `datepicker_mindate`= %s, `datepicker_maxdate`= %s, `datepicker_changemonths`= %s, `datepicker_changeyears`= %s, `column_type`= %s, `custom_html`= %s, `google_maps`= %s, `heading`= %s, `recaptcha_site_key`= %s, `recaptcha_security_key`= %s, `recaptcha_wrong_message`= %s, `recaptcha_theme`= %s, `recaptcha_type`= %s, `contact_data`= %s, `contact_data_width`= %s, `creative_popup`= %s, `creative_popup_embed`= %s 
			WHERE
				`id` = '".$id."'
			",
        $cfg_id_form, $cfg_name, $cfg_tooltip_text, $cfg_id_type, $cfg_published, $cfg_ordering_field, $cfg_required, $cfg_width, $cfg_field_margin_top, $cfg_select_show_scroll_after, $cfg_select_show_search_after, $cfg_show_parent_label, $cfg_select_default_text, $cfg_select_no_match_text, $cfg_upload_button_text, $cfg_upload_minfilesize, $cfg_upload_maxfilesize, $cfg_upload_acceptfiletypes, $cfg_upload_minfilesize_message, $cfg_upload_maxfilesize_message, $cfg_upload_acceptfiletypes_message, $cfg_captcha_wrong_message, $cfg_datepicker_date_format, $cfg_datepicker_animation, $cfg_datepicker_style, $cfg_datepicker_icon_style, $cfg_datepicker_show_icon, $cfg_datepicker_input_readonly, $cfg_datepicker_number_months, $cfg_datepicker_mindate, $cfg_datepicker_maxdate, $cfg_datepicker_changemonths, $cfg_datepicker_changeyears, $cfg_column_type, $cfg_custom_html, $cfg_google_maps, $cfg_heading, $cfg_recaptcha_site_key, $cfg_recaptcha_security_key, $cfg_recaptcha_wrong_message, $cfg_recaptcha_theme, $cfg_recaptcha_type, $cfg_contact_data, $cfg_contact_data_width, $cfg_creative_popup, $cfg_creative_popup_embed
    ) );

    if($q !== false) {
        if($task == 'save')
            $redirect = "admin.php?page=cfg_fields&act=edit&id=".$id."&filter_form=".$id_form;
        elseif($task == 'save_new')
            $redirect = "admin.php?page=cfg_fields&act=new&filter_form=".$id_form;
        else
            $redirect = "admin.php?page=cfg_fields&filter_form=".$id_form;
    }
    else {
        $redirect = "admin.php?page=cfg_fields&error=1&filter_form=".$id_form;
    }
}


header("Location: ".$redirect);
exit();
?>