<?php 
// no direct access!
defined('ABSPATH') or die("No direct access");

if(!isset($_SESSION['wpcfg_rate_us_counter']))
	$_SESSION['wpcfg_rate_us_counter'] = 0;
else
	$_SESSION['wpcfg_rate_us_counter'] ++;

?>
<?php if ($_SESSION['wpcfg_rate_us_counter'] > 3 && $_SESSION['wpcfg_rate_us_counter'] < 100): ?>	
<div class="wpcfg_rate_us_wrapper">
	<b>PLEASE</b> help us to make this plugin more popular, and write a <b>5-star</b> review in <a href="https://wordpress.org/support/view/plugin-reviews/contact-form-generator" target="_blank">Plugins Directory</a>.
	<br /> That will take less than 5 minutes, but is extremely important for us! <span class="wpcfg_thx">Thanks in advance!</span>
	<div id="wpcfg_close_rate_us_dialog" title="Hide this box">Close</div>
</div>
<?php endif ?>

<table class="adminlist bottom_table" style="width: 100%;clear: both;"><tr><td align="center" valign="middle" id="cfg_ext_td" style="position: relative;">
	<div id="cfg_bottom_link"><a href="http://creative-solutions.net/wordpress/contact-form-generator" target="_blank">Contact Form Generator</a> developed and designed by <a href="http://creative-solutions.net/" target="_blank">Creative Solutions</a></div>
	<div style="position: absolute;right: 2px;top: 7px;">
		<a href="http://creative-solutions.net/wordpress/contact-form-generator" target="_blank" id="cfg_ext_homepage" style="margin: 0 2px 0 0px;" class="cfg_ext_bottom_icon" title="Go to project homepage">&nbsp;</a>
		<a href="http://creative-solutions.net/forum/contact-form-generator-wordpress/" target="_blank" id="cfg_ext_support" class="cfg_ext_bottom_icon" title="Here You can ask any questions related to this plugin">&nbsp;</a>
		<a href="http://creative-solutions.net/wordpress/contact-form-generator" target="_blank" id="cfg_ext_buy" class="cfg_ext_bottom_icon" title="Buy version without backlink and limits">&nbsp;</a>
	</div>
</td></tr></table>

<style type="text/css">
.wpcfg_rate_us_wrapper {
	line-height: 20px;
	text-align: center;
	padding: 10px;
	border: 1px solid rgb(158, 158, 158);
	background-color: rgba(246, 250, 95, 0.37);
	border-radius: 12px;
	clear: both;
	margin-bottom: 5px;
	position: relative;
}
.wpcfg_thx {
	font-size: 105%;
	color: rgb(224, 0, 0);
	font-weight: bold;
}
.wpcfg_rate_us_wrapper a{
	font-weight: bold;
}
#wpcfg_close_rate_us_dialog {
	text-decoration: underline;
	position: absolute;
	top: 0px;
	right: 11px;
	font-style: italic;
	font-size: 12px;
	cursor: pointer;
}
#wpcfg_close_rate_us_dialog:hover {
	color: rgb(224, 0, 0);
}

</style>
