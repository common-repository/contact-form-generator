<?php
// no direct access!
defined('ABSPATH') or die("No direct access");
?>

<div id="cfg_content">
	<?php 
		if($page == 'contactformgenerator')
			include('overview.php');
		elseif($page == 'cfg_forms') {
			if($act == '')
				include('forms.php');
			elseif($act == 'new' || $act == 'edit')
				include('form.php');
		}
		elseif($page == 'cfg_fields') {
			if($act == '')
				include('fields.php');
			elseif($act == 'new' || $act == 'edit')
				include('field.php');
		}
		elseif($page == 'cfg_templates') {
			if($act == '')
				include('templates.php');
			elseif($act == 'new')
				include('template_add.php');
			elseif($act == 'edit')
				include('template_edit.php');
		}
	?>
</div>