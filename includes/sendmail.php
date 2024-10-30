<?php
// no direct access!
defined('ABSPATH') or die("No direct access");
// error_reporting(0);
header('Content-Type: text/plain');
if(ob_get_length() > 0)
    ob_clean();
global $wpdb;

$get_token = isset($_GET['get_token']) ? (int) $_GET['get_token'] : 0;

if($get_token == 0) {
	parse_str($_POST['data'],$wpcfg_my_post);

	$module_id = (int) $wpcfg_my_post['contactformgenerator_module_id'];
	$form_id = (int) $wpcfg_my_post['contactformgenerator_form_id'];
	$session_token = $_SESSION['contactformgenerator_token'];
	$token = $wpcfg_my_post['contactformgenerator_token'];

	//get form configuration
	$query = "
				SELECT
					sp.`email_to`,
					sp.`email_bcc`,
					sp.`email_subject`,
					sp.`email_from`,
					sp.`email_from_name`,
					sp.`email_replyto`,
					sp.`email_replyto_name`,
					sp.`show_back`,
					sp.`email_info_show_referrer`,
					sp.`email_info_show_ip`,
					sp.`email_info_show_browser`,
					sp.`email_info_show_os`,
					sp.`email_info_show_sc_res`
				FROM
					`".$wpdb->prefix."cfg_forms` sp
				WHERE sp.published = '1'
				AND sp.id = '".$form_id."'";
	$form_data = $wpdb->get_row($query);

	$check_token_enable = $form_data->show_back == 1 ? true : false;
}

if($get_token == 0) {
	if ($token != $session_token && $check_token_enable) {
		echo '[{"invalid":"invalid_token"}]';
	}
	else {
		
		$info = Array();
		
		//get from
		$fromname = get_option( 'blogname', 'Wordpress site' );
		$mailfrom = get_option( 'admin_email', '' );
		if ($mailfrom == '') {
			$info[] = 'Mail from not set in Global Configuration';
		}
		
		//get email to
		$email_to = array();
		if ( $form_data->email_to != '' ) {
			$email_to = explode(',', $form_data->email_to);
		}
		if (count($email_to) == 0) {
			$email_to = $mailfrom;
		}
		
		// Email subject
		$contactformgenerator_subject = $form_data->email_subject == '' ? 'Message sent from '.$fromname : $form_data->email_subject;
		
		//generate the body
		$headers = array();
		$body = '';
		$sender_email = '';
		$sender_name = '';
		if(isset($wpcfg_my_post['contactformgenerator_fields'])) {
			foreach($wpcfg_my_post['contactformgenerator_fields'] as $field_data) {
				$field_label = strip_tags(trim($field_data[1]));
				$field_type = strip_tags(trim($field_data[2]));

				if(isset($field_data[0])) {
					if(is_array($field_data[0])) {
						$field_value = implode(', ',$field_data[0]);
						$field_value = strip_tags(trim($field_value));
					}
					else
						$field_value = strip_tags(trim($field_data[0]));
				}
				else {
					$field_value = '';
				}
				$field_value = str_replace('creative_empty', '', $field_value);

				// start separator
				if($field_type == 'text-area')
					$fields_seperator = ":\n";
				else
					$fields_seperator = ": ";

				// ens separator
				if($field_type == 'text-area')
					$fields_end_seperator = "\r\n\n";
				else
					$fields_end_seperator = "\r\n";

				$body .= $field_label.$fields_seperator.$field_value.$fields_end_seperator;
				
				if($field_type == 'email')
					$sender_email = $field_value;

				if($field_type == 'name')
					$sender_name = $field_value;
			}
		}

		
		//Set Sender
		$sender_email = $form_data->email_from == '' ? ($sender_email == '' ?  $mailfrom : $sender_email) : $form_data->email_from;
		$sender_name = $form_data->email_from_name == '' ? ($sender_name == '' ?  $fromname : $sender_name) : $form_data->email_from_name;
		$headers[] = 'From: '.$sender_name.' <'.$sender_email.'>';
		//$mail->setSender( array( $sender_email, $sender_name ) );
		$info[] = 'Sender set: ';
		
		// set reply to
		$replyto_email = $form_data->email_replyto == '' ? ($sender_email == '' ?  $mailfrom : $sender_email) : $form_data->email_replyto;
		$email_replyto_name = $form_data->email_replyto_name == '' ? ($sender_name == '' ? $fromname : $sender_name) : $form_data->email_replyto_name;
		$headers[] = 'Reply-To: '.$email_replyto_name.' <'.$replyto_email.'>';
		//$mail->addReplyTo( array( $replyto_email, $email_replyto_name) );
		$info[] = 'Reply to set: ';
		
		// add blind carbon recipient
		if ($form_data->email_bcc != '') {
			$email_bcc = explode(',', $form_data->email_bcc);
			if(is_array($email_bcc)) {
				foreach($email_bcc as $email_bcc_item) {
					$headers[] = 'Bcc: <'.$email_bcc_item.'>';
				}
			}
			//$mail->addBCC($email_bcc);
			$info[] = 'BCC recipients added';
		}
		
		//send email
		$attach_files = array();
		$wpcfg_send = wp_mail( $email_to, $contactformgenerator_subject, $body, $headers, $attach_files);
		
		if ( $wpcfg_send === true ) {
			$wpcfg_token = bin2hex(random_bytes(32));
			$_SESSION['contactformgenerator_token'] = $wpcfg_token;
			$info[] = 'Email sent successful';
		}
		else $info[] = 'There are problems sending email';
		
		//generates json output
		echo '[{';
		if(sizeof($info) > 0) {
			echo '"info": ';
			echo '[';
			foreach ($info as $k => $data) {
				$data = str_replace('"','',$data);
				echo '"'.$data.'"';
				if ($k != sizeof($info) - 1)
					echo ',';
			}
			echo ']';
		}
			
		echo '}]';
	}
}
else {
	$wpcfg_token = bin2hex(random_bytes(32));
	$_SESSION['contactformgenerator_token'] = $wpcfg_token;
	echo $wpcfg_token;
}
exit();