<?php 
// no direct access!
defined('ABSPATH') or die("No direct access");

global $wpdb;

$task = isset($_REQUEST['task']) ? $_REQUEST['task'] : '';
$ids = isset($_REQUEST['ids']) ?  $_REQUEST['ids'] : array();
$filter_state = isset($_REQUEST['filter_state']) ? (int) $_REQUEST['filter_state'] : 2;
$filter_type = isset($_REQUEST['filter_type']) ? (int) $_REQUEST['filter_type'] : 0;
$filter_search = isset($_REQUEST['filter_search']) ? stripslashes(str_replace(array('\'','"'), '', trim($_REQUEST['filter_search']))) : '';

$query = "SELECT min(`id`) FROM `".$wpdb->prefix."cfg_forms`";
$form_id_first = $wpdb->get_var($query);
$filter_form = (isset($_REQUEST['filter_form']) && (int) $_REQUEST['filter_form'] != 0) ? (int) $_REQUEST['filter_form'] : $form_id_first;

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
					$sql = "UPDATE ".$wpdb->prefix."cfg_fields SET `published` = '0' WHERE `id` = '".$idk."'";
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
					$sql = "UPDATE ".$wpdb->prefix."cfg_fields SET `published` = '1' WHERE `id` = '".$idk."'";
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
					$sql = "DELETE FROM ".$wpdb->prefix."cfg_fields WHERE `id` = '".$idk."'";
					$wpdb->query($sql);
					// delete options
					$sql = "DELETE FROM ".$wpdb->prefix."cfg_form_options WHERE `id_parent` = '".$idk."'";
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
				sp.published,
				sp.ordering,
				sp.column_type,
				sf.name AS form, 
				sf.id AS form_id, 
				sf.id_template as id_template,
				st.name AS type, 
				st.id AS type_id
			FROM ".$wpdb->prefix."cfg_fields  sp
			LEFT JOIN ".$wpdb->prefix."cfg_forms AS sf ON sf.id=sp.id_form
			LEFT JOIN  ".$wpdb->prefix."cfg_field_types AS st ON st.id=sp.id_type 
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
if($filter_type != 0) {
	$sql .= " AND sp.id_type = '".$filter_type."'";
}
if($filter_form != 0) {
	$sql .= " AND sp.id_form = '".$filter_form."'";
}

$sql .= " ORDER BY `form_id`,`ordering`,`id` ASC";
$rows = $wpdb->get_results($sql);

//get types
$types_sql = "SELECT `id`, `name` FROM `".$wpdb->prefix."cfg_field_types`";
$type_rows = $wpdb->get_results($types_sql);
//get forms
$forms_sql = "SELECT `id`, `name`, `id_template` FROM `".$wpdb->prefix."cfg_forms` order by `ordering`,`id` ";
$forms_rows = $wpdb->get_results($forms_sql);
?>
<form action="admin.php?page=cfg_fields" method="post" id="wpcfg_form">
<div style="overflow: hidden;margin: 0 0 10px 0;">
	<div style="float: left;">
		<select id="wpcfg_filter_form" class="wpcfg_select" name="filter_form" style="font-size: 12px;width: 150px;">
			<option value="0">Select Form</option>
			<?php 
				foreach($forms_rows as $form) {
					$selected = $filter_form == $form->id ? 'selected="selected"' : '';
					echo '<option value="'.$form->id.'" '.$selected.'>'.$form->name.'</option>';
				}
			?>
		</select>
		<select id="wpcfg_filter_state" class="wpcfg_select" name="filter_state" style="font-size: 12px;width: 102px;">
			<option value="2" <?php if($filter_state == 2) echo 'selected="selected"';?> >Select Status</option>
			<option value="1"<?php if($filter_state == 1) echo 'selected="selected"';?> >Published</option>
			<option value="0"<?php if($filter_state == 0) echo 'selected="selected"';?> >Unpublished</option>
		</select>
		<select id="wpcfg_filter_type" class="wpcfg_select" name="filter_type" style="font-size: 12px;width: 95px;">
			<option value="0">Select Type</option>
			<?php 
				foreach($type_rows as $type) {
					$selected = $filter_type == $type->id ? 'selected="selected"' : '';
					echo '<option value="'.$type->id.'" '.$selected.'>'.$type->name.'</option>';
				}
			?>
		</select>
		<input type="search" placeholder="Filter..." value="<?php echo $filter_search;?>" id="wpcfg_filter_search" name="filter_search" style="font-size: 12px;width: 95px;">
		<button id="wpcfg_filter_search_submit" class="button-primary">Search</button>
		<a href="admin.php?page=cfg_fields"  class="button">Reset</a>
	</div>
	<div class="col_info_wrapper" style="width: 420px;font-size: 12px !important;margin-top: 6px;float: left;margin-left: 15px;">
		<span class="col_0_preview"></span><span class="col_pr_name">Both Columns</span>
		<span class="col_1_preview"></span><span class="col_pr_name">Left Column</span>
		<span class="col_2_preview"></span><span class="col_pr_name">Right Column</span>
		<span class="col_none_preview"></span><span class="col_pr_name">Popup</span>
	</div>
	<div style="float:right;">
		<a href="admin.php?page=cfg_fields&act=new&filter_form=<?php echo $filter_form; ?>" id="wpcfg_add" class="button-primary">New</a>
		<button id="wpcfg_edit" class="button button-disabled wpcfg_disabled" title="Please make a selection from the list, to activate this button">Edit</button>
		<button id="wpcfg_publish_list" class="button button-disabled wpcfg_disabled" title="Please make a selection from the list, to activate this button">Publish</button>
		<button id="wpcfg_unpublish_list" class="button button-disabled wpcfg_disabled" title="Please make a selection from the list, to activate this button">Unpublish</button>
		<button id="wpcfg_delete" class="button button-disabled wpcfg_disabled" title="Please make a selection from the list, to activate this button">Delete</button>
	</div>
</div>
<table class="widefat" >
	<thead>
		<tr>
			<th nowrap align="center" style="width: 30px;text-align: center;"><input type="checkbox" name="toggle" value="" id="wpcfg_check_all" /></th>
			<th nowrap align="center" style="width: 30px;text-align: center;">Order</th>
			<th nowrap align="center" style="width: 30px;text-align: center;">Status</th>
			<th nowrap align="left" style="text-align: left;padding-left: 22px;">Name</th>
			<th nowrap align="left" style="text-align: left;">Type</th>
			<th nowrap align="left" style="text-align: left;">Form</th>
			<th nowrap align="center" style="width: 30px;text-align: center;">Id</th>
		</tr>
	</thead>
<tbody id="wpcfg_sortable" table_name="<?php echo $wpdb->prefix;?>cfg_fields" reorder_type="reorder">
<?php        
			$k = 0;
			for($i=0; $i < count( $rows ); $i++) {
				$row = $rows[$i];
				$col_color = $row->type != 'Creative Popup' ? $row->column_type : 'none';
?>
				<tr class="cfg_column_<?php echo $col_color;?> ui-state-default" id="option_li_<?php echo $row->id; ?>">
					<td nowrap valign="middle" align="center" style="vertical-align: middle;width: 30px;" >
						<input style="margin-left: 8px;" type="checkbox" id="cb<?php echo $i; ?>" class="wpcfg_row_ch" name="ids[]" value="<?php echo $row->id; ?>" />
					</td>
					<td valign="middle" align="center" style="vertical-align: middle;width: 30px;">
						<div class="wpcfg_reorder"></div>
					</td>
					<td valign="middle" align="center" style="vertical-align: middle;width: 30px;">
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
					<td valign="middle" align="left" style="vertical-align: middle;padding-left: 22px;" now_w="1">
						<a href="admin.php?page=cfg_fields&act=edit&id=<?php echo $row->id;?>"><?php echo esc_html($row->name); ?></a>
					</td>
					<td valign="middle" align="left" style="vertical-align: middle;" now_w="1">
						<?php echo intval($row->type);?>
					</td>
					<td valign="middle" align="left" style="vertical-align: middle;" now_w="1">
						<a href="admin.php?page=cfg_forms&act=edit&id=<?php echo intval($row->form_id);?>"><?php echo esc_html($row->form); ?></a>
					</td>
					<td valign="middle" align="center" style="vertical-align: middle;width: 30px;">
						<?php echo intval($row->id); ?>
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

<style>
th {
	border-bottom: none !important;
}
td {
	border-top: 1px solid #C2C2C2;
}
tr:first-child td { 
   border-top: 1px solid rgba(194, 194, 194, 0.67);
}
tr.cfg_column_0 td {
	background-color: rgba(255, 199, 135, 0.46) !important;
}
tr.cfg_column_1 td {
	background-color: rgba(121, 210, 255, 0.35) !important;
}
tr.cfg_column_2 td {
	background-color: rgba(127, 255, 138, 0.53) !important;
}
tr.cfg_column_none td {
	background-color: rgba(0, 0, 0, 0.2) !important;
}
.col_info_wrapper {
	font-size: 12px !important;
	margin-top: 6px;
}
.col_0_preview {
	display: inline-block;
	width: 20px;
	height: 18px;
	margin-top: -1px;
	padding: 0 5px 0 5px;
	background-color: rgba(255, 199, 135, 0.46) !important;
	border: 1px solid #C2C2C2 !important;
	float: left;
	cursor: pointer;
	transition: all 0.2s ease-out 0s;
	-webkit-transition: all 0.2s ease-out 0s;
	-moz-transition: all 0.2s ease-out 0s;
}
.col_1_preview {
	display: inline-block;
	width: 20px;
	height: 18px;
	margin-top: -1px;
	padding: 0 5px 0 5px;
	background-color: rgba(121, 210, 255, 0.35) !important;
	border: 1px solid #C2C2C2 !important;
	float: left;
	margin-left: 5px;
	cursor: pointer;
	transition: all 0.2s ease-out 0s;
	-webkit-transition: all 0.2s ease-out 0s;
	-moz-transition: all 0.2s ease-out 0s;
}
.col_2_preview {
	display: inline-block;
	width: 20px;
	height: 18px;
	margin-top: -1px;
	padding: 0 5px 0 5px;
	background-color: rgba(127, 255, 138, 0.53) !important;
	border: 1px solid #C2C2C2 !important;
	float: left;
	margin-left: 5px;
	cursor: pointer;
	transition: all 0.2s ease-out 0s;
	-webkit-transition: all 0.2s ease-out 0s;
	-moz-transition: all 0.2s ease-out 0s;
}
.col_none_preview {
	display: inline-block;
	width: 20px;
	height: 18px;
	margin-top: -1px;
	padding: 0 5px 0 5px;
	background-color: rgba(0, 0, 0, 0.2) !important;
	border: 1px solid #A8A8A8 !important;
	float: left;
	margin-left: 5px;
	cursor: pointer;
	transition: all 0.2s ease-out 0s;
	-webkit-transition: all 0.2s ease-out 0s;
	-moz-transition: all 0.2s ease-out 0s;
}
.col_0_preview:hover,
.col_1_preview:hover,
.col_2_preview:hover,
.col_none_preview:hover {
	transform: scale(1.2,1.2);
	-webkit-transform: scale(1.2,1.2);
	-moz-transform: scale(1.2,1.2);
}
.col_pr_name {
	display: inline-block;
	float: left;
	margin-left: 3px;
}
</style>

