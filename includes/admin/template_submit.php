<?php 
// no direct access!
defined('ABSPATH') or die("No direct access");

global $wpdb;
$id = (int) $_POST['id'];
$task = isset($_REQUEST['task']) ? $_REQUEST['task'] : '';

// 2.5.0 fix, security check
$cfg_token = isset($_REQUEST['cfg_token']) ? $_REQUEST['cfg_token'] : '';
if($cfg_token == "" || $cfg_token != $_SESSION["cfg_token"]) {
	$redirect = "admin.php?page=cfg_templates&error=1";
	header("Location: ".$redirect);
	exit();
}

if($id == 0) {
	$id_template = (int) $_POST['id_template'];
	$sql = "SELECT `styles` FROM `".$wpdb->prefix."cfg_templates` WHERE `id` = ".$id_template;
	$styles = $wpdb->get_var($sql);
	
	$sql = "SELECT MAX(`ordering`) FROM `".$wpdb->prefix."cfg_templates`";
	$max_order = $wpdb->get_var($sql) + 1;
	
	$wpdb->query( $wpdb->prepare(
			"
			INSERT INTO ".$wpdb->prefix."cfg_templates
			( 
				`name`, `styles`, `published`, `ordering`
			)
			VALUES ( %s, %s, %d, %d)
			",
			$_POST['name'], $styles, $_POST['published'], $max_order
	) );
	
	$insrtid = (int) $wpdb->insert_id;
	if($insrtid != 0) {
		if($task == 'save')
			$redirect = "admin.php?page=cfg_templates&act=edit&id=".$insrtid;
		elseif($task == 'save_new')
			$redirect = "admin.php?page=cfg_templates&act=new";
		else
			$redirect = "admin.php?page=cfg_templates";
	}
	else
		$redirect = "admin.php?page=cfg_templates&error=1";
}
else {
	$styles = $_REQUEST['styles'];
	$styles_formated = '';
	$ind = 0;
	foreach($styles as $k => $val) {
		$styles_formated .= $k.'~'.$val;
		if($ind != sizeof($styles) - 1)
			$styles_formated .= '|';
		$ind ++;
	}
	
	$q = $wpdb->query( $wpdb->prepare(
			"
			UPDATE ".$wpdb->prefix."cfg_templates
			SET
				`name` = %s, 
				`styles` = %s
			WHERE
				`id` = '".$id."'
			",
			$_POST['name'], $styles_formated
	) );
	
	if($q !== false) {
		if($task == 'save')
			$redirect = "admin.php?page=cfg_templates&act=edit&id=".$id;
		elseif($task == 'save_new')
			$redirect = "admin.php?page=cfg_templates&act=new";
		else
			$redirect = "admin.php?page=cfg_templates";
	}
	else
		$redirect = "admin.php?page=cfg_templates&error=1";
}
header("Location: ".$redirect);
exit();
?>