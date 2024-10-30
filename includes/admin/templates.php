<?php 
// no direct access!
defined('ABSPATH') or die("No direct access");

global $wpdb;

$task = isset($_REQUEST['task']) ? $_REQUEST['task'] : '';
$ids = isset($_REQUEST['ids']) ?  $_REQUEST['ids'] : array();
$filter_state = isset($_REQUEST['filter_state']) ? (int) $_REQUEST['filter_state'] : 2;
$filter_search = isset($_REQUEST['filter_search']) ? stripslashes(str_replace(array('\'','"'), '', trim($_REQUEST['filter_search']))) : '';

// 2.5.0 fix security check
$cfg_token = isset($_REQUEST['cfg_token']) ? $_REQUEST['cfg_token'] : '';
$tokens_validated = true;
if($task != "") {
	if($cfg_token == "" || $cfg_token != $_SESSION["cfg_token"]) {
		$tokens_validated = false;
	}
}

if($tokens_validated) {
	//unpublish task
	if($task == 'unpublish') {
		if(is_array($ids)) {
			foreach($ids as $id) {
				$idk = (int)$id;
				if($idk != 0) {
					$sql = "UPDATE ".$wpdb->prefix."cfg_templates SET `published` = '0' WHERE `id` = '".$idk."'";
					$wpdb->query($sql);
				}
			}
		}
	}
	//publish task
	if($task == 'publish') {
		if(is_array($ids)) {
			foreach($ids as $id) {
				$idk = (int)$id;
				if($idk != 0) {
					$sql = "UPDATE ".$wpdb->prefix."cfg_templates SET `published` = '1' WHERE `id` = '".$idk."'";
					$wpdb->query($sql);
				}
			}
		}
	}
	//delete task
	if($task == 'delete') {
		if(is_array($ids)) {
			foreach($ids as $id) {
				$idk = (int)$id;
				if($idk != 0) {
					$sql = "DELETE FROM ".$wpdb->prefix."cfg_templates WHERE `id` = '".$idk."'";
					$wpdb->query($sql);
				}
			}
		}
	}
}

//get the rows
$sql = 
		"
			SELECT 
				sp.id,
				sp.name,
				sp.published
			FROM ".$wpdb->prefix."cfg_templates  sp
			WHERE 1 
		";
		
if($filter_state == 1)
	$sql .= " AND sp.published = '1'";
elseif($filter_state == 0)
	$sql .= " AND sp.published = '0'";
if($filter_search != '') {
	if (stripos($filter_search, 'id:') === 0) {
		$sql .= " AND sp.id = " . (int) substr($filter_search, 3);
	}
	else {
		$sql .= " AND sp.name LIKE '%".$filter_search."%'";
	}
}
$sql .= " ORDER BY sp.`ordering`,`id` ASC";
$rows = $wpdb->get_results($sql);
?>
<form action="admin.php?page=cfg_templates" method="post" id="wpcfg_form">
<div style="overflow: hidden;margin: 0 0 10px 0;">
	<div style="float: left;">
		<select id="wpcfg_filter_state" class="wpcfg_select" name="filter_state">
			<option value="2" <?php if($filter_state == 2) echo 'selected="selected"';?> >Select Status</option>
			<option value="1"<?php if($filter_state == 1) echo 'selected="selected"';?> >Published</option>
			<option value="0"<?php if($filter_state == 0) echo 'selected="selected"';?> >Unpublished</option>
		</select>
		<input type="search" placeholder="Filter items by name" value="<?php echo $filter_search;?>" id="wpcfg_filter_search" name="filter_search">
		<button id="wpcfg_filter_search_submit" class="button-primary">Search</button>
		<a href="admin.php?page=cfg_templates"  class="button">Reset</a>
	</div>
	<div style="float:right;">
		<a href="admin.php?page=cfg_templates&act=new" id="wpcfg_add" class="button-primary">New</a>
		<button id="wpcfg_edit" class="button button-disabled wpcfg_disabled" title="Please make a selection from the list, to activate this button">Edit</button>
		<button id="wpcfg_publish_list" class="button button-disabled wpcfg_disabled" title="Please make a selection from the list, to activate this button">Publish</button>
		<button id="wpcfg_unpublish_list" class="button button-disabled wpcfg_disabled" title="Please make a selection from the list, to activate this button">Unpublish</button>
		<button id="wpcfg_delete" class="button button-disabled wpcfg_disabled" title="Please make a selection from the list, to activate this button">Delete</button>
	</div>
</div>
<table class="widefat">
	<thead>
		<tr>
			<th nowrap align="center" style="width: 30px;text-align: center;"><input type="checkbox" name="toggle" value="" id="wpcfg_check_all" /></th>
			<th nowrap align="center" style="width: 30px;text-align: center;">Order</th>
			<th nowrap align="center" style="width: 30px;text-align: center;">Status</th>
			<th nowrap align="left" style="text-align: left;padding-left: 22px;">Name</th>
			<th nowrap align="center" style="width: 30px;text-align: center;">Id</th>
		</tr>
	</thead>
<tbody id="wpcfg_sortable" table_name="<?php echo $wpdb->prefix;?>cfg_templates" reorder_type="reorder">
<?php        
			$k = 0;
			for($i=0; $i < count( $rows ); $i++) {
				$row = $rows[$i];
?>
				<tr class="row<?php echo $k; ?> ui-state-default" id="option_li_<?php echo $row->id; ?>">
					<td nowrap valign="middle" align="center" style="vertical-align: middle;">
						<input style="margin-left: 8px;" type="checkbox" id="cb<?php echo $i; ?>" class="wpcfg_row_ch" name="ids[]" value="<?php echo $row->id; ?>" />
					</td>
					<td valign="middle" align="center" style="vertical-align: middle;width: 30px;">
						<div class="wpcfg_reorder"></div>
					</td>
					<td valign="middle" align="center" style="vertical-align: middle;">
						<?php if($row->published == 1) {?>
						<a href="#" class="wpcfg_unpublish" wpcfg_id="<?php echo $row->id; ?>">
							<img src="<?php echo plugins_url( '../images/published.png' , __FILE__ );?>" alt="^" border="0" title="Published" />
						</a>
						<?php } else {?>
						<a href="#" class="wpcfg_publish" wpcfg_id="<?php echo $row->id; ?>">
							<img src="<?php echo plugins_url( '../images/unpublished.png' , __FILE__ );?>" alt="v" border="0" title="Unpublished" />
						</a>
						<?php }?>
					</td>
					<td valign="middle" align="left" style="vertical-align: middle;padding-left: 22px;">
						<a href="admin.php?page=cfg_templates&act=edit&id=<?php echo $row->id;?>"><?php echo $row->name; ?></a>
					</td>
					<td valign="middle" align="center" style="vertical-align: middle;">
						<?php echo $row->id; ?>
					</td>
				</tr>
<?php
				$k = 1 - $k;
			} // for
?>
</tbody>
</table>
<input type="hidden" name="task" value="" id="wpcfg_task" />
<input type="hidden" name="ids[]" value="" id="wpcfg_def_id" />
<input type="hidden" name="cfg_token" value="<?php echo $_SESSION["cfg_token"];?>" id="cfg_token" />
</form>

