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

//get template sarray
$sql = "SELECT name, id FROM ".$wpdb->prefix."cfg_templates";
$templates = $wpdb->get_results($sql);
?>
<form action="admin.php?page=cfg_forms&act=cfg_submit_data&holder=templates" method="post" id="wpcfg_form">
<div style="overflow: hidden;margin: 0 0 10px 0;">
	<div style="float:right;">
		<button  id="wpcfg_form_save" class="button-primary">Save</button>
		<button id="wpcfg_form_save_close" class="button">Save & Close</button>
		<button id="wpcfg_form_save_new" class="button">Save & New</button>
		<a href="admin.php?page=cfg_templates" id="wpcfg_add" class="button"><?php echo $t = $id == 0 ? 'Cancel' : 'Close';?></a>
	</div>
</div>
<table class="wpcfg_table">
	<tr>
		<td style="width: 180px;"><label for="wpcfg_name" title="New template name">Name <span style="color: red">*</span></label></td>
		<td><input name="name" id="wpcfg_name" type="text" value="" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpcfg_id_template" title="Load default values from this template">Start values</label><br /><a href="#" target="_blank">See Templates Demo</a></td>
		<td>
			<select id="wpcfg_id_template" name="id_template">
				<?php 
					foreach($templates as $template) {
						echo '<option value="'.$template->id.'">'.$template->name.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<tr>
		<td><label title="Status">Status</label></td>
		<td>
			<label for="wpcfg_status_yes">Published</label>
			<input id="wpcfg_status_yes" type="radio" name="published" value="1" checked="checked"  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpcfg_status_no">Unpublished</label>
			<input id="wpcfg_status_no" type="radio" name="published" value="0" />
		</td>	
	</tr>
</table>
<input type="hidden" name="task" value="" id="wpcfg_task">
<input type="hidden" name="id" value="0" >
<input type="hidden" name="cfg_token" value="<?php echo $_SESSION["cfg_token"];?>" id="cfg_token" />
</form>