<?php 
// no direct access!
defined('ABSPATH') or die("No direct access");
?>
<div class="purchase_block">
	<div class="purchase_block_txt">Get Contact Form Generator Commercial and gain access to <b style="color: rgb(0, 107, 145);">Unlimited Fields, Unlimited Forms, NO CopyRight, Professional Support and much more.</b></div>
    <a href="http://creative-solutions.net/wordpress/contact-form-generator" id="cfg_buy_pro" target="_blank">Get Contact Form Generator Commercial</a>
</div>
<?php 
$page = isset($_GET['page']) ? $_GET['page'] : 'contactformgenerator';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$id = isset($_REQUEST['id']) ?  $_REQUEST['id'] : 0;
//get the active text
switch ($page) {
	case 'contactformgenerator':
		$active_text = 'Overview';
		break;
	case 'cfg_forms':
		$active_text = $act == '' ? 'Forms' : ($act == 'new' ? 'Forms : New' : 'Forms : Edit');
		break;
	case 'cfg_fields':
		$active_text = $act == '' ? 'Fields' : ($act == 'new' ? 'Fields : New' : 'Fields : Edit');
		break;
	case 'cfg_templates':
		$active_text = 'Templates';
		break;
}
?>
    <div id="cfg_logo" class="icon32"></div>
    <h2>Contact Form Generator : <?php echo $active_text;?></h2>
    <p></p>
    <div id="cfg-toolbar">
        <ul id="cfg-toolbar-links">
	        <li><div class="cfg-toolbar-link-bg" id="cfg-toolbar-link-overview<?php echo $page == 'contactformgenerator' ? '_active' : '';?>" style="margin-left: 5px;"></div><a class="<?php echo $page == 'contactformgenerator' ? 'cfg-toolbar-active' : '';?>" href="admin.php?page=contactformgenerator">Overview</a></li>
	        <li><div class="cfg-toolbar-link-bg" id="cfg-toolbar-link-forms<?php echo $page == 'cfg_forms' ? '_active' : '';?>"></div><a class="<?php echo $page == 'cfg_forms' ? 'cfg-toolbar-active' : '';?>" href="admin.php?page=cfg_forms">Forms</a></li>
	        <li><div class="cfg-toolbar-link-bg" id="cfg-toolbar-link-fields<?php echo $page == 'cfg_fields' ? '_active' : '';?>"></div><a class="<?php echo $page == 'cfg_fields' ? 'cfg-toolbar-active' : '';?>" href="admin.php?page=cfg_fields">Fields</a></li>
	        <li><div class="cfg-toolbar-link-bg" id="cfg-toolbar-link-templates<?php echo $page == 'cfg_templates' ? '_active' : '';?>"></div><a class="<?php echo $page == 'cfg_templates' ? 'cfg-toolbar-active' : '';?>" href="admin.php?page=cfg_templates">Templates</a></li>
        </ul>
    </div>
    <div style="clear:both;"></div>

    