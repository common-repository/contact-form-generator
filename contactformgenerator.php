<?php
// no direct access!
defined('ABSPATH') or die("No direct access");

/*
Plugin Name: Contact Form Generator
Plugin URI: http://creative-solutions.net/wordpress/contact-form-generator/
Description: Contact Form Generator is a powerful contact form builder for WordPress! See <a href="http://creative-solutions.net/wordpress/contact-form-generator/demo">Live Demos</a>. It is packed with a <a href="http://creative-solutions.net/wordpress/contact-form-generator/template-creator-demo">Template Creator Wizard</a> to create fantastic forms in a matter of seconds without coding.
Author: Creative Solutions
Author URI: http://creative-solutions.net/
Version: 2.6.0
*/

//strat session
if (session_id() == '') {
	session_start();
	//check
}
global $wpcfg_db_version;
$plugin_version = '2.6.0';
$wpcfg_db_version = '2.6.0';

define('WPCFG_PLUGINS_URL', plugins_url());
define('WPCFG_FOLDER', basename(dirname(__FILE__)));
define('WPCFG_DIR', dirname(__FILE__));
define('WPCFG_PLUGIN_PATH', WPCFG_PLUGINS_URL . '/' . WPCFG_FOLDER);
define('WPCFG_SITE_URL', get_option('siteurl'));

/******************************
* includes
******************************/

if(isset($_GET['act']) && $_GET['act'] == 'cfg_submit_data') {
	if(isset($_GET['holder']) && $_GET['holder'] == 'forms')
		include('includes/admin/form_submit.php');
	elseif(isset($_GET['holder']) && $_GET['holder'] == 'fields')
		include('includes/admin/field_submit.php');
	elseif(isset($_GET['holder']) && $_GET['holder'] == 'templates')
		include('includes/admin/template_submit.php');
	elseif(isset($_GET['holder']) && $_GET['holder'] == 'cfg_ajax')
		include('includes/admin/cfg_ajax.php');
	elseif(isset($_GET['holder']) && $_GET['holder'] == 'generate_css')
		include('includes/generate.css.php');
	elseif(isset($_GET['holder']) && $_GET['holder'] == 'generate_js')
		include('includes/generate.js.php');
	exit();
}
include('includes/display-functions.php'); // display content functions
include('includes/contactformgenerator_widget.php'); // widget
include('includes/admin-page.php'); // the plugin options page HTML and save functions

function wpcfg_on_install() {
	include('includes/install/install.sql.php'); // install
}

register_activation_hook(__FILE__, 'wpcfg_on_install');

function wpcfg_on_uninstall() {
	include('includes/install/uninstall.sql.php'); // uninstall
}

register_uninstall_hook(__FILE__, 'wpcfg_on_uninstall');

add_action('wp_ajax_wpcfg_send_email', 'wpcfg_send_email');
add_action('wp_ajax_nopriv_wpcfg_send_email', 'wpcfg_send_email');

add_action('wp_ajax_wpcfg_upload', 'wpcfg_upload');
add_action('wp_ajax_nopriv_wpcfg_upload', 'wpcfg_upload');

function wpcfg_send_email() {
	include('includes/sendmail.php');
}
function wpcfg_upload() {
	include('includes/fileupload.php');
}

?>