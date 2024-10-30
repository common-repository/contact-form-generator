<?php 
// no direct access!
defined('ABSPATH') or die("No direct access");

global $wpdb;
$id = (int) $_POST['id'];
$task = isset($_REQUEST['task']) ? $_REQUEST['task'] : '';

// 2.5.0 fix, security check
$cfg_token = isset($_REQUEST['cfg_token']) ? $_REQUEST['cfg_token'] : '';
if($cfg_token == "" || $cfg_token != $_SESSION["cfg_token"]) {
	$redirect = "admin.php?page=cfg_forms&error=1";
	header("Location: ".$redirect);
	exit();
}

$name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
$top_text = isset($_POST['top_text']) ? sanitize_text_field($_POST['top_text']) : '';
$pre_text = isset($_POST['pre_text']) ? sanitize_text_field($_POST['pre_text']) : '';
$thank_you_text = isset($_POST['thank_you_text']) ? sanitize_text_field($_POST['thank_you_text']) : '';
$send_text = isset($_POST['send_text']) ? sanitize_text_field($_POST['send_text']) : '';
$send_new_text = isset($_POST['send_new_text']) ? sanitize_text_field($_POST['send_new_text']) : '';
$close_alert_text = isset($_POST['close_alert_text']) ? sanitize_text_field($_POST['close_alert_text']) : '';
$form_width = isset($_POST['form_width']) ? sanitize_text_field($_POST['form_width']) : '';
$id_template = isset($_POST['id_template']) ? sanitize_text_field($_POST['id_template']) : '';
$redirect = isset($_POST['redirect']) ? sanitize_text_field($_POST['redirect']) : '';
$redirect_itemid = isset($_POST['redirect_itemid']) ? sanitize_text_field($_POST['redirect_itemid']) : '';
$redirect_url = isset($_POST['redirect_url']) ? sanitize_text_field($_POST['redirect_url']) : '';
$redirect_delay = isset($_POST['redirect_delay']) ? sanitize_text_field($_POST['redirect_delay']) : '';
$send_copy_enable = isset($_POST['send_copy_enable']) ? sanitize_text_field($_POST['send_copy_enable']) : '';
$send_copy_text = isset($_POST['send_copy_text']) ? sanitize_text_field($_POST['send_copy_text']) : '';
$email_to = isset($_POST['email_to']) ? sanitize_text_field($_POST['email_to']) : '';
$email_bcc = isset($_POST['email_bcc']) ? sanitize_text_field($_POST['email_bcc']) : '';
$email_subject = isset($_POST['email_subject']) ? sanitize_text_field($_POST['email_subject']) : '';
$email_from = isset($_POST['email_from']) ? sanitize_text_field($_POST['email_from']) : '';
$email_from_name = isset($_POST['email_from_name']) ? sanitize_text_field($_POST['email_from_name']) : '';
$email_replyto = isset($_POST['email_replyto']) ? sanitize_text_field($_POST['email_replyto']) : '';
$email_replyto_name = isset($_POST['email_replyto_name']) ? sanitize_text_field($_POST['email_replyto_name']) : '';
$shake_count = isset($_POST['shake_count']) ? intval($_POST['shake_count']) : 0;
$shake_distanse = isset($_POST['shake_distanse']) ? intval($_POST['shake_distanse']) : 0;
$shake_duration = isset($_POST['shake_duration']) ? intval($_POST['shake_duration']) : 0;
$published = isset($_POST['published']) ? intval($_POST['published']) : 0;
$show_back = isset($_POST['show_back']) ? intval($_POST['show_back']) : 0;
$custom_css = isset($_POST['custom_css']) ? sanitize_text_field($_POST['custom_css']) : '';
$email_info_show_referrer = isset($_POST['email_info_show_referrer']) ? intval($_POST['email_info_show_referrer']) : 0;
$email_info_show_ip = isset($_POST['email_info_show_ip']) ? intval($_POST['email_info_show_ip']) : 0;
$email_info_show_browser = isset($_POST['email_info_show_browser']) ? intval($_POST['email_info_show_browser']) : 0;
$email_info_show_os = isset($_POST['email_info_show_os']) ? intval($_POST['email_info_show_os']) : 0;
$email_info_show_sc_res = isset($_POST['email_info_show_sc_res']) ? intval($_POST['email_info_show_sc_res']) : 0;

$sql = "SELECT COUNT(id) FROM ".$wpdb->prefix."cfg_forms";
$count_forms = $wpdb->get_var($sql);

if($count_forms >= 1 && $id == 0) {
	$redirect = "admin.php?page=cfg_forms&error=1";
	header("Location: ".$redirect);
	exit();
}

if($id == 0) {
	$sql = "SELECT MAX(`ordering`) FROM `".$wpdb->prefix."cfg_forms`";
	$max_order = $wpdb->get_var($sql) + 1;
	
	$wpdb->query( $wpdb->prepare(
			"
			INSERT INTO ".$wpdb->prefix."cfg_forms
			( 
				`name`, `top_text`, `pre_text`, `thank_you_text`, `send_text`, `send_new_text`, `close_alert_text`, `form_width`, `id_template`, `redirect`, `redirect_itemid`, `redirect_url`, `redirect_delay`, `send_copy_enable`, `send_copy_text`, `email_to`, `email_bcc`, `email_subject`, `email_from`, `email_from_name`,  `email_replyto`, `email_replyto_name`, `shake_count`, `shake_distanse`, `shake_duration`,  `published`, `ordering`, `show_back`,`custom_css`,`email_info_show_referrer`,`email_info_show_ip`,`email_info_show_browser`,`email_info_show_os`,`email_info_show_sc_res`
			)
			VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %d, %s, %d, %s, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %d, %d, %d, %d, %d, %s, %s, %d, %d, %d, %d, %d )
			",
			$name, $top_text, $pre_text, $thank_you_text, $send_text, $send_new_text, $close_alert_text, $form_width, $id_template, $redirect, $redirect_itemid, $redirect_url, $redirect_delay, $send_copy_enable, $send_copy_text, $email_to, $email_bcc, $email_subject, $email_from, $email_from_name, $email_replyto, $email_replyto_name, $shake_count, $shake_distanse, $shake_duration, $published, $max_order, $show_back, $custom_css, $email_info_show_referrer, $email_info_show_ip, $email_info_show_browser, $email_info_show_os, $email_info_show_sc_res
	) );

	$insrtid = (int) $wpdb->insert_id;
	if($insrtid != 0) {
		if($task == 'save')
			$redirect = "admin.php?page=cfg_forms&act=edit&id=".$insrtid;
		elseif($task == 'save_new')
			$redirect = "admin.php?page=cfg_forms&act=new";
		else
			$redirect = "admin.php?page=cfg_forms";
	}
	else
		$redirect = "admin.php?page=cfg_forms&error=1";
}

if($id != 0 && $task != 'save_copy') {
	$q = $wpdb->query( $wpdb->prepare(
			"
			UPDATE ".$wpdb->prefix."cfg_forms
			SET
				`name` = %s, `top_text` = %s, `pre_text` = %s, `thank_you_text` = %s, `send_text` = %s, `send_new_text` = %s, `close_alert_text` = %s, `form_width` = %s, `id_template` = %d, `redirect` = %s, `redirect_itemid` = %d, `redirect_url` = %s, `redirect_delay` = %d, `send_copy_enable` = %s, `send_copy_text` = %s, `email_to` = %s, `email_bcc` = %s, `email_subject` = %s, `email_from` = %s, `email_from_name` = %s, `email_replyto` = %s, `email_replyto_name` = %s, `shake_count` = %d, `shake_distanse` = %d, `shake_duration` = %d, `published` = %d, `show_back` = %s, `custom_css` = %s, `email_info_show_referrer` = %d, `email_info_show_ip` = %d, `email_info_show_browser` = %d, `email_info_show_os` = %d, `email_info_show_sc_res` = %d 
			WHERE
				`id` = '".$id."'
			",
			$name, $top_text, $pre_text, $thank_you_text, $send_text, $send_new_text, $close_alert_text, $form_width, $id_template, $redirect, $redirect_itemid, $redirect_url, $redirect_delay, $send_copy_enable, $send_copy_text, $email_to, $email_bcc, $email_subject, $email_from, $email_from_name, $email_replyto, $email_replyto_name, $shake_count, $shake_distanse, $shake_duration, $published, $show_back, $custom_css, $email_info_show_referrer, $email_info_show_ip, $email_info_show_browser, $email_info_show_os, $email_info_show_sc_res
	) );
	if($q !== false) {
		if($task == 'save')
			$redirect = "admin.php?page=cfg_forms&act=edit&id=".$id;
		elseif($task == 'save_new')
			$redirect = "admin.php?page=cfg_forms&act=new";
		else
			$redirect = "admin.php?page=cfg_forms";
	}
	else
		$redirect = "admin.php?page=cfg_forms&error=1";
}

header("Location: ".$redirect);
exit();
?>