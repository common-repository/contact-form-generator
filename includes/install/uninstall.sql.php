<?php 
// no direct access!
defined('ABSPATH') or die("No direct access");

global $wpdb;
delete_option('wpcfg_db_version');

require_once(ABSPATH . '/wp-admin/includes/upgrade.php');

$sql = "DROP TABLE IF EXISTS `".$wpdb->prefix."cfg_templates`";
$wpdb->query($sql);

$sql = "DROP TABLE IF EXISTS `".$wpdb->prefix."cfg_forms`";
$wpdb->query($sql);

$sql = "DROP TABLE IF EXISTS `".$wpdb->prefix."cfg_fields`";
$wpdb->query($sql);

$sql = "DROP TABLE IF EXISTS `".$wpdb->prefix."cfg_field_types`";
$wpdb->query($sql);

$sql = "DROP TABLE IF EXISTS `".$wpdb->prefix."cfg_form_options`";
$wpdb->query($sql);
?>