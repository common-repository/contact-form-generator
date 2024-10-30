<?php 
// no direct access!
defined('ABSPATH') or die("No direct access");

global $wpdb;

$id = intval($id);

if($id != 0) {
//get the rows
$sql = "SELECT * FROM ".$wpdb->prefix."cfg_fields WHERE id = '".$id."'";
$row = $wpdb->get_row($sql);
}

//get types
$types_sql = "SELECT `id`, `name` FROM `".$wpdb->prefix."cfg_field_types`";
$type_rows = $wpdb->get_results($types_sql);
//get forms
$forms_sql = "SELECT `id`, `name`, `id_template` FROM `".$wpdb->prefix."cfg_forms` order by `ordering`,`name` ";
$forms_rows = $wpdb->get_results($forms_sql);

//set variables
$wpcfg_name = $id == 0 || $row->name == '' ? '' : esc_html($row->name);
$wpcfg_id_form = $id == 0 || $row->id_form == '' ? 0 : esc_html($row->id_form);
$wpcfg_id_type = $id == 0 || $row->id_type == '' ? 1 : esc_html($row->id_type);
$wpcfg_required = $id == 0 || $row->required == '' ? 1 : esc_html($row->required);
$wpcfg_status = $id == 0 || $row->published == '' ? '1' : intval($row->published);
$wpcfg_width = $id == 0 || $row->width == '' ? '' : esc_html($row->width);
$wpcfg_ordering_field = $id == 0 || $row->ordering_field == '' ? 0 : esc_html($row->ordering_field);
$wpcfg_show_parent_label = $id == 0 || $row->show_parent_label == '' ? 1 : intval($row->show_parent_label);
$wpcfg_select_default_text = $id == 0 || $row->select_default_text == '' ? 'Select' : esc_html($row->select_default_text);
$wpcfg_select_no_match_text = $id == 0 || $row->select_no_match_text == '' ? 'No results match' : esc_html($row->select_no_match_text);
$wpcfg_select_show_scroll_after = $id == 0 || $row->select_show_scroll_after == 0 ? 10 : intval($row->select_show_scroll_after);
$wpcfg_select_show_search_after = $id == 0 || $row->select_show_search_after == 0 ? 10 : intval($row->select_show_search_after);
$wpcfg_upload_button_text = $id == 0 || $row->upload_button_text == '' ? 'Select files...' : esc_html($row->upload_button_text);
$wpcfg_upload_minfilesize = $id == 0 || $row->upload_minfilesize == 0 ? 1 : intval($row->upload_minfilesize);
$wpcfg_upload_maxfilesize = $id == 0 || $row->upload_maxfilesize == 0 ? 5 : intval($row->upload_maxfilesize);
$wpcfg_upload_acceptfiletypes = $id == 0 || $row->upload_acceptfiletypes == '' ? 'jpg|jpeg|png|gif|pdf|doc|docx|ppt|pptx|odt|avi|ogg|m4a|mov|mp3|mp4|mpg|wav|wmv|zip|rar|7z' : esc_html($row->upload_acceptfiletypes);
$wpcfg_upload_minfilesize_message = $id == 0 || $row->upload_minfilesize_message == '' ? 'File is too small' : esc_html($row->upload_minfilesize_message);
$wpcfg_upload_maxfilesize_message = $id == 0 || $row->upload_maxfilesize_message == '' ? 'File size exceeds the maximum allowed size (5 MB)' : esc_html($row->upload_maxfilesize_message);
$wpcfg_upload_acceptfiletypes_message = $id == 0 || $row->upload_acceptfiletypes_message == '' ? 'Invalid file format' : esc_html($row->upload_acceptfiletypes_message);
$wpcfg_captcha_wrong_message = $id == 0 || $row->captcha_wrong_message == '' ? 'Security code is not correct' : esc_html($row->captcha_wrong_message);

$wpcfg_tooltip_text = $id == 0 ? '' : esc_html($row->tooltip_text);
$wpcfg_field_margin_top = $id == 0 ? '' : esc_html($row->field_margin_top);
$wpcfg_column_type = $id == 0 ? 0 : esc_html($row->column_type);
$wpcfg_datepicker_date_format = $id == 0 ? '' : esc_html($row->datepicker_date_format);
$wpcfg_datepicker_animation = $id == 0 ? '' : esc_html($row->datepicker_animation);
$wpcfg_datepicker_style = $id == 0 ? 1 : esc_html($row->datepicker_style);
$wpcfg_datepicker_icon_style = $id == 0 ? 1 : esc_html($row->datepicker_icon_style);
$wpcfg_datepicker_show_icon = $id == 0 ? 1 : esc_html($row->datepicker_show_icon);
$wpcfg_datepicker_input_readonly = $id == 0 ? 0 : esc_html($row->datepicker_input_readonly);
$wpcfg_datepicker_number_months = $id == 0 ? 1 : esc_html($row->datepicker_number_months);
$wpcfg_datepicker_mindate = $id == 0 ? '' : esc_html($row->datepicker_mindate);
$wpcfg_datepicker_maxdate = $id == 0 ? '' : esc_html($row->datepicker_maxdate);
$wpcfg_datepicker_changemonths = $id == 0 ? 0 : esc_html($row->datepicker_changemonths);
$wpcfg_datepicker_changeyears = $id == 0 ? 0 : esc_html($row->datepicker_changeyears);
$wpcfg_custom_html = $id == 0 ? '' : esc_html($row->custom_html);
$wpcfg_heading = $id == 0 ? '' : esc_html($row->heading);
$wpcfg_google_maps = $id == 0 ? '' : esc_html($row->google_maps);
$wpcfg_recaptcha_site_key = $id == 0 ? '' : esc_html($row->recaptcha_site_key);
$wpcfg_recaptcha_security_key = $id == 0 ? '' : esc_html($row->recaptcha_security_key);
$wpcfg_recaptcha_wrong_message = $id == 0 ? 'Security code is not correct' : esc_html($row->recaptcha_wrong_message);
$wpcfg_recaptcha_theme = $id == 0 ? '' : esc_html($row->recaptcha_theme);
$wpcfg_recaptcha_type = $id == 0 ? '' : esc_html($row->recaptcha_type);
$wpcfg_contact_data = $id == 0 ? '' : esc_html($row->contact_data);
$wpcfg_contact_data_width = $id == 0 ? 120 : esc_html($row->contact_data_width);
$wpcfg_creative_popup = $id == 0 ? '' : esc_html($row->creative_popup);
$wpcfg_creative_popup_embed = $id == 0 ? '' : esc_html($row->creative_popup_embed);

$filter_form = (isset($_REQUEST['filter_form']) && (int) $_REQUEST['filter_form'] != 0) ? (int) $_REQUEST['filter_form'] : $wpcfg_id_form;

?>
<?php 
$sql = "SELECT COUNT(id) FROM ".$wpdb->prefix."cfg_fields";
$count_fields = $wpdb->get_var($sql);
if($id == 0 && $count_fields >= 5) {
	?>
	<div style="color: rgb(235, 9, 9);font-size: 16px;font-weight: bold;">Please Upgrade to PRO Version to have more than 5 Fields!</div>
	<div id="cpanel" style="float: left;">
		<div class="icon" style="float: right;">
			<a href="http://creative-solutions.net/wordpress/creative-contact-form" target="_blank" title="Buy PRO version">
				<table style="width: 100%;height: 100%;text-decoration: none;">
					<tr>
						<td align="center" valign="middle">
							<img src="<?php echo plugins_url( '../images/shopping_cart.png' , __FILE__ );?>" /><br />
							Buy Pro Version
						</td>
					</tr>
				</table>
			</a>
		</div>
	</div>
	<div style="font-style: italic;font-size: 12px;color: #949494;clear: both;">Updrading to PRO is easy, and will take only <u style="color: rgb(44, 66, 231);font-weight: bold;">5 minutes!</u></div>
	<?php 
}
else {
?>
<form action="admin.php?page=cfg_forms&act=cfg_submit_data&holder=fields" method="post" id="wpcfg_form">
<div style="overflow: hidden;margin: 0 0 10px 0;float: right;">
	<div style="float:right;">
		<button  id="wpcfg_form_save" class="button-primary">Save</button>
		<?php if($id != 0){?>
		<button id="wpcfg_form_save_close" class="button">Save & Close</button>
		<button id="wpcfg_form_save_new" class="button">Save & New</button>
		<button id="wpcfg_form_save_copy" class="button">Save as Copy</button>
		<?php }?>
		<a href="admin.php?page=cfg_fields&filter_form=<?php echo $filter_form; ?>"  class="button"><?php echo $t = $id == 0 ? 'Cancel' : 'Close';?></a>
	</div>
</div>
<?php if($id == 0 ) {?><h3 style="font-size: 16px;font-weight: normal;font-style: italic;">Field options are based on field type. Choose desired <u>type</u>, anc click <u>Save</u>.</h3><?php } ?>
<table class="wpcfg_table">
	<tr>
		<td colspan="2" style="">
			<h3 style="margin-top: 5px;">Basic Options</h3>
		</td>
	</tr>
	<tr>
		<td style="width: 180px;"><label for="wpcfg_name" title="Contact Box Name">Name <span style="color: red">*</span></label></td>
		<td><input name="name" id="wpcfg_name" type="text" value="<?php echo $wpcfg_name;?>" class="required" /></td>	
	</tr>
	<?php if(in_array($wpcfg_id_type, array("1","2","3","4","5","6","7","8","15")) && $id != 0) {?>
	<tr>
		<td><label for="wpcfg_tooltip_text" title="This text will appear in creative tooltip, when user focus this element.">Toltip Text<span style="font-size: 12px;color: rgb(221, 0, 0);font-style: italic;text-decoration: underline;display: inline-block;margin-left: 5px;">Pro Version</span></label></td>
		<td><input name="tooltip_text" id="wpcfg_tooltip_text" type="text" value="<?php echo $wpcfg_tooltip_text;?>" class="" /></td>	
	</tr>
	<?php }?>
	<tr>
		<td><label for="wpcfg_id_form" title="Form">Form</label></td>
		<td>
			<select id="wpcfg_id_form" name="id_form">
				<?php 
					foreach($forms_rows as $form) {
						$selected = $form->id == $wpcfg_id_form ? 'selected="selected"' : '';
						echo '<option value="'.$form->id.'" '.$selected.'>'.$form->name.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<tr>
		<td><label for="wpcfg_id_type" title="Type">Type</label></td>
		<td>
			<select id="wpcfg_id_type" name="id_type">
				<?php 
					foreach($type_rows as $type) {
						$selected = $type->id == $wpcfg_id_type ? 'selected="selected"' : '';
						echo '<option value="'.$type->id.'" '.$selected.'>'.$type->name.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	
	<?php if($id != 0) {?>
	<tr>
		<td><label title="Set the columns wrapping type for this field" for="wpcfg_column_type">Columns Wrapping</label></td>
		<td>
			<select id="wpcfg_column_type" name="column_type">
				<?php 
				$col_types = array("0"=>"Both Columns", "1"=>"Left Column : PRO feature","2"=>"Right Column : PRO feature");
					foreach($col_types as $k => $col_type) {
						$selected = $k == $wpcfg_column_type ? 'selected="selected"' : '';
						echo '<option value="'.$k.'" '.$selected.'>'.$col_type.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<?php }?>

	<?php if(in_array($wpcfg_id_type, array("1","2","3","4","5","6","7","8","9","10","11","12","14","15")) && $id != 0) {?>
	<tr>
		<td><label title="Required">Required</label></td>
		<td style="padding-top: 5px;">
			<label for="wpcfg_required_yes">Yes</label>
			<input id="wpcfg_required_yes" type="radio" name="required" value="1" <?php if($wpcfg_required == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpcfg_required_no">No</label>
			<input id="wpcfg_required_no" type="radio" name="required" value="0"  <?php if($wpcfg_required == 0) echo 'checked="checked"';?>/>
		</td>	
	</tr>
	<?php }?>
	<?php if($id != 0) {?>
	<tr>
		<td><label title="Status">Status</label></td>
		<td>
			<label for="wpcfg_status_yes">Published</label>
			<input id="wpcfg_status_yes" type="radio" name="published" value="1" <?php if($wpcfg_status == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpcfg_status_no">Unpublished</label>
			<input id="wpcfg_status_no" type="radio" name="published" value="0"  <?php if($wpcfg_status == 0) echo 'checked="checked"';?>/>
		</td>	
	</tr>
	<?php }?>

	<?php if(!in_array($wpcfg_id_type,array(11,12,13,14)) && $id != 0) {?>
	<!-- width -->
	<tr>
		<td><label for="wpcfg_width" title="Field width in pixels, or percents. Example: 100% or 450px. If empty, template rule will be used">Width</label></td>
		<td><input name="width" id="wpcfg_width" type="text" value="<?php echo $wpcfg_width;?>" /></td>	
	</tr>
	<?php }?>
	<?php if($id != 0) {?>
	<!-- margin -->
	<tr>
		<td><label for="wpcfg_margin" title="Margin of this element. Use the following structure: TOP RIGHT BOTTOM LEFT. If empty, the default 0px 0px 10px 0px will be used(margin-botom is 10px, all other are 0px). Can be used to easily move element. EXAMPLE: -5px 0px 10px 0px">Margin</label></td>
		<td><input name="field_margin_top" id="wpcfg_margin" type="text" value="<?php echo $wpcfg_field_margin_top;?>" /></td>	
	</tr>
	<?php }?>
	
	<?php if(in_array($wpcfg_id_type,array(9,10,11,12))) {?>
	<tr>
		<td colspan="2" style="height: 10px;">
			<h3>Option parameters</h3>
		</td>
	</tr>
	<!-- ordering_field -->
	<tr>
		<td><label title="Order option by...">Options ordering</label></td>
		<td>
			<label for="wpcfg_ordering_field_yes">Custom</label>
			<input id="wpcfg_ordering_field_yes" type="radio" name="ordering_field" value="0" <?php if($wpcfg_ordering_field == 0) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpcfg_ordering_field_no">Name</label>
			<input id="wpcfg_ordering_field_no" type="radio" name="ordering_field" value="1"  <?php if($wpcfg_ordering_field == 1) echo 'checked="checked"';?>/>
		</td>	
	</tr>
	<?php }?>
	<?php if(in_array($wpcfg_id_type,array(9,10,11,12,14,15,16,18,19,20))) {?>
	<!-- show_parent_label -->
	<tr>
		<td><label title="Show the label for field element, or just show the options">Show field name</label></td>
		<td>
			<label for="wpcfg_show_parent_label_yes">No</label>
			<input id="wpcfg_show_parent_label_yes" type="radio" name="show_parent_label" value="0" <?php if($wpcfg_show_parent_label == 0) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpcfg_show_parent_label_no">Yes</label>
			<input id="wpcfg_show_parent_label_no" type="radio" name="show_parent_label" value="1"  <?php if($wpcfg_show_parent_label == 1) echo 'checked="checked"';?>/>
		</td>	
	</tr>
	<?php }?>
	
	<?php if(in_array($wpcfg_id_type,array(9,10))) {?>
	<!-- select_default_text -->
	<tr>
		<td><label for="wpcfg_select_default_text" title="Select tag default text. When none of options is selected">Select tag default text</label></td>
		<td><input name="select_default_text" id="wpcfg_select_default_text" type="text" value="<?php echo $wpcfg_select_default_text;?>" /></td>	
	</tr>
	<!-- select_no_match_text -->
	<tr>
		<td><label for="wpcfg_select_no_match_text" title="Select tag search text, when no results to be shown">No results match text</label></td>
		<td><input name="select_no_match_text" id="wpcfg_select_no_match_text" type="text" value="<?php echo $wpcfg_select_no_match_text;?>" /></td>	
	</tr>
	<!-- select_show_scroll_after -->
	<tr>
		<td><label for="wpcfg_select_show_scroll_after" title="Show scrolling after this count of options">Show scroll after</label></td>
		<td><input name="select_show_scroll_after" id="wpcfg_select_show_scroll_after" type="text" value="<?php echo $wpcfg_select_show_scroll_after;?>" /></td>	
	</tr>
	<!-- select_show_search_after -->
	<tr>
		<td><label for="wpcfg_select_show_search_after" title="Show search after this count of options">Show search after</label></td>
		<td><input name="select_show_search_after" id="wpcfg_select_show_search_after" type="text" value="<?php echo $wpcfg_select_show_search_after;?>" /></td>	
	</tr>
	<?php }?>
	
	<?php if($wpcfg_id_type == 14) {?>
	<!-- upload_button_text -->
	<tr>
		<td colspan="2" style="">
			<h3 style="">Upload Options</h3>
		</td>
	</tr>
	<tr>
		<td><label for="wpcfg_upload_button_text" title="Upload button text">Upload button text</label></td>
		<td><input name="upload_button_text" id="wpcfg_upload_button_text" type="text" value="<?php echo $wpcfg_upload_button_text;?>" /></td>	
	</tr>
	<!-- upload_minfilesize -->
	<tr>
		<td><label for="wpcfg_upload_minfilesize" title="The min allowed upload size in bytes. 1KB = 1024 bytes, 1MB = 1024 KB">Upload min size (in bytes)</label></td>
		<td><input name="upload_minfilesize" id="wpcfg_upload_minfilesize" type="text" value="<?php echo $wpcfg_upload_minfilesize;?>" /></td>	
	</tr>
	<!-- upload_maxfilesize -->
	<tr>
		<td><label for="wpcfg_upload_maxfilesize" title="The max allowed upload size in MegaBytes">Upload max size (in MB)</label></td>
		<td><input name="upload_maxfilesize" id="wpcfg_upload_maxfilesize" type="text" value="<?php echo $wpcfg_upload_maxfilesize;?>" /></td>	
	</tr>
	<!-- upload_acceptfiletypes -->
	<tr>
		<td><label for="wpcfg_upload_acceptfiletypes" title="Seperated with vertical bar |">Accepted file types</label></td>
		<td><input name="upload_acceptfiletypes" id="wpcfg_upload_acceptfiletypes" type="text" value="<?php echo $wpcfg_upload_acceptfiletypes;?>" /></td>	
	</tr>
	<!-- upload_minfilesize_message -->
	<tr>
		<td><label for="wpcfg_upload_minfilesize_message" title="Min size error message">Min size error message</label></td>
		<td><input name="upload_minfilesize_message" id="wpcfg_upload_minfilesize_message" type="text" value="<?php echo $wpcfg_upload_minfilesize_message;?>" /></td>	
	</tr>
	<!-- upload_maxfilesize_message -->
	<tr>
		<td><label for="wpcfg_upload_maxfilesize_message" title="Max size error message">Max size error message</label></td>
		<td><input name="upload_maxfilesize_message" id="wpcfg_upload_maxfilesize_message" type="text" value="<?php echo $wpcfg_upload_maxfilesize_message;?>" /></td>	
	</tr>
	<!-- upload_acceptfiletypes_message -->
	<tr>
		<td><label for="wpcfg_upload_acceptfiletypes_message" title="Invalid type error message">Invalid type error message</label></td>
		<td><input name="upload_acceptfiletypes_message" id="wpcfg_upload_acceptfiletypes_message" type="text" value="<?php echo $wpcfg_upload_acceptfiletypes_message;?>" /></td>	
	</tr>
	<?php }?>
	
	
	<?php if($wpcfg_id_type == 13) {?>
	<!-- captcha_wrong_message -->
	<tr>
		<td colspan="2" style="">
			<h3 style="">Captcha Options</h3>
		</td>
	</tr>
	<tr>
		<td><label for="wpcfg_captcha_wrong_message" title="Wrong captcha message">Wrong captcha message</label></td>
		<td><input name="captcha_wrong_message" id="wpcfg_captcha_wrong_message" type="text" value="<?php echo $wpcfg_captcha_wrong_message;?>" /></td>	
	</tr>
	<?php }?>	

	<?php if($wpcfg_id_type == 16) {?>
	<!-- Custom html -->
	<tr>
		<td colspan="2" style="">
			<h3 style="">Custom Html</h3>
		</td>
	</tr>
	<tr>
		<td valign="top"><label for="wpcfg_custom_html" title="Custom Html">Custom Html</label></td>
		<td>
			<?php  wp_editor( $wpcfg_custom_html, "wpcfg_custom_html" );?>
		</td>	
	</tr>
	<?php }?>

	<?php if($wpcfg_id_type == 15) {?>
	<!-- Datepicker -->
	<tr>
		<td colspan="2" style="">
			<h3 style="">Datepicker Options</h3>
		</td>
	</tr>
	<tr>
		<td><label for="wpcfg_datepicker_date_format" title="Date Format">Date Format</label></td>
		<td>
			<select id="wpcfg_datepicker_date_format" name="datepicker_date_format">
				<?php 
				$cfg_opts = array("mm/dd/yy"=>"Default - mm/dd/yy", "yy-mm-dd"=>"ISO 8601 - yy-mm-dd","dd/mm/yy"=>"Custom - dd/mm/yy","d M, yy"=>"Short - d M, yy","d MM, yy"=>"Medium - d MM, yyn","DD, d MM, yy"=>"Full - DD, d MM, yy");
					foreach($cfg_opts as $k => $cfg_opt) {
						$selected = $k == $wpcfg_datepicker_date_format ? 'selected="selected"' : '';
						echo '<option value="'.$k.'" '.$selected.'>'.$cfg_opt.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<tr>
		<td><label for="wpcfg_datepicker_animation" title="Animation">Animation</label></td>
		<td>
			<select id="wpcfg_datepicker_animation" name="datepicker_animation">
				<?php 
				$cfg_opts = array("show"=>"Show (Default)","slideDown"=>"Slide Down","fadeIn"=>"FadeIn","blind"=>"Blind (UI Effect)","bounce"=>"Bounce (UI Effect)","clip"=>"Clip (UI Effect)","drop"=>"Drop (UI Effect)","fold"=>"Fold (UI Effect)","slide"=>"Slide (UI Effect)");
					foreach($cfg_opts as $k => $cfg_opt) {
						$selected = $k == $wpcfg_datepicker_animation ? 'selected="selected"' : '';
						echo '<option value="'.$k.'" '.$selected.'>'.$cfg_opt.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>	
	<tr>
		<td><label for="wpcfg_datepicker_show_icon" title="Show Date Icon">Show Date Icon</label></td>
		<td>
			<select id="wpcfg_datepicker_show_icon" name="datepicker_show_icon">
				<?php 
				$cfg_opts = array("0"=>"No","1"=>"Yes");
					foreach($cfg_opts as $k => $cfg_opt) {
						$selected = $k == $wpcfg_datepicker_show_icon ? 'selected="selected"' : '';
						echo '<option value="'.$k.'" '.$selected.'>'.$cfg_opt.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<tr>
		<td><label for="wpcfg_datepicker_input_readonly" title="If YES, datepicker will be opened onclick of input">Input Readonly</label></td>
		<td>
			<select id="wpcfg_datepicker_input_readonly" name="datepicker_input_readonly">
				<?php 
				$cfg_opts = array("0"=>"No","1"=>"Yes");
					foreach($cfg_opts as $k => $cfg_opt) {
						$selected = $k == $wpcfg_datepicker_input_readonly ? 'selected="selected"' : '';
						echo '<option value="'.$k.'" '.$selected.'>'.$cfg_opt.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<tr>
		<td><label for="wpcfg_datepicker_changemonths" title="Allow to change months in datepicker">Change Months</label></td>
		<td>
			<select id="wpcfg_datepicker_changemonths" name="datepicker_changemonths">
				<?php 
				$cfg_opts = array("0"=>"No","1"=>"Yes");
					foreach($cfg_opts as $k => $cfg_opt) {
						$selected = $k == $wpcfg_datepicker_changemonths ? 'selected="selected"' : '';
						echo '<option value="'.$k.'" '.$selected.'>'.$cfg_opt.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<tr>
		<td><label for="wpcfg_datepicker_changeyears" title="Allow to change years in datepicker">Change Years</label></td>
		<td>
			<select id="wpcfg_datepicker_changeyears" name="datepicker_changeyears">
				<?php 
				$cfg_opts = array("0"=>"No","1"=>"Yes");
					foreach($cfg_opts as $k => $cfg_opt) {
						$selected = $k == $wpcfg_datepicker_changeyears ? 'selected="selected"' : '';
						echo '<option value="'.$k.'" '.$selected.'>'.$cfg_opt.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<tr>
		<td><label for="wpcfg_datepicker_number_months" title="Number of Months in datepicker">Number of Months</label></td>
		<td><input name="datepicker_number_months" id="wpcfg_datepicker_number_months" type="text" value="<?php echo $wpcfg_datepicker_number_months;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_datepicker_mindate" title="Set the beginning and end dates as a numeric offset from today (-20), or as a string of periods and units ('+1M +10D'). For the last, use 'D' for days, 'W' for weeks, 'M' for months, or 'Y' for years.">MIN Date</label></td>
		<td><input name="datepicker_mindate" id="wpcfg_datepicker_mindate" type="text" value="<?php echo $wpcfg_datepicker_mindate;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_datepicker_maxdate" title="Set the beginning and end dates as a numeric offset from today (-20), or as a string of periods and units ('+1M +10D'). For the last, use 'D' for days, 'W' for weeks, 'M' for months, or 'Y' for years.">MAX Date</label></td>
		<td><input name="datepicker_maxdate" id="wpcfg_datepicker_maxdate" type="text" value="<?php echo $wpcfg_datepicker_maxdate;?>" /></td>	
	</tr>
	<?php }?>
	<?php if($wpcfg_id_type == 17) {?>
	<!-- Heading -->
	<tr>
		<td colspan="2" style="">
			<h3 style="">Heading Options</h3>
		</td>
	</tr>
	<tr>
		<td><label for="wpcfg_heading" title="Heading Content">Heading Content</label></td>
		<td><textarea name="heading" id="wpcfg_heading" ><?php echo $wpcfg_heading;?></textarea></td>	
	</tr>
	<?php }?>

	<?php if($wpcfg_id_type == 18) {?>
	<!-- Google Maps -->
	<tr>
		<td colspan="2" style="">
			<h3 style="">Google Maps Options</h3>
			<a style="font-size: 14px;font-style: italic;" href="https://www.google.com/maps" target="_blank">Create a basic map</a> or <a style="font-size: 14px;font-style: italic;" href="https://www.google.com/maps/d/?pli=1" target="_blank">Go to new maps.</a>
			<span style="font-size: 14px;font-style: italic;display: block;margin-top: 10px;margin-bottom: 15px;font-weight: normal;"><a href="http://creative-solutions.net/wordpress/contact-form-generator/documentation?section=google-maps" target="_blank">Read more in documentation!</a></span>
		</td>
	</tr>
	<tr>
		<td><label for="wpcfg_google_maps" title="Insert Google Maps code here.">Google Maps Code</label></td>
		<td><textarea name="google_maps" id="wpcfg_google_maps" ><?php echo $wpcfg_google_maps;?></textarea></td>	
	</tr>
	<?php }?>

	<?php if($wpcfg_id_type == 19) {?>
	<!-- Google ReCaptcha -->
	<tr>
		<td colspan="2" style="">
			<h3 style="">Google ReCaptcha Options</h3>
			<a style="font-size: 14px;font-style: italic;" href="https://www.google.com/recaptcha/intro/index.html" target="_blank">Get ReCapctha</a>
			<span style="font-size: 14px;font-style: italic;display: block;margin-top: 10px;margin-bottom: 15px;font-weight: normal;"><a href="http://creative-solutions.net/wordpress/contact-form-generator/documentation?section=google-recapctha" target="_blank">Read more in documentation!</a></span>
		</td>
	</tr>
	<tr>
		<td><label for="wpcfg_recaptcha_site_key" title="Site Key">Site Key</label></td>
		<td><input name="recaptcha_site_key" id="wpcfg_recaptcha_site_key" type="text" value="<?php echo $wpcfg_recaptcha_site_key;?>" /></td>
	</tr>
	<tr>
		<td><label for="wpcfg_recaptcha_security_key" title="Security Key">Security Key</label></td>
		<td><input name="recaptcha_security_key" id="wpcfg_recaptcha_security_key" type="text" value="<?php echo $wpcfg_recaptcha_security_key;?>" /></td>
	</tr>
	<tr>
		<td><label for="wpcfg_recaptcha_theme" title="Theme">Theme</label></td>
		<td>
			<select id="wpcfg_recaptcha_theme" name="recaptcha_theme">
				<?php 
				$cfg_opts = array("light"=>"Light","dark"=>"Dark");
					foreach($cfg_opts as $k => $cfg_opt) {
						$selected = $k == $wpcfg_recaptcha_theme ? 'selected="selected"' : '';
						echo '<option value="'.$k.'" '.$selected.'>'.$cfg_opt.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<tr>
		<td><label for="wpcfg_recaptcha_type" title="Type">Type</label></td>
		<td>
			<select id="wpcfg_recaptcha_type" name="recaptcha_type">
				<?php 
				$cfg_opts = array("image"=>"Image","audio"=>"Audio");
					foreach($cfg_opts as $k => $cfg_opt) {
						$selected = $k == $wpcfg_recaptcha_type ? 'selected="selected"' : '';
						echo '<option value="'.$k.'" '.$selected.'>'.$cfg_opt.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<?php }?>

	<?php if($wpcfg_id_type == 20) {?>
	<!-- Contact Data -->
	<tr>
		<td colspan="2" style="">
			<h3 style="">Contact Data Options</h3>

			<div style="margin-top: 10px;margin-bottom: 20px;">To add a section, use the following structure:<br>
				<span style="font-weight: bold;font-style: italic;margin-top: 5px;display: inline-block;">
					{section icon="<span style="color: rgb(0, 24, 192)">section_icon</span>" label="<span style="color: rgb(0, 24, 192)">section_label</span>"}<span style="color: rgb(215, 0, 0);">section_content</span>{/section}
				</span>
				<span style="display: block;margin-top: 5px;">
					<span style="color: rgb(155, 36, 36);font-weight: bold">Icon</span>: The icon of section. Possible values: <span style="font-style: italic;text-decoration: underline;font-weight: bold">address</span>, <span style="font-style: italic;text-decoration: underline;font-weight: bold">phone</span>, <span style="font-style: italic;text-decoration: underline;font-weight: bold">mobile</span>, <span style="font-style: italic;text-decoration: underline;font-weight: bold">fax</span>, <span style="font-style: italic;text-decoration: underline;font-weight: bold">email</span>, <span style="font-style: italic;text-decoration: underline;font-weight: bold">link</span>, <span style="font-style: italic;text-decoration: underline;font-weight: bold">tip</span>, <span style="font-style: italic;text-decoration: underline;font-weight: bold">info</span>, <span style="font-style: italic;text-decoration: underline;font-weight: bold">question</span>, <span style="font-style: italic;text-decoration: underline;font-weight: bold">map</span>.
				</span>
				<span style="display: block;margin-top: 2px;">
					<span style="color: rgb(155, 36, 36);font-weight: bold">Label</span>: The label of section. Width of section label can be configured through <u>Label Width</u> option.
				</span>
				<span style="display: block;margin-top: 2px;">
					<span style="color: rgb(155, 36, 36);font-weight: bold">Section Content</span>: The content of section. HTML is allowed! To apply number styling, use {num}{/num} structure. 
				</span>
				<span style="display: block;margin-top: 2px;">
					<span style="color: rgb(155, 36, 36);font-weight: bold">Example:</span>
					<span style="font-weight: bold;font-style: italic;">
						{section icon="<span style="color: rgb(0, 24, 192)">phone</span>" label="<span style="color: rgb(0, 24, 192)">Phone:</span>"}<span style="color: rgb(215, 0, 0);">+00 (0) 123 456 789</span>{/section}
					</span>
				</span>
			<span style="font-size: 14px;font-style: italic;display: block;margin-top: 10px;margin-bottom: 15px;font-weight: normal;"><a href="http://creative-solutions.net/wordpress/contact-form-generator/documentation?section=contact-data" target="_blank">Read more in documentation!</a></span>
			</div>
		</td>
	</tr>
	<tr>
		<td valign="top" ><label for="wpcfg_contact_data" title="Contact Data">Contact Data</label></td>
		<td><textarea name="contact_data" id="wpcfg_contact_data" style="height: 300px;"><?php echo $wpcfg_contact_data;?></textarea></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_contact_data_width" title="The width of section first column in pixels. Same for all sections in ceratin field.">Label Width (px)</label></td>
		<td><input name="contact_data_width" id="wpcfg_contact_data_width" type="text" value="<?php echo $wpcfg_contact_data_width;?>" /></td>
	</tr>
	<?php }?>

	<?php if($wpcfg_id_type == 21) {?>
	<!-- Creative Popup -->
	<tr>
		<td colspan="2" style="">
			<h3 style="">Popup Options</h3>
			<div style="margin-top: 10px;margin-bottom: 20px;">To use this popup, insert the following code where you need to add a popup link:<br>
				<span style="font-weight: bold;font-style: italic;margin-top: 5px;display: inline-block;">
					{creative_popup id="<span style="color: rgb(215, 0, 0);"><?php echo $id; ?></span>" size="800X600"}<span style="color: rgb(0, 24, 192)">Popup Link Text</span>{/creative_popup}
				</span>
				<span style="display: block;margin-top: 7px;">
					<span style="font-weight: normal">To use template heading use this code:<br></span>
					<span style="font-weight: bold;font-style: italic;">
						{heading}<span style="color: rgb(0, 24, 192);">heading text...</span>{/heading}
					</span>
				</span>
				<span style="display: block;margin-top: 7px;">
					<span style="font-weight: normal">To render sections use this code:<br></span>
					<span style="font-weight: bold;font-style: italic;">
						{section icon="<span style="color: rgb(215, 0, 0)">info</span>" label="<span style="color: rgb(215, 0, 0)">Info:</span>"}<span style="color: rgb(0, 24, 192);">content...</span>{/section}
					</span>
				</span>
				<span style="display:block;margin-top:5px;color:#777;font-size: 11px;"><b>Note:</b> Place popup fields at the end of form!</span>
				<span style="font-size: 14px;font-style: italic;display: block;margin-top: 10px;margin-bottom: 15px;font-weight: normal;"><a href="http://creative-solutions.net/wordpress/contact-form-generator/documentation?section=contact-data" target="_blank">Read more in documentation!</a></span>
			</div>
		</td>
	</tr>
	<tr>
		<td valign="top"><label for="wpcfg_creative_popup" title="Popup Content">Popup Content</label></td>
		<td><?php  wp_editor( $wpcfg_creative_popup, "creative_popup" );?></td>
	</tr>
	<tr>
		<td valign="top" ><label for="wpcfg_creative_popup_embed" title="Can be used for rendering google maps, youtube, vimeo or any other embed code! Will be inserted after Popup Content.">Popup Embed</label></td>
		<td><textarea name="creative_popup_embed" id="wpcfg_creative_popup_embed" style="height: 300px;"><?php echo $wpcfg_creative_popup_embed;?></textarea></td>	
	</tr>
	<?php }?>

</table>
<input type="hidden" name="task" value="" id="wpcfg_task">
<input type="hidden" name="id" value="<?php echo $id;?>" >
<input type="hidden" name="cfg_token" value="<?php echo $_SESSION["cfg_token"];?>" id="cfg_token">
</form>
<?php
//options
if(in_array($wpcfg_id_type,array(9,10,11,12))) {
	
	if(isset($_GET['load_countries'])) {
		$query = "
		SELECT
		spo.name,
		spo.id,
		spo.ordering,
		spo.showrow
		FROM
		`".$wpdb->prefix."cfg_form_options` spo
		WHERE spo.id_parent = '".$id."'";
		$childs_array_current = $wpdb->get_results($query);
	
		if (sizeof($childs_array_current) == 0) {
			$query =
			"
			INSERT INTO `".$wpdb->prefix."cfg_form_options` (`id`, `id_parent`, `name`, `value`, `ordering`, `showrow`, `selected`) VALUES
			(NULL, '".$id."', 'Afghanistan', 'Afghanistan', '0', '1', '0'),
			(NULL, '".$id."', 'Albania', 'Albania', '0', '1', '0'),
			(NULL, '".$id."', 'Algeria', 'Algeria', '0', '1', '0'),
			(NULL, '".$id."', 'American Samoa', 'American Samoa', '0', '1', '0'),
			(NULL, '".$id."', 'Andorra', 'Andorra', '0', '1', '0'),
			(NULL, '".$id."', 'Angola', 'Angola', '0', '1', '0'),
			(NULL, '".$id."', 'Anguilla', 'Anguilla', '0', '1', '0'),
			(NULL, '".$id."', 'Antarctica', 'Antarctica', '0', '1', '0'),
			(NULL, '".$id."', 'Antigua and Barbuda', 'Antigua and Barbuda', '0', '1', '0'),
			(NULL, '".$id."', 'Argentina', 'Argentina', '0', '1', '0'),
			(NULL, '".$id."', 'Armenia', 'Armenia', '0', '1', '0'),
			(NULL, '".$id."', 'Aruba', 'Aruba', '0', '1', '0'),
			(NULL, '".$id."', 'Australia', 'Australia', '0', '1', '0'),
			(NULL, '".$id."', 'Austria', 'Austria', '0', '1', '0'),
			(NULL, '".$id."', 'Azerbaijan', 'Azerbaijan', '0', '1', '0'),
			(NULL, '".$id."', 'Bahamas', 'Bahamas', '0', '1', '0'),
			(NULL, '".$id."', 'Bahrain', 'Bahrain', '0', '1', '0'),
			(NULL, '".$id."', 'Bangladesh', 'Bangladesh', '0', '1', '0'),
			(NULL, '".$id."', 'Barbados', 'Barbados', '0', '1', '0'),
			(NULL, '".$id."', 'Belarus', 'Belarus', '0', '1', '0'),
			(NULL, '".$id."', 'Belgium', 'Belgium', '0', '1', '0'),
			(NULL, '".$id."', 'Belize', 'Belize', '0', '1', '0'),
			(NULL, '".$id."', 'Benin', 'Benin', '0', '1', '0'),
			(NULL, '".$id."', 'Bermuda', 'Bermuda', '0', '1', '0'),
			(NULL, '".$id."', 'Bhutan', 'Bhutan', '0', '1', '0'),
			(NULL, '".$id."', 'Bolivia', 'Bolivia', '0', '1', '0'),
			(NULL, '".$id."', 'Bosnia and Herzegowina', 'Bosnia and Herzegowina', '0', '1', '0'),
			(NULL, '".$id."', 'Botswana', 'Botswana', '0', '1', '0'),
			(NULL, '".$id."', 'Bouvet Island', 'Bouvet Island', '0', '1', '0'),
			(NULL, '".$id."', 'Brazil', 'Brazil', '0', '1', '0'),
			(NULL, '".$id."', 'British Indian Ocean Territory', 'British Indian Ocean Territory', '0', '1', '0'),
			(NULL, '".$id."', 'Brunei Darussalam', 'Brunei Darussalam', '0', '1', '0'),
			(NULL, '".$id."', 'Bulgaria', 'Bulgaria', '0', '1', '0'),
			(NULL, '".$id."', 'Burkina Faso', 'Burkina Faso', '0', '1', '0'),
			(NULL, '".$id."', 'Burundi', 'Burundi', '0', '1', '0'),
			(NULL, '".$id."', 'Cambodia', 'Cambodia', '0', '1', '0'),
			(NULL, '".$id."', 'Cameroon', 'Cameroon', '0', '1', '0'),
			(NULL, '".$id."', 'Canada', 'Canada', '0', '1', '0'),
			(NULL, '".$id."', 'Cape Verde', 'Cape Verde', '0', '1', '0'),
			(NULL, '".$id."', 'Cayman Islands', 'Cayman Islands', '0', '1', '0'),
			(NULL, '".$id."', 'Central African Republic', 'Central African Republic', '0', '1', '0'),
			(NULL, '".$id."', 'Chad', 'Chad', '0', '1', '0'),
			(NULL, '".$id."', 'Chile', 'Chile', '0', '1', '0'),
			(NULL, '".$id."', 'China', 'China', '0', '1', '0'),
			(NULL, '".$id."', 'Christmas Island', 'Christmas Island', '0', '1', '0'),
			(NULL, '".$id."', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', '0', '1', '0'),
			(NULL, '".$id."', 'Colombia', 'Colombia', '0', '1', '0'),
			(NULL, '".$id."', 'Comoros', 'Comoros', '0', '1', '0'),
			(NULL, '".$id."', 'Congo', 'Congo', '0', '1', '0'),
			(NULL, '".$id."', 'Cook Islands', 'Cook Islands', '0', '1', '0'),
			(NULL, '".$id."', 'Costa Rica', 'Costa Rica', '0', '1', '0'),
			(NULL, '".$id."', 'Cote D\'Ivoire', 'Cote DIvoire', '0', '1', '0'),
			(NULL, '".$id."', 'Croatia', 'Croatia', '0', '1', '0'),
			(NULL, '".$id."', 'Cuba', 'Cuba', '0', '1', '0'),
			(NULL, '".$id."', 'Cyprus', 'Cyprus', '0', '1', '0'),
			(NULL, '".$id."', 'Czech Republic', 'Czech Republic', '0', '1', '0'),
			(NULL, '".$id."', 'Democratic Republic of Congo', 'Democratic Republic of Congo', '0', '1', '0'),
			(NULL, '".$id."', 'Denmark', 'Denmark', '0', '1', '0'),
			(NULL, '".$id."', 'Djibouti', 'Djibouti', '0', '1', '0'),
			(NULL, '".$id."', 'Dominica', 'Dominica', '0', '1', '0'),
			(NULL, '".$id."', 'Dominican Republic', 'Dominican Republic', '0', '1', '0'),
			(NULL, '".$id."', 'East Timor', 'East Timor', '0', '1', '0'),
			(NULL, '".$id."', 'Ecuador', 'Ecuador', '0', '1', '0'),
			(NULL, '".$id."', 'Egypt', 'Egypt', '0', '1', '0'),
			(NULL, '".$id."', 'El Salvador', 'El Salvador', '0', '1', '0'),
			(NULL, '".$id."', 'Equatorial Guinea', 'Equatorial Guinea', '0', '1', '0'),
			(NULL, '".$id."', 'Eritrea', 'Eritrea', '0', '1', '0'),
			(NULL, '".$id."', 'Estonia', 'Estonia', '0', '1', '0'),
			(NULL, '".$id."', 'Ethiopia', 'Ethiopia', '0', '1', '0'),
			(NULL, '".$id."', 'Falkland Islands (Malvinas)', 'Falkland Islands (Malvinas)', '0', '1', '0'),
			(NULL, '".$id."', 'Faroe Islands', 'Faroe Islands', '0', '1', '0'),
			(NULL, '".$id."', 'Fiji', 'Fiji', '0', '1', '0'),
			(NULL, '".$id."', 'Finland', 'Finland', '0', '1', '0'),
			(NULL, '".$id."', 'France', 'France', '0', '1', '0'),
			(NULL, '".$id."', 'France, Metropolitan', 'France, Metropolitan', '0', '1', '0'),
			(NULL, '".$id."', 'French Guiana', 'French Guiana', '0', '1', '0'),
			(NULL, '".$id."', 'French Polynesia', 'French Polynesia', '0', '1', '0'),
			(NULL, '".$id."', 'French Southern Territories', 'French Southern Territories', '0', '1', '0'),
			(NULL, '".$id."', 'Gabon', 'Gabon', '0', '1', '0'),
			(NULL, '".$id."', 'Gambia', 'Gambia', '0', '1', '0'),
			(NULL, '".$id."', 'Georgia', 'Georgia', '0', '1', '0'),
			(NULL, '".$id."', 'Germany', 'Germany', '0', '1', '0'),
			(NULL, '".$id."', 'Ghana', 'Ghana', '0', '1', '0'),
			(NULL, '".$id."', 'Gibraltar', 'Gibraltar', '0', '1', '0'),
			(NULL, '".$id."', 'Greece', 'Greece', '0', '1', '0'),
			(NULL, '".$id."', 'Greenland', 'Greenland', '0', '1', '0'),
			(NULL, '".$id."', 'Grenada', 'Grenada', '0', '1', '0'),
			(NULL, '".$id."', 'Guadeloupe', 'Guadeloupe', '0', '1', '0'),
			(NULL, '".$id."', 'Guam', 'Guam', '0', '1', '0'),
			(NULL, '".$id."', 'Guatemala', 'Guatemala', '0', '1', '0'),
			(NULL, '".$id."', 'Guinea', 'Guinea', '0', '1', '0'),
			(NULL, '".$id."', 'Guinea-bissau', 'Guinea-bissau', '0', '1', '0'),
			(NULL, '".$id."', 'Guyana', 'Guyana', '0', '1', '0'),
			(NULL, '".$id."', 'Haiti', 'Haiti', '0', '1', '0'),
			(NULL, '".$id."', 'Heard and Mc Donald Islands', 'Heard and Mc Donald Islands', '0', '1', '0'),
			(NULL, '".$id."', 'Honduras', 'Honduras', '0', '1', '0'),
			(NULL, '".$id."', 'Hong Kong', 'Hong Kong', '0', '1', '0'),
			(NULL, '".$id."', 'Hungary', 'Hungary', '0', '1', '0'),
			(NULL, '".$id."', 'Iceland', 'Iceland', '0', '1', '0'),
			(NULL, '".$id."', 'India', 'India', '0', '1', '0'),
			(NULL, '".$id."', 'Indonesia', 'Indonesia', '0', '1', '0'),
			(NULL, '".$id."', 'Iran', 'Iran', '0', '1', '0'),
			(NULL, '".$id."', 'Iraq', 'Iraq', '0', '1', '0'),
			(NULL, '".$id."', 'Ireland', 'Ireland', '0', '1', '0'),
			(NULL, '".$id."', 'Israel', 'Israel', '0', '1', '0'),
			(NULL, '".$id."', 'Italy', 'Italy', '0', '1', '0'),
			(NULL, '".$id."', 'Jamaica', 'Jamaica', '0', '1', '0'),
			(NULL, '".$id."', 'Japan', 'Japan', '0', '1', '0'),
			(NULL, '".$id."', 'Jordan', 'Jordan', '0', '1', '0'),
			(NULL, '".$id."', 'Kazakhstan', 'Kazakhstan', '0', '1', '0'),
			(NULL, '".$id."', 'Kenya', 'Kenya', '0', '1', '0'),
			(NULL, '".$id."', 'Kiribati', 'Kiribati', '0', '1', '0'),
			(NULL, '".$id."', 'Korea', 'Korea', '0', '1', '0'),
			(NULL, '".$id."', 'Kuwait', 'Kuwait', '0', '1', '0'),
			(NULL, '".$id."', 'Kyrgyzstan', 'Kyrgyzstan', '0', '1', '0'),
			(NULL, '".$id."', 'Lao People\'s Democratic Republic', 'Lao Peoples Democratic Republic', '0', '1', '0'),
			(NULL, '".$id."', 'Latvia', 'Latvia', '0', '1', '0'),
			(NULL, '".$id."', 'Lebanon', 'Lebanon', '0', '1', '0'),
			(NULL, '".$id."', 'Lesotho', 'Lesotho', '0', '1', '0'),
			(NULL, '".$id."', 'Liberia', 'Liberia', '0', '1', '0'),
			(NULL, '".$id."', 'Libyan Arab Jamahiriya', 'Libyan Arab Jamahiriya', '0', '1', '0'),
			(NULL, '".$id."', 'Liechtenstein', 'Liechtenstein', '0', '1', '0'),
			(NULL, '".$id."', 'Lithuania', 'Lithuania', '0', '1', '0'),
			(NULL, '".$id."', 'Luxembourg', 'Luxembourg', '0', '1', '0'),
			(NULL, '".$id."', 'Macau', 'Macau', '0', '1', '0'),
			(NULL, '".$id."', 'Macedonia', 'Macedonia', '0', '1', '0'),
			(NULL, '".$id."', 'Madagascar', 'Madagascar', '0', '1', '0'),
			(NULL, '".$id."', 'Malawi', 'Malawi', '0', '1', '0'),
			(NULL, '".$id."', 'Malaysia', 'Malaysia', '0', '1', '0'),
			(NULL, '".$id."', 'Maldives', 'Maldives', '0', '1', '0'),
			(NULL, '".$id."', 'Mali', 'Mali', '0', '1', '0'),
			(NULL, '".$id."', 'Malta', 'Malta', '0', '1', '0'),
			(NULL, '".$id."', 'Marshall Islands', 'Marshall Islands', '0', '1', '0'),
			(NULL, '".$id."', 'Martinique', 'Martinique', '0', '1', '0'),
			(NULL, '".$id."', 'Mauritania', 'Mauritania', '0', '1', '0'),
			(NULL, '".$id."', 'Mauritius', 'Mauritius', '0', '1', '0'),
			(NULL, '".$id."', 'Mayotte', 'Mayotte', '0', '1', '0'),
			(NULL, '".$id."', 'Mexico', 'Mexico', '0', '1', '0'),
			(NULL, '".$id."', 'Micronesia', 'Micronesia', '0', '1', '0'),
			(NULL, '".$id."', 'Moldova', 'Moldova', '0', '1', '0'),
			(NULL, '".$id."', 'Monaco', 'Monaco', '0', '1', '0'),
			(NULL, '".$id."', 'Mongolia', 'Mongolia', '0', '1', '0'),
			(NULL, '".$id."', 'Montserrat', 'Montserrat', '0', '1', '0'),
			(NULL, '".$id."', 'Morocco', 'Morocco', '0', '1', '0'),
			(NULL, '".$id."', 'Mozambique', 'Mozambique', '0', '1', '0'),
			(NULL, '".$id."', 'Myanmar', 'Myanmar', '0', '1', '0'),
			(NULL, '".$id."', 'Namibia', 'Namibia', '0', '1', '0'),
			(NULL, '".$id."', 'Nauru', 'Nauru', '0', '1', '0'),
			(NULL, '".$id."', 'Nepal', 'Nepal', '0', '1', '0'),
			(NULL, '".$id."', 'Netherlands', 'Netherlands', '0', '1', '0'),
			(NULL, '".$id."', 'Netherlands Antilles', 'Netherlands Antilles', '0', '1', '0'),
			(NULL, '".$id."', 'New Caledonia', 'New Caledonia', '0', '1', '0'),
			(NULL, '".$id."', 'New Zealand', 'New Zealand', '0', '1', '0'),
			(NULL, '".$id."', 'Nicaragua', 'Nicaragua', '0', '1', '0'),
			(NULL, '".$id."', 'Niger', 'Niger', '0', '1', '0'),
			(NULL, '".$id."', 'Nigeria', 'Nigeria', '0', '1', '0'),
			(NULL, '".$id."', 'Niue', 'Niue', '0', '1', '0'),
			(NULL, '".$id."', 'Norfolk Island', 'Norfolk Island', '0', '1', '0'),
			(NULL, '".$id."', 'North Korea', 'North Korea', '0', '1', '0'),
			(NULL, '".$id."', 'Northern Mariana Islands', 'Northern Mariana Islands', '0', '1', '0'),
			(NULL, '".$id."', 'Norway', 'Norway', '0', '1', '0'),
			(NULL, '".$id."', 'Oman', 'Oman', '0', '1', '0'),
			(NULL, '".$id."', 'Pakistan', 'Pakistan', '0', '1', '0'),
			(NULL, '".$id."', 'Palau', 'Palau', '0', '1', '0'),
			(NULL, '".$id."', 'Panama', 'Panama', '0', '1', '0'),
			(NULL, '".$id."', 'Papua New Guinea', 'Papua New Guinea', '0', '1', '0'),
			(NULL, '".$id."', 'Paraguay', 'Paraguay', '0', '1', '0'),
			(NULL, '".$id."', 'Peru', 'Peru', '0', '1', '0'),
			(NULL, '".$id."', 'Philippines', 'Philippines', '0', '1', '0'),
			(NULL, '".$id."', 'Pitcairn', 'Pitcairn', '0', '1', '0'),
			(NULL, '".$id."', 'Poland', 'Poland', '0', '1', '0'),
			(NULL, '".$id."', 'Portugal', 'Portugal', '0', '1', '0'),
			(NULL, '".$id."', 'Puerto Rico', 'Puerto Rico', '0', '1', '0'),
			(NULL, '".$id."', 'Qatar', 'Qatar', '0', '1', '0'),
			(NULL, '".$id."', 'Reunion', 'Reunion', '0', '1', '0'),
			(NULL, '".$id."', 'Romania', 'Romania', '0', '1', '0'),
			(NULL, '".$id."', 'Russian Federation', 'Russian Federation', '0', '1', '0'),
			(NULL, '".$id."', 'Rwanda', 'Rwanda', '0', '1', '0'),
			(NULL, '".$id."', 'Saint Kitts and Nevis', 'Saint Kitts and Nevis', '0', '1', '0'),
			(NULL, '".$id."', 'Saint Lucia', 'Saint Lucia', '0', '1', '0'),
			(NULL, '".$id."', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', '0', '1', '0'),
			(NULL, '".$id."', 'Samoa', 'Samoa', '0', '1', '0'),
			(NULL, '".$id."', 'San Marino', 'San Marino', '0', '1', '0'),
			(NULL, '".$id."', 'Sao Tome and Principe', 'Sao Tome and Principe', '0', '1', '0'),
			(NULL, '".$id."', 'Saudi Arabia', 'Saudi Arabia', '0', '1', '0'),
			(NULL, '".$id."', 'Senegal', 'Senegal', '0', '1', '0'),
			(NULL, '".$id."', 'Seychelles', 'Seychelles', '0', '1', '0'),
			(NULL, '".$id."', 'Sierra Leone', 'Sierra Leone', '0', '1', '0'),
			(NULL, '".$id."', 'Singapore', 'Singapore', '0', '1', '0'),
			(NULL, '".$id."', 'Slovak Republic', 'Slovak Republic', '0', '1', '0'),
			(NULL, '".$id."', 'Slovenia', 'Slovenia', '0', '1', '0'),
			(NULL, '".$id."', 'Solomon Islands', 'Solomon Islands', '0', '1', '0'),
			(NULL, '".$id."', 'Somalia', 'Somalia', '0', '1', '0'),
			(NULL, '".$id."', 'South Africa', 'South Africa', '0', '1', '0'),
			(NULL, '".$id."', 'South Georgia &amp; South Sandwich Islands', 'South Georgia & South Sandwich Islands', '0', '1', '0'),
			(NULL, '".$id."', 'Spain', 'Spain', '0', '1', '0'),
			(NULL, '".$id."', 'Sri Lanka', 'Sri Lanka', '0', '1', '0'),
			(NULL, '".$id."', 'St. Helena', 'St. Helena', '0', '1', '0'),
			(NULL, '".$id."', 'St. Pierre and Miquelon', 'St. Pierre and Miquelon', '0', '1', '0'),
			(NULL, '".$id."', 'Sudan', 'Sudan', '0', '1', '0'),
			(NULL, '".$id."', 'Suriname', 'Suriname', '0', '1', '0'),
			(NULL, '".$id."', 'Svalbard and Jan Mayen Islands', 'Svalbard and Jan Mayen Islands', '0', '1', '0'),
			(NULL, '".$id."', 'Swaziland', 'Swaziland', '0', '1', '0'),
			(NULL, '".$id."', 'Sweden', 'Sweden', '0', '1', '0'),
			(NULL, '".$id."', 'Switzerland', 'Switzerland', '0', '1', '0'),
			(NULL, '".$id."', 'Syrian Arab Republic', 'Syrian Arab Republic', '0', '1', '0'),
			(NULL, '".$id."', 'Taiwan', 'Taiwan', '0', '1', '0'),
			(NULL, '".$id."', 'Tajikistan', 'Tajikistan', '0', '1', '0'),
			(NULL, '".$id."', 'Tanzania', 'Tanzania', '0', '1', '0'),
			(NULL, '".$id."', 'Thailand', 'Thailand', '0', '1', '0'),
			(NULL, '".$id."', 'Togo', 'Togo', '0', '1', '0'),
			(NULL, '".$id."', 'Tokelau', 'Tokelau', '0', '1', '0'),
			(NULL, '".$id."', 'Tonga', 'Tonga', '0', '1', '0'),
			(NULL, '".$id."', 'Trinidad and Tobago', 'Trinidad and Tobago', '0', '1', '0'),
			(NULL, '".$id."', 'Tunisia', 'Tunisia', '0', '1', '0'),
			(NULL, '".$id."', 'Turkey', 'Turkey', '0', '1', '0'),
			(NULL, '".$id."', 'Turkmenistan', 'Turkmenistan', '0', '1', '0'),
			(NULL, '".$id."', 'Turks and Caicos Islands', 'Turks and Caicos Islands', '0', '1', '0'),
			(NULL, '".$id."', 'Tuvalu', 'Tuvalu', '0', '1', '0'),
			(NULL, '".$id."', 'Uganda', 'Uganda', '0', '1', '0'),
			(NULL, '".$id."', 'Ukraine', 'Ukraine', '0', '1', '0'),
			(NULL, '".$id."', 'United Arab Emirates', 'United Arab Emirates', '0', '1', '0'),
			(NULL, '".$id."', 'United Kingdom', 'United Kingdom', '0', '1', '0'),
			(NULL, '".$id."', 'United States', 'United States', '0', '1', '0'),
			(NULL, '".$id."', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', '0', '1', '0'),
			(NULL, '".$id."', 'Uruguay', 'Uruguay', '0', '1', '0'),
			(NULL, '".$id."', 'Uzbekistan', 'Uzbekistan', '0', '1', '0'),
			(NULL, '".$id."', 'Vanuatu', 'Vanuatu', '0', '1', '0'),
			(NULL, '".$id."', 'Vatican City State (Holy See)', 'Vatican City State (Holy See)', '0', '1', '0'),
			(NULL, '".$id."', 'Venezuela', 'Venezuela', '0', '1', '0'),
			(NULL, '".$id."', 'Viet Nam', 'Viet Nam', '0', '1', '0'),
			(NULL, '".$id."', 'Virgin Islands (British)', 'Virgin Islands (British)', '0', '1', '0'),
			(NULL, '".$id."', 'Virgin Islands (U.S.)', 'Virgin Islands (U.S.)', '0', '1', '0'),
			(NULL, '".$id."', 'Wallis and Futuna Islands', 'Wallis and Futuna Islands', '0', '1', '0'),
			(NULL, '".$id."', 'Western Sahara', 'Western Sahara', '0', '1', '0'),
			(NULL, '".$id."', 'Yemen', 'Yemen', '0', '1', '0'),
			(NULL, '".$id."', 'Yugoslavia', 'Yugoslavia', '0', '1', '0'),
			(NULL, '".$id."', 'Zambia', 'Zambia', '0', '1', '0'),
			(NULL, '".$id."', 'Zimbabwe', 'Zimbabwe', '0', '1', '0')
			";
			$wpdb->query($query);
		}
			
	}
echo '<div style="margin: 2px;">';
	$query = "
				SELECT
					spo.name,
					spo.id,
					spo.ordering,
					spo.showrow
				FROM
					`".$wpdb->prefix."cfg_form_options` spo
				WHERE spo.id_parent = '".$id."'
				ORDER BY ";
	if($wpcfg_ordering_field == 0)
		$query .= "spo.ordering";
	else
		$query .= "spo.name";
	$childs_array = $wpdb->get_results($query);
	
	echo '<H3 style="margin-top: 0px;">Options</H3>';
	
	echo '<div class="options_wrapper">';
	
		echo '<div class="menus_header">';
			echo  '<img src="'.plugins_url( "../images/new_page.gif" , __FILE__ ).'" class="new_submenu_img" title="New Option" menu_id="'.$id.'" />';
			if (sizeof($childs_array) == 0) {
				echo  '<img src="'.plugins_url( "../images/country.png" , __FILE__ ).'" class="load_countries_data" title="Load countries data? (239 countries)" />';
			}
		echo '</div>';
		
		$disabled_ordering = $wpcfg_ordering_field == 1 ? 'disabledordering' : '';

		echo '<div class="menu_tree">';
		echo '<ul id="sortable_menu">';
		if (sizeof($childs_array) > 0)
		{
			foreach ($childs_array as $key => $value)
			{
				$show = $value->showrow;
				$class = " ui-state-default text";
				$show_class = $show == 1 ? 'hide' : 'show';
				$show_title = $show == 0 ? 'Publish option' : 'Unpublish option';
				
				echo '<li class="'.$class.'" id="option_li_'.$value->id.'">';
					echo '<div class="option_item" id="option_'.$value->id.'">'.$value->name.'</div>';
					echo '<div class="menu_moove '.$disabled_ordering.'" title="Move option" >&nbsp;</div>';
					echo '<div id="edit_'.$value->id.'" menu_id="'.$value->id.'" class="edit" title="Edit option" >&nbsp;</div>';
					echo '<div id="showrow_'.$value->id.'" menu_id="'.$value->id.'" class="'.$show_class.'" title="'.$show_title.'" >&nbsp;</div>';
					echo '<div id="remove_'.$value->id.'" menu_id="'.$value->id.'" class="delete" title="Delete option" >&nbsp;</div>';
				echo '</li>';
			}
		}
		echo '</ul>';
		echo '</div>';
	echo '</div>';
}
?>
<div id="edit_menu_data" style="display: none;">
	<div id="ajax_loader">&nbsp;</div>
	<div id="dialog_inner_wrapper"></div>
	<input type="hidden" value="" id="menu_id" />
</div>
</div>
<?php }?>

<?php if ($id == 0): ?>
<script type="text/javascript">
	var filet_form = <?php echo $filter_form; ?>;
	document.getElementById("wpcfg_id_form").value = filet_form;
</script>
<?php endif ?>

<style type="text/css">
	#wpfooter {
		display: none !important;
	}
</style>