<?php 
// no direct access!
defined('ABSPATH') or die("No direct access");

global $wpdb;

$id = intval($id);

if($id != 0) {
//get the rows
$sql = "SELECT * FROM ".$wpdb->prefix."cfg_forms WHERE id = '".$id."'";
$row = $wpdb->get_row($sql);
}

//set variables
$wpcfg_name = $id == 0 ? '' : esc_html($row->name);
$wpcfg_top_text = $id == 0 ? '' : esc_html($row->top_text);
$wpcfg_pre_text = $id == 0 ? '' : esc_html($row->pre_text);
$wpcfg_thank_you_text = $id == 0 ? 'Message successfully sent' : esc_html($row->thank_you_text);
$wpcfg_send_text = $id == 0 ? 'Send' : esc_html($row->send_text);
$wpcfg_send_new_text = $id == 0 ? 'New email' : esc_html($row->send_new_text);
$wpcfg_close_alert_text = $id == 0 ? 'Close' : esc_html($row->close_alert_text);
$wpcfg_form_width = $id == 0 ? '100%' : esc_html($row->form_width);
$wpcfg_id_template = $id == 0 ? '1' : intval($row->id_template);
$wpcfg_redirect = $id == 0 ? '0' : intval($row->redirect);
$wpcfg_redirect_itemid = $id == 0 ? '' : intval($row->redirect_itemid);
$wpcfg_redirect_url = $id == 0 ? '' : esc_url($row->redirect_url);
$wpcfg_redirect_delay = $id == 0 ? '' : intval($row->redirect_delay);
$wpcfg_send_copy_enable = $id == 0 ? '1' : intval($row->send_copy_enable);
$wpcfg_send_copy_text = $id == 0 ? 'Send me a copy' : esc_html($row->send_copy_text);
$wpcfg_email_to = $id == 0 ? '' : esc_html($row->email_to);
$wpcfg_email_bcc = $id == 0 ? '' : esc_html($row->email_bcc);
$wpcfg_email_subject = $id == 0 ? '' : esc_html($row->email_subject);
$wpcfg_email_from = $id == 0 ? '' : esc_html($row->email_from);
$wpcfg_email_from_name = $id == 0 ? '' : esc_html($row->email_from_name);
$wpcfg_email_replyto = $id == 0 ? '' : esc_html($row->email_replyto);
$wpcfg_email_replyto_name = $id == 0 ? '' : esc_html($row->email_replyto_name);
$wpcfg_shake_count = $id == 0 ? '2' : intval($row->shake_count);
$wpcfg_shake_distanse = $id == 0 ? '10' : intval($row->shake_distanse);
$wpcfg_shake_duration = $id == 0 ? '300' : intval($row->shake_duration);
$wpcfg_status = $id == 0 ? '1' : intval($row->published);
$wpcfg_show_back = $id == 0 ? '1' : intval($row->show_back);

$wpcfg_custom_css = $id == 0 ? '' : $row->custom_css;
$wpcfg_email_info_show_referrer = $id == 0 ? 1 : intval($row->email_info_show_referrer);
$wpcfg_email_info_show_ip = $id == 0 ? 1 : intval($row->email_info_show_ip);
$wpcfg_email_info_show_browser = $id == 0 ? 1 : intval($row->email_info_show_browser);
$wpcfg_email_info_show_os = $id == 0 ? 1 : intval($row->email_info_show_os);
$wpcfg_email_info_show_sc_res = $id == 0 ? 1 : intval($row->email_info_show_sc_res);

//getbtemplate sarray
$sql = "SELECT name, id FROM ".$wpdb->prefix."cfg_templates";
$templates = $wpdb->get_results($sql);
?>
<?php $args = array(
	'sort_order' => 'ASC',
	'sort_column' => 'post_title',
	'hierarchical' => 1,
	'exclude' => '',
	'include' => '',
	'meta_key' => '',
	'meta_value' => '',
	'authors' => '',
	'child_of' => 0,
	'parent' => -1,
	'exclude_tree' => '',
	'number' => '',
	'offset' => 0,
	'post_type' => 'page',
	'post_status' => 'publish'
); 
$pages = get_pages($args); 
?>
<?php 
$sql = "SELECT COUNT(id) FROM ".$wpdb->prefix."cfg_forms";
$count_forms = $wpdb->get_var($sql);
if($id == 0 && $count_forms >= 1) {
// if(false) {
	?>
	<div style="color: rgb(235, 9, 9);font-size: 16px;font-weight: bold;">Please Upgrade to PRO Version to have more than 1 Forms!</div>
	<div id="cpanel" style="float: left;">
		<div class="icon" style="float: right;">
			<a href="http://creative-solutions.net/wordpress/contact-form-generator" target="_blank" title="Buy PRO version">
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
<form action="admin.php?page=cfg_forms&act=cfg_submit_data&holder=forms" method="post" id="wpcfg_form">
<div style="overflow: hidden;margin: 0 0 10px 0;float: right;">
	<div>
		<button  id="wpcfg_form_save" class="button-primary">Save</button>
		<button id="wpcfg_form_save_close" class="button">Save & Close</button>
		<button id="wpcfg_form_save_new" class="button">Save & New</button>
		<?php if ($id != 0): ?>
		<button id="wpcfg_form_save_copy" class="button">Save as Copy</button>
		<?php endif ?>
		<a href="admin.php?page=cfg_forms" id="wpcfg_add" class="button"><?php echo $t = $id == 0 ? 'Cancel' : 'Close';?></a>
	</div>
</div>
<?php if($id != 0 ) {?><h3 style="font-size: 16px;font-weight: normal;font-style: italic;">To manage <b>form fields</b>, go to <a href="admin.php?page=cfg_fields&filter_form=<?php echo $id;?>" target="_blank">fields page.</a> Read more in <a href="http://creative-solutions.net/wordpress/contact-form-generator/documentation?section=form-options" target="_blank">documentation.</a></h3><?php } ?>
<table class="wpcfg_table">
	<tr>
		<td>
			<h3 style="margin-bottom: 20px;">Basic Options</h3>
		</td>
	</tr>
	<tr>
		<td style="width: 180px;"><label for="wpcfg_name" title="Contact Box Name">Name <span style="color: red">*</span></label></td>
		<td><input name="name" id="wpcfg_name" type="text" value="<?php echo $wpcfg_name;?>" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_top_text" title="Top text">Top text <span style="color: red">*</span></label></td>
		<td><input name="top_text" id="wpcfg_top_text" type="text" value="<?php echo $wpcfg_top_text;?>" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_pre_text" title="Pre text">Pre text</label></td>
		<td>
			<textarea id="wpcfg_pre_text" name="pre_text"><?php echo $wpcfg_pre_text;?></textarea>
		</td>	
	</tr>
	<tr>
		<td><label for="wpcfg_thank_you_text" title="Message to show, after email successfully sent">Thank You Message</label></td>
		<td><input name="thank_you_text" id="wpcfg_thank_you_text" type="text" value="<?php echo $wpcfg_thank_you_text;?>" class="" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_send_text" title="Send button text">Send text <span style="color: red">*</span></label></td>
		<td><input name="send_text" id="wpcfg_send_text" type="text" value="<?php echo $wpcfg_send_text;?>" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_send_new_text" title="Send new button text">Send new text <span style="color: red">*</span></label></td>
		<td><input name="send_new_text" id="wpcfg_send_new_text" type="text" value="<?php echo $wpcfg_send_new_text;?>" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_close_alert_text" title="Close alert box text">Close alert text <span style="color: red">*</span></label></td>
		<td><input name="close_alert_text" id="wpcfg_close_alert_text" type="text" value="<?php echo $wpcfg_close_alert_text;?>" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_form_width" title="Form width. Can be a percent, or in pixels.">Form width <span style="color: red">*</span></label></td>
		<td><input name="form_width" id="wpcfg_form_width" type="text" value="<?php echo $wpcfg_form_width;?>" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_id_template" title="Template">Template <span style="font-size: 12px;color: rgb(221, 0, 0);font-style: italic;text-decoration: underline;display: inline-block;margin-left: 5px;">Commercial Version</span></label><br /><a href="http://creative-solutions.net/wordpress/contact-form-generator/demo" target="_blank">See Templates Demo</a></td>
		<td>
			<select id="wpcfg_id_template" name="id_template">
				<?php 
					foreach($templates as $template) {
						$selected = $template->id == $wpcfg_id_template ? 'selected="selected"' : '';
						echo '<option value="'.$template->id.'" '.$selected.'>'.$template->name.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<tr>
		<td style="" colspan="2">
			<h3 style="margin-bottom: 20px;margin-top: 25px;">Email Settings</h3>
			<div style="color: #555;font-size: 12px;"><b>Note1:</b> Usually the form works well when <u style="font-weight: bold;">all email settings are empty</u>. It will use <b>global settings</b> in that case!</div>
			<div style="color: #555;font-size: 12px;margin-top: 3px;margin-bottom: 15px;"><b>Note2:</b> Some email servers require emails to be sent from the same server as the site in. If your domian is <b style="color: rgb(126, 33, 33)">example.com</b>,<br /><span style="display: inline-block;width: 5px;"></span>then you should set <b style="text-decoration: none;color: rgb(10, 47, 161);font-style: italic">Email To</b> it to <b style="color: rgb(126, 33, 33);">email1@example.com</b>, and <b style="text-decoration: none;color: rgb(10, 47, 161);font-style: italic">Email From</b> to <b style="color: rgb(126, 33, 33);">email2@example.com</b> (different emails).</div>
		</td>
	</tr>
	<tr>
		<td><label for="wpcfg_email_to" title="If blank then message will be sent to email set in global configuration. To add multiple recipitents, seperate them with coma(,)">Email to (recipient)</label></td>
		<td><input name="email_to" id="wpcfg_email_to" type="text" value="<?php echo $wpcfg_email_to;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_email_bcc" title="Add bind carbon copy recipitens to the email. To add multiple recipitents, seperate them with coma(,)">Email Bcc</label></td>
		<td><input name="email_bcc" id="wpcfg_email_bcc" type="text" value="<?php echo $wpcfg_email_bcc;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_email_subject" title="If blank, then (Message sent from SITE NAME) will be used">Email Subject</label></td>
		<td><input name="email_subject" id="wpcfg_email_subject" type="text" value="<?php echo $wpcfg_email_subject;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_email_from" title="If blank, then it will be set to user inputed email, if it is empty, then to email set in global configuration">Email From</label></td>
		<td><input name="email_from" id="wpcfg_email_from" type="text" value="<?php echo $wpcfg_email_from;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_email_from_name" title="Email from name">Email From Name</label></td>
		<td><input name="email_from_name" id="wpcfg_email_from_name" type="text" value="<?php echo $wpcfg_email_from_name;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_email_replyto" title="If blank, then user will reply to user inputed email, if it is empty, then to email set in global configuration">Reply to Email</label></td>
		<td><input name="email_replyto" id="wpcfg_email_replyto" type="text" value="<?php echo $wpcfg_email_replyto;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_email_replyto_name" title="Reply to Name">Reply to Name</label></td>
		<td><input name="email_replyto_name" id="wpcfg_email_replyto_name" type="text" value="<?php echo $wpcfg_email_replyto_name;?>" /></td>	
	</tr>
	<tr>
		<td style="height: 15px;" colspan="2">
			<h3 style="margin-bottom: 20px;margin-top: 25px;">Redirect Options</h3>
		</td>
	</tr>
	<tr>
		<td><label title="Enable Redirect. Redirect to another page, after email has been sent">Enable Redirect</label></td>
		<td>
			<label for="wpcfg_redirect_yes">Yes</label>
			<input id="wpcfg_redirect_yes" type="radio" name="redirect" value="1" <?php if($wpcfg_redirect == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpcfg_redirect_no">No</label>
			<input id="wpcfg_redirect_no" type="radio" name="redirect" value="0"  <?php if($wpcfg_redirect == 0) echo 'checked="checked"';?>/>
		</td>	
	</tr>
	<tr>
		<td><label for="wpcfg_redirect_itemid" title="Redirect to this menu item, after email has been sent">Redirect menu item</label></td>
		<td>
			<select id="wpcfg_redirect_itemid" name="redirect_itemid">
				<?php 
					foreach($pages as $page) {
						$selected = $page->ID == $wpcfg_redirect_itemid ? 'selected="selected"' : '';
						echo '<option value="'.$page->ID.'" '.$selected.'>'.$page->post_title.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<tr>
		<td><label for="wpcfg_redirect_url" title="Redirect URL. If blank, menu item will be used">Redirect URL</label></td>
		<td><input name="redirect_url" id="wpcfg_redirect_url" type="text" value="<?php echo $wpcfg_redirect_url;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_redirect_delay" title="Time before redirect (in miliseconds)">Redirect delay</label></td>
		<td><input name="redirect_delay" id="wpcfg_redirect_delay" type="text" value="<?php echo $wpcfg_redirect_delay;?>" /></td>	
	</tr>
	<tr>
		<td style="" colspan="2">
			<h3 style="margin-bottom: 20px;margin-top: 25px;">Send Copy Options <span style="font-size: 12px;color: rgb(221, 0, 0);font-style: italic;text-decoration: underline;display: inline-block;margin-left: 5px;">Commercial Version</span></h3>
		</td>
	</tr>
	<tr>
		<td><label title="Show 'Send me a copy' field">Show send me copy</label></td>
		<td>
			<label for="wpcfg_send_copy_enable_yes">Yes</label>
			<input id="wpcfg_send_copy_enable_yes" type="radio" name="send_copy_enable" value="1" <?php if($wpcfg_send_copy_enable == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpcfg_send_copy_enable_no">No</label>
			<input id="wpcfg_send_copy_enable_no" type="radio" name="send_copy_enable" value="0"  <?php if($wpcfg_send_copy_enable == 0) echo 'checked="checked"';?>/>
		</td>	
	</tr>
	<tr>
		<td><label for="wpcfg_send_copy_text" title="'Send me a copy' text">Send me a copy text <span style="color: red">*</span></label></td>
		<td><input name="send_copy_text" id="wpcfg_send_copy_text" type="text" value="<?php echo $wpcfg_send_copy_text;?>" class="required" /></td>	
	</tr>

	<tr>
		<td style="" colspan="2">
			<h3 style="margin-bottom: 20px;margin-top: 25px;">Shake Effect Options</h3>
		</td>
	</tr>
	<tr>
		<td><label for="wpcfg_shake_count" title="How many times shake field, if it is not valid">Shakes Count</label></td>
		<td><input name="shake_count" id="wpcfg_shake_count" type="text" value="<?php echo $wpcfg_shake_count;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_shake_distanse" title="Shake distanse in pixels">Shakes Distanse</label></td>
		<td><input name="shake_distanse" id="wpcfg_shake_distanse" type="text" value="<?php echo $wpcfg_shake_distanse;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_shake_duration" title="Shake Duration, set in miliseconds">Shakes Duration</label></td>
		<td><input name="shake_duration" id="wpcfg_shake_duration" type="text" value="<?php echo $wpcfg_shake_duration;?>" /></td>	
	</tr>

	<tr>
		<td style="" colspan="2">
			<h3 style="margin-bottom: 20px;margin-top: 25px;">User Info Options <span style="font-size: 12px;color: rgb(221, 0, 0);font-style: italic;text-decoration: underline;display: inline-block;margin-left: 5px;">Commercial Version</span></h3>
		</td>
	</tr>
	<tr>
		<td><label title="Show page title in sent email">Show Page Title</label></td>
		<td>
			<label for="wpcfg_referrer_yes">Yes</label>
			<input id="wpcfg_referrer_yes" type="radio" name="email_info_show_referrer" value="1" <?php if($wpcfg_email_info_show_referrer == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpcfg_referrer_no">No</label>
			<input id="wpcfg_referrer_no" type="radio" name="email_info_show_referrer" value="0"  <?php if($wpcfg_email_info_show_referrer == 0) echo 'checked="checked"';?>/>
		</td>		
	</tr>
	<tr>
		<td><label title="Show ip of user in sent email">Show IP</label></td>
		<td>
			<label for="wpcfg_ip_yes">Yes</label>
			<input id="wpcfg_ip_yes" type="radio" name="email_info_show_ip" value="1" <?php if($wpcfg_email_info_show_ip == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpcfg_ip_no">No</label>
			<input id="wpcfg_ip_no" type="radio" name="email_info_show_ip" value="0"  <?php if($wpcfg_email_info_show_ip == 0) echo 'checked="checked"';?>/>
		</td>		
	</tr>
	<tr>
		<td><label title="Show browser in sent email">Show Browser</label></td>
		<td>
			<label for="wpcfg_browser_yes">Yes</label>
			<input id="wpcfg_browser_yes" type="radio" name="email_info_show_browser" value="1" <?php if($wpcfg_email_info_show_browser == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpcfg_browser_no">No</label>
			<input id="wpcfg_browser_no" type="radio" name="email_info_show_browser" value="0"  <?php if($wpcfg_email_info_show_browser == 0) echo 'checked="checked"';?>/>
		</td>		
	</tr>
	<tr>
		<td><label title="Show Operation System in sent email">Show Operation System</label></td>
		<td>
			<label for="wpcfg_os_yes">Yes</label>
			<input id="wpcfg_os_yes" type="radio" name="email_info_show_os" value="1" <?php if($wpcfg_email_info_show_os == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpcfg_os_no">No</label>
			<input id="wpcfg_os_no" type="radio" name="email_info_show_os" value="0"  <?php if($wpcfg_email_info_show_os == 0) echo 'checked="checked"';?>/>
		</td>		
	</tr>
	<tr>
		<td><label title="Show Screen Resolution in sent email">Show Screen Resolution</label></td>
		<td>
			<label for="wpcfg_sc_res_yes">Yes</label>
			<input id="wpcfg_sc_res_yes" type="radio" name="email_info_show_sc_res" value="1" <?php if($wpcfg_email_info_show_sc_res == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpcfg_sc_res_no">No</label>
			<input id="wpcfg_sc_res_no" type="radio" name="email_info_show_sc_res" value="0"  <?php if($wpcfg_email_info_show_sc_res == 0) echo 'checked="checked"';?>/>
		</td>		
	</tr>

	<tr>
		<td style="" colspan="2">
			<h3 style="margin-bottom: 20px;margin-top: 25px;">Other Options</h3>
		</td>
	</tr>
	<tr>
		<td><label title="Additional anti-spam protection. If you got INVALID TOKEN message, set it to no.">Check Token</label></td>
		<td>
			<label for="wpcfg_show_back_yes">Yes</label>
			<input id="wpcfg_show_back_yes" type="radio" name="show_back" value="1" <?php if($wpcfg_show_back == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpcfg_show_back_no">No</label>
			<input id="wpcfg_show_back_no" type="radio" name="show_back" value="0"  <?php if($wpcfg_show_back == 0) echo 'checked="checked"';?>/>
		</td>		
	</tr>
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

	<tr>
		<td style="" colspan="2">
			<h3 style="margin-bottom: 20px;margin-top: 25px;">Custom Styling<span style="font-size: 12px;color: rgb(221, 0, 0);font-style: italic;text-decoration: underline;display: inline-block;margin-left: 5px;">Commercial Version</span></h3>
		</td>
	</tr>
	<tr>
		<td valign="top"><label for="wpcfg_custom_css" title="Custom Css" >Custom Css</label></td>
		<td>
			<textarea id="wpcfg_custom_css" name="custom_css" style="height: 300px;"><?php echo $wpcfg_custom_css;?></textarea>
		</td>	
	</tr>
</table>
<input type="hidden" name="task" value="" id="wpcfg_task">
<input type="hidden" name="id" value="<?php echo $id;?>" >
<input type="hidden" name="cfg_token" value="<?php echo $_SESSION["cfg_token"];?>" id="cfg_token" />
</form>
<?php }?>