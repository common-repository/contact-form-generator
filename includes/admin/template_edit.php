<?php 
// no direct access!
defined('ABSPATH') or die("No direct access");

global $wpdb;

$id = intval($id);

if($id != 0) {
//get the rows
	$sql = "SELECT * FROM ".$wpdb->prefix."cfg_templates WHERE id = '".$id."'";
	$row = $wpdb->get_row($sql);

	$styles_row = $row->styles;
	$styles_array = explode('|',$styles_row);
	$max = 0;
	foreach ($styles_array as $val) {
		$arr = explode('~',$val);
		$styles[$arr[0]] = $arr[1];
		$max = $arr[0]> $max ? $arr[0] : $max;
	}

	/*
	*/
	$keys = array_keys($styles);
	sort($keys);
}
?>
<?php
	$cfg_fonts_indexes_array = array(506,507,508,509,131,112,202,152,529);
	$cfg_google_requested_fonts = array();
	foreach($cfg_fonts_indexes_array as $key) {
		$cfg_googlefont = 'cfg-googlewebfont-';
		preg_match('/'.$key.'~([^\|]+)\|/',$styles_row,$m);
		$cfg_font_rule = isset($m[1]) ? $m[1] : '';

		if (strpos($cfg_font_rule,$cfg_googlefont) !== false) {
			$cfg_font_rule = str_replace($cfg_googlefont, '', $cfg_font_rule);
			$cfg_font_rule = str_replace(' ', '+', $cfg_font_rule);
			$cfg_google_requested_fonts[] = $cfg_font_rule;
		}
	}
	$cfg_google_requested_fonts = implode('|',$cfg_google_requested_fonts);
	if($cfg_google_requested_fonts != '') {
		$cfg_google_font_link = 'http://fonts.googleapis.com/css?family='.$cfg_google_requested_fonts;
		// $document->addStyleSheet($cfg_google_font_link, 'text/css', null, array());
		wp_enqueue_style('wpgs-styles100', $cfg_google_font_link);
	}
?>
<?php 
echo '<style>
		.colorpicker input {
			background-color: transparent !important;
			border: 1px solid transparent !important;
			position: absolute !important;
			font-size: 10px !important;
			font-family: Arial, Helvetica, sans-serif !important;
			color: #898989 !important;
			top: 4px !important;
			right: 11px !important;
			text-align: right !important;
			margin: 0 !important;
			padding: 0 !important;
			height: 11px !important;
			outline: none !important;
			box-shadow: none !important;
			width: 32px !important;
			height: 12px !important;
			top: 2px !important;
		}
		.colorpicker_hex input {
			width: 38px !important;
			right: 6px !important;
		}
		.colorpicker_hex input.inactive_state {
			width: 38px !important;
			right: 6px !important;
		}
</style>';
?>
<script type="text/javascript">
(function($) {
	$(document).ready(function() {
$('.sexycontactform_input_element input,.sexycontactform_input_element textarea').focus(function() {
	$(this).parents('.sexycontactform_input_element').not('.sexy_error_input').addClass('focused');
});
$('.sexycontactform_input_element input,.sexycontactform_input_element textarea').blur(function() {
	$(this).parents('.sexycontactform_input_element').removeClass('focused');
});

})

})(jQuery);

if (typeof contactformgenerator_shake_count_array === 'undefined') { var contactformgenerator_shake_count_array = new Array();};contactformgenerator_shake_count_array[1] = "3"; if (typeof contactformgenerator_shake_distanse_array === 'undefined') { var contactformgenerator_shake_distanse_array = new Array();};contactformgenerator_shake_distanse_array[1] = "10"; if (typeof contactformgenerator_shake_duration_array === 'undefined') { var contactformgenerator_shake_duration_array = new Array();};contactformgenerator_shake_duration_array[1] = "300";var contactformgenerator_path = ""; if (typeof contactformgenerator_redirect_enable_array === 'undefined') { var contactformgenerator_redirect_enable_array = new Array();};contactformgenerator_redirect_enable_array[1] = "0"; if (typeof contactformgenerator_redirect_array === 'undefined') { var contactformgenerator_redirect_array = new Array();};contactformgenerator_redirect_array[1] = ""; if (typeof contactformgenerator_redirect_delay_array === 'undefined') { var contactformgenerator_redirect_delay_array = new Array();};contactformgenerator_redirect_delay_array[1] = "0"; if (typeof contactformgenerator_thank_you_text_array === 'undefined') { var contactformgenerator_thank_you_text_array = new Array();};contactformgenerator_thank_you_text_array[1] = "Message successfully sent"; if (typeof contactformgenerator_pre_text_array === 'undefined') { var contactformgenerator_pre_text_array = new Array();};contactformgenerator_pre_text_array[1] = "Contact us, if you have any questions";

//admin forever
var req = false;
function refreshSession() {
    req = false;
    if(window.XMLHttpRequest && !(window.ActiveXObject)) {
        try {
            req = new XMLHttpRequest();
        } catch(e) {
            req = false;
        }
    // branch for IE/Windows ActiveX version
    } else if(window.ActiveXObject) {
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                req = false;
            }
        }
    }

    if(req) {
        req.onreadystatechange = processReqChange;
        req.open("HEAD", "<?php echo plugins_url( '../../../../../' , __FILE__ );?>", true);
        req.send();
    }
}

function processReqChange() {
    // only if req shows "loaded"
    if(req.readyState == 4) {
        // only if "OK"
        if(req.status == 200) {
            // TODO: think what can be done here
        } else {
            // TODO: think what can be done here
            //alert("There was a problem retrieving the XML data: " + req.statusText);
        }
    }
}
setInterval("refreshSession()", 60000);
</script>

<script type="text/javascript">
(function($) {
	$(document).ready(function() {

		$('.contactformgenerator_input_element input,.contactformgenerator_input_element textarea').focus(function() {
			$(this).parents('.contactformgenerator_input_element').not('.cfg_error_input').addClass('focused');
		});
		$('.contactformgenerator_input_element input,.contactformgenerator_input_element textarea').blur(function() {
			$(this).parents('.contactformgenerator_input_element').removeClass('focused');
		});


		var active_element;
		$('.colorSelector').click(function() {
			active_element = $(this);
		})
		
		//magic functions
		function create_backround_gradient() {

		}
		
		$('.colorSelector').ColorPicker({
			onBeforeShow: function () {
				$color = $(active_element).next('input').val();
				$(this).ColorPickerSetColor($color);
			},
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {

				$(active_element).children('div').css('backgroundColor', '#' + hex);
				$(active_element).next('input').val('#' + hex);
				roll = $(active_element).next('input').attr('roll');

				//main wrapper
				if(roll == 0 || roll == 130) {
					if($("#elem-627").val() == 1) {

						var back = '-webkit-linear-gradient(top, ' + $("#elem-0").val() + ', '  + $("#elem-130").val() + ')';
						$(".contactformgenerator_wrapper").css('background' , back);
						back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-0").val() + '), to('  + $("#elem-130").val() + '))';
						$(".contactformgenerator_wrapper").css('background' , back);
						back = '-moz-linear-gradient(top, ' + $("#elem-0").val() + ', '  + $("#elem-130").val() + ')';
						$(".contactformgenerator_wrapper").css('background' , back);
						back = '-ms-linear-gradient(top, ' + $("#elem-0").val() + ', '  + $("#elem-130").val() + ')';
						$(".contactformgenerator_wrapper").css('background' , back);
						back = '-o-linear-gradient(top, ' + $("#elem-0").val() + ', '  + $("#elem-130").val() + ')';
						$(".contactformgenerator_wrapper").css('background' , back);
						fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-0").val() + ', endColorstr='  + $("#elem-130").val() + ')';
						$(".contactformgenerator_wrapper").css('filter' , fil);

						$(".contactformgenerator_wrapper").css('background-color' , $("#elem-0").val());
					}
					else {
						$(".contactformgenerator_wrapper").css('background' , 'none');
						$(".contactformgenerator_wrapper").css('background-color' , $("#elem-0").val());
					}

				}
				// header styles
				else if(roll == 601 || roll == 602) {
					$(".contactformgenerator_header").css('backgroundColor' , '#' + hex);

					var back = '-webkit-linear-gradient(top, ' + $("#elem-601").val() + ', '  + $("#elem-602").val() + ')';
					$(".contactformgenerator_header").css('background' , back);
					back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-601").val() + '), to('  + $("#elem-602").val() + '))';
					$(".contactformgenerator_header").css('background' , back);
					back = '-moz-linear-gradient(top, ' + $("#elem-601").val() + ', '  + $("#elem-602").val() + ')';
					$(".contactformgenerator_header").css('background' , back);
					back = '-ms-linear-gradient(top, ' + $("#elem-601").val() + ', '  + $("#elem-602").val() + ')';
					$(".contactformgenerator_header").css('background' , back);
					back = '-o-linear-gradient(top, ' + $("#elem-601").val() + ', '  + $("#elem-602").val() + ')';
					$(".contactformgenerator_header").css('background' , back);
					fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-601").val() + ', endColorstr='  + $("#elem-602").val() + ')';
					$(".contactformgenerator_header").css('filter' , fil);

				}
				// body styles
				else if(roll == 611 || roll == 612) {

					$(".contactformgenerator_body").css('backgroundColor' , '#' + hex);

					var back = '-webkit-linear-gradient(top, ' + $("#elem-611").val() + ', '  + $("#elem-612").val() + ')';
					$(".contactformgenerator_body").css('background' , back);
					back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-611").val() + '), to('  + $("#elem-612").val() + '))';
					$(".contactformgenerator_body").css('background' , back);
					back = '-moz-linear-gradient(top, ' + $("#elem-611").val() + ', '  + $("#elem-612").val() + ')';
					$(".contactformgenerator_body").css('background' , back);
					back = '-ms-linear-gradient(top, ' + $("#elem-611").val() + ', '  + $("#elem-612").val() + ')';
					$(".contactformgenerator_body").css('background' , back);
					back = '-o-linear-gradient(top, ' + $("#elem-611").val() + ', '  + $("#elem-612").val() + ')';
					$(".contactformgenerator_body").css('background' , back);
					fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-611").val() + ', endColorstr='  + $("#elem-612").val() + ')';
					$(".contactformgenerator_body").css('filter' , fil);
				}
				// footer styles
				else if(roll == 618 || roll == 619) {
					$(".contactformgenerator_footer").css('backgroundColor' , '#' + hex);

					var back = '-webkit-linear-gradient(top, ' + $("#elem-618").val() + ', '  + $("#elem-619").val() + ')';
					$(".contactformgenerator_footer").css('background' , back);
					back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-618").val() + '), to('  + $("#elem-619").val() + '))';
					$(".contactformgenerator_footer").css('background' , back);
					back = '-moz-linear-gradient(top, ' + $("#elem-618").val() + ', '  + $("#elem-619").val() + ')';
					$(".contactformgenerator_footer").css('background' , back);
					back = '-ms-linear-gradient(top, ' + $("#elem-618").val() + ', '  + $("#elem-619").val() + ')';
					$(".contactformgenerator_footer").css('background' , back);
					back = '-o-linear-gradient(top, ' + $("#elem-618").val() + ', '  + $("#elem-619").val() + ')';
					$(".contactformgenerator_footer").css('background' , back);
					fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-618").val() + ', endColorstr='  + $("#elem-619").val() + ')';
					$(".contactformgenerator_footer").css('filter' , fil);
				}
				else if(roll == 1) {
					$(".contactformgenerator_wrapper").css('borderColor' , '#' + hex);
				}
				else if(roll == 8) {
					var boxShadow = $("#elem-9").val() + ' ' + $("#elem-10").val() + 'px '  + $("#elem-11").val() + 'px '  + $("#elem-12").val() + 'px ' + $("#elem-13").val() + 'px ' + $("#elem-8").val();
					var boxShadow_ = $("#elem-15").val() + ' ' + $("#elem-16").val() + 'px '  + $("#elem-17").val() + 'px '  + $("#elem-18").val() + 'px ' + $("#elem-19").val() + 'px  ' + $("#elem-14").val();

					$(".contactformgenerator_wrapper").css('boxShadow' , boxShadow);
					$(".contactformgenerator_wrapper").hover(function() {
						$(this).css('boxShadow' , boxShadow_);
					},function() {
						$(this).css('boxShadow' , boxShadow);
					});

				}
				else if(roll == 14) {
					var boxShadow = $("#elem-9").val() + ' ' + $("#elem-10").val() + 'px '  + $("#elem-11").val() + 'px '  + $("#elem-12").val() + 'px ' + $("#elem-13").val() + 'px ' + $("#elem-8").val();
					var boxShadow_ = $("#elem-15").val() + ' ' + $("#elem-16").val() + 'px '  + $("#elem-17").val() + 'px '  + $("#elem-18").val() + 'px ' + $("#elem-19").val() + 'px  ' + $("#elem-14").val();
					
					$(".contactformgenerator_wrapper").css('boxShadow' , boxShadow);
					$(".contactformgenerator_wrapper").hover(function() {
						$(this).css('boxShadow' , boxShadow_);
					},function() {
						$(this).css('boxShadow' , boxShadow);
					});
				}
				//top text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				else if(roll == 20) {
					$(".contactformgenerator_title").css('color' , '#' + hex);
				}
				else if(roll == 27) {
					var textShadow = $("#elem-28").val() + 'px '  + $("#elem-29").val() + 'px '  + $("#elem-30").val() + 'px ' + $("#elem-27").val();
					$(".contactformgenerator_title").css('textShadow' , textShadow);
				}
				//field text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				else if(roll == 31) {
					$('.contactformgenerator_field_box').not('.contactformgenerator_error').find(".contactformgenerator_field_name").css('color' , '#' + hex);
				}
				else if(roll == 37) {
					var textShadow = $("#elem-38").val() + 'px '  + $("#elem-39").val() + 'px '  + $("#elem-40").val() + 'px ' + $("#elem-37").val();
					$('.contactformgenerator_field_box').not('.contactformgenerator_error').find(".contactformgenerator_field_name").css('textShadow' , textShadow);
				}
				//asterisk text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				else if(roll == 41) {
					$(".contactformgenerator_field_required").css('color' , '#' + hex);
				}
				else if(roll == 46) {
					var textShadow = $("#elem-47").val() + 'px '  + $("#elem-48").val() + 'px '  + $("#elem-49").val() + 'px ' + $("#elem-46").val();
					$(".contactformgenerator_field_required").css('textShadow' , textShadow);
				}

				//contactformgenerator_send////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				else if(roll == 91 || roll == 50 ) {
					var backColor_ = $("#elem-91").val();
					$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('backgroundColor' , backColor_);

					var back = '-webkit-linear-gradient(top, ' + $("#elem-91").val() + ', '  + $("#elem-50").val() + ')';
					$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('background' , back);
					back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-91").val() + '), to('  + $("#elem-50").val() + '))';
					$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('background' , back);
					back = '-moz-linear-gradient(top, ' + $("#elem-91").val() + ', '  + $("#elem-50").val() + ')';
					$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('background' , back);
					back = '-ms-linear-gradient(top, ' + $("#elem-91").val() + ', '  + $("#elem-50").val() + ')';
					$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('background' , back);
					back = '-o-linear-gradient(top, ' + $("#elem-91").val() + ', '  + $("#elem-50").val() + ')';
					$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('background' , back);
					fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-91").val() + ', endColorstr='  + $("#elem-50").val() + ')';
					$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('filter' , fil);

				}
				else if(roll == 51 || roll == 52 ) {
					var backColor_ = $("#elem-51").val();
					$(".contactformgenerator_send_hovered").css('backgroundColor' , backColor_);

					var back = '-webkit-linear-gradient(top, ' + $("#elem-51").val() + ', '  + $("#elem-52").val() + ')';
					$(".contactformgenerator_send_hovered").css('background' , back);
					back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-51").val() + '), to('  + $("#elem-52").val() + '))';
					$(".contactformgenerator_send_hovered").css('background' , back);
					back = '-moz-linear-gradient(top, ' + $("#elem-51").val() + ', '  + $("#elem-52").val() + ')';
					$(".contactformgenerator_send_hovered").css('background' , back);
					back = '-ms-linear-gradient(top, ' + $("#elem-51").val() + ', '  + $("#elem-52").val() + ')';
					$(".contactformgenerator_send_hovered").css('background' , back);
					back = '-o-linear-gradient(top, ' + $("#elem-51").val() + ', '  + $("#elem-52").val() + ')';
					$(".contactformgenerator_send_hovered").css('background' , back);
					fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-51").val() + ', endColorstr='  + $("#elem-52").val() + ')';
					$(".contactformgenerator_send_hovered").css('filter' , fil);
				}
				else if(roll == 100) {//answer animation backgroundColor
					var borderColor_ = $("#elem-100").val();
					$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('borderColor' , borderColor_);

				}
				else if(roll == 126) {
					var borderColor_ = $("#elem-126").val();
					$(".contactformgenerator_send_hovered").css('borderColor' , borderColor_);
				}
				else if(roll == 94) { //
					var boxShadow_ = $("#elem-95").val() + ' ' + $("#elem-96").val() + 'px '  + $("#elem-97").val() + 'px '  + $("#elem-98").val() + 'px ' + $("#elem-99").val() + 'px ' + $("#elem-94").val();
					$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('boxShadow' , boxShadow_);
				}
				else if(roll == 117) { //
					var boxShadow = $("#elem-118").val() + ' ' + $("#elem-119").val() + 'px '  + $("#elem-120").val() + 'px '  + $("#elem-121").val() + 'px ' + $("#elem-122").val() + 'px ' +  $("#elem-117").val();
					$(".contactformgenerator_send_hovered").css('boxShadow' , boxShadow);
				}
				else if(roll == 106) {
					var textColor_ = $("#elem-106").val();
					$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('color' , textColor_);
				}
				else if(roll == 124) {
					var textColor_ = $("#elem-124").val();
					$(".contactformgenerator_send_hovered").css('color' , textColor_);
				}
				else if(roll == 113) { 
					var textShadow_ = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px ' + $("#elem-113").val();
					$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('textShadow' , textShadow_);
				}
				else if(roll == 125) { 
					var textShadow = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px ' + $("#elem-125").val();
					$(".contactformgenerator_send_hovered").css('textShadow' , textShadow);
				}

				//contactformgenerator text inputs////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				else if(roll == 132 || roll == 133 || roll == 157 || roll == 158) {//answer animation backgroundColor
					var backColor_ = $("#elem-132").val();
					$(".contactformgenerator_input_element").not('.cfg_error_input').css('backgroundColor' , backColor_);

					var back = '-webkit-linear-gradient(top, ' + $("#elem-132").val() + ', '  + $("#elem-133").val() + ')';
					$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').css('background' , back);

					back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-132").val() + '), to('  + $("#elem-133").val() + '))';
					$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').css('background' , back);

					back = '-moz-linear-gradient(top, ' + $("#elem-132").val() + ', '  + $("#elem-133").val() + ')';
					$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').css('background' , back);

					back = '-ms-linear-gradient(top, ' + $("#elem-132").val() + ', '  + $("#elem-133").val() + ')';
					$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').css('background' , back);

					back = '-o-linear-gradient(top, ' + $("#elem-132").val() + ', '  + $("#elem-133").val() + ')';
					$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').css('background' , back);

					fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-132").val() + ', endColorstr='  + $("#elem-133").val() + ')';
					$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').css('filter' , fil);
					
					// hovered state

					var back = '-webkit-linear-gradient(top, ' + $("#elem-157").val() + ', '  + $("#elem-158").val() + ')';
					$(".contactformgenerator_input_element_hovered").not('.cfg_error_input').css('background' , back);
					back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-157").val() + '), to('  + $("#elem-158").val() + '))';
					$(".contactformgenerator_input_element_hovered").not('.cfg_error_input').css('background' , back);
					back = '-moz-linear-gradient(top, ' + $("#elem-157").val() + ', '  + $("#elem-158").val() + ')';
					$(".contactformgenerator_input_element_hovered").not('.cfg_error_input').css('background' , back);
					back = '-ms-linear-gradient(top, ' + $("#elem-157").val() + ', '  + $("#elem-158").val() + ')';
					$(".contactformgenerator_input_element_hovered").not('.cfg_error_input').css('background' , back);
					back = '-o-linear-gradient(top, ' + $("#elem-157").val() + ', '  + $("#elem-158").val() + ')';
					$(".contactformgenerator_input_element_hovered").not('.cfg_error_input').css('background' , back);
					fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-157").val() + ', endColorstr='  + $("#elem-158").val() + ')';
					$(".contactformgenerator_input_element_hovered").not('.cfg_error_input').css('filter' , fil);

				}
				else if(roll == 134 || roll == 161) {//answer animation backgroundColor
					var borderColor = $("#elem-134").val();
					var borderColor_ = $("#elem-161").val();
					$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').css('borderColor' , borderColor);
					
					$(".contactformgenerator_input_element_hovered").css('borderColor' , borderColor_);
				}
				else if(roll == 141 || roll == 162) { 

					var boxShadow = $("#elem-142").val() + ' ' + $("#elem-143").val() + 'px '  + $("#elem-144").val() + 'px '  + $("#elem-145").val() + 'px ' + $("#elem-146").val() + 'px ' +  $("#elem-141").val();
					var boxShadow_ = $("#elem-163").val() + ' ' + $("#elem-164").val() + 'px '  + $("#elem-165").val() + 'px '  + $("#elem-166").val() + 'px ' + $("#elem-167").val() + 'px ' +  $("#elem-162").val();
					$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').css('boxShadow' , boxShadow);
					
					$(".contactformgenerator_input_element_hovered").css('boxShadow' , boxShadow_);
				}
				else if(roll == 147 || roll == 159) {
					var textColor = $("#elem-147").val();
					var textColor_ = $("#elem-159").val();
					$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').find('input').css('color' , textColor);
					$(".contactformgenerator_input_element textarea").css('color' , textColor);

					$(".contactformgenerator_input_element_hovered input").css('color' , textColor_);
				}
				else if(roll == 153 || roll == 160) { 
					var textShadow = $("#elem-154").val() + 'px '  + $("#elem-155").val() + 'px '  + $("#elem-156").val() + 'px ' + $("#elem-153").val();
					var textShadow_ = $("#elem-154").val() + 'px '  + $("#elem-155").val() + 'px '  + $("#elem-156").val() + 'px ' + $("#elem-160").val();
					$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').find('input').css('textShadow' , textShadow);
					$(".contactformgenerator_input_element textarea").css('textShadow' , textShadow);
					
					$(".contactformgenerator_input_element_hovered input").css('textShadow' , textShadow_);
				}
				//Error State////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        	
	        	else if(roll == 171) {
					$(".contactformgenerator_error .contactformgenerator_field_name").css('color' , '#' + hex);
				}
				else if(roll == 172) {
					var textShadow = $("#elem-173").val() + 'px '  + $("#elem-174").val() + 'px '  + $("#elem-175").val() + 'px ' + $("#elem-172").val();
					$(".contactformgenerator_error .contactformgenerator_field_name").css('textShadow' , textShadow);
				}
				
				else if(roll == 176 || roll == 177) {
					var backColor = $("#elem-176").val();
					$(".contactformgenerator_error .contactformgenerator_input_element").css('backgroundColor' , backColor);

					var back = '-webkit-linear-gradient(top, ' + $("#elem-176").val() + ', '  + $("#elem-177").val() + ')';
					$(".contactformgenerator_error .contactformgenerator_input_element").css('background' , back);
					back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-176").val() + '), to('  + $("#elem-177").val() + '))';
					$(".contactformgenerator_error .contactformgenerator_input_element").css('background' , back);
					back = '-moz-linear-gradient(top, ' + $("#elem-176").val() + ', '  + $("#elem-177").val() + ')';
					$(".contactformgenerator_error .contactformgenerator_input_element").css('background' , back);
					back = '-ms-linear-gradient(top, ' + $("#elem-176").val() + ', '  + $("#elem-177").val() + ')';
					$(".contactformgenerator_error .contactformgenerator_input_element").css('background' , back);
					back = '-o-linear-gradient(top, ' + $("#elem-176").val() + ', '  + $("#elem-177").val() + ')';
					$(".contactformgenerator_error .contactformgenerator_input_element").css('background' , back);
					fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-176").val() + ', endColorstr='  + $("#elem-177").val() + ')';
					$(".contactformgenerator_error .contactformgenerator_input_element").css('filter' , fil);

				}
				else if(roll == 178) {
					var borderColor = $("#elem-178").val();
					$(".contactformgenerator_error .contactformgenerator_input_element").css('borderColor' , borderColor);
				}
				else if(roll == 179) {
					var fontColor = $("#elem-179").val();
					$(".contactformgenerator_error input").css('color' , fontColor);
				}
				else if(roll == 184) { 
					var boxShadow = $("#elem-185").val() + ' ' + $("#elem-186").val() + 'px '  + $("#elem-187").val() + 'px '  + $("#elem-188").val() + 'px ' + $("#elem-189").val() + 'px ' +  $("#elem-184").val();
					$(".contactformgenerator_error .contactformgenerator_input_element").css('boxShadow' , boxShadow);
				}
				else if(roll == 180) { 
					var textShadow = $("#elem-181").val() + 'px '  + $("#elem-182").val() + 'px '  + $("#elem-183").val() + 'px ' + $("#elem-180").val();
					$(".contactformgenerator_error input").css('textShadow' , textShadow);
				}
				/*pre text ********************************************************************************************************************************************************************************/
	        	else if(roll == 195) { 
					var borderTop = $("#elem-194").val() + 'px '  + $("#elem-196").val() + $("#elem-195").val();
					$(".contactformgenerator_pre_text").css('borderTop' , borderTop);
				}
	        	else if(roll == 197) {
					$(".contactformgenerator_pre_text").css('color' , $("#elem-197").val());
				}
	        	else if(roll == 203) { 
					var textShadow = $("#elem-204").val() + 'px '  + $("#elem-205").val() + 'px '  + $("#elem-206").val() + 'px ' + $("#elem-203").val();
					$(".contactformgenerator_pre_text").css('textShadow' , textShadow);
				}


			/*contactformgenerator_headding ********************************************************************************************************************************************************************************/
				else if(roll == 541 || roll == 542) {
					var backColor = $("#elem-541").val();
					$(".contactformgenerator_heading").css('backgroundColor' , backColor);

					var back = '-webkit-linear-gradient(top, ' + $("#elem-541").val() + ', '  + $("#elem-542").val() + ')';
					$(".contactformgenerator_heading").css('background' , back);
					back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-541").val() + '), to('  + $("#elem-542").val() + '))';
					$(".contactformgenerator_heading").css('background' , back);
					back = '-moz-linear-gradient(top, ' + $("#elem-541").val() + ', '  + $("#elem-542").val() + ')';
					$(".contactformgenerator_heading").css('background' , back);
					back = '-ms-linear-gradient(top, ' + $("#elem-541").val() + ', '  + $("#elem-542").val() + ')';
					$(".contactformgenerator_heading").css('background' , back);
					back = '-o-linear-gradient(top, ' + $("#elem-541").val() + ', '  + $("#elem-542").val() + ')';
					$(".contactformgenerator_heading").css('background' , back);
					fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-541").val() + ', endColorstr='  + $("#elem-542").val() + ')';
					$(".contactformgenerator_heading").css('filter' , fil);

				}
				else if(roll == 548 || roll == 549 || roll == 550 || roll == 551) { 
	        		var border_top = $("#elem-543").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-548").val();
	        		var border_right = $("#elem-544").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-549").val();
	        		var border_bottom = $("#elem-545").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-550").val();
	        		var border_left = $("#elem-546").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-551").val();
					$(".contactformgenerator_heading").css('border-top' , border_top);
					$(".contactformgenerator_heading").css('border-right' , border_right);
					$(".contactformgenerator_heading").css('border-bottom' , border_bottom);
					$(".contactformgenerator_heading").css('border-left' , border_left);
	        	}
	        	else if(roll == 531) { 
					var textShadow = $("#elem-532").val() + 'px '  + $("#elem-533").val() + 'px '  + $("#elem-534").val() + 'px ' + $("#elem-531").val();
					$(".contactformgenerator_heading").css('textShadow' , textShadow);
				}
	        	else if(roll == 524) { 
					var fontColor = $("#elem-524").val();
					$(".contactformgenerator_heading").css('color' ,fontColor);
				}

	        	else if(roll == 587) { 
					var fontColor = $("#elem-587").val();
					$(".contactformgenerator_wrapper").css('color' ,fontColor);
				}	        	
				else if(roll == 553) { 
					var fontColor = $("#elem-553").val();
					$(".cfg_content_element_label").css('color' ,fontColor);
				}
	        	else if(roll == 558) { 
					var textShadow = $("#elem-559").val() + 'px '  + $("#elem-560").val() + 'px '  + $("#elem-561").val() + 'px ' + $("#elem-558").val();
					$(".cfg_content_element_label").css('textShadow' , textShadow);
				}
	        	else if(roll == 592) { 
					var borderBottom = $("#elem-590").val() + 'px '  + $("#elem-591").val() + ' ' + $("#elem-592").val();
					$(".cfg_content_element_label").css('border-bottom' , borderBottom);
				}

	        	else if(roll == 564) { 
					var fontColor = $("#elem-564").val();
					$(".cfg_link").css('color' ,fontColor);
				}
	        	else if(roll == 570) { 
					var textShadow = $("#elem-571").val() + 'px '  + $("#elem-572").val() + 'px '  + $("#elem-573").val() + 'px ' + $("#elem-570").val();
					$(".cfg_link").css('textShadow' , textShadow);
				}
	        	else if(roll == 569) { 
					var borderBottom = $("#elem-567").val() + 'px '  + $("#elem-568").val() + ' ' + $("#elem-569").val();
					$(".cfg_link").css('border-bottom' , borderBottom);
				}

	        	else if(roll == 574) { 
					var fontColor = $("#elem-574").val();
					$(".cfg_link_hovered").css('color' ,fontColor);
				}
	        	else if(roll == 576) { 
					var textShadow = $("#elem-577").val() + 'px '  + $("#elem-578").val() + 'px '  + $("#elem-579").val() + 'px ' + $("#elem-576").val();
					$(".cfg_link_hovered").css('textShadow' , textShadow);
				}
	        	else if(roll == 575) { 
					var borderBottom = $("#elem-567").val() + 'px '  + $("#elem-568").val() + ' ' + $("#elem-575").val();
					$(".cfg_link_hovered").css('border-bottom' , borderBottom);
				}


	        	else if(roll == 580) { 
					var fontColor = $("#elem-580").val();
					$(".cfg_content_styling").css('color' ,fontColor);
				}
	        	else if(roll == 583) { 
					var textShadow = $("#elem-584").val() + 'px '  + $("#elem-585").val() + 'px '  + $("#elem-586").val() + 'px ' + $("#elem-583").val();
					$(".cfg_content_styling").css('textShadow' , textShadow);
				}

	        	else if(roll == 609) { 
					var borderBottom = $("#elem-607").val() + 'px '  + $("#elem-608").val() + ' ' + $("#elem-609").val();
					$(".contactformgenerator_header").css('border-bottom' , borderBottom);
				}
	        	else if(roll == 626) { 
					var borderTop = $("#elem-624").val() + 'px '  + $("#elem-625").val() + ' ' + $("#elem-626").val();
					$(".contactformgenerator_footer").css('border-top' , borderTop);
				}
	        	
			}
		});

		//size up
		var up_int,down_int,curr_up,curr_down;
		$('.size_up').mousedown(function() {
			
			var $this = $(this);
			curr_up = parseInt($this.parent('div').prev('input').val());
			up_int = setInterval(function() {
				max_val = parseInt($this.attr("maxval"));
				val = parseInt($this.parent('div').prev('input').val());
				if(val < max_val) {
					$this.parent('div').prev('input').val(val*1 + 1);
					roll = $this.parent('div').prev('input').attr('roll');
					move_up(roll,val);
				}
			},100);
		})
		
		$('.size_up').mouseup(function() {
			clearInterval(up_int);
			var $this = $(this);
			max_val = parseInt($this.attr("maxval"));
			val = parseInt($this.parent('div').prev('input').val());
			if((val < max_val) && (curr_up == val)) {
				$this.parent('div').prev('input').val(val*1 + 1);
				roll = $this.parent('div').prev('input').attr('roll');
				move_up(roll,val);
			}
		});

		$('.size_up').mouseleave(function() {
			clearInterval(up_int);
		});

		function move_up(roll,val) {
			console.log(val);
			if(roll == 2) {
				$(".contactformgenerator_wrapper").css({
					borderLeftWidth : val*1 + 1,
					borderRightWidth : val*1 + 1,
					borderBottomWidth : val*1 + 1,
					borderTopWidth : val*1 + 1
				});
			}
			else if(roll == 4) {
				$(".contactformgenerator_wrapper").css('border-top-left-radius' , val*1 + 1);
			}
			else if(roll == 5) {
				$(".contactformgenerator_wrapper").css('border-top-right-radius' , val*1 + 1);
			}
			else if(roll == 6) {
				$(".contactformgenerator_wrapper").css('border-bottom-left-radius' , val*1 + 1);
			}
			else if(roll == 7) {
				$(".contactformgenerator_wrapper").css('border-bottom-right-radius' , val*1 + 1);
			}
			else if(roll == 10 || roll == 11 || roll == 12 || roll == 13  || roll == 16  || roll == 17  || roll == 18  || roll == 19  ) { 
				var boxShadow = $("#elem-9").val() + ' ' + $("#elem-10").val() + 'px '  + $("#elem-11").val() + 'px '  + $("#elem-12").val() + 'px ' + $("#elem-13").val() + 'px ' + $("#elem-8").val();
				var boxShadow_ = $("#elem-15").val() + ' ' + $("#elem-16").val() + 'px '  + $("#elem-17").val() + 'px '  + $("#elem-18").val() + 'px ' + $("#elem-19").val() + 'px  ' + $("#elem-14").val();
				
				$(".contactformgenerator_wrapper").css('boxShadow' , boxShadow);
				$(".contactformgenerator_wrapper").hover(function() {
					$(this).css('boxShadow' , boxShadow_);
				},function() {
					$(this).css('boxShadow' , boxShadow);
				});
			}
			//top text
			else if(roll == 21) {
				$(".contactformgenerator_title").css('fontSize' , val*1 + 1);
			}
			else if(roll == 28 || roll == 29 || roll == 30 ) {
				var textShadow = $("#elem-28").val() + 'px '  + $("#elem-29").val() + 'px '  + $("#elem-30").val() + 'px ' + $("#elem-27").val();
				$(".contactformgenerator_title").css('textShadow' , textShadow);
			}
			//field text
			else if(roll == 32) {
				$(".contactformgenerator_field_name").css('fontSize' , val*1 + 1);
			}
			else if(roll == 38 || roll == 39 || roll == 40) {
				var textShadow = $("#elem-38").val() + 'px '  + $("#elem-39").val() + 'px '  + $("#elem-40").val() + 'px ' + $("#elem-37").val();
				$('.contactformgenerator_field_box').not('.contactformgenerator_error').find(".contactformgenerator_field_name").css('textShadow' , textShadow);
			}
			//asterisk text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 42) {
				$(".contactformgenerator_field_required").css('fontSize' , val*1 + 1);
			}
			else if(roll == 47 || roll == 48 || roll == 49) {
				var textShadow = $("#elem-47").val() + 'px '  + $("#elem-48").val() + 'px '  + $("#elem-49").val() + 'px ' + $("#elem-46").val();
				$(".contactformgenerator_field_required").css('textShadow' , textShadow);
			}

			//file upload///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 597) {
				$(".cfg_fileupload").css('paddingTop' , val*1 + 1);
				$(".cfg_fileupload").css('paddingBottom' , val*1 + 1);
			}
			else if(roll == 598) {
				$(".cfg_fileupload").css('paddingLeft' , val*1 + 1);
				$(".cfg_fileupload").css('paddingRight' , val*1 + 1);
			}


			//send///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 92) {
				$(".contactformgenerator_send").not('.cfg_fileupload').css('paddingTop' , val*1 + 1);
				$(".contactformgenerator_send").not('.cfg_fileupload').css('paddingBottom' , val*1 + 1);
			}
			else if(roll == 93) {
				$(".contactformgenerator_send").not('.cfg_fileupload').css('paddingLeft' , val*1 + 1);
				$(".contactformgenerator_send").not('.cfg_fileupload').css('paddingRight' , val*1 + 1);
			}
			else if(roll == 101) { //box border width
				$(".contactformgenerator_send").css({
					borderLeftWidth : val*1 + 1,
					borderRightWidth : val*1 + 1,
					borderBottomWidth : val*1 + 1,
					borderTopWidth : val*1 + 1
				});
			}
			else if(roll == 102) {
				$(".contactformgenerator_send").css('border-top-left-radius' , val*1 + 1);
			}
			else if(roll == 103) {
				$(".contactformgenerator_send").css('border-top-right-radius' , val*1 + 1);
			}
			else if(roll == 104) {
				$(".contactformgenerator_send").css('border-bottom-left-radius' , val*1 + 1);
			}
			else if(roll == 105) {
				$(".contactformgenerator_send").css('border-bottom-right-radius' , val*1 + 1);
			}
			else if(roll == 96 || roll == 97 || roll == 98 || roll == 99) {
				var boxShadow_ = $("#elem-95").val() + ' ' + $("#elem-96").val() + 'px '  + $("#elem-97").val() + 'px '  + $("#elem-98").val() + 'px ' + $("#elem-99").val() + 'px ' + $("#elem-94").val();
				$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('boxShadow' , boxShadow_);
			}
			else if(roll == 119 || roll == 120 || roll == 121 || roll == 122) {
				var boxShadow = $("#elem-118").val() + ' ' + $("#elem-119").val() + 'px '  + $("#elem-120").val() + 'px '  + $("#elem-121").val() + 'px ' + $("#elem-122").val() + 'px ' + $("#elem-117").val();
				$(".contactformgenerator_send_hovered").css('boxShadow' , boxShadow);
			}
			else if(roll == 107) {
				$(".contactformgenerator_send").css('fontSize' , val*1 + 1);
			}
			else if(roll == 114 || roll == 115 || roll == 116 ) {
				var textShadow = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px ' + $("#elem-125").val();
				var textShadow_ = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px ' + $("#elem-113").val();
				$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('textShadow' , textShadow_);
				$(".contactformgenerator_send_hovered").css('textShadow' , textShadow);
			}
			
			//text inputs///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 135) { //box border width
				$(".contactformgenerator_input_element").css({
					borderLeftWidth : val*1 + 1,
					borderRightWidth : val*1 + 1,
					borderBottomWidth : val*1 + 1,
					borderTopWidth : val*1 + 1
				});
			}
			else if(roll == 137) {
				$(".contactformgenerator_input_element").css('border-top-left-radius' , val*1 + 1);
			}
			else if(roll == 138) {
				$(".contactformgenerator_input_element").css('border-top-right-radius' , val*1 + 1);
			}
			else if(roll == 139) {
				$(".contactformgenerator_input_element").css('border-bottom-left-radius' , val*1 + 1);
			}
			else if(roll == 140) {
				$(".contactformgenerator_input_element").css('border-bottom-right-radius' , val*1 + 1);
			}

			else if(roll == 143 || roll == 144 || roll == 145 || roll == 146) { 

				var boxShadow = $("#elem-142").val() + ' ' + $("#elem-143").val() + 'px '  + $("#elem-144").val() + 'px '  + $("#elem-145").val() + 'px ' + $("#elem-146").val() + 'px ' +  $("#elem-141").val();
				var boxShadow_ = $("#elem-163").val() + ' ' + $("#elem-164").val() + 'px '  + $("#elem-165").val() + 'px '  + $("#elem-166").val() + 'px ' + $("#elem-167").val() + 'px ' +  $("#elem-162").val();
				$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').css('boxShadow' , boxShadow);

			}
			else if(roll == 164 || roll == 165 || roll == 166 || roll == 167) { 
				var boxShadow_ = $("#elem-163").val() + ' ' + $("#elem-164").val() + 'px '  + $("#elem-165").val() + 'px '  + $("#elem-166").val() + 'px ' + $("#elem-167").val() + 'px ' +  $("#elem-162").val();
				$(".contactformgenerator_input_element_hovered").css('boxShadow' , boxShadow_);
			}
			else if(roll == 154 || roll == 155 || roll == 156) { 
				var textShadow = $("#elem-154").val() + 'px '  + $("#elem-155").val() + 'px '  + $("#elem-156").val() + 'px ' + $("#elem-153").val();
				var textShadow_hovered = $("#elem-154").val() + 'px '  + $("#elem-155").val() + 'px '  + $("#elem-156").val() + 'px ' + $("#elem-160").val();

				$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').find('input').css('textShadow' , textShadow);
				$(".contactformgenerator_input_element textarea").css('textShadow' , textShadow);
				$(".contactformgenerator_input_element_hovered input").css('textShadow' , textShadow_hovered);
			}


			else if(roll == 148) {
				$(".contactformgenerator_input_element input,.contactformgenerator_input_element textarea").css('fontSize' , val*1 + 1);
			}
			
			else if(roll == 168) {
				var w = val*1 + 1 + '%';
				$(".contactformgenerator_field_box_inner").not('.cfg_textarea_wrapper').css('width' , w);
			}
			else if(roll == 169) {
				var w = val*1 + 1 + '%';
				$(".contactformgenerator_field_box_textarea_inner").css('width' , w);
			}
			else if(roll == 170) {
				$(".cfg_textarea_wrapper").css('height' , val*1 + 1);
			}
			
			//Error State////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 173 || roll == 174 || roll == 175) {
				var textShadow = $("#elem-173").val() + 'px '  + $("#elem-174").val() + 'px '  + $("#elem-175").val() + 'px ' + $("#elem-172").val();
				$(".contactformgenerator_error .contactformgenerator_field_name").css('textShadow' , textShadow);
			}
			else if(roll == 186 || roll == 187 || roll == 188 || roll == 189) { 
				var boxShadow = $("#elem-185").val() + ' ' + $("#elem-186").val() + 'px '  + $("#elem-187").val() + 'px '  + $("#elem-188").val() + 'px ' + $("#elem-189").val() + 'px ' +  $("#elem-184").val();
				$(".contactformgenerator_error .contactformgenerator_input_element").css('boxShadow' , boxShadow);
			}
			else if(roll == 181 || roll == 182 || roll == 183) { 
				var textShadow = $("#elem-181").val() + 'px '  + $("#elem-182").val() + 'px '  + $("#elem-183").val() + 'px ' + $("#elem-180").val();
				$(".contactformgenerator_error input").css('textShadow' , textShadow);
			}
			/*pre text ********************************************************************************************************************************************************************************/
        	else if(roll == 190) { 
				var marginTop = $("#elem-190").val() + 'px';
				$(".contactformgenerator_pre_text").css('marginTop' , marginTop);
			}
        	else if(roll == 191) { 
				var marginBottom = $("#elem-191").val() + 'px';
				$(".contactformgenerator_pre_text").css('marginBottom' , marginBottom);
			}
        	else if(roll == 193) { 
				var paddingTop = $("#elem-193").val() + 'px';
				$(".contactformgenerator_pre_text").css('paddingTop' , paddingTop);
			}
        	else if(roll == 192) { 
				var w = $("#elem-192").val() + '%';
				$(".contactformgenerator_pre_text").css('width' , w);
			}
        	else if(roll == 198) { 
				var f = $("#elem-198").val();
				$(".contactformgenerator_pre_text").css('fontSize' ,val*1 + 1);
			}
        	else if(roll == 194) { 
				var borderTop = $("#elem-194").val() + 'px '  + $("#elem-196").val() + $("#elem-195").val();
				$(".contactformgenerator_pre_text").css('borderTop' , borderTop);
			}
        	else if(roll == 204 || roll == 205 || roll == 206) { 
				var textShadow = $("#elem-204").val() + 'px '  + $("#elem-205").val() + 'px '  + $("#elem-206").val() + 'px ' + $("#elem-203").val();
				$(".contactformgenerator_pre_text").css('textShadow' , textShadow);
			}
			/*contactformgenerator_wrapper_inner ********************************************************************************************************************************************************************************/
        	else if(roll == 207 || roll == 208 || roll == 213 || roll == 214) { 
        		var padding = $("#elem-207").val() + 'px ' + $("#elem-214").val() + 'px ' + $("#elem-213").val() + 'px ' + $("#elem-208").val() + 'px';
				$(".contactformgenerator_wrapper_inner").css('padding' , padding);
			}
			/*field name ********************************************************************************************************************************************************************************/
        	else if(roll == 215 || roll == 216 || roll == 217 || roll == 218) { 
				var margin = $("#elem-215").val() + 'px ' + $("#elem-216").val() + 'px ' + $("#elem-217").val() + 'px ' + $("#elem-218").val() + 'px';
				$(".contactformgenerator_field_name").css('margin' , margin);
			}
			/*contactformgenerator_wrapper_inner ********************************************************************************************************************************************************************************/
        	else if(roll == 210 || roll == 211 || roll == 219 || roll == 220) { 
        		var margin = $("#elem-210").val() + 'px ' + $("#elem-211").val() + 'px ' + $("#elem-219").val() + 'px ' + $("#elem-220").val() + 'px';
				$(".contactformgenerator_submit_wrapper").css('margin' , margin);
        	}
        	else if(roll == 209) { 
				var w = $("#elem-209").val() + '%';
				$(".contactformgenerator_submit_wrapper").css('width' , w);
			}

			/*contactformgenerator_headding ********************************************************************************************************************************************************************************/
			else if(roll == 535 || roll == 536 || roll == 537 || roll == 538) { 
        		var margin = $("#elem-535").val() + 'px ' + $("#elem-536").val() + 'px ' + $("#elem-537").val() + 'px ' + $("#elem-538").val() + 'px';
				$(".contactformgenerator_heading_inner").css('margin' , margin);
        	}
			else if(roll == 539 || roll == 540) { 
        		var margin = $("#elem-539").val() + 'px  0px ' + $("#elem-540").val() + 'px 0px';
				$(".contactformgenerator_heading").css('margin' , margin);
        	}
			else if(roll == 543 || roll == 544 || roll == 545 || roll == 546) { 
        		var border_top = $("#elem-543").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-548").val();
        		var border_right = $("#elem-544").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-549").val();
        		var border_bottom = $("#elem-545").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-550").val();
        		var border_left = $("#elem-546").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-551").val();
				$(".contactformgenerator_heading").css('border-top' , border_top);
				$(".contactformgenerator_heading").css('border-right' , border_right);
				$(".contactformgenerator_heading").css('border-bottom' , border_bottom);
				$(".contactformgenerator_heading").css('border-left' , border_left);
        	}
        	else if(roll == 532 || roll == 533 || roll == 534) { 
				var textShadow = $("#elem-532").val() + 'px '  + $("#elem-533").val() + 'px '  + $("#elem-534").val() + 'px ' + $("#elem-531").val();
				$(".contactformgenerator_heading").css('textShadow' , textShadow);
			}
        	else if(roll == 525) { 
				var f = $("#elem-525").val() + 'px';
				$(".contactformgenerator_heading").css('fontSize' ,f);
			}

			else if(roll == 588) { 
				var f = $("#elem-588").val() + 'px';
				$(".contactformgenerator_wrapper").css('fontSize' ,f);
			}
			else if(roll == 554) { 
				var f = $("#elem-554").val() + 'px';
				$(".cfg_content_element_label").css('fontSize' ,f);
			}
        	else if(roll == 559 || roll == 560 || roll == 561) { 
				var textShadow = $("#elem-559").val() + 'px '  + $("#elem-560").val() + 'px '  + $("#elem-561").val() + 'px ' + $("#elem-558").val();
				$(".cfg_content_element_label").css('textShadow' , textShadow);
			}
        	else if(roll == 590) { 
				var borderBottom = $("#elem-590").val() + 'px '  + $("#elem-591").val() + ' ' + $("#elem-592").val();
				$(".cfg_content_element_label").css('border-bottom' , borderBottom);
			}
			else if(roll == 571 || roll == 572 || roll == 573) { 
				var textShadow = $("#elem-571").val() + 'px '  + $("#elem-572").val() + 'px '  + $("#elem-573").val() + 'px ' + $("#elem-570").val();
				$(".cfg_link").css('textShadow' , textShadow);
			}
        	else if(roll == 567) { 
				var borderBottom = $("#elem-567").val() + 'px '  + $("#elem-568").val() + ' ' + $("#elem-569").val();
				$(".cfg_link").css('border-bottom' , borderBottom);

				var borderBottom = $("#elem-567").val() + 'px '  + $("#elem-568").val() + ' ' + $("#elem-575").val();
				$(".cfg_link_hovered").css('border-bottom' , borderBottom);
			}
    	   	else if(roll == 577 || roll == 578 || roll == 579) { 
				var textShadow = $("#elem-577").val() + 'px '  + $("#elem-578").val() + 'px '  + $("#elem-579").val() + 'px ' + $("#elem-576").val();
				$(".cfg_link_hovered").css('textShadow' , textShadow);
			}
        	else if(roll == 584 || roll == 585 || roll == 586) { 
				var textShadow = $("#elem-584").val() + 'px '  + $("#elem-585").val() + 'px '  + $("#elem-586").val() + 'px ' + $("#elem-583").val();
				$(".cfg_content_styling").css('textShadow' , textShadow);
			}

			/*contactformgenerator_header ********************************************************************************************************************************************************************************/
        	else if(roll == 603 || roll == 604 || roll == 605 || roll == 606) { 
        		var padding = $("#elem-603").val() + 'px ' + $("#elem-604").val() + 'px ' + $("#elem-605").val() + 'px ' + $("#elem-606").val() + 'px';
				$(".contactformgenerator_header").css('padding' , padding);
			}
			/*contactformgenerator_body  ********************************************************************************************************************************************************************************/
        	else if(roll == 613 || roll == 614 || roll == 615 || roll == 616) { 
        		var padding = $("#elem-613").val() + 'px ' + $("#elem-614").val() + 'px ' + $("#elem-615").val() + 'px ' + $("#elem-616").val() + 'px';
				$(".contactformgenerator_body").css('padding' , padding);
			}
			/*contactformgenerator_footer  ********************************************************************************************************************************************************************************/
        	else if(roll == 620 || roll == 621 || roll == 622 || roll == 623) { 
        		var padding = $("#elem-620").val() + 'px ' + $("#elem-621").val() + 'px ' + $("#elem-622").val() + 'px ' + $("#elem-623").val() + 'px';
				$(".contactformgenerator_footer").css('padding' , padding);
			}
        	else if(roll == 607) { 
				var borderBottom = $("#elem-607").val() + 'px '  + $("#elem-608").val() + ' ' + $("#elem-609").val();
				$(".contactformgenerator_header").css('border-bottom' , borderBottom);
			}
        	else if(roll == 624) { 
				var borderTop = $("#elem-624").val() + 'px '  + $("#elem-625").val() + ' ' + $("#elem-626").val();
				$(".contactformgenerator_footer").css('border-top' , borderTop);
			}

		}
			
		$('.size_down').mousedown(function() {
			var $this = $(this);
			curr_down = parseInt($this.parent('div').prev('input').val());
			down_int = setInterval(function() {
				min_val = parseInt($this.attr("minval"));
				val = parseInt($this.parent('div').prev('input').val());
				if(val > min_val) {
					$this.parent('div').prev('input').val(val*1 - 1);
					roll = $this.parent('div').prev('input').attr('roll');
					move_down(roll,val);
				}
			},100);
		})
		
		$('.size_down').mouseup(function() {
			clearInterval(down_int);
			var $this = $(this);
			min_val = parseInt($this.attr("minval"));
			val = parseInt($this.parent('div').prev('input').val());
			if((val > min_val) && (curr_down == val)) {
				$this.parent('div').prev('input').val(val*1 - 1);
				roll = $this.parent('div').prev('input').attr('roll');
				move_down(roll,val);
			}
		})
		
		$('.size_down').mouseleave(function() {
			clearInterval(down_int);
		});

		function move_down(roll,val) {
			console.log(val);
			if(roll == 2) {
				$(".contactformgenerator_wrapper").css({
					borderLeftWidth : val*1 - 1,
					borderRightWidth : val*1 - 1,
					borderBottomWidth : val*1 - 1,
					borderTopWidth : val*1 - 1
				});
			}
			else if(roll == 4) {
				$(".contactformgenerator_wrapper").css('border-top-left-radius' , val*1 - 1);
			}
			else if(roll == 5) {
				$(".contactformgenerator_wrapper").css('border-top-right-radius' , val*1 - 1);
			}
			else if(roll == 6) {
				$(".contactformgenerator_wrapper").css('border-bottom-left-radius' , val*1 - 1);
			}
			else if(roll == 7) {
				$(".contactformgenerator_wrapper").css('border-bottom-right-radius' , val*1 - 1);
			}
			else if(roll == 10 || roll == 11 || roll == 12 || roll == 13  || roll == 16  || roll == 17  || roll == 18  || roll == 19  ) { 
				var boxShadow = $("#elem-9").val() + ' ' + $("#elem-10").val() + 'px '  + $("#elem-11").val() + 'px '  + $("#elem-12").val() + 'px ' + $("#elem-13").val() + 'px ' + $("#elem-8").val();
				var boxShadow_ = $("#elem-15").val() + ' ' + $("#elem-16").val() + 'px '  + $("#elem-17").val() + 'px '  + $("#elem-18").val() + 'px ' + $("#elem-19").val() + 'px  ' + $("#elem-14").val();
				
				$(".contactformgenerator_wrapper").css('boxShadow' , boxShadow);
				$(".contactformgenerator_wrapper").hover(function() {
					$(this).css('boxShadow' , boxShadow_);
				},function() {
					$(this).css('boxShadow' , boxShadow);
				});
			}
			//top text
			else if(roll == 21) {
				$(".contactformgenerator_title").css('fontSize' , val*1 - 1);
			}
			else if(roll == 28 || roll == 29 || roll == 30 ) {
				var textShadow = $("#elem-28").val() + 'px '  + $("#elem-29").val() + 'px '  + $("#elem-30").val() + 'px ' + $("#elem-27").val();
				$(".contactformgenerator_title").css('textShadow' , textShadow);
			}
			//field text
			else if(roll == 32) {
				$(".contactformgenerator_field_name").css('fontSize' , val*1 - 1);
			}
			else if(roll == 38 || roll == 39 || roll == 40) {
				var textShadow = $("#elem-38").val() + 'px '  + $("#elem-39").val() + 'px '  + $("#elem-40").val() + 'px ' + $("#elem-37").val();
				$('.contactformgenerator_field_box').not('.contactformgenerator_error').find(".contactformgenerator_field_name").css('textShadow' , textShadow);
			}

			//asterisk text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 42) {
				$(".contactformgenerator_field_required").css('fontSize' , val*1 + 1);
			}
			else if(roll == 47 || roll == 48 || roll == 49) {
				var textShadow = $("#elem-47").val() + 'px '  + $("#elem-48").val() + 'px '  + $("#elem-49").val() + 'px ' + $("#elem-46").val();
				$(".contactformgenerator_field_required").css('textShadow' , textShadow);
			}
			//file upload///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 597) {
				$(".cfg_fileupload").css('paddingTop' , val*1 - 1);
				$(".cfg_fileupload").css('paddingBottom' , val*1 - 1);
			}
			else if(roll == 598) {
				$(".cfg_fileupload").css('paddingLeft' , val*1 - 1);
				$(".cfg_fileupload").css('paddingRight' , val*1 - 1);
			}

			//send///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 92) {
				$(".contactformgenerator_send").not('.cfg_fileupload').css('paddingTop' , val*1 - 1);
				$(".contactformgenerator_send").not('.cfg_fileupload').css('paddingBottom' , val*1 - 1);
			}
			else if(roll == 93) {
				$(".contactformgenerator_send").not('.cfg_fileupload').css('paddingLeft' , val*1 - 1);
				$(".contactformgenerator_send").not('.cfg_fileupload').css('paddingRight' , val*1 - 1);
			}
			else if(roll == 101) { //box border width
				$(".contactformgenerator_send").css({
					borderLeftWidth : val*1 - 1,
					borderRightWidth : val*1 - 1,
					borderBottomWidth : val*1 - 1,
					borderTopWidth : val*1 - 1
				});
			}
			else if(roll == 102) {
				$(".contactformgenerator_send").css('border-top-left-radius' , val*1 - 1);
			}
			else if(roll == 103) {
				$(".contactformgenerator_send").css('border-top-right-radius' , val*1 - 1);
			}
			else if(roll == 104) {
				$(".contactformgenerator_send").css('border-bottom-left-radius' , val*1 - 1);
			}
			else if(roll == 105) {
				$(".contactformgenerator_send").css('border-bottom-right-radius' , val*1 - 1);
			}
			else if(roll == 96 || roll == 97 || roll == 98 || roll == 99) {
				var boxShadow_ = $("#elem-95").val() + ' ' + $("#elem-96").val() + 'px '  + $("#elem-97").val() + 'px '  + $("#elem-98").val() + 'px ' + $("#elem-99").val() + 'px ' + $("#elem-94").val();
				$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('boxShadow' , boxShadow_);
			}
			else if(roll == 119 || roll == 120 || roll == 121 || roll == 122) {
				var boxShadow = $("#elem-118").val() + ' ' + $("#elem-119").val() + 'px '  + $("#elem-120").val() + 'px '  + $("#elem-121").val() + 'px ' + $("#elem-122").val() + 'px ' + $("#elem-117").val();
				$(".contactformgenerator_send_hovered").css('boxShadow' , boxShadow);
			}
			else if(roll == 107) {
				$(".contactformgenerator_send").css('fontSize' , val*1 - 1);
			}
			else if(roll == 114 || roll == 115 || roll == 116 ) {
				var textShadow = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px ' + $("#elem-125").val();
				var textShadow_ = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px ' + $("#elem-113").val();
				$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('textShadow' , textShadow_);
				$(".contactformgenerator_send_hovered").css('textShadow' , textShadow);
			}

			//text inputs///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 135) { //box border width
				$(".contactformgenerator_input_element").css({
					borderLeftWidth : val*1 - 1,
					borderRightWidth : val*1 - 1,
					borderBottomWidth : val*1 - 1,
					borderTopWidth : val*1 - 1
				});
			}
			else if(roll == 137) {
				$(".contactformgenerator_input_element").css('border-top-left-radius' , val*1 - 1);
			}
			else if(roll == 138) {
				$(".contactformgenerator_input_element").css('border-top-right-radius' , val*1 - 1);
			}
			else if(roll == 139) {
				$(".contactformgenerator_input_element").css('border-bottom-left-radius' , val*1 - 1);
			}
			else if(roll == 140) {
				$(".contactformgenerator_input_element").css('border-bottom-right-radius' , val*1 - 1);
			}

			else if(roll == 143 || roll == 144 || roll == 145 || roll == 146) { 

				var boxShadow = $("#elem-142").val() + ' ' + $("#elem-143").val() + 'px '  + $("#elem-144").val() + 'px '  + $("#elem-145").val() + 'px ' + $("#elem-146").val() + 'px ' +  $("#elem-141").val();
				var boxShadow_ = $("#elem-163").val() + ' ' + $("#elem-164").val() + 'px '  + $("#elem-165").val() + 'px '  + $("#elem-166").val() + 'px ' + $("#elem-167").val() + 'px ' +  $("#elem-162").val();
				$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').css('boxShadow' , boxShadow);

			}
			else if(roll == 164 || roll == 165 || roll == 166 || roll == 167) { 
				var boxShadow_ = $("#elem-163").val() + ' ' + $("#elem-164").val() + 'px '  + $("#elem-165").val() + 'px '  + $("#elem-166").val() + 'px ' + $("#elem-167").val() + 'px ' +  $("#elem-162").val();
				$(".contactformgenerator_input_element_hovered").css('boxShadow' , boxShadow_);
			}
			else if(roll == 154 || roll == 155 || roll == 156) { 
				var textShadow = $("#elem-154").val() + 'px '  + $("#elem-155").val() + 'px '  + $("#elem-156").val() + 'px ' + $("#elem-153").val();
				var textShadow_hovered = $("#elem-154").val() + 'px '  + $("#elem-155").val() + 'px '  + $("#elem-156").val() + 'px ' + $("#elem-160").val();

				$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').find('input').css('textShadow' , textShadow);
				$(".contactformgenerator_input_element textarea").css('textShadow' , textShadow);
				$(".contactformgenerator_input_element_hovered input").css('textShadow' , textShadow_hovered);
			}

			else if(roll == 148) {
				$(".contactformgenerator_input_element input,.contactformgenerator_input_element textarea").css('fontSize' , val*1 - 1);
			}
			else if(roll == 168) {
				var w = val*1 - 1 + '%';
				$(".contactformgenerator_field_box_inner").css('width' , w);
			}
			else if(roll == 169) {
				var w = val*1 - 1 + '%';
				$(".contactformgenerator_field_box_textarea_inner").css('width' , w);
			}
			else if(roll == 170) {
				$(".cfg_textarea_wrapper").css('height' , val*1 - 1);
			}
			
			//Error State////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 173 || roll == 174 || roll == 175) {
				var textShadow = $("#elem-173").val() + 'px '  + $("#elem-174").val() + 'px '  + $("#elem-175").val() + 'px ' + $("#elem-172").val();
				$(".contactformgenerator_error .contactformgenerator_field_name").css('textShadow' , textShadow);
			}
			else if(roll == 186 || roll == 187 || roll == 188 || roll == 189) { 
				var boxShadow = $("#elem-185").val() + ' ' + $("#elem-186").val() + 'px '  + $("#elem-187").val() + 'px '  + $("#elem-188").val() + 'px ' + $("#elem-189").val() + 'px ' +  $("#elem-184").val();
				$(".contactformgenerator_error .contactformgenerator_input_element").css('boxShadow' , boxShadow);
			}
			else if(roll == 181 || roll == 182 || roll == 183) { 
				var textShadow = $("#elem-181").val() + 'px '  + $("#elem-182").val() + 'px '  + $("#elem-183").val() + 'px ' + $("#elem-180").val();
				$(".contactformgenerator_error input").css('textShadow' , textShadow);
			}
			/*pre text ********************************************************************************************************************************************************************************/
        	else if(roll == 190) { 
				var marginTop = $("#elem-190").val() + 'px';
				$(".contactformgenerator_pre_text").css('marginTop' , marginTop);
			}
        	else if(roll == 191) { 
				var marginBottom = $("#elem-191").val() + 'px';
				$(".contactformgenerator_pre_text").css('marginBottom' , marginBottom);
			}
        	else if(roll == 193) { 
				var paddingTop = $("#elem-193").val() + 'px';
				$(".contactformgenerator_pre_text").css('paddingTop' , paddingTop);
			}
        	else if(roll == 192) { 
				var w = $("#elem-192").val() + '%';
				$(".contactformgenerator_pre_text").css('width' , w);
			}
        	else if(roll == 198) { 
				$(".contactformgenerator_pre_text").css('fontSize' , val*1 - 1);
			}
        	else if(roll == 194) { 
				var borderTop = $("#elem-194").val() + 'px '  + $("#elem-196").val() + $("#elem-195").val();
				$(".contactformgenerator_pre_text").css('borderTop' , borderTop);
			}
        	else if(roll == 204 || roll == 205 || roll == 206) { 
				var textShadow = $("#elem-204").val() + 'px '  + $("#elem-205").val() + 'px '  + $("#elem-206").val() + 'px ' + $("#elem-203").val();
				$(".contactformgenerator_pre_text").css('textShadow' , textShadow);
			}
			/*contactformgenerator_wrapper_inner ********************************************************************************************************************************************************************************/
        	else if(roll == 207 || roll == 208 || roll == 213 || roll == 214) { 
        		var padding = $("#elem-207").val() + 'px ' + $("#elem-214").val() + 'px ' + $("#elem-213").val() + 'px ' + $("#elem-208").val() + 'px';
				$(".contactformgenerator_wrapper_inner").css('padding' , padding);
			}
			/*field name ********************************************************************************************************************************************************************************/
        	else if(roll == 215 || roll == 216 || roll == 217 || roll == 218) { 
				var margin = $("#elem-215").val() + 'px ' + $("#elem-216").val() + 'px ' + $("#elem-217").val() + 'px ' + $("#elem-218").val() + 'px';
				$(".contactformgenerator_field_name").css('margin' , margin);
			}
			/*contactformgenerator_wrapper_inner ********************************************************************************************************************************************************************************/
        	else if(roll == 210 || roll == 211 || roll == 219 || roll == 220) { 
        		var margin = $("#elem-210").val() + 'px ' + $("#elem-211").val() + 'px ' + $("#elem-219").val() + 'px ' + $("#elem-220").val() + 'px';
				$(".contactformgenerator_submit_wrapper").css('margin' , margin);
        	}
        	else if(roll == 209) { 
				var w = $("#elem-209").val() + '%';
				$(".contactformgenerator_submit_wrapper").css('width' , w);
			}

			/*contactformgenerator_headding ********************************************************************************************************************************************************************************/
			else if(roll == 535 || roll == 536 || roll == 537 || roll == 538) { 
        		var margin = $("#elem-535").val() + 'px ' + $("#elem-536").val() + 'px ' + $("#elem-537").val() + 'px ' + $("#elem-538").val() + 'px';
				$(".contactformgenerator_heading_inner").css('margin' , margin);
        	}
			else if(roll == 539 || roll == 540) { 
        		var margin = $("#elem-539").val() + 'px  0px ' + $("#elem-540").val() + 'px 0px';
				$(".contactformgenerator_heading").css('margin' , margin);
        	}
			else if(roll == 543 || roll == 544 || roll == 545 || roll == 546) { 
        		var border_top = $("#elem-543").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-548").val();
        		var border_right = $("#elem-544").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-549").val();
        		var border_bottom = $("#elem-545").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-550").val();
        		var border_left = $("#elem-546").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-551").val();
				$(".contactformgenerator_heading").css('border-top' , border_top);
				$(".contactformgenerator_heading").css('border-right' , border_right);
				$(".contactformgenerator_heading").css('border-bottom' , border_bottom);
				$(".contactformgenerator_heading").css('border-left' , border_left);
        	}
        	else if(roll == 532 || roll == 533 || roll == 534) { 
				var textShadow = $("#elem-532").val() + 'px '  + $("#elem-533").val() + 'px '  + $("#elem-534").val() + 'px ' + $("#elem-531").val();
				$(".contactformgenerator_heading").css('textShadow' , textShadow);
			}
        	else if(roll == 525) { 
				var f = $("#elem-525").val() + 'px';
				$(".contactformgenerator_heading").css('fontSize' ,f);
			}

			else if(roll == 588) { 
				var f = $("#elem-588").val() + 'px';
				$(".contactformgenerator_wrapper").css('fontSize' ,f);
			}
			else if(roll == 554) { 
				var f = $("#elem-554").val() + 'px';
				$(".cfg_content_element_label").css('fontSize' ,f);
			}
        	else if(roll == 559 || roll == 560 || roll == 561) { 
				var textShadow = $("#elem-559").val() + 'px '  + $("#elem-560").val() + 'px '  + $("#elem-561").val() + 'px ' + $("#elem-558").val();
				$(".cfg_content_element_label").css('textShadow' , textShadow);
			}
        	else if(roll == 590) { 
				var borderBottom = $("#elem-590").val() + 'px '  + $("#elem-591").val() + ' ' + $("#elem-592").val();
				$(".cfg_content_element_label").css('border-bottom' , borderBottom);
			}
			else if(roll == 571 || roll == 572 || roll == 573) { 
				var textShadow = $("#elem-571").val() + 'px '  + $("#elem-572").val() + 'px '  + $("#elem-573").val() + 'px ' + $("#elem-570").val();
				$(".cfg_link").css('textShadow' , textShadow);
			}
        	else if(roll == 567) { 
				var borderBottom = $("#elem-567").val() + 'px '  + $("#elem-568").val() + ' ' + $("#elem-569").val();
				$(".cfg_link").css('border-bottom' , borderBottom);

				var borderBottom = $("#elem-567").val() + 'px '  + $("#elem-568").val() + ' ' + $("#elem-575").val();
				$(".cfg_link_hovered").css('border-bottom' , borderBottom);
			}
    	   	else if(roll == 577 || roll == 578 || roll == 579) { 
				var textShadow = $("#elem-577").val() + 'px '  + $("#elem-578").val() + 'px '  + $("#elem-579").val() + 'px ' + $("#elem-576").val();
				$(".cfg_link_hovered").css('textShadow' , textShadow);
			}
        	else if(roll == 584 || roll == 585 || roll == 586) { 
				var textShadow = $("#elem-584").val() + 'px '  + $("#elem-585").val() + 'px '  + $("#elem-586").val() + 'px ' + $("#elem-583").val();
				$(".cfg_content_styling").css('textShadow' , textShadow);
			}

			/*contactformgenerator_header ********************************************************************************************************************************************************************************/
        	else if(roll == 603 || roll == 604 || roll == 605 || roll == 606) { 
        		var padding = $("#elem-603").val() + 'px ' + $("#elem-604").val() + 'px ' + $("#elem-605").val() + 'px ' + $("#elem-606").val() + 'px';
				$(".contactformgenerator_header").css('padding' , padding);
			}
			/*contactformgenerator_body  ********************************************************************************************************************************************************************************/
        	else if(roll == 613 || roll == 614 || roll == 615 || roll == 616) { 
        		var padding = $("#elem-613").val() + 'px ' + $("#elem-614").val() + 'px ' + $("#elem-615").val() + 'px ' + $("#elem-616").val() + 'px';
				$(".contactformgenerator_body").css('padding' , padding);
			}
			/*contactformgenerator_footer  ********************************************************************************************************************************************************************************/
        	else if(roll == 620 || roll == 621 || roll == 622 || roll == 623) { 
        		var padding = $("#elem-620").val() + 'px ' + $("#elem-621").val() + 'px ' + $("#elem-622").val() + 'px ' + $("#elem-623").val() + 'px';
				$(".contactformgenerator_footer").css('padding' , padding);
			}
        	else if(roll == 607) { 
				var borderBottom = $("#elem-607").val() + 'px '  + $("#elem-608").val() + ' ' + $("#elem-609").val();
				$(".contactformgenerator_header").css('border-bottom' , borderBottom);
			}
        	else if(roll == 624) { 
				var borderTop = $("#elem-624").val() + 'px '  + $("#elem-625").val() + ' ' + $("#elem-626").val();
				$(".contactformgenerator_footer").css('border-top' , borderTop);
			}

		}
		
		$('.contactformgenerator_error').hover(function(event) {
			event.stopPropagation();
		})
		
		$('.temp_family').blur(function() {
			var val = $(this).val().replace('|','');
			val = val.replace('~','');
			$(this).val(val);
		})
		
		//main box
		$("#elem-3").change(function() {
			var borderStyle = $(this).val();
			$(".contactformgenerator_wrapper").css('borderStyle' , borderStyle);
		})
		$("#elem-9").change(function() {
			var boxShadow = $("#elem-9").val() + ' ' + $("#elem-10").val() + 'px '  + $("#elem-11").val() + 'px '  + $("#elem-12").val() + 'px ' + $("#elem-13").val() + 'px ' + $("#elem-8").val();
			var boxShadow_ = $("#elem-15").val() + ' ' + $("#elem-16").val() + 'px '  + $("#elem-17").val() + 'px '  + $("#elem-18").val() + 'px ' + $("#elem-19").val() + 'px  ' + $("#elem-14").val();
			
			$(".contactformgenerator_wrapper").css('boxShadow' , boxShadow);
			$(".contactformgenerator_wrapper").hover(function() {
				$(this).css('boxShadow' , boxShadow_);
			},function() {
				$(this).css('boxShadow' , boxShadow);
			});
		})
		$("#elem-15").change(function() {
			var boxShadow = $("#elem-9").val() + ' ' + $("#elem-10").val() + 'px '  + $("#elem-11").val() + 'px '  + $("#elem-12").val() + 'px ' + $("#elem-13").val() + 'px ' + $("#elem-8").val();
			var boxShadow_ = $("#elem-15").val() + ' ' + $("#elem-16").val() + 'px '  + $("#elem-17").val() + 'px '  + $("#elem-18").val() + 'px ' + $("#elem-19").val() + 'px  ' + $("#elem-14").val();
			
			$(".contactformgenerator_wrapper").css('boxShadow' , boxShadow);
			$(".contactformgenerator_wrapper").hover(function() {
				$(this).css('boxShadow' , boxShadow_);
			},function() {
				$(this).css('boxShadow' , boxShadow);
			});
		})
		$("#elem-131").change(function() {
			var val = $(this).val();
			var font_name = $(this).find('option:selected').html();
			var cfg_font_ident = 'cfg-googlewebfont-';

			if(val.indexOf(cfg_font_ident) > -1) {
				val = val.replace(cfg_font_ident, '');
				val = val.replace(/ /g, '+');
				var font_href = 'http://fonts.googleapis.com/css?family=' + val;

				//load new css
				$("<link/>", {
				   rel: "stylesheet",
				   type: "text/css",
				   href: font_href
				}).appendTo("head");

				var google_font_war = font_name + ', sans-serif';
				$(".contactformgenerator_wrapper").css('fontFamily' , google_font_war);
			}
			else 
				$(".contactformgenerator_wrapper").css('fontFamily' , val);
		});
		
		//top text
		$("#elem-22").change(function() {
			$(".contactformgenerator_title").css('fontWeight' , $(this).val());
		})
		$("#elem-23").change(function() {
			$(".contactformgenerator_title").css('fontStyle' , $(this).val());
		})
		$("#elem-24").change(function() {
			$(".contactformgenerator_title").css('textDecoration' , $(this).val());
		})
		$("#elem-25").change(function() {
			$(".contactformgenerator_title").css('textAlign' , $(this).val());
		})

		$("#elem-500").change(function() {
			$(".contactformgenerator_input_element input, .contactformgenerator_input_element textarea").css('textAlign' , $(this).val());
		})
		$("#elem-501").change(function() {
			var m = $(this).val() == 'right' ? '0 0 0 auto' : ($(this).val() == 'center' ? '0 auto' : '0');
			$(".contactformgenerator_field_box_inner,.contactformgenerator_field_box_textarea_inner").css('margin' , m);
		})
		$("#elem-502").change(function() {
			$(".contactformgenerator_pre_text").css('textAlign' , $(this).val());
			var mr = $(this).val() == 'right' ? '0' : ($(this).val() == 'center' ? 'auto' : '0');
			var ml = $(this).val() == 'right' ? 'auto' : ($(this).val() == 'center' ? 'auto' : '0');
			$(".contactformgenerator_pre_text").css('marginLeft' , ml);
			$(".contactformgenerator_pre_text").css('marginRight' , mr);

		})
		
		//field text
		$("#elem-33").change(function() {
			$(".contactformgenerator_field_name").css('fontWeight' , $(this).val());
		})
		$("#elem-34").change(function() {
			$(".contactformgenerator_field_name").css('fontStyle' , $(this).val());
		})
		$("#elem-35").change(function() {
			$(".contactformgenerator_field_name").css('textDecoration' , $(this).val());
		})
		$("#elem-36").change(function() {
			$(".contactformgenerator_field_name").css('textAlign' , $(this).val());
		})
		
		//asterisk text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#elem-43").change(function() {
			$(".contactformgenerator_field_required").css('fontWeight' , $(this).val());
		})
		$("#elem-44").change(function() {
			$(".contactformgenerator_field_required").css('fontStyle' , $(this).val());
		})
		
		
		//Send///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#elem-127").change(function() {
			var borderStyle = $(this).val();
			$(".contactformgenerator_send").css('borderStyle' , borderStyle);
		})
		// $("#elem-112").blur(function() {
		// 	$(".contactformgenerator_send").css('fontFamily' , $(this).val());
		// });
		$("#elem-112").change(function() {
			var val = $(this).val();
			var font_name = $(this).find('option:selected').html();
			var cfg_font_ident = 'cfg-googlewebfont-';

			if(val.indexOf(cfg_font_ident) > -1) {
				val = val.replace(cfg_font_ident, '');
				val = val.replace(/ /g, '+');
				var font_href = 'http://fonts.googleapis.com/css?family=' + val;

				//load new css
				$("<link/>", {
				   rel: "stylesheet",
				   type: "text/css",
				   href: font_href
				}).appendTo("head");

				var google_font_war = font_name + ', sans-serif';
				$(".contactformgenerator_send").css('fontFamily' , google_font_war);
			}
			else 
				$(".contactformgenerator_send").css('fontFamily' , val);
		});
		$("#elem-108").change(function() {
			$(".contactformgenerator_send").css('fontWeight' , $(this).val());
		})
		$("#elem-109").change(function() {
			$(".contactformgenerator_send").css('fontStyle' , $(this).val());
		})
		$("#elem-110").change(function() {
			$(".contactformgenerator_send").css('textDecoration' , $(this).val());
		})
		$("#elem-95").change(function() {
			var boxShadow_ = $("#elem-95").val() + ' ' + $("#elem-96").val() + 'px '  + $("#elem-97").val() + 'px '  + $("#elem-98").val() + 'px ' + $("#elem-99").val() + 'px ' + $("#elem-94").val();
			$(".contactformgenerator_send").not('.contactformgenerator_send_hovered').css('boxShadow' , boxShadow_);
		})
		$("#elem-118").change(function() {
			var boxShadow = $("#elem-118").val() + ' ' + $("#elem-119").val() + 'px '  + $("#elem-120").val() + 'px '  + $("#elem-121").val() + 'px ' + $("#elem-122").val() + 'px ' + $("#elem-117").val();
			$(".contactformgenerator_send_hovered").css('boxShadow' , boxShadow);
		})
		
		//input text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#elem-136").change(function() {
			var borderStyle = $(this).val();
			// $(".contactformgenerator_input_element").not('.cfg_error_input').css('border' , $("#elem-135").val() + 'px ' +  borderStyle + $("#elem-134").val());
			$(".contactformgenerator_input_element").css('borderStyle' , borderStyle);
		})
		// $("#elem-152").blur(function() {
		// 	$(".contactformgenerator_input_element input,.contactformgenerator_input_element textarea").css('fontFamily' , $(this).val());
		// });
		$("#elem-152").change(function() {
			var val = $(this).val();
			var font_name = $(this).find('option:selected').html();
			var cfg_font_ident = 'cfg-googlewebfont-';

			if(val.indexOf(cfg_font_ident) > -1) {
				val = val.replace(cfg_font_ident, '');
				val = val.replace(/ /g, '+');
				var font_href = 'http://fonts.googleapis.com/css?family=' + val;

				//load new css
				$("<link/>", {
				   rel: "stylesheet",
				   type: "text/css",
				   href: font_href
				}).appendTo("head");

				var google_font_war = font_name + ', sans-serif';
				$(".contactformgenerator_input_element input,.contactformgenerator_input_element textarea").css('fontFamily' , google_font_war);
			}
			else 
				$(".contactformgenerator_input_element input,.contactformgenerator_input_element textarea").css('fontFamily' , val);
		});
		$("#elem-149").change(function() {
			$(".contactformgenerator_input_element input,.contactformgenerator_input_element textarea").css('fontWeight' , $(this).val());
		})
		$("#elem-150").change(function() {
			$(".contactformgenerator_input_element input,.contactformgenerator_input_element textarea").css('fontStyle' , $(this).val());
		})
		$("#elem-151").change(function() {
			$(".contactformgenerator_input_element input,.contactformgenerator_input_element textarea").css('textDecoration' , $(this).val());
		})
		$("#elem-163").change(function() {
			var boxShadow_ = $("#elem-163").val() + ' ' + $("#elem-164").val() + 'px '  + $("#elem-165").val() + 'px '  + $("#elem-166").val() + 'px ' + $("#elem-167").val() + 'px ' +  $("#elem-162").val();
			$(".contactformgenerator_input_element_hovered").css('boxShadow' , boxShadow_);
		})
		$("#elem-142").change(function() {
			var boxShadow = $("#elem-142").val() + ' ' + $("#elem-143").val() + 'px '  + $("#elem-144").val() + 'px '  + $("#elem-145").val() + 'px ' + $("#elem-146").val() + 'px ' +  $("#elem-141").val();
			var boxShadow_ = $("#elem-163").val() + ' ' + $("#elem-164").val() + 'px '  + $("#elem-165").val() + 'px '  + $("#elem-166").val() + 'px ' + $("#elem-167").val() + 'px ' +  $("#elem-162").val();
			$(".contactformgenerator_input_element").not('.cfg_error_input').not('.contactformgenerator_input_element_hovered').css('boxShadow' , boxShadow);
		})
		//Error State////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#elem-185").change(function() {
			var boxShadow = $("#elem-185").val() + ' ' + $("#elem-186").val() + 'px '  + $("#elem-187").val() + 'px '  + $("#elem-188").val() + 'px ' + $("#elem-189").val() + 'px ' +  $("#elem-184").val();
			$(".contactformgenerator_error .contactformgenerator_input_element").css('boxShadow' , boxShadow);
		})
		//Pre text////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#elem-196").change(function() {
			var borderTop = $("#elem-194").val() + 'px '  + $("#elem-196").val() + $("#elem-195").val();
			$(".contactformgenerator_pre_text").css('borderTop' , borderTop);
		})
		// $("#elem-202").blur(function() {
		// 	$(".contactformgenerator_pre_text").css('fontFamily' , $(this).val());
		// });
		$("#elem-202").change(function() {
			var val = $(this).val();
			var font_name = $(this).find('option:selected').html();
			var cfg_font_ident = 'cfg-googlewebfont-';

			if(val.indexOf(cfg_font_ident) > -1) {
				val = val.replace(cfg_font_ident, '');
				val = val.replace(/ /g, '+');
				var font_href = 'http://fonts.googleapis.com/css?family=' + val;

				//load new css
				$("<link/>", {
				   rel: "stylesheet",
				   type: "text/css",
				   href: font_href
				}).appendTo("head");

				var google_font_war = font_name + ', sans-serif';
				$(".contactformgenerator_pre_text").css('fontFamily' , google_font_war);
			}
			else 
				$(".contactformgenerator_pre_text").css('fontFamily' , val);
		});
		$("#elem-199").change(function() {
			$(".contactformgenerator_pre_text").css('fontWeight' , $(this).val());
		})
		$("#elem-200").change(function() {
			$(".contactformgenerator_pre_text").css('fontStyle' , $(this).val());
		})
		$("#elem-201").change(function() {
			$(".contactformgenerator_pre_text").css('textDecoration' , $(this).val());
		})


		//heading
		$("#elem-547").change(function() {
			var border_top = $("#elem-543").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-548").val();
    		var border_right = $("#elem-544").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-549").val();
    		var border_bottom = $("#elem-545").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-550").val();
    		var border_left = $("#elem-546").val() + 'px ' + $("#elem-547").val() + ' ' + $("#elem-551").val();
			$(".contactformgenerator_heading").css('border-top' , border_top);
			$(".contactformgenerator_heading").css('border-right' , border_right);
			$(".contactformgenerator_heading").css('border-bottom' , border_bottom);
			$(".contactformgenerator_heading").css('border-left' , border_left);
		});
		$("#elem-529").change(function() {
			var val = $(this).val();
			var font_name = $(this).find('option:selected').html();
			var cfg_font_ident = 'cfg-googlewebfont-';

			if(val.indexOf(cfg_font_ident) > -1) {
				val = val.replace(cfg_font_ident, '');
				val = val.replace(/ /g, '+');
				var font_href = 'http://fonts.googleapis.com/css?family=' + val;

				//load new css
				$("<link/>", {
				   rel: "stylesheet",
				   type: "text/css",
				   href: font_href
				}).appendTo("head");

				var google_font_war = font_name + ', sans-serif';
				$(".contactformgenerator_heading").css('fontFamily' , google_font_war);
			}
			else 
				$(".contactformgenerator_heading").css('fontFamily' , val);
		});
		$("#elem-526").change(function() {
			$(".contactformgenerator_heading").css('fontWeight' , $(this).val());
		})
		$("#elem-527").change(function() {
			$(".contactformgenerator_heading").css('fontStyle' , $(this).val());
		})
		$("#elem-528").change(function() {
			$(".contactformgenerator_heading").css('textDecoration' , $(this).val());
		});


    	$("#elem-591").change(function() {
			var borderBottom = $("#elem-590").val() + 'px '  + $("#elem-591").val() + ' ' + $("#elem-592").val();
			$(".cfg_content_element_label").css('border-bottom' , borderBottom);
		});

    	$("#elem-568").change(function() {
			var borderBottom = $("#elem-567").val() + 'px '  + $("#elem-568").val() + ' ' + $("#elem-569").val();
			$(".cfg_link").css('border-bottom' , borderBottom);

			var borderBottom = $("#elem-567").val() + 'px '  + $("#elem-568").val() + ' ' + $("#elem-575").val();
			$(".cfg_link_hovered").css('border-bottom' , borderBottom);
		});

		$("#elem-555").change(function() {
			$(".cfg_content_element_label").css('fontWeight' , $(this).val());
		})
		$("#elem-556").change(function() {
			$(".cfg_content_element_label").css('fontStyle' , $(this).val());
		});		
		$("#elem-565").change(function() {
			$(".cfg_link").css('fontWeight' , $(this).val());
			$(".cfg_link_hovered").css('fontWeight' , $(this).val());
		})
		$("#elem-566").change(function() {
			$(".cfg_link").css('fontStyle' , $(this).val());
			$(".cfg_link_hovered").css('fontStyle' , $(this).val());
		});
		$("#elem-581").change(function() {
			$(".cfg_content_styling").css('fontWeight' , $(this).val());
		})
		$("#elem-582").change(function() {
			$(".cfg_content_styling").css('fontStyle' , $(this).val());
		});
		$("#elem-593").change(function() {
			$(".cfg_content_styling").css('textDecoration' , $(this).val());
		});
		$("#elem-594").change(function() {
			$(".cfg_link").css('textDecoration' , $(this).val());
		});		
		$("#elem-595").change(function() {
			$(".cfg_link_hovered").css('textDecoration' , $(this).val());
		});
		$("#elem-596").change(function() {
			$(".cfg_content_element_label").css('textDecoration' , $(this).val());
		});










		/*contactformgenerator_wrapper_inner ********************************************************************************************************************************************************************************/
        $("#elem-212").change(function() {
    		$(".contactformgenerator_send").css('float' , $(this).val());
    	});
    	/*tooltip*/
    	$("#elem-505").change(function() {
    		var val = $(this).val();
    		$(".contactformgenerator_send").css('float' , $(this).val());
    		var new_class = 'the-tooltip top right ' + val;
    		$('.tooltip_inner').parent('span').attr("class",new_class);
    	});
		$("#elem-506").change(function() {
			var val = $(this).val();
			var font_name = $(this).find('option:selected').html();
			var cfg_font_ident = 'cfg-googlewebfont-';

			if(val.indexOf(cfg_font_ident) > -1) {
				val = val.replace(cfg_font_ident, '');
				val = val.replace(/ /g, '+');
				var font_href = 'http://fonts.googleapis.com/css?family=' + val;

				//load new css
				$("<link/>", {
				   rel: "stylesheet",
				   type: "text/css",
				   href: font_href
				}).appendTo("head");

				var google_font_war = font_name + ', sans-serif';
				$(".contactformgenerator_title").css('fontFamily' , google_font_war);
			}
			else 
				$(".contactformgenerator_title").css('fontFamily' , val);
		});
		$("#elem-507").change(function() {
			var val = $(this).val();
			var font_name = $(this).find('option:selected').html();
			var cfg_font_ident = 'cfg-googlewebfont-';

			if(val.indexOf(cfg_font_ident) > -1) {
				val = val.replace(cfg_font_ident, '');
				val = val.replace(/ /g, '+');
				var font_href = 'http://fonts.googleapis.com/css?family=' + val;

				//load new css
				$("<link/>", {
				   rel: "stylesheet",
				   type: "text/css",
				   href: font_href
				}).appendTo("head");

				var google_font_war = font_name + ', sans-serif';
				$(".contactformgenerator_field_name").css('fontFamily' , google_font_war);
			}
			else 
				$(".contactformgenerator_field_name").css('fontFamily' , val);
		});
		$("#elem-508").change(function() {
			var val = $(this).val();
			var font_name = $(this).find('option:selected').html();
			var cfg_font_ident = 'cfg-googlewebfont-';

			if(val.indexOf(cfg_font_ident) > -1) {
				val = val.replace(cfg_font_ident, '');
				val = val.replace(/ /g, '+');
				var font_href = 'http://fonts.googleapis.com/css?family=' + val;

				//load new css
				$("<link/>", {
				   rel: "stylesheet",
				   type: "text/css",
				   href: font_href
				}).appendTo("head");

				var google_font_war = font_name + ', sans-serif';
				$(".tooltip_inner").css('fontFamily' , google_font_war);
			}
			else 
				$(".tooltip_inner").css('fontFamily' , val);
		});
		$("#elem-509").change(function() {
			var val = $(this).val();
			var font_name = $(this).find('option:selected').html();
			var cfg_font_ident = 'cfg-googlewebfont-';

			if(val.indexOf(cfg_font_ident) > -1) {
				val = val.replace(cfg_font_ident, '');
				val = val.replace(/ /g, '+');
				var font_href = 'http://fonts.googleapis.com/css?family=' + val;

				//load new css
				$("<link/>", {
				   rel: "stylesheet",
				   type: "text/css",
				   href: font_href
				}).appendTo("head");

				var google_font_war = font_name + ', sans-serif';
				$(".contactformgenerator_field_required").css('fontFamily' , google_font_war);
			}
			else 
				$(".contactformgenerator_field_required").css('fontFamily' , val);
		});
		$("#elem-510").change(function() {
			var new_class = 'contactformgenerator_title' + ' ' + $(this).val();
			$(".contactformgenerator_title").attr("class",new_class);
		});
		$("#elem-511").change(function() {
			var new_class = 'contactformgenerator_pre_text' + ' ' + $(this).val();
			$(".contactformgenerator_pre_text").attr("class",new_class);
		});
		$("#elem-512").change(function() {
			var new_class = 'contactformgenerator_field_name' + ' ' + $(this).val();
			$('.contactformgenerator_field_box').not('.contactformgenerator_field_box_hovered').not('.contactformgenerator_error').find(".contactformgenerator_field_name").attr("class",new_class);
		});
		$("#elem-513").change(function() {
			var new_class = 'contactformgenerator_field_name' + ' ' + $(this).val();
			$('.contactformgenerator_field_box_hovered').find(".contactformgenerator_field_name").attr("class",new_class);
		});
		$("#elem-514").change(function() {
			var new_class = 'contactformgenerator_field_name' + ' ' + $(this).val();
			$('.contactformgenerator_error').find(".contactformgenerator_field_name").attr("class",new_class);
		});
		$("#elem-515").change(function() {
			var new_class = 'contactformgenerator_send' + ' ' + $(this).val();
			$('.contactformgenerator_send').not(".contactformgenerator_send_hovered").attr("class",new_class);
		});
		$("#elem-516").change(function() {
			var new_class = 'contactformgenerator_send contactformgenerator_send_hovered' + ' ' + $(this).val();
			$('.contactformgenerator_send_hovered').attr("class",new_class);
		});
		$("#elem-530").change(function() {
			var new_class = 'contactformgenerator_heading' + ' ' + $(this).val();
			$(".contactformgenerator_heading").attr("class",new_class);
		});

		$("#elem-563").change(function() {
			var path_0 = $(".cfg_datepicker_icon").attr("data_src");
			var icon_id = $(this).val();
			var img_path = path_0 + 'style-' + icon_id + '.png';
			$(".cfg_datepicker_icon").attr("src",img_path);
		});

		$("#elem-552").change(function() {
			var icon_id = $(this).val();
			var new_class = 'cfg_sections_wrapper cfg_sections_template_' + icon_id;
			$(".cfg_sections_wrapper").attr("class",new_class);
		});

		$("#elem-608").change(function() {
			var borderBottom = $("#elem-607").val() + 'px '  + $("#elem-608").val() + ' ' + $("#elem-609").val();
			$(".contactformgenerator_header").css('border-bottom' , borderBottom);
		});		
		$("#elem-625").change(function() {
			var borderTop = $("#elem-624").val() + 'px '  + $("#elem-625").val() + ' ' + $("#elem-626").val();
			$(".contactformgenerator_footer").css('border-top' , borderTop);
		});
		
		$("#elem-600").change(function() {
			if($(this).val() == 0) {
				$(".contactformgenerator_header").addClass('cfg_transparent');
			}
			else {
				$(".contactformgenerator_header").removeClass('cfg_transparent');
			}
		});		
		$("#elem-610").change(function() {
			if($(this).val() == 0) {
				$(".contactformgenerator_body").addClass('cfg_transparent');
			}
			else {
				$(".contactformgenerator_body").removeClass('cfg_transparent');
			}
		});		
		$("#elem-617").change(function() {
			if($(this).val() == 0) {
				$(".contactformgenerator_footer").addClass('cfg_transparent');
			}
			else {
				$(".contactformgenerator_footer").removeClass('cfg_transparent');
			}
		});




		



		var top_offset = parseInt($(".preview_box").css('top'));
		top_offset_moove = 75;
		//animate preview
		$(window).scroll(function() {
			var off = $("#preview_dummy").offset().top;

			var off_0 = $("#c_div").offset().top;
			if(off > off_0 && !($('.answers_switcher').hasClass('active')) ) {
				delta = off - off_0 + top_offset_moove*1;
				$(".preview_box").stop(true).animate( {
					top: delta
				},500);
			}
			else {
				$(".preview_box").stop(true).animate( {
					top: top_offset
				},500);
			}
			
		})

		$('.temp_block').click(function() {
			if($(this).hasClass('closed')) {
				$(this).removeClass('closed');
				$(this).addClass('opened');
				$(this).next('div').slideDown(600);
			}
			else {
				$(this).removeClass('opened');
				$(this).addClass('closed');
				$(this).next('div').slideUp(600);
			}
		})


		//answers switcher
		$('.answers_switcher').click(function() {
			if($(this).hasClass('active')) {
				$("#answers_styles_table").height("");
				$(this).removeClass('active');
				$(this).html('Switch to Answers');

				$('.main_view').slideDown(600);
				$('.answers_view').slideUp(600);
				$('#main_styles_table').slideDown(600);
				$('#answers_styles_table').slideUp(600);
			}
			else {
				setTimeout(function() {
					var h = $("#answers_styles_table").height();
					var h1 = $('.preview_box').height();
					if(parseInt(h1) > parseInt(h))
						$("#answers_styles_table").height(h1 + 50*1);
				},650)
				
				$('.preview_box').animate({'top':'26px'},600);
				$('html, body').animate({scrollTop:0}, 600);
				$(this).addClass('active');
				$(this).html('Switch to Main View');

				$('.main_view').slideUp(600);
				$('.answers_view').slideDown(600);
				$('#main_styles_table').slideUp(600);
				$('#answers_styles_table').slideDown(600);

			}
		});

	    $.fn.shake_elem = function (options) {
	        // defaults
	        var settings = {
	            'shakes': 3,
	            'distance': 10,
	            'duration':300
	        };
	        // merge options
	        if (options) {
	            $.extend(settings, options);
	        };
	        // make it so
	        var pos;
	        return this.each(function () {
	            $this = $(this);
	            // position if necessary
	            pos = $this.css('position');
	            if (!pos || pos === 'static') {
	                $this.css('position', 'relative');
	            };
	            // shake it
	            for (var x = 1; x <= settings.shakes; x++) {
	                $this.animate({ left: settings.distance * -1 }, (settings.duration / settings.shakes) / 4)
	                    .animate({ left: settings.distance }, (settings.duration / settings.shakes) / 2)
	                    .animate({ left: 0 }, (settings.duration / settings.shakes) / 4);
	            };
	        });
	    };


		$('.navigate_to_option').click(function() {
			var roll = parseInt($(this).attr("roll"));
			var $scrollTo = $('#scroll_to_' + roll);

			var elem_scroll_top = $scrollTo.offset().top;

			var h_offset = 42;
			var elem_scroll_top_calc = elem_scroll_top - h_offset;

			$("html, body").animate({
				scrollTop: elem_scroll_top_calc
			},400);

			$('#scroll_to_' + roll).addClass('sep_td_highlighted');
			setTimeout(function() {
				$('#scroll_to_' + roll).removeClass('sep_td_highlighted');
				$('#scroll_to_' + roll).parent('div').shake_elem({'shakes': 2,'distance': 10,'duration':400});
			},1200);


		});


		// view toggler



		$("#cfg_main_view").click(function() {
			if($(this).hasClass('active'))
				return;

			$("#cfg_main_view_inner").show();
			$("#cfg_icons_view_inner").hide();
		});

		$("#cfg_icons_view").click(function() {
			if($(this).hasClass('active'))
				return;

			$("#cfg_main_view_inner").hide();
			$("#cfg_icons_view_inner").show();
		});

		$(".view_toggler_item").click(function() {
			$(".view_toggler_item").removeClass('active');
			$(this).addClass("active");
		});

		setTimeout(function() {
			$(".preview_box").fadeIn(800);
		},800);

	});

})(jQuery);
</script>
<?php 
function create_accordion($txt,$state,$title='',$roll='') {
	$dis = $state == 'opened' ? '' : 'display:none;';
	echo '<tr>
			<td colspan="2">
				<div class="temp_data_container">
				<div id="scroll_to_'.$roll.'" class="temp_block '.$state.'" title="'.$title.'">'.$txt.'</div><div style="'.$dis.'margin-bottom:6px;">
					<table>';
}
function close_accordion() {
	echo '</table></div></div></td></tr>';
}
function echo_font_tr($txt,$i,$value) {
	echo '
			<tr>
            <td width="180" align="right" class="key">
                <label for="name">';
                    echo $txt;
                echo '</label>
            </td>
            <td class="st_td">
	               <input class="temp_family" value="'.$value.'" name="styles['.$i.']" roll="'.$i.'"  id="elem-'.$i.'"/>	               
            </td>
        </tr>
	';
}
function echo_select_tr($txt,$i,$values,$value) {
	echo '
			<tr>
            <td width="180" align="right" class="key">
                <label for="name">';
                    echo $txt;
                echo '</label>
            </td>
            <td class="st_td">
	               <select name="styles['.$i.']"  id="elem-'.$i.'" class="temp_select">';
                	foreach($values as $k => $val) {
                		$selected = $value == $k ? 'selected="selected"' : '';
                		echo '<option value="'.$k.'" '.$selected.'>'.$val.'</option>';
                	}
			echo '</select>	               
            </td>
        </tr>
	';
}
function echo_select_tr_with_optgroups($txt,$i,$values,$value) {
	echo '
			<tr>
            <td width="180" align="right" class="key">
                <label for="name">';
                    echo $txt;
                echo '</label>
            </td>
            <td class="st_td">
	               <select name="styles['.$i.']"  id="elem-'.$i.'" class="temp_select">';
	               $q = 0;
                	foreach($values as $label => $val_array) {
                		echo '<optgroup label="'.$label.'">';
                		foreach($val_array as $k => $val) {
                			$def_class=$q == 0 ? '' : 'googlefont';
	                		$selected = $value == $k ? 'selected="selected"' : '';
	                		echo '<option class="'.$def_class.'" value="'.$k.'" '.$selected.'>'.$val.'</option>';
                		}
                		echo '</optgroup>';
                		$q ++;
                	}
			echo '</select>	               
            </td>
        </tr>
	';
}
function echo_color_tr($txt,$i,$color) {
	echo '
			<tr>
            <td width="180" align="right" class="key">
                <label for="name">';
                    echo$txt;
                echo '</label>
            </td>
            <td class="st_td">
	               <div id="colorSelector" class="colorSelector" style="float: left;"><div style="background-color: '.$color.'"></div></div>
	               <input type="hidden" value="'.$color.'" name="styles['.$i.']" roll="'.$i.'"  id="elem-'.$i.'" />
            </td>
        </tr>
	';
}
function echo_size_tr($txt,$i,$size,$min,$max) {
	echo '
			<tr>
            <td width="180" align="right" class="key">
                <label for="name">';
                    echo $txt;
                echo '</label>
            </td>
             <td class="st_td">
            	<div class="size_container">
	            	<input class="size_input" type="text" value="'. $size .'" name="styles['.$i.']" readonly="readonly" roll="'.$i.'" id="elem-'.$i.'" />
	            	<div class="size_arrows">
	            		<div class="size_up" maxval="'.$max.'" title="Up"></div>
	            		<div class="size_down" minval="'.$min.'" title="Down"></div>
	            	</div>
	            	<div class="pix_info">px</div>
	            </div>
            </td>
        </tr>
	';
}
function echo_size_perc_tr($txt,$i,$size,$min,$max) {
	echo '
			<tr>
            <td width="180" align="right" class="key">
                <label for="name">';
                    echo $txt;
                echo '</label>
            </td>
             <td class="st_td">
            	<div class="size_container">
	            	<input class="size_input" type="text" value="'. $size .'" name="styles['.$i.']" readonly="readonly" roll="'.$i.'" id="elem-'.$i.'" />
	            	<div class="size_arrows">
	            		<div class="size_up" maxval="'.$max.'" title="Up"></div>
	            		<div class="size_down" minval="'.$min.'" title="Down"></div>
	            	</div>
	            	<div class="pix_info">%</div>
	            </div>
            </td>
        </tr>
	';
}

function echo_textarea_tr($txt,$i,$value,$desc) {
	echo '
		<tr>
            <td colspan="2">
	            	<textarea style="width: 330px;height: 350px;resize:none;" name="styles['.$i.']" id="elem-'.$i.'">'. $value .'</textarea>
            		'.$desc.'
            </td>
        </tr>';
}

function seperate_tr($txt,$title='',$roll='') {
	echo '<tr><td colspan="2"><div class="sep_td_wrapper"><div id="scroll_to_'.$roll.'" class="sep_td" title="'.$title.'">'.$txt.'</div></div></td></tr>';
}

?>

<div style="color: rgb(235, 9, 9);font-size: 16px;font-weight: bold;">Please Upgrade to PRO Version to use Template Creator Wizard!</div>
<div id="cpanel" style="float: left;">
	<div class="icon" style="float: right;">
		<a href="http://creative-solutions.net/wordpress/contact-form-generator" target="_blank" title="Buy PRO version">
			<table style="width: 100%;height: 100%;text-decoration: none;">
				<tr>
					<td align="center" valign="middle">
						<img src="<?php echo plugins_url( '../images/shopping_cart.png' , __FILE__ );?>" /><br />
						Buy Pro Version
					</td>
				</tr>
			</table>
		</a>
	</div>
</div>
<div style="font-style: italic;font-size: 12px;color: #949494;clear: both;">Updrading to PRO is easy, and will take only <u style="color: rgb(44, 66, 231);font-weight: bold;">5 minutes!</u></div>
<div style="color: rgb(0, 85, 182);
  font-size: 25px;
  text-align: center;
  clear: both;
  margin-bottom: 15px;
  padding-bottom: 16px;
  border-bottom: 1px dotted rgb(95, 94, 94);">Template Creator Wizard Demo</div>

<div class="col100" style="position: relative;" id="c_div">
	 <div id="preview_dummy"></div>
	 
	 <div class="preview_box" style="display:none">
	 	<div class="view_toggler_wrapper">
	 		<span class="view_toggler_item active" style="margin-right: 5px;" title="Switch to main view." id="cfg_main_view">Main view</span>
	 		<span class="view_toggler_item" title="Switch to icons view." id="cfg_icons_view">Icons view</span>
	 	</div>
	 	<div class="main_view">
	
			<div class="contactformgenerator_wrapper " >
			<div class="contactformgenerator_wrapper_inner " >

				<!-- Main View --------------------------------------------------------------------------------------------------------- -->
				<div id="cfg_main_view_inner">

					<div class="contactformgenerator_header <?php if($styles[600] == 0) echo 'cfg_transparent'; ?>">
			 			<div class="contactformgenerator_title <?php echo $styles[510];?>">
			 				<span style="position:relative;display: inline-block;">
			 					Contact Us
			 					<img roll="1" style="top: 2px;right: -23px;;" title="Edit: Top Text" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option"/>
			 				</span>
			 			</div>
			 			<div  class="contactformgenerator_pre_text <?php echo $styles[511];?>">
			 				<span style="position:relative;display: inline-block;">
			 					Contact us, if you have any questions
									<img roll="2" style="top: -2px;right: -23px;" title="Edit: Pre Text" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
			 				</span>
			 			</div>

						<img roll="0" style="top: -7px;right: -7px;" title="Edit: Main Box" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option"/>
					</div>

					<div class="contactformgenerator_body <?php if($styles[610] == 0) echo 'cfg_transparent'; ?>">
 					
				 		<div class="contactformgenerator_field_box"><div class="contactformgenerator_field_box_inner">
				 			<label class="contactformgenerator_field_name <?php echo $styles[512];?>" for="name_0_1">
				 				<span class="cfg_label_txt_wrapper">
				 					Text Input <span class="contactformgenerator_field_required">*</span>
		 							<img roll="4" style="top: -2px;right: -50px;" title="Edit: Label Asterisk Symbol" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
		 							<img roll="3" style="top: -2px;right: -34px;" title="Edit: Label Text" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
				 				</span>
				 			</label>
				 			<div class="contactformgenerator_input_element contactformgenerator_required">
				 				<div class="cfg_input_dummy_wrapper">
				 					<span class="the-tooltip top right <?php echo $st = $styles[505] == '' ? 'white' : $styles[505];?>">
				 						<span class="tooltip_inner ">
				 							Tooltip text goes here!
		 									<img roll="12" style="top: 0px;right: -23px;" title="Edit: Tooltip Style" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
				 						</span>
				 					</span>
				 					<input class="cfg_name contactformgenerator_required cfg_input_reset" value="Normal state text..." type="text" id="name_0_1" name="contactformgenerator_fields[1][0]">
		 							<img roll="5" style="top: 2px;right: -23px;" title="Edit: Text Inputs" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
				 				</div>
				 			</div>
				 		</div></div>

				 		<div class="contactformgenerator_field_box contactformgenerator_field_box_hovered"><div class="contactformgenerator_field_box_inner">
				 			<label class="contactformgenerator_field_name <?php echo $styles[513];?>" for="email_0_2">
				 				<span class="cfg_label_txt_wrapper">
				 					Hover State
				 					<img roll="13" style="top: -2px;right: -23px;" title="Edit: Label Text Focus State" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
				 				</span>
				 			</label>
				 			<div class="contactformgenerator_input_element contactformgenerator_input_element_hovered">
					 			<div class="cfg_input_dummy_wrapper">
					 				<input class="cfg_email  cfg_input_reset" value="Hover state text..." type="text" id="email_0_2" name="contactformgenerator_fields[2][0]">
		 							<img roll="6" style="top: 2px;right: -23px;" title="Edit: Hover State" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
					 			</div>
				 			</div>
				 		</div></div>

				 		<div class="contactformgenerator_field_box contactformgenerator_error"><div class="contactformgenerator_field_box_inner">
				 			<label class="contactformgenerator_field_name <?php echo $styles[514];?>" for="phone_0_3">
				 				<span class="cfg_label_txt_wrapper">
				 					Error state
				 					<img roll="14" style="top: -2px;right: -23px;" title="Edit: Label Text Error State" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
				 				</span>
				 			</label>
				 			<div class="contactformgenerator_input_element contactformgenerator_required cfg_error_input">
				 				<div class="cfg_input_dummy_wrapper">
				 					<input class="cfg_phone  cfg_input_reset contactformgenerator_required" value="Error state text..." type="text" id="phone_0_3" name="contactformgenerator_fields[3][0]">
		 							<img roll="7" style="top: 2px;right: -23px;" title="Edit: Error State" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
				 				</div>
				 			</div>
				 		</div></div>


				 		<div class="contactformgenerator_field_box" style="margin: 0 !important;position: relative;"><div class="contactformgenerator_field_box_inner" style="width: 100%">
				 			<div class="contactformgenerator_heading <?php echo $styles[530];?>">
				 				<div class="contactformgenerator_heading_inner">
				 					<span style="position: relative">
				 						Heading example
				 					</span>
				 				</div>
				 			</div>
 							<img roll="19" style="top: 5px;right: -15px;" title="Edit: Heading Styles" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
				 		</div></div>

				 		<div class="contactformgenerator_field_box"><div class="contactformgenerator_field_box_textarea_inner">
				 			<label class="contactformgenerator_field_name <?php echo $styles[512];?>" for="text-area_0_5"><span class="cfg_label_txt_wrapper">Textarea</span></label>
				 			<div class="contactformgenerator_input_element cfg_textarea_wrapper contactformgenerator_required">
				 				<div class="cfg_textarea_dummy_wrapper">
				 					<textarea class="cfg_textarea cfg_text-area contactformgenerator_required cfg_textarea_reset" value="" cols="30" rows="15" id="text-area_0_5" name="contactformgenerator_fields[5][0]"></textarea>
		 							<img roll="11" style="top: 2px;right: -23px;" title="Edit: Textarea Styles" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
				 				</div>
				 			</div>
				 		</div></div>

	 				</div>

	 				<div class="contactformgenerator_footer <?php if($styles[617] == 0) echo 'cfg_transparent'; ?>">
			 			<div class="contactformgenerator_submit_wrapper">
				 			<div class="cfg_button_holder" style="position: relative;display: inline-block;">			
				 				<input type="button" value="Send" class="contactformgenerator_send <?php echo $styles[515];?>" roll="1" />
	 							<img roll="9" style="top: 2px;right: -18px;" title="Edit: Send Button" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
				 				<div class="contactformgenerator_clear"></div>
				 			</div>
				 			<div class="cfg_button_holder" style="position: relative;display: inline-block;margin: 0 30px;">			
				 				<input type="button" title="Send button hovered state" value="Hovered" class="contactformgenerator_send contactformgenerator_send_hovered <?php echo $styles[516];?>" roll="1" />
	 							<img roll="10" style="top: 2px;right: -18px;" title="Edit: Send Button Hover State" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
				 				<div class="contactformgenerator_clear"></div>
				 			</div>
			 			</div>
			 			<div class="contactformgenerator_clear"></div>
 					</div>
				</div>
	 			<!-- icons View --------------------------------------------------------------------------------------------------------- -->
	 			<div id="cfg_icons_view_inner" style="display: none;">
	 				<div class="contactformgenerator_body">
		 				<div class="cfg_preview_left_col" >
		 					<!-- Left column Conent **************************************************************** -->
		 					<div class="contactformgenerator_field_box"><div class="contactformgenerator_field_box_inner" style="width: 100%">
	 							<div class="cfg_sections_wrapper cfg_sections_template_<?php echo $styles[552];?>">
			 						<div class="cfg_content_element">
			 							<div class="cfg_content_element_content_wrapper">
				 							<div style="margin-left: 120px;">
												<span>
													PO Box 21177 / Level 13, 2 Elizabeth St...
												</span>
											</div>
										</div>
										<div class="cfg_content_element_icon_wrapper" style="width: 120px;position: relative">
											<span class="cfg_content_icon cfg_content_icon_address"></span>
											<span class="cfg_content_element_label">Address:</span>
											<img roll="20" style="top: 3px;right: 5px;" title="Edit: Sections Styles" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
										</div>
									</div>

									<div class="cfg_content_element">
										<div class="cfg_content_element_content_wrapper">
											<div style="margin-left: 120px;">
												<span>
													<span class="cfg_content_styling">+00 (0) 123 456 789</span>,<br/>
													<span class="cfg_content_styling">+00 (0) 123 456 789</span>
												</span>
											</div>
										</div>
										<div class="cfg_content_element_icon_wrapper" style="width: 120px;">
											<span class="cfg_content_icon cfg_content_icon_phone"></span>
											<span class="cfg_content_element_label">Phone:</span>
										</div>
									</div>

									<div class="cfg_content_element">
										<div class="cfg_content_element_content_wrapper">
											<div style="margin-left: 120px;">
												<span>
													<span class="cfg_content_styling">+00 (0) 123 456 789</span>
												</span>
											</div>
										</div>
										<div class="cfg_content_element_icon_wrapper" style="width: 120px;">
											<span class="cfg_content_icon cfg_content_icon_mobile"></span>
											<span class="cfg_content_element_label">Mobile:</span>
										</div>
									</div>

									<div class="cfg_content_element">
										<div class="cfg_content_element_content_wrapper">
											<div style="margin-left: 120px;">
												<span>
													email1@example.com,<br/>
													email2@example.com
												</span>
											</div>
										</div>
										<div class="cfg_content_element_icon_wrapper" style="width: 120px;">
											<span class="cfg_content_icon cfg_content_icon_email"></span>
											<span class="cfg_content_element_label">E-mail:</span>
										</div>
									</div>

									<div class="cfg_content_element">
										<div class="cfg_content_element_content_wrapper">
											<div style="margin-left: 120px;">
												<span>
													<a href="http://example.com" class="cfg_link" target="_blank">Example.com</a>
												</span>
											</div>
										</div>
										<div class="cfg_content_element_icon_wrapper" style="width: 120px;">
											<span class="cfg_content_icon cfg_content_icon_link"></span>
											<span class="cfg_content_element_label">Website:</span>
										</div>
									</div>


									<div class="cfg_content_element">
										<div class="cfg_content_element_content_wrapper">
											<div style="margin-left: 120px;">
												<span>
													Info section example...
												</span>
											</div>
										</div>
										<div class="cfg_content_element_icon_wrapper" style="width: 120px;">
											<span class="cfg_content_icon cfg_content_icon_info"></span>
											<span class="cfg_content_element_label">Info:</span>
										</div>
									</div>


									<div class="cfg_content_element">
										<div class="cfg_content_element_content_wrapper">
											<div style="margin-left: 120px;">
												<span>
													Tip section example...
												</span>
											</div>
										</div>
										<div class="cfg_content_element_icon_wrapper" style="width: 120px;">
											<span class="cfg_content_icon cfg_content_icon_tip"></span>
											<span class="cfg_content_element_label">Tip:</span>
										</div>
									</div>

									<div class="cfg_content_element">
										<div class="cfg_content_element_content_wrapper">
											<div style="margin-left: 120px;">
												<span>
													Question section example...
												</span>
											</div>
										</div>
										<div class="cfg_content_element_icon_wrapper" style="width: 120px;">
											<span class="cfg_content_icon cfg_content_icon_question"></span>
											<span class="cfg_content_element_label">Question:</span>
										</div>
									</div>

									<div class="cfg_content_element">
										<div class="cfg_content_element_content_wrapper">
											<div style="margin-left: 120px;">
												<span>
													Fax section example...
												</span>
											</div>
										</div>
										<div class="cfg_content_element_icon_wrapper" style="width: 120px;">
											<span class="cfg_content_icon cfg_content_icon_fax"></span>
											<span class="cfg_content_element_label">Fax:</span>
										</div>
									</div>

									<div class="cfg_content_element">
										<div class="cfg_content_element_content_wrapper">
											<div style="margin-left: 120px;">
												<span>
													Map section example...
												</span>
											</div>
										</div>
										<div class="cfg_content_element_icon_wrapper" style="width: 120px;">
											<span class="cfg_content_icon cfg_content_icon_map"></span>
											<span class="cfg_content_element_label">Map:</span>
										</div>
									</div>

								</div>

		 					</div></div>
		 					<!-- END Left column Conent ***************************************************************** -->
		 				</div>
		 				<div class="cfg_preview_right_col">
		 					<!-- Right column Conent ******************************************************************** -->
		 						<div class="contactformgenerator_field_box"><div class="contactformgenerator_field_box_inner" style="width: 82%">
						 			<label class="contactformgenerator_field_name <?php echo $styles[512];?>" for="name_0_1">
						 				<span class="cfg_label_txt_wrapper">
						 					Datepicker <span class="contactformgenerator_field_required">*</span>
						 				</span>
						 			</label>
						 			<div class="contactformgenerator_input_element contactformgenerator_required">
						 				<div class="cfg_input_dummy_wrapper">
						 					<input class="cfg_name contactformgenerator_required cfg_input_reset" value="" type="text" id="name_0_1" name="contactformgenerator_fields[1][0]">
						 					<img class="ui-datepicker-trigger cfg_datepicker_icon" data_src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/datepicker/"  src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/datepicker/style-<?php echo $styles[563];?>.png" alt="Select date" title="Select date">
				 							<img roll="21" style="top: 2px;right: -50px;" title="Edit: Text Inputs" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
						 				</div>
						 			</div>
						 		</div></div>

						 		<div class="contactformgenerator_field_box "><div class="contactformgenerator_field_box_inner" style="width: 100%">
						 			<label class="contactformgenerator_field_name <?php echo $styles[512];?>" >
						 				<span class="cfg_label_txt_wrapper">
						 					File Upload
						 				</span>
						 			</label>
									<div style="position: relative">			
						 				<input style="float: none;" type="button" value="Select Files..." class="cfg_fileupload contactformgenerator_send <?php echo $styles[515];?>" roll="1" />
			 							<img roll="25" style="top: 8px;right: -5px;" title="Edit: Send Button" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
						 			</div>
						 		</div></div>
								
								<div class="contactformgenerator_field_box" style="margin-top: 20px !important; "><div class="contactformgenerator_field_box_inner" style="width: 100%">
						 			<span style="position: relative;margin-right: 25px;">
						 				<a href="#" onclick="return false;" class="cfg_link">Links and Popup label.</a>
						 				<img roll="22" style="top: -1px;right: -15px;" title="Edit: Links" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
						 			</span>	
						 			<span style="position: relative;">
						 				<a href="#" onclick="return false;" class="cfg_link_hovered">Hover state.</a>
						 				<img roll="23" style="top: -1px;right: -19px;" title="Edit: Links Hover State" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
						 			</span>
						 		</div></div>

								<div class="contactformgenerator_field_box" style="margin-top: 20px !important; "><div class="contactformgenerator_field_box_inner" style="width: 100%">
						 			<span style="position: relative;">
						 				<span class="cfg_content_styling">Number styling example.</span>
						 				<img roll="24" style="top: -1px;right: -19px;" title="Edit: Links" src="<?php echo WPCFG_PLUGIN_PATH;?>/includes/assets/images/tmp_edit4.png" class="navigate_to_option" />
						 			</span>	
						 		</div></div>

		 					<!-- END Right column Conent **************************************************************** -->
		 				</div>
		 				<div class="contactformgenerator_clear"></div>
	 				</div>
	 			</div>
 			</div>
 			</div>
 		</div>
	 </div>
</div>

<form action="admin.php?page=cfg_forms&act=cfg_submit_data&holder=templates" method="post" id="wpcfg_form">
<div style="overflow: hidden;margin: 0 0 10px 0;float: right;">
	<div>
		<a href="admin.php?page=cfg_templates" id="wpcfg_add" class="button"><?php echo $t = $id == 0 ? 'Cancel' : 'Close';?></a>
	</div>
</div>

    <fieldset class="adminform" style="position: relative;">
        <div id="main_styles_table">
	        <table class="temp_table">
	        <?php seperate_tr("Template Name");
	        	create_accordion('Name','closed');?>
	        <tr>
	            <td width="180" align="right" class="key" style="width: 230px;">
	                <label for="name">
	                    Name:
	                </label>
	            </td>
	            <td class="st_td">
	                <input class="text_area" type="text" name="name" id="name" size="60" maxlength="250" value="<?php echo $row->name;?>" />
	            </td>
	            <?php close_accordion();?>
	        </tr>
	        <?php 
	        	$fonts_array = array(
		        				"Standard Fonts" => array(
		        					"inherit" => "Use Parent Font",
			        				"Arial, Helvetica, sans-serif" => "Arial",
			        				"'Comic Sans MS', cursive, sans-serif" => "Comic Sans MS",
			        				"Impact, Charcoal, sans-serif" => "Impact",
			        				"'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "Lucida Sans Unicode",
			        				"Tahoma, Geneva, sans-serif" => "Tahoma",
			        				"'Trebuchet MS', Helvetica, sans-serif" => "Trebuchet MS",
			        				"Verdana, Geneva, sans-serif" => "Verdana",

			        				"Georgia, serif" => "Georgia",
			        				"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "Palatino Linotype",
			        				"'Times New Roman', Times, serif" => "Times New Roman",
			        				
			        				"'Courier New', Courier, monospace" => "Courier New",
			        				"Monaco, monospace" => "Monaco",
			        				"'Lucida Console', monospace" => "Lucida Console",
	        					),
	        					"Google Web Fonts" => array(
									"cfg-googlewebfont-ABeeZee" => "ABeeZee",
									"cfg-googlewebfont-Abel" => "Abel",
									// "Abril Fatface" => "Abril Fatface",
									"cfg-googlewebfont-Aclonica" => "Aclonica",
									"cfg-googlewebfont-Acme" => "Acme",
									"cfg-googlewebfont-Actor" => "Actor",
									"cfg-googlewebfont-Adamina" => "Adamina",
									"cfg-googlewebfont-Advent Pro" => "Advent Pro",
									"cfg-googlewebfont-Aguafina Script" => "Aguafina Script",
									"cfg-googlewebfont-Akronim" => "Akronim",
									"cfg-googlewebfont-Aladin" => "Aladin",
									"cfg-googlewebfont-Aldrich" => "Aldrich",
									"cfg-googlewebfont-Alef" => "Alef",
									"cfg-googlewebfont-Alegreya" => "Alegreya",
									"cfg-googlewebfont-Alegreya SC" => "Alegreya SC",
									"cfg-googlewebfont-Alegreya Sans" => "Alegreya Sans",
									"cfg-googlewebfont-Alegreya Sans SC" => "Alegreya Sans SC",
									"cfg-googlewebfont-Alex Brush" => "Alex Brush",
									"cfg-googlewebfont-Alfa Slab One" => "Alfa Slab One",
									"cfg-googlewebfont-Alice" => "Alice",
									"cfg-googlewebfont-Alike" => "Alike",
									"cfg-googlewebfont-Alike Angular" => "Alike Angular",
									"cfg-googlewebfont-Allan" => "Allan",
									"cfg-googlewebfont-Allerta" => "Allerta",
									"cfg-googlewebfont-Allerta Stencil" => "Allerta Stencil",
									"cfg-googlewebfont-Allura" => "Allura",
									"cfg-googlewebfont-Almendra" => "Almendra",
									"cfg-googlewebfont-Almendra Display" => "Almendra Display",
									"cfg-googlewebfont-Almendra SC" => "Almendra SC",
									"cfg-googlewebfont-Amarante" => "Amarante",
									"cfg-googlewebfont-Amaranth" => "Amaranth",
									"cfg-googlewebfont-Amatic SC" => "Amatic SC",
									"cfg-googlewebfont-Amethysta" => "Amethysta",
									"cfg-googlewebfont-Anaheim" => "Anaheim",
									"cfg-googlewebfont-Andada" => "Andada",
									"cfg-googlewebfont-Andika" => "Andika",
									"cfg-googlewebfont-Angkor" => "Angkor",
									"cfg-googlewebfont-Annie Use Your Telescope" => "Annie Use Your Telescope",
									"cfg-googlewebfont-Anonymous Pro" => "Anonymous Pro",
									"cfg-googlewebfont-Antic" => "Antic",
									"cfg-googlewebfont-Antic Didone" => "Antic Didone",
									"cfg-googlewebfont-Antic Slab" => "Antic Slab",
									"cfg-googlewebfont-Anton" => "Anton",
									"cfg-googlewebfont-Arapey" => "Arapey",
									"cfg-googlewebfont-Arbutus" => "Arbutus",
									"cfg-googlewebfont-Arbutus Slab" => "Arbutus Slab",
									"cfg-googlewebfont-Architects Daughter" => "Architects Daughter",
									"cfg-googlewebfont-Archivo Black" => "Archivo Black",
									"cfg-googlewebfont-Archivo Narrow" => "Archivo Narrow",
									"cfg-googlewebfont-Arimo" => "Arimo",
									"cfg-googlewebfont-Arizonia" => "Arizonia",
									"cfg-googlewebfont-Armata" => "Armata",
									"cfg-googlewebfont-Artifika" => "Artifika",
									"cfg-googlewebfont-Arvo" => "Arvo",
									"cfg-googlewebfont-Asap" => "Asap",
									"cfg-googlewebfont-Asset" => "Asset",
									"cfg-googlewebfont-Astloch" => "Astloch",
									"cfg-googlewebfont-Asul" => "Asul",
									"cfg-googlewebfont-Atomic Age" => "Atomic Age",
									"cfg-googlewebfont-Aubrey" => "Aubrey",
									"cfg-googlewebfont-Audiowide" => "Audiowide",
									"cfg-googlewebfont-Autour One" => "Autour One",
									"cfg-googlewebfont-Average" => "Average",
									"cfg-googlewebfont-Average Sans" => "Average Sans",
									"cfg-googlewebfont-Averia Gruesa Libre" => "Averia Gruesa Libre",
									"cfg-googlewebfont-Averia Libre" => "Averia Libre",
									"cfg-googlewebfont-Averia Sans Libre" => "Averia Sans Libre",
									"cfg-googlewebfont-Averia Serif Libre" => "Averia Serif Libre",
									"cfg-googlewebfont-Bad Script" => "Bad Script",
									"cfg-googlewebfont-Balthazar" => "Balthazar",
									"cfg-googlewebfont-Bangers" => "Bangers",
									"cfg-googlewebfont-Basic" => "Basic",
									"cfg-googlewebfont-Battambang" => "Battambang",
									"cfg-googlewebfont-Baumans" => "Baumans",
									"cfg-googlewebfont-Bayon" => "Bayon",
									"cfg-googlewebfont-Belgrano" => "Belgrano",
									"cfg-googlewebfont-Belleza" => "Belleza",
									"cfg-googlewebfont-BenchNine" => "BenchNine",
									"cfg-googlewebfont-Bentham" => "Bentham",
									"cfg-googlewebfont-Berkshire Swash" => "Berkshire Swash",
									"cfg-googlewebfont-Bevan" => "Bevan",
									"cfg-googlewebfont-Bigelow Rules" => "Bigelow Rules",
									"cfg-googlewebfont-Bigshot One" => "Bigshot One",
									"cfg-googlewebfont-Bilbo" => "Bilbo",
									"cfg-googlewebfont-Bilbo Swash Caps" => "Bilbo Swash Caps",
									"cfg-googlewebfont-Bitter" => "Bitter",
									"cfg-googlewebfont-Black Ops One" => "Black Ops One",
									"cfg-googlewebfont-Bokor" => "Bokor",
									"cfg-googlewebfont-Bonbon" => "Bonbon",
									"cfg-googlewebfont-Boogaloo" => "Boogaloo",
									"cfg-googlewebfont-Bowlby One" => "Bowlby One",
									"cfg-googlewebfont-Bowlby One SC" => "Bowlby One SC",
									"cfg-googlewebfont-Brawler" => "Brawler",
									"cfg-googlewebfont-Bree Serif" => "Bree Serif",
									"cfg-googlewebfont-Bubblegum Sans" => "Bubblegum Sans",
									"cfg-googlewebfont-Bubbler One" => "Bubbler One",
									"cfg-googlewebfont-Buda" => "Buda",
									"cfg-googlewebfont-Buenard" => "Buenard",
									"cfg-googlewebfont-Butcherman" => "Butcherman",
									"cfg-googlewebfont-Butterfly Kids" => "Butterfly Kids",
									"cfg-googlewebfont-Cabin" => "Cabin",
									"cfg-googlewebfont-Cabin Condensed" => "Cabin Condensed",
									"cfg-googlewebfont-Cabin Sketch" => "Cabin Sketch",
									"cfg-googlewebfont-Caesar Dressing" => "Caesar Dressing",
									"cfg-googlewebfont-Cagliostro" => "Cagliostro",
									"cfg-googlewebfont-Calligraffitti" => "Calligraffitti",
									"cfg-googlewebfont-Cambo" => "Cambo",
									"cfg-googlewebfont-Candal" => "Candal",
									"cfg-googlewebfont-Cantarell" => "Cantarell",
									"cfg-googlewebfont-Cantata One" => "Cantata One",
									"cfg-googlewebfont-Cantora One" => "Cantora One",
									"cfg-googlewebfont-Capriola" => "Capriola",
									"cfg-googlewebfont-Cardo" => "Cardo",
									"cfg-googlewebfont-Carme" => "Carme",
									"cfg-googlewebfont-Carrois Gothic" => "Carrois Gothic",
									"cfg-googlewebfont-Carrois Gothic SC" => "Carrois Gothic SC",
									"cfg-googlewebfont-Carter One" => "Carter One",
									"cfg-googlewebfont-Caudex" => "Caudex",
									"cfg-googlewebfont-Cedarville Cursive" => "Cedarville Cursive",
									"cfg-googlewebfont-Ceviche One" => "Ceviche One",
									"cfg-googlewebfont-Changa One" => "Changa One",
									"cfg-googlewebfont-Chango" => "Chango",
									"cfg-googlewebfont-Chau Philomene One" => "Chau Philomene One",
									"cfg-googlewebfont-Chela One" => "Chela One",
									"cfg-googlewebfont-Chelsea Market" => "Chelsea Market",
									"cfg-googlewebfont-Chenla" => "Chenla",
									"cfg-googlewebfont-Cherry Cream Soda" => "Cherry Cream Soda",
									"cfg-googlewebfont-Cherry Swash" => "Cherry Swash",
									"cfg-googlewebfont-Chewy" => "Chewy",
									"cfg-googlewebfont-Chicle" => "Chicle",
									"cfg-googlewebfont-Chivo" => "Chivo",
									"cfg-googlewebfont-Cinzel" => "Cinzel",
									"cfg-googlewebfont-Cinzel Decorative" => "Cinzel Decorative",
									"cfg-googlewebfont-Clicker Script" => "Clicker Script",
									"cfg-googlewebfont-Coda" => "Coda",
									"cfg-googlewebfont-Coda Caption" => "Coda Caption",
									"cfg-googlewebfont-Codystar" => "Codystar",
									"cfg-googlewebfont-Combo" => "Combo",
									"cfg-googlewebfont-Comfortaa" => "Comfortaa",
									"cfg-googlewebfont-Coming Soon" => "Coming Soon",
									"cfg-googlewebfont-Concert One" => "Concert One",
									"cfg-googlewebfont-Condiment" => "Condiment",
									"cfg-googlewebfont-Content" => "Content",
									"cfg-googlewebfont-Contrail One" => "Contrail One",
									"cfg-googlewebfont-Convergence" => "Convergence",
									"cfg-googlewebfont-Cookie" => "Cookie",
									"cfg-googlewebfont-Copse" => "Copse",
									"cfg-googlewebfont-Corben" => "Corben",
									"cfg-googlewebfont-Courgette" => "Courgette",
									"cfg-googlewebfont-Cousine" => "Cousine",
									"cfg-googlewebfont-Coustard" => "Coustard",
									"cfg-googlewebfont-Covered By Your Grace" => "Covered By Your Grace",
									"cfg-googlewebfont-Crafty Girls" => "Crafty Girls",
									"cfg-googlewebfont-Creepster" => "Creepster",
									"cfg-googlewebfont-Crete Round" => "Crete Round",
									"cfg-googlewebfont-Crimson Text" => "Crimson Text",
									"cfg-googlewebfont-Croissant One" => "Croissant One",
									"cfg-googlewebfont-Crushed" => "Crushed",
									"cfg-googlewebfont-Cuprum" => "Cuprum",
									"cfg-googlewebfont-Cutive" => "Cutive",
									"cfg-googlewebfont-Cutive Mono" => "Cutive Mono",
									"cfg-googlewebfont-Damion" => "Damion",
									"cfg-googlewebfont-Dancing Script" => "Dancing Script",
									"cfg-googlewebfont-Dangrek" => "Dangrek",
									"cfg-googlewebfont-Dawning of a New Day" => "Dawning of a New Day",
									"cfg-googlewebfont-Days One" => "Days One",
									"cfg-googlewebfont-Delius" => "Delius",
									"cfg-googlewebfont-Delius Swash Caps" => "Delius Swash Caps",
									"cfg-googlewebfont-Delius Unicase" => "Delius Unicase",
									"cfg-googlewebfont-Della Respira" => "Della Respira",
									"cfg-googlewebfont-Denk One" => "Denk One",
									"cfg-googlewebfont-Devonshire" => "Devonshire",
									"cfg-googlewebfont-Didact Gothic" => "Didact Gothic",
									"cfg-googlewebfont-Diplomata" => "Diplomata",
									"cfg-googlewebfont-Diplomata SC" => "Diplomata SC",
									"cfg-googlewebfont-Domine" => "Domine",
									"cfg-googlewebfont-Donegal One" => "Donegal One",
									"cfg-googlewebfont-Doppio One" => "Doppio One",
									"cfg-googlewebfont-Dorsa" => "Dorsa",
									"cfg-googlewebfont-Dosis" => "Dosis",
									"cfg-googlewebfont-Dr Sugiyama" => "Dr Sugiyama",
									"cfg-googlewebfont-Droid Sans" => "Droid Sans",
									"cfg-googlewebfont-Droid Sans Mono" => "Droid Sans Mono",
									"cfg-googlewebfont-Droid Serif" => "Droid Serif",
									"cfg-googlewebfont-Duru Sans" => "Duru Sans",
									"cfg-googlewebfont-Dynalight" => "Dynalight",
									"cfg-googlewebfont-EB Garamond" => "EB Garamond",
									"cfg-googlewebfont-Eagle Lake" => "Eagle Lake",
									"cfg-googlewebfont-Eater" => "Eater",
									"cfg-googlewebfont-Economica" => "Economica",
									"cfg-googlewebfont-Ek Mukta" => "Ek Mukta",
									"cfg-googlewebfont-Electrolize" => "Electrolize",
									"cfg-googlewebfont-Elsie" => "Elsie",
									"cfg-googlewebfont-Elsie Swash Caps" => "Elsie Swash Caps",
									"cfg-googlewebfont-Emblema One" => "Emblema One",
									"cfg-googlewebfont-Emilys Candy" => "Emilys Candy",
									"cfg-googlewebfont-Engagement" => "Engagement",
									"cfg-googlewebfont-Englebert" => "Englebert",
									"cfg-googlewebfont-Enriqueta" => "Enriqueta",
									"cfg-googlewebfont-Erica One" => "Erica One",
									"cfg-googlewebfont-Esteban" => "Esteban",
									"cfg-googlewebfont-Euphoria Script" => "Euphoria Script",
									"cfg-googlewebfont-Ewert" => "Ewert",
									"cfg-googlewebfont-Exo" => "Exo",
									"cfg-googlewebfont-Exo 2" => "Exo 2",
									"cfg-googlewebfont-Expletus Sans" => "Expletus Sans",
									"cfg-googlewebfont-Fanwood Text" => "Fanwood Text",
									"cfg-googlewebfont-Fascinate" => "Fascinate",
									"cfg-googlewebfont-Fascinate Inline" => "Fascinate Inline",
									"cfg-googlewebfont-Faster One" => "Faster One",
									"cfg-googlewebfont-Fasthand" => "Fasthand",
									"cfg-googlewebfont-Fauna One" => "Fauna One",
									"cfg-googlewebfont-Federant" => "Federant",
									"cfg-googlewebfont-Federo" => "Federo",
									"cfg-googlewebfont-Felipa" => "Felipa",
									"cfg-googlewebfont-Fenix" => "Fenix",
									"cfg-googlewebfont-Finger Paint" => "Finger Paint",
									"cfg-googlewebfont-Fira Mono" => "Fira Mono",
									"cfg-googlewebfont-Fira Sans" => "Fira Sans",
									"cfg-googlewebfont-Fjalla One" => "Fjalla One",
									"cfg-googlewebfont-Fjord One" => "Fjord One",
									"cfg-googlewebfont-Flamenco" => "Flamenco",
									"cfg-googlewebfont-Flavors" => "Flavors",
									"cfg-googlewebfont-Fondamento" => "Fondamento",
									"cfg-googlewebfont-Fontdiner Swanky" => "Fontdiner Swanky",
									"cfg-googlewebfont-Forum" => "Forum",
									"cfg-googlewebfont-Francois One" => "Francois One",
									"cfg-googlewebfont-Freckle Face" => "Freckle Face",
									"cfg-googlewebfont-Fredericka the Great" => "Fredericka the Great",
									"cfg-googlewebfont-Fredoka One" => "Fredoka One",
									"cfg-googlewebfont-Freehand" => "Freehand",
									"cfg-googlewebfont-Fresca" => "Fresca",
									"cfg-googlewebfont-Frijole" => "Frijole",
									"cfg-googlewebfont-Fruktur" => "Fruktur",
									"cfg-googlewebfont-Fugaz One" => "Fugaz One",
									"cfg-googlewebfont-GFS Didot" => "GFS Didot",
									"cfg-googlewebfont-GFS Neohellenic" => "GFS Neohellenic",
									"cfg-googlewebfont-Gabriela" => "Gabriela",
									"cfg-googlewebfont-Gafata" => "Gafata",
									"cfg-googlewebfont-Galdeano" => "Galdeano",
									"cfg-googlewebfont-Galindo" => "Galindo",
									"cfg-googlewebfont-Gentium Basic" => "Gentium Basic",
									"cfg-googlewebfont-Gentium Book Basic" => "Gentium Book Basic",
									"cfg-googlewebfont-Geo" => "Geo",
									"cfg-googlewebfont-Geostar" => "Geostar",
									"cfg-googlewebfont-Geostar Fill" => "Geostar Fill",
									"cfg-googlewebfont-Germania One" => "Germania One",
									"cfg-googlewebfont-Gilda Display" => "Gilda Display",
									"cfg-googlewebfont-Give You Glory" => "Give You Glory",
									"cfg-googlewebfont-Glass Antiqua" => "Glass Antiqua",
									"cfg-googlewebfont-Glegoo" => "Glegoo",
									"cfg-googlewebfont-Gloria Hallelujah" => "Gloria Hallelujah",
									"cfg-googlewebfont-Goblin One" => "Goblin One",
									"cfg-googlewebfont-Gochi Hand" => "Gochi Hand",
									"cfg-googlewebfont-Gorditas" => "Gorditas",
									"cfg-googlewebfont-Goudy Bookletter 1911" => "Goudy Bookletter 1911",
									"cfg-googlewebfont-Graduate" => "Graduate",
									"cfg-googlewebfont-Grand Hotel" => "Grand Hotel",
									"cfg-googlewebfont-Gravitas One" => "Gravitas One",
									"cfg-googlewebfont-Great Vibes" => "Great Vibes",
									"cfg-googlewebfont-Griffy" => "Griffy",
									"cfg-googlewebfont-Gruppo" => "Gruppo",
									"cfg-googlewebfont-Gudea" => "Gudea",
									"cfg-googlewebfont-Habibi" => "Habibi",
									"cfg-googlewebfont-Halant" => "Halant",
									"cfg-googlewebfont-Hammersmith One" => "Hammersmith One",
									"cfg-googlewebfont-Hanalei" => "Hanalei",
									"cfg-googlewebfont-Hanalei Fill" => "Hanalei Fill",
									"cfg-googlewebfont-Handlee" => "Handlee",
									"cfg-googlewebfont-Hanuman" => "Hanuman",
									"cfg-googlewebfont-Happy Monkey" => "Happy Monkey",
									"cfg-googlewebfont-Headland One" => "Headland One",
									"cfg-googlewebfont-Henny Penny" => "Henny Penny",
									"cfg-googlewebfont-Herr Von Muellerhoff" => "Herr Von Muellerhoff",
									"cfg-googlewebfont-Hind" => "Hind",
									"cfg-googlewebfont-Holtwood One SC" => "Holtwood One SC",
									"cfg-googlewebfont-Homemade Apple" => "Homemade Apple",
									"cfg-googlewebfont-Homenaje" => "Homenaje",
									"cfg-googlewebfont-IM Fell DW Pica" => "IM Fell DW Pica",
									"cfg-googlewebfont-IM Fell DW Pica SC" => "IM Fell DW Pica SC",
									"cfg-googlewebfont-IM Fell Double Pica" => "IM Fell Double Pica",
									"cfg-googlewebfont-IM Fell Double Pica SC" => "IM Fell Double Pica SC",
									"cfg-googlewebfont-IM Fell English" => "IM Fell English",
									"cfg-googlewebfont-IM Fell English SC" => "IM Fell English SC",
									"cfg-googlewebfont-IM Fell French Canon" => "IM Fell French Canon",
									"cfg-googlewebfont-IM Fell French Canon SC" => "IM Fell French Canon SC",
									"cfg-googlewebfont-IM Fell Great Primer" => "IM Fell Great Primer",
									"cfg-googlewebfont-IM Fell Great Primer SC" => "IM Fell Great Primer SC",
									"cfg-googlewebfont-Iceberg" => "Iceberg",
									"cfg-googlewebfont-Iceland" => "Iceland",
									"cfg-googlewebfont-Imprima" => "Imprima",
									"cfg-googlewebfont-Inconsolata" => "Inconsolata",
									"cfg-googlewebfont-Inder" => "Inder",
									"cfg-googlewebfont-Indie Flower" => "Indie Flower",
									"cfg-googlewebfont-Inika" => "Inika",
									"cfg-googlewebfont-Irish Grover" => "Irish Grover",
									"cfg-googlewebfont-Istok Web" => "Istok Web",
									"cfg-googlewebfont-Italiana" => "Italiana",
									"cfg-googlewebfont-Italianno" => "Italianno",
									"cfg-googlewebfont-Jacques Francois" => "Jacques Francois",
									"cfg-googlewebfont-Jacques Francois Shadow" => "Jacques Francois Shadow",
									"cfg-googlewebfont-Jim Nightshade" => "Jim Nightshade",
									"cfg-googlewebfont-Jockey One" => "Jockey One",
									"cfg-googlewebfont-Jolly Lodger" => "Jolly Lodger",
									"cfg-googlewebfont-Josefin Sans" => "Josefin Sans",
									"cfg-googlewebfont-Josefin Slab" => "Josefin Slab",
									"cfg-googlewebfont-Joti One" => "Joti One",
									"cfg-googlewebfont-Judson" => "Judson",
									"cfg-googlewebfont-Julee" => "Julee",
									"cfg-googlewebfont-Julius Sans One" => "Julius Sans One",
									"cfg-googlewebfont-Junge" => "Junge",
									"cfg-googlewebfont-Jura" => "Jura",
									"cfg-googlewebfont-Just Another Hand" => "Just Another Hand",
									"cfg-googlewebfont-Just Me Again Down Here" => "Just Me Again Down Here",
									"cfg-googlewebfont-Kalam" => "Kalam",
									"cfg-googlewebfont-Kameron" => "Kameron",
									"cfg-googlewebfont-Kantumruy" => "Kantumruy",
									"cfg-googlewebfont-Karla" => "Karla",
									"cfg-googlewebfont-Karma" => "Karma",
									"cfg-googlewebfont-Kaushan Script" => "Kaushan Script",
									"cfg-googlewebfont-Kavoon" => "Kavoon",
									"cfg-googlewebfont-Kdam Thmor" => "Kdam Thmor",
									"cfg-googlewebfont-Keania One" => "Keania One",
									"cfg-googlewebfont-Kelly Slab" => "Kelly Slab",
									"cfg-googlewebfont-Kenia" => "Kenia",
									"cfg-googlewebfont-Khand" => "Khand",
									"cfg-googlewebfont-Khmer" => "Khmer",
									"cfg-googlewebfont-Kite One" => "Kite One",
									"cfg-googlewebfont-Knewave" => "Knewave",
									"cfg-googlewebfont-Kotta One" => "Kotta One",
									"cfg-googlewebfont-Koulen" => "Koulen",
									"cfg-googlewebfont-Kranky" => "Kranky",
									"cfg-googlewebfont-Kreon" => "Kreon",
									"cfg-googlewebfont-Kristi" => "Kristi",
									"cfg-googlewebfont-Krona One" => "Krona One",
									"cfg-googlewebfont-La Belle Aurore" => "La Belle Aurore",
									"cfg-googlewebfont-Laila" => "Laila",
									"cfg-googlewebfont-Lancelot" => "Lancelot",
									"cfg-googlewebfont-Lato" => "Lato",
									"cfg-googlewebfont-League Script" => "League Script",
									"cfg-googlewebfont-Leckerli One" => "Leckerli One",
									"cfg-googlewebfont-Ledger" => "Ledger",
									"cfg-googlewebfont-Lekton" => "Lekton",
									"cfg-googlewebfont-Lemon" => "Lemon",
									"cfg-googlewebfont-Libre Baskerville" => "Libre Baskerville",
									"cfg-googlewebfont-Life Savers" => "Life Savers",
									"cfg-googlewebfont-Lilita One" => "Lilita One",
									"cfg-googlewebfont-Lily Script One" => "Lily Script One",
									"cfg-googlewebfont-Limelight" => "Limelight",
									"cfg-googlewebfont-Linden Hill" => "Linden Hill",
									"cfg-googlewebfont-Lobster" => "Lobster",
									"cfg-googlewebfont-Lobster Two" => "Lobster Two",
									"cfg-googlewebfont-Londrina Outline" => "Londrina Outline",
									"cfg-googlewebfont-Londrina Shadow" => "Londrina Shadow",
									"cfg-googlewebfont-Londrina Sketch" => "Londrina Sketch",
									"cfg-googlewebfont-Londrina Solid" => "Londrina Solid",
									"cfg-googlewebfont-Lora" => "Lora",
									"cfg-googlewebfont-Love Ya Like A Sister" => "Love Ya Like A Sister",
									"cfg-googlewebfont-Loved by the King" => "Loved by the King",
									"cfg-googlewebfont-Lovers Quarrel" => "Lovers Quarrel",
									"cfg-googlewebfont-Luckiest Guy" => "Luckiest Guy",
									"cfg-googlewebfont-Lusitana" => "Lusitana",
									"cfg-googlewebfont-Lustria" => "Lustria",
									"cfg-googlewebfont-Macondo" => "Macondo",
									"cfg-googlewebfont-Macondo Swash Caps" => "Macondo Swash Caps",
									"cfg-googlewebfont-Magra" => "Magra",
									"cfg-googlewebfont-Maiden Orange" => "Maiden Orange",
									"cfg-googlewebfont-Mako" => "Mako",
									"cfg-googlewebfont-Marcellus" => "Marcellus",
									"cfg-googlewebfont-Marcellus SC" => "Marcellus SC",
									"cfg-googlewebfont-Marck Script" => "Marck Script",
									"cfg-googlewebfont-Margarine" => "Margarine",
									"cfg-googlewebfont-Marko One" => "Marko One",
									"cfg-googlewebfont-Marmelad" => "Marmelad",
									"cfg-googlewebfont-Marvel" => "Marvel",
									"cfg-googlewebfont-Mate" => "Mate",
									"cfg-googlewebfont-Mate SC" => "Mate SC",
									"cfg-googlewebfont-Maven Pro" => "Maven Pro",
									"cfg-googlewebfont-McLaren" => "McLaren",
									"cfg-googlewebfont-Meddon" => "Meddon",
									"cfg-googlewebfont-MedievalSharp" => "MedievalSharp",
									"cfg-googlewebfont-Medula One" => "Medula One",
									"cfg-googlewebfont-Megrim" => "Megrim",
									"cfg-googlewebfont-Meie Script" => "Meie Script",
									"cfg-googlewebfont-Merienda" => "Merienda",
									"cfg-googlewebfont-Merienda One" => "Merienda One",
									"cfg-googlewebfont-Merriweather" => "Merriweather",
									"cfg-googlewebfont-Merriweather Sans" => "Merriweather Sans",
									"cfg-googlewebfont-Metal" => "Metal",
									"cfg-googlewebfont-Metal Mania" => "Metal Mania",
									"cfg-googlewebfont-Metamorphous" => "Metamorphous",
									"cfg-googlewebfont-Metrophobic" => "Metrophobic",
									"cfg-googlewebfont-Michroma" => "Michroma",
									"cfg-googlewebfont-Milonga" => "Milonga",
									"cfg-googlewebfont-Miltonian" => "Miltonian",
									"cfg-googlewebfont-Miltonian Tattoo" => "Miltonian Tattoo",
									"cfg-googlewebfont-Miniver" => "Miniver",
									"cfg-googlewebfont-Miss Fajardose" => "Miss Fajardose",
									"cfg-googlewebfont-Modern Antiqua" => "Modern Antiqua",
									"cfg-googlewebfont-Molengo" => "Molengo",
									"cfg-googlewebfont-Molle" => "Molle",
									"cfg-googlewebfont-Monda" => "Monda",
									"cfg-googlewebfont-Monofett" => "Monofett",
									"cfg-googlewebfont-Monoton" => "Monoton",
									"cfg-googlewebfont-Monsieur La Doulaise" => "Monsieur La Doulaise",
									"cfg-googlewebfont-Montaga" => "Montaga",
									"cfg-googlewebfont-Montez" => "Montez",
									"cfg-googlewebfont-Montserrat" => "Montserrat",
									"cfg-googlewebfont-Montserrat Alternates" => "Montserrat Alternates",
									"cfg-googlewebfont-Montserrat Subrayada" => "Montserrat Subrayada",
									"cfg-googlewebfont-Moul" => "Moul",
									"cfg-googlewebfont-Moulpali" => "Moulpali",
									"cfg-googlewebfont-Mountains of Christmas" => "Mountains of Christmas",
									"cfg-googlewebfont-Mouse Memoirs" => "Mouse Memoirs",
									"cfg-googlewebfont-Mr Bedfort" => "Mr Bedfort",
									"cfg-googlewebfont-Mr Dafoe" => "Mr Dafoe",
									"cfg-googlewebfont-Mr De Haviland" => "Mr De Haviland",
									"cfg-googlewebfont-Mrs Saint Delafield" => "Mrs Saint Delafield",
									"cfg-googlewebfont-Mrs Sheppards" => "Mrs Sheppards",
									"cfg-googlewebfont-Muli" => "Muli",
									"cfg-googlewebfont-Mystery Quest" => "Mystery Quest",
									"cfg-googlewebfont-Neucha" => "Neucha",
									"cfg-googlewebfont-Neuton" => "Neuton",
									"cfg-googlewebfont-New Rocker" => "New Rocker",
									"cfg-googlewebfont-News Cycle" => "News Cycle",
									"cfg-googlewebfont-Niconne" => "Niconne",
									"cfg-googlewebfont-Nixie One" => "Nixie One",
									"cfg-googlewebfont-Nobile" => "Nobile",
									"cfg-googlewebfont-Nokora" => "Nokora",
									"cfg-googlewebfont-Norican" => "Norican",
									"cfg-googlewebfont-Nosifer" => "Nosifer",
									"cfg-googlewebfont-Nothing You Could Do" => "Nothing You Could Do",
									"cfg-googlewebfont-Noticia Text" => "Noticia Text",
									"cfg-googlewebfont-Noto Sans" => "Noto Sans",
									"cfg-googlewebfont-Noto Serif" => "Noto Serif",
									"cfg-googlewebfont-Nova Cut" => "Nova Cut",
									"cfg-googlewebfont-Nova Flat" => "Nova Flat",
									"cfg-googlewebfont-Nova Mono" => "Nova Mono",
									"cfg-googlewebfont-Nova Oval" => "Nova Oval",
									"cfg-googlewebfont-Nova Round" => "Nova Round",
									"cfg-googlewebfont-Nova Script" => "Nova Script",
									"cfg-googlewebfont-Nova Slim" => "Nova Slim",
									"cfg-googlewebfont-Nova Square" => "Nova Square",
									"cfg-googlewebfont-Numans" => "Numans",
									"cfg-googlewebfont-Nunito" => "Nunito",
									"cfg-googlewebfont-Odor Mean Chey" => "Odor Mean Chey",
									"cfg-googlewebfont-Offside" => "Offside",
									"cfg-googlewebfont-Old Standard TT" => "Old Standard TT",
									"cfg-googlewebfont-Oldenburg" => "Oldenburg",
									"cfg-googlewebfont-Oleo Script" => "Oleo Script",
									"cfg-googlewebfont-Oleo Script Swash Caps" => "Oleo Script Swash Caps",
									"cfg-googlewebfont-Open Sans" => "Open Sans",
									"cfg-googlewebfont-Open Sans Condensed" => "Open Sans Condensed",
									"cfg-googlewebfont-Oranienbaum" => "Oranienbaum",
									"cfg-googlewebfont-Orbitron" => "Orbitron",
									"cfg-googlewebfont-Oregano" => "Oregano",
									"cfg-googlewebfont-Orienta" => "Orienta",
									"cfg-googlewebfont-Original Surfer" => "Original Surfer",
									"cfg-googlewebfont-Oswald" => "Oswald",
									"cfg-googlewebfont-Over the Rainbow" => "Over the Rainbow",
									"cfg-googlewebfont-Overlock" => "Overlock",
									"cfg-googlewebfont-Overlock SC" => "Overlock SC",
									"cfg-googlewebfont-Ovo" => "Ovo",
									"cfg-googlewebfont-Oxygen" => "Oxygen",
									"cfg-googlewebfont-Oxygen Mono" => "Oxygen Mono",
									"cfg-googlewebfont-PT Mono" => "PT Mono",
									"cfg-googlewebfont-PT Sans" => "PT Sans",
									"cfg-googlewebfont-PT Sans Caption" => "PT Sans Caption",
									"cfg-googlewebfont-PT Sans Narrow" => "PT Sans Narrow",
									"cfg-googlewebfont-PT Serif" => "PT Serif",
									"cfg-googlewebfont-PT Serif Caption" => "PT Serif Caption",
									"cfg-googlewebfont-Pacifico" => "Pacifico",
									"cfg-googlewebfont-Paprika" => "Paprika",
									"cfg-googlewebfont-Parisienne" => "Parisienne",
									"cfg-googlewebfont-Passero One" => "Passero One",
									"cfg-googlewebfont-Passion One" => "Passion One",
									"cfg-googlewebfont-Pathway Gothic One" => "Pathway Gothic One",
									"cfg-googlewebfont-Patrick Hand" => "Patrick Hand",
									"cfg-googlewebfont-Patrick Hand SC" => "Patrick Hand SC",
									"cfg-googlewebfont-Patua One" => "Patua One",
									"cfg-googlewebfont-Paytone One" => "Paytone One",
									"cfg-googlewebfont-Peralta" => "Peralta",
									"cfg-googlewebfont-Permanent Marker" => "Permanent Marker",
									"cfg-googlewebfont-Petit Formal Script" => "Petit Formal Script",
									"cfg-googlewebfont-Petrona" => "Petrona",
									"cfg-googlewebfont-Philosopher" => "Philosopher",
									"cfg-googlewebfont-Piedra" => "Piedra",
									"cfg-googlewebfont-Pinyon Script" => "Pinyon Script",
									"cfg-googlewebfont-Pirata One" => "Pirata One",
									"cfg-googlewebfont-Plaster" => "Plaster",
									"cfg-googlewebfont-Play" => "Play",
									"cfg-googlewebfont-Playball" => "Playball",
									"cfg-googlewebfont-Playfair Display" => "Playfair Display",
									"cfg-googlewebfont-Playfair Display SC" => "Playfair Display SC",
									"cfg-googlewebfont-Podkova" => "Podkova",
									"cfg-googlewebfont-Poiret One" => "Poiret One",
									"cfg-googlewebfont-Poller One" => "Poller One",
									"cfg-googlewebfont-Poly" => "Poly",
									"cfg-googlewebfont-Pompiere" => "Pompiere",
									"cfg-googlewebfont-Pontano Sans" => "Pontano Sans",
									"cfg-googlewebfont-Port Lligat Sans" => "Port Lligat Sans",
									"cfg-googlewebfont-Port Lligat Slab" => "Port Lligat Slab",
									"cfg-googlewebfont-Prata" => "Prata",
									"cfg-googlewebfont-Preahvihear" => "Preahvihear",
									"cfg-googlewebfont-Press Start 2P" => "Press Start 2P",
									"cfg-googlewebfont-Princess Sofia" => "Princess Sofia",
									"cfg-googlewebfont-Prociono" => "Prociono",
									"cfg-googlewebfont-Prosto One" => "Prosto One",
									"cfg-googlewebfont-Puritan" => "Puritan",
									"cfg-googlewebfont-Purple Purse" => "Purple Purse",
									"cfg-googlewebfont-Quando" => "Quando",
									"cfg-googlewebfont-Quantico" => "Quantico",
									"cfg-googlewebfont-Quattrocento" => "Quattrocento",
									"cfg-googlewebfont-Quattrocento Sans" => "Quattrocento Sans",
									"cfg-googlewebfont-Questrial" => "Questrial",
									"cfg-googlewebfont-Quicksand" => "Quicksand",
									"cfg-googlewebfont-Quintessential" => "Quintessential",
									"cfg-googlewebfont-Qwigley" => "Qwigley",
									"cfg-googlewebfont-Racing Sans One" => "Racing Sans One",
									"cfg-googlewebfont-Radley" => "Radley",
									"cfg-googlewebfont-Rajdhani" => "Rajdhani",
									"cfg-googlewebfont-Raleway" => "Raleway",
									"cfg-googlewebfont-Raleway Dots" => "Raleway Dots",
									"cfg-googlewebfont-Rambla" => "Rambla",
									"cfg-googlewebfont-Rammetto One" => "Rammetto One",
									"cfg-googlewebfont-Ranchers" => "Ranchers",
									"cfg-googlewebfont-Rancho" => "Rancho",
									"cfg-googlewebfont-Rationale" => "Rationale",
									"cfg-googlewebfont-Redressed" => "Redressed",
									"cfg-googlewebfont-Reenie Beanie" => "Reenie Beanie",
									"cfg-googlewebfont-Revalia" => "Revalia",
									"cfg-googlewebfont-Ribeye" => "Ribeye",
									"cfg-googlewebfont-Ribeye Marrow" => "Ribeye Marrow",
									"cfg-googlewebfont-Righteous" => "Righteous",
									"cfg-googlewebfont-Risque" => "Risque",
									"cfg-googlewebfont-Roboto" => "Roboto",
									"cfg-googlewebfont-Roboto Condensed" => "Roboto Condensed",
									"cfg-googlewebfont-Roboto Slab" => "Roboto Slab",
									"cfg-googlewebfont-Rochester" => "Rochester",
									"cfg-googlewebfont-Rock Salt" => "Rock Salt",
									"cfg-googlewebfont-Rokkitt" => "Rokkitt",
									"cfg-googlewebfont-Romanesco" => "Romanesco",
									"cfg-googlewebfont-Ropa Sans" => "Ropa Sans",
									"cfg-googlewebfont-Rosario" => "Rosario",
									"cfg-googlewebfont-Rosarivo" => "Rosarivo",
									"cfg-googlewebfont-Rouge Script" => "Rouge Script",
									"cfg-googlewebfont-Rozha One" => "Rozha One",
									"cfg-googlewebfont-Rubik Mono One" => "Rubik Mono One",
									"cfg-googlewebfont-Rubik One" => "Rubik One",
									"cfg-googlewebfont-Ruda" => "Ruda",
									"cfg-googlewebfont-Rufina" => "Rufina",
									"cfg-googlewebfont-Ruge Boogie" => "Ruge Boogie",
									"cfg-googlewebfont-Ruluko" => "Ruluko",
									"cfg-googlewebfont-Rum Raisin" => "Rum Raisin",
									"cfg-googlewebfont-Ruslan Display" => "Ruslan Display",
									"cfg-googlewebfont-Russo One" => "Russo One",
									"cfg-googlewebfont-Ruthie" => "Ruthie",
									"cfg-googlewebfont-Rye" => "Rye",
									"cfg-googlewebfont-Sacramento" => "Sacramento",
									"cfg-googlewebfont-Sail" => "Sail",
									"cfg-googlewebfont-Salsa" => "Salsa",
									"cfg-googlewebfont-Sanchez" => "Sanchez",
									"cfg-googlewebfont-Sancreek" => "Sancreek",
									"cfg-googlewebfont-Sansita One" => "Sansita One",
									"cfg-googlewebfont-Sarina" => "Sarina",
									"cfg-googlewebfont-Sarpanch" => "Sarpanch",
									"cfg-googlewebfont-Satisfy" => "Satisfy",
									"cfg-googlewebfont-Scada" => "Scada",
									"cfg-googlewebfont-Schoolbell" => "Schoolbell",
									"cfg-googlewebfont-Seaweed Script" => "Seaweed Script",
									"cfg-googlewebfont-Sevillana" => "Sevillana",
									"cfg-googlewebfont-Seymour One" => "Seymour One",
									"cfg-googlewebfont-Shadows Into Light" => "Shadows Into Light",
									"cfg-googlewebfont-Shadows Into Light Two" => "Shadows Into Light Two",
									"cfg-googlewebfont-Shanti" => "Shanti",
									"cfg-googlewebfont-Share" => "Share",
									"cfg-googlewebfont-Share Tech" => "Share Tech",
									"cfg-googlewebfont-Share Tech Mono" => "Share Tech Mono",
									"cfg-googlewebfont-Shojumaru" => "Shojumaru",
									"cfg-googlewebfont-Short Stack" => "Short Stack",
									"cfg-googlewebfont-Siemreap" => "Siemreap",
									"cfg-googlewebfont-Sigmar One" => "Sigmar One",
									"cfg-googlewebfont-Signika" => "Signika",
									"cfg-googlewebfont-Signika Negative" => "Signika Negative",
									"cfg-googlewebfont-Simonetta" => "Simonetta",
									"cfg-googlewebfont-Sintony" => "Sintony",
									"cfg-googlewebfont-Sirin Stencil" => "Sirin Stencil",
									"cfg-googlewebfont-Six Caps" => "Six Caps",
									"cfg-googlewebfont-Skranji" => "Skranji",
									"cfg-googlewebfont-Slabo 13px" => "Slabo 13px",
									"cfg-googlewebfont-Slabo 27px" => "Slabo 27px",
									"cfg-googlewebfont-Slackey" => "Slackey",
									"cfg-googlewebfont-Smokum" => "Smokum",
									"cfg-googlewebfont-Smythe" => "Smythe",
									"cfg-googlewebfont-Sniglet" => "Sniglet",
									"cfg-googlewebfont-Snippet" => "Snippet",
									"cfg-googlewebfont-Snowburst One" => "Snowburst One",
									"cfg-googlewebfont-Sofadi One" => "Sofadi One",
									"cfg-googlewebfont-Sofia" => "Sofia",
									"cfg-googlewebfont-Sonsie One" => "Sonsie One",
									"cfg-googlewebfont-Sorts Mill Goudy" => "Sorts Mill Goudy",
									"cfg-googlewebfont-Source Code Pro" => "Source Code Pro",
									"cfg-googlewebfont-Source Sans Pro" => "Source Sans Pro",
									"cfg-googlewebfont-Source Serif Pro" => "Source Serif Pro",
									"cfg-googlewebfont-Special Elite" => "Special Elite",
									"cfg-googlewebfont-Spicy Rice" => "Spicy Rice",
									"cfg-googlewebfont-Spinnaker" => "Spinnaker",
									"cfg-googlewebfont-Spirax" => "Spirax",
									"cfg-googlewebfont-Squada One" => "Squada One",
									"cfg-googlewebfont-Stalemate" => "Stalemate",
									"cfg-googlewebfont-Stalinist One" => "Stalinist One",
									"cfg-googlewebfont-Stardos Stencil" => "Stardos Stencil",
									"cfg-googlewebfont-Stint Ultra Condensed" => "Stint Ultra Condensed",
									"cfg-googlewebfont-Stint Ultra Expanded" => "Stint Ultra Expanded",
									"cfg-googlewebfont-Stoke" => "Stoke",
									"cfg-googlewebfont-Strait" => "Strait",
									"cfg-googlewebfont-Sue Ellen Francisco" => "Sue Ellen Francisco",
									"cfg-googlewebfont-Sunshiney" => "Sunshiney",
									"cfg-googlewebfont-Supermercado One" => "Supermercado One",
									"cfg-googlewebfont-Suwannaphum" => "Suwannaphum",
									"cfg-googlewebfont-Swanky and Moo Moo" => "Swanky and Moo Moo",
									"cfg-googlewebfont-Syncopate" => "Syncopate",
									"cfg-googlewebfont-Tangerine" => "Tangerine",
									"cfg-googlewebfont-Taprom" => "Taprom",
									"cfg-googlewebfont-Tauri" => "Tauri",
									"cfg-googlewebfont-Teko" => "Teko",
									"cfg-googlewebfont-Telex" => "Telex",
									"cfg-googlewebfont-Tenor Sans" => "Tenor Sans",
									"cfg-googlewebfont-Text Me One" => "Text Me One",
									"cfg-googlewebfont-The Girl Next Door" => "The Girl Next Door",
									"cfg-googlewebfont-Tienne" => "Tienne",
									"cfg-googlewebfont-Tinos" => "Tinos",
									"cfg-googlewebfont-Titan One" => "Titan One",
									"cfg-googlewebfont-Titillium Web" => "Titillium Web",
									"cfg-googlewebfont-Trade Winds" => "Trade Winds",
									"cfg-googlewebfont-Trocchi" => "Trocchi",
									"cfg-googlewebfont-Trochut" => "Trochut",
									"cfg-googlewebfont-Trykker" => "Trykker",
									"cfg-googlewebfont-Tulpen One" => "Tulpen One",
									"cfg-googlewebfont-Ubuntu" => "Ubuntu",
									"cfg-googlewebfont-Ubuntu Condensed" => "Ubuntu Condensed",
									"cfg-googlewebfont-Ubuntu Mono" => "Ubuntu Mono",
									"cfg-googlewebfont-Ultra" => "Ultra",
									"cfg-googlewebfont-Uncial Antiqua" => "Uncial Antiqua",
									"cfg-googlewebfont-Underdog" => "Underdog",
									"cfg-googlewebfont-Unica One" => "Unica One",
									"cfg-googlewebfont-UnifrakturCook" => "UnifrakturCook",
									"cfg-googlewebfont-UnifrakturMaguntia" => "UnifrakturMaguntia",
									"cfg-googlewebfont-Unkempt" => "Unkempt",
									"cfg-googlewebfont-Unlock" => "Unlock",
									"cfg-googlewebfont-Unna" => "Unna",
									"cfg-googlewebfont-VT323" => "VT323",
									"cfg-googlewebfont-Vampiro One" => "Vampiro One",
									"cfg-googlewebfont-Varela" => "Varela",
									"cfg-googlewebfont-Varela Round" => "Varela Round",
									"cfg-googlewebfont-Vast Shadow" => "Vast Shadow",
									"cfg-googlewebfont-Vesper Libre" => "Vesper Libre",
									"cfg-googlewebfont-Vibur" => "Vibur",
									"cfg-googlewebfont-Vidaloka" => "Vidaloka",
									"cfg-googlewebfont-Viga" => "Viga",
									"cfg-googlewebfont-Voces" => "Voces",
									"cfg-googlewebfont-Volkhov" => "Volkhov",
									"cfg-googlewebfont-Vollkorn" => "Vollkorn",
									"cfg-googlewebfont-Voltaire" => "Voltaire",
									"cfg-googlewebfont-Waiting for the Sunrise" => "Waiting for the Sunrise",
									"cfg-googlewebfont-Wallpoet" => "Wallpoet",
									"cfg-googlewebfont-Walter Turncoat" => "Walter Turncoat",
									"cfg-googlewebfont-Warnes" => "Warnes",
									"cfg-googlewebfont-Wellfleet" => "Wellfleet",
									"cfg-googlewebfont-Wendy One" => "Wendy One",
									"cfg-googlewebfont-Wire One" => "Wire One",
									"cfg-googlewebfont-Yanone Kaffeesatz" => "Yanone Kaffeesatz",
									"cfg-googlewebfont-Yellowtail" => "Yellowtail",
									"cfg-googlewebfont-Yeseva One" => "Yeseva One",
									"cfg-googlewebfont-Yesteryear" => "Yesteryear",
									"cfg-googlewebfont-Zeyada" => "Zeyada"
        						)
	        				);

							$font_effects = array
	        							(
	        								"cfg_font_effect_none" => "None",
	        								"cfg_font_effect_emboss" => "Emboss",
	        								"cfg_font_effect_fire" => "Fire",
	        								"cfg_font_effect_fire_animation" => "Fire Animation",
	        								"cfg_font_effect_neon" => "Neon",
	        								"cfg_font_effect_outline" => "Outline",
	        								"cfg_font_effect_shadow_multiple" => "Shadow Multiple",
	        								"cfg_font_effect_3d" => "3D",
	        								"cfg_font_effect_3d_float" => "3D Float"
        								);
	        	
	        	//Main Box//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Main Box",'','0');
	        	create_accordion('Global Styles','closed');
	        		echo_color_tr('Font Color :','587',$styles[587]);
	        		echo_size_tr('Font Size:','588',$styles[588],'0','50');
		        	echo_select_tr_with_optgroups('Font Family','131',$fonts_array,$styles[131]);
	        		$global_icon_styles = array(
	        								"1" => "Style 1 (Black)",
	        								"2" => "Style 2 (White)"
        									);
	        		echo_select_tr('Icons Style','589',$global_icon_styles,$styles[589]);
	        		$crollbar_styles = array(
	        								"dark-thin" => "dark-thin",
	        								"light-thin" => "light-thin",
	        								"inset-dark" => "inset-dark",
	        								"inset" => "inset",
	        								"inset-2-dark" => "inset-2-dark",
	        								"inset-2" => "inset-2",
	        								"inset-3-dark" => "inset-3-dark",
	        								"inset-3" => "inset-3",
	        								"rounded-dark" => "rounded-dark",
	        								"rounded" => "rounded",
	        								"rounded-dots-dark" => "rounded-dots-dark",
	        								"rounded-dots" => "rounded-dots",
	        								"3d-dark" => "3d-dark",
	        								"3d" => "3d",
	        								"3d-thick-dark" => "3d-thick-dark",
	        								"3d-thick" => "3d-thick",
        									);
	        		echo_select_tr('Scrollbar Style (popup) <a href="http://cfg-solutions.net/joomla/contact-form-generator/documentation?section=creative-scrollbar" target="_blank">See Demo</a>','629',$crollbar_styles,$styles[629]);
	        		echo_select_tr('Scrollbar Style (content) <a href="http://cfg-solutions.net/joomla/contact-form-generator/documentation?section=creative-scrollbar" target="_blank">See Demo</a>','630',$crollbar_styles,$styles[630]);
	        	close_accordion();

	        	create_accordion('Wrapper Styles','closed');
		        	echo_select_tr('Use Background Gradient','627',array("0" => "No","1" => "Yes"),$styles[627]);
		        	echo_color_tr('Backround Color Start:','0',$styles[0]);
		        	echo_color_tr('Backround Color End:','130',$styles[130]);
		        	echo_size_perc_tr('Left Column Width:','517',$styles[517],'0','80');
		        	echo_size_perc_tr('Right Column Width:','518',$styles[518],'0','80');
		        	

		        	echo_color_tr('Border Color:','1',$styles[1]);
		        	echo_size_tr('Border Size:','2',$styles[2],'0','30');
		        	echo_select_tr('Border Style','3',array("solid" => "Solid", "dotted" => "Dotted","dashed" => "Dashed", "double" => "Double", "groove" => "Groove", "ridge" => "Ridge", "inset" => "Inset", "outset" => "Outset"),$styles[3]);
		        	echo_size_tr('Border Top Left Radius:','4',$styles[4],'0','80');
		        	echo_size_tr('Border Top Right Radius:','5',$styles[5],'0','80');
		        	echo_size_tr('Border Bottom Left Radius:','6',$styles[6],'0','80');
		        	echo_size_tr('Border Bottom Right Radius:','7',$styles[7],'0','80');
	        	close_accordion();
	        	
	        	create_accordion('Box Shadow','closed');
		        	echo_color_tr('Box Shadow Color:','8',$styles[8]);
		        	echo_select_tr('Box Shadow Type','9',array("" => "Default","inset" => "Inset"),$styles[9]);
		        	echo_size_tr('Box Shadow Horizontal Offset:','10',$styles[10],'-80','80');
		        	echo_size_tr('Box Shadow Vertical Offset:','11',$styles[11],'-80','80');
		        	echo_size_tr('Box Shadow Blur Radius:','12',$styles[12],'-120','120');
		        	echo_size_tr('Box Shadow Spread Radius:','13',$styles[13],'-120','120');
		        	echo_color_tr('Box Shadow Hover Color:','14',$styles[14]);
		        	echo_select_tr('Box Shadow Hover Type','15',array("" => "Default","inset" => "Inset"),$styles[15]);
		        	echo_size_tr('Box Shadow Hover Horizontal Offset:','16',$styles[16],'-80','80');
		        	echo_size_tr('Box Shadow Hover Vertical Offset:','17',$styles[17],'-80','80');
		        	echo_size_tr('Box Shadow Hover Blur Radius:','18',$styles[18],'-120','120');
		        	echo_size_tr('Box Shadow Hover Spread Radius:','19',$styles[19],'-120','120');
	        	close_accordion();
	        	
	        	create_accordion('Header Styles','closed','');
	        		echo_select_tr('Use Background','600',array("0" => "No","1" => "Yes"),$styles[600]);
		        	echo_color_tr('Backround Color Start:','601',$styles[601]);
		        	echo_color_tr('Backround Color End:','602',$styles[602]);
		        	
		        	echo_size_tr('Top Offset:','603',$styles[603],'0','300');
		        	echo_size_tr('Right Offset:','604',$styles[604],'0','300');
		        	echo_size_tr('Bottom Offset:','605',$styles[605],'0','300');
		        	echo_size_tr('Left Offset:','606',$styles[606],'0','300');

		        	echo_size_tr('Border Bottom Size:','607',$styles[607],'0','30');
		        	echo_select_tr('Border Bottom Style','608',array("solid" => "Solid", "dotted" => "Dotted","dashed" => "Dashed", "double" => "Double", "groove" => "Groove", "ridge" => "Ridge", "inset" => "Inset", "outset" => "Outset"),$styles[608]);
		        	echo_color_tr('Border Bottom Color:','609',$styles[609]);

	        	close_accordion();

	        	create_accordion('Body Styles','closed','');
	        		echo_select_tr('Use Background','610',array("0" => "No","1" => "Yes"),$styles[610]);
		        	echo_color_tr('Backround Color Start:','611',$styles[611]);
		        	echo_color_tr('Backround Color End:','612',$styles[612]);
		        	
		        	echo_size_tr('Top Offset:','613',$styles[613],'0','300');
		        	echo_size_tr('Right Offset:','614',$styles[614],'0','300');
		        	echo_size_tr('Bottom Offset:','615',$styles[615],'0','300');
		        	echo_size_tr('Left Offset:','616',$styles[616],'0','300');
	        	close_accordion();

	        	create_accordion('Footer Styles','closed','');
	        		echo_select_tr('Use Background','617',array("0" => "No","1" => "Yes"),$styles[617]);
		        	echo_color_tr('Backround Color Start:','618',$styles[618]);
		        	echo_color_tr('Backround Color End:','619',$styles[619]);
		        	
		        	echo_size_tr('Top Offset:','620',$styles[620],'0','300');
		        	echo_size_tr('Right Offset:','621',$styles[621],'0','300');
		        	echo_size_tr('Bottom Offset:','622',$styles[622],'0','300');
		        	echo_size_tr('Left Offset:','623',$styles[623],'0','300');

		        	echo_size_tr('Border Top Size:','624',$styles[624],'0','30');
		        	echo_select_tr('Border Top Style','625',array("solid" => "Solid", "dotted" => "Dotted","dashed" => "Dashed", "double" => "Double", "groove" => "Groove", "ridge" => "Ridge", "inset" => "Inset", "outset" => "Outset"),$styles[625]);
		        	echo_color_tr('Border Top Color:','626',$styles[626]);
	        	close_accordion();



	        	
	        	//Top Text////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Top text",'','1');
	        	create_accordion('Font Styles','closed');
	        		echo_color_tr('Font Color:','20',$styles[20]);
	        		echo_size_tr('Font Size:','21',$styles[21],'8','70');
	        		echo_select_tr('Font Weight','22',array("normal" => "Normal","bold" => "Bold"),$styles[22]);
	        		echo_select_tr('Font Style','23',array("normal" => "Normal","italic" => "Italic"),$styles[23]);
	        		echo_select_tr('Text Decoration','24',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[24]);
	        		echo_select_tr('Text Align','25',array("left" => "Left","right" => "Right","center" => "Center"),$styles[25]);
	        		echo_select_tr_with_optgroups('Font Family','506',$fonts_array,$styles[506]);
	        		echo_select_tr('Font Effect','510',$font_effects,$styles[510]);
	        	close_accordion();
	        	create_accordion('Text Shadow','closed');
	        		echo_color_tr('Text Shadow Color:','27',$styles[27]);
	        		echo_size_tr('Text Shadow Horizontal Offset:','28',$styles[28],'-50','50');
	        		echo_size_tr('Text Shadow Vertical Offset:','29',$styles[29],'-50','50');
	        		echo_size_tr('Text Shadow Blur Radius:','30',$styles[30],'0','50');
	        	close_accordion();
	        	
	        	//pre text
	        	seperate_tr("Pre-text",'','2');
	        	create_accordion('Styles','closed','');
		        	echo_size_tr('Offset Top:','190',$styles[190],'-500','500');
		        	echo_size_tr('Offset Bottom:','191',$styles[191],'-500','500');
		        	echo_size_perc_tr('Width:','192',$styles[192],'0','100');
		        	echo_select_tr('Text Align','502',array("left" => "Left","right" => "Right","center" => "Center"),$styles[502]);
	        	close_accordion();
	        	create_accordion('Horizontal Line','closed');
		        	echo_size_tr('Horizontal Line Offset:','193',$styles[193],'-500','500');
		        	echo_size_tr('Horizontal Line Size:','194',$styles[194],'0','10');
		        	echo_color_tr('Horizontal Line Color:','195',$styles[195]);
		        	echo_select_tr('Horizontal Line Style','196',array("solid" => "Solid", "dotted" => "Dotted","dashed" => "Dashed", "double" => "Double", "groove" => "Groove", "ridge" => "Ridge", "inset" => "Inset", "outset" => "Outset"),$styles[196]);
	        	close_accordion();
	        	create_accordion('Font Styles','closed');
		        	echo_color_tr('Font Color:','197',$styles[197]);
		        	echo_size_tr('Font Size:','198',$styles[198],'8','70');
		        	echo_select_tr('Font Weight','199',array("normal" => "Normal","bold" => "Bold"),$styles[199]);
		        	echo_select_tr('Font Style','200',array("normal" => "Normal","italic" => "Italic"),$styles[200]);
		        	echo_select_tr('Text Decoration','201',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[201]);
		        	echo_select_tr_with_optgroups('Font Family','202',$fonts_array,$styles[202]);
		        	echo_select_tr('Font Effect','511',$font_effects,$styles[511]);

	        	close_accordion();
	        	create_accordion('Text Shadow','closed');
		        	echo_color_tr('Text Shadow Color:','203',$styles[203]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','204',$styles[204],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','205',$styles[205],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','206',$styles[206],'0','50');
	        	close_accordion();
	        	
	        	//Label text////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Label text",'','3');
	        	create_accordion('Offsets','closed');
		        	echo_size_tr('Top Offset:','215',$styles[215],'-50','50');
		        	echo_size_tr('Right Offset:','216',$styles[216],'-50','50');
		        	echo_size_tr('Bottom Offset:','217',$styles[217],'-50','50');
		        	echo_size_tr('Left Offset:','218',$styles[218],'-50','50');
	        	close_accordion();
	        	create_accordion('Font Styles','closed');
	        		echo_color_tr('Font Color:','31',$styles[31]);
	        		echo_size_tr('Font Size:','32',$styles[32],'8','70');
	        		echo_select_tr('Font Weight','33',array("normal" => "Normal","bold" => "Bold"),$styles[33]);
	        		echo_select_tr('Font Style','34',array("normal" => "Normal","italic" => "Italic"),$styles[34]);
	        		echo_select_tr('Text Decoration','35',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[35]);
	        		echo_select_tr('Text Align','36',array("left" => "Left","right" => "Right","center" => "Center"),$styles[36]);
	        		echo_select_tr_with_optgroups('Font Family','507',$fonts_array,$styles[507]);
	        		echo_select_tr('Font Effect','512',$font_effects,$styles[512]);


	        	close_accordion();
	        	create_accordion('Text Shadow','closed');
	        		echo_color_tr('Text Shadow Color:','37',$styles[37]);
	        		echo_size_tr('Text Shadow Horizontal Offset:','38',$styles[38],'-50','50');
	        		echo_size_tr('Text Shadow Vertical Offset:','39',$styles[39],'-50','50');
	        		echo_size_tr('Text Shadow Blur Radius:','40',$styles[40],'0','50');
	        	close_accordion();
	        	
	        	//Asterisk Styles////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Asterisk Styles",'','4');
	        	create_accordion('Font Styles','closed');
	        		echo_color_tr('Font Color:','41',$styles[41]);
	        		echo_size_tr('Font Size:','42',$styles[42],'8','70');
	        		echo_select_tr('Font Weight','43',array("normal" => "Normal","bold" => "Bold"),$styles[43]);
	        		echo_select_tr('Font Style','44',array("normal" => "Normal","italic" => "Italic"),$styles[44]);
	        		echo_select_tr_with_optgroups('Font Family','509',$fonts_array,$styles[509]);
	        	close_accordion();
	        	create_accordion('Text Shadow','closed');
	        		echo_color_tr('Text Shadow Color:','46',$styles[46]);
	        		echo_size_tr('Text Shadow Horizontal Offset:','47',$styles[47],'-50','50');
	        		echo_size_tr('Text Shadow Vertical Offset:','48',$styles[48],'-50','50');
	        		echo_size_tr('Text Shadow Blur Radius:','49',$styles[49],'0','50');
	        	close_accordion();
	        	
				//Tooltip Styles////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Tooltip Styles",'','12');
	        	create_accordion('Styles','closed');
	        		echo_select_tr('Tooltip Color','505',array("white"=>"White","apple-green" => "Apple Green","apricot" => "Apricot","black" => "Black","bright-lavender" => "Bright Lavender","carrot-orange" => "Carrot Orange","dark-midnight-blue" => "Dark Midnight Blue","eggplant" => "Eggplant","forest-green" => "Forest Green","magic-mint" => "Magic Mint","mustard" => "Mustard","sienna" => "Sienna","sky-blue" => "Sky Blue","sunset"=>"Sunset"),$styles[505]);
	        		echo_select_tr_with_optgroups('Font Family','508',$fonts_array,$styles[508]);
	        	close_accordion();

	        	//Input Elements /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Text Inputs",'','5');
	        	create_accordion('Styles','closed','Background Color, Paddings');
		        	echo_color_tr('Background Color Start:','132',$styles[132]);
		        	echo_color_tr('Background Color End:','133',$styles[133]);
		        	echo_size_perc_tr('Input Width:','168',$styles[168],'10','100');
		        	echo_size_perc_tr('Input Width(Left Column):','519',$styles[519],'10','100');
		        	echo_size_perc_tr('Input Width(Right Column):','520',$styles[520],'10','100');

		        	echo_select_tr('Text Align','500',array("left" => "Left","right" => "Right","center" => "Center"),$styles[500]);
		        	echo_select_tr('Box Align','501',array("left" => "Left","right" => "Right","center" => "Center"),$styles[501]);
	        	close_accordion();

	        	create_accordion('Border','closed');
		        	echo_color_tr('Border Color:','134',$styles[134]);
		        	echo_size_tr('Border Size:','135',$styles[135],'0','3');
		        	echo_select_tr('Border Style','136',array("solid" => "Solid", "dotted" => "Dotted","dashed" => "Dashed", "double" => "Double", "groove" => "Groove", "ridge" => "Ridge", "inset" => "Inset", "outset" => "Outset"),$styles[136]);
		        	echo_size_tr('Border Top Left Radius:','137',$styles[137],'0','80');
		        	echo_size_tr('Border Top Right Radius:','138',$styles[138],'0','80');
		        	echo_size_tr('Border Bottom Left Radius:','139',$styles[139],'0','80');
		        	echo_size_tr('Border Bottom Right Radius:','140',$styles[140],'0','80');
	        	close_accordion();
	        	
	        	create_accordion('Box Shadow','closed');
		        	echo_color_tr('Box Shadow Color:','141',$styles[141]);
		        	echo_select_tr('Box Shadow Type','142',array("" => "Default","inset" => "Inset"),$styles[142]);
		        	echo_size_tr('Box Shadow Horizontal Offset:','143',$styles[143],'-80','80');
		        	echo_size_tr('Box Shadow Vertical Offset:','144',$styles[144],'-80','80');
		        	echo_size_tr('Box Shadow Blur Radius:','145',$styles[145],'-120','120');
		        	echo_size_tr('Box Shadow Spread Radius:','146',$styles[146],'-120','120');
	        	close_accordion();
	        	
	        	create_accordion('Font Styles','closed');
		        	echo_color_tr('Font Color:','147',$styles[147]);
		        	echo_size_tr('Font Size:','148',$styles[148],'8','70');
		        	echo_select_tr('Font Weight','149',array("normal" => "Normal","bold" => "Bold"),$styles[149]);
		        	echo_select_tr('Font Style','150',array("normal" => "Normal","italic" => "Italic"),$styles[150]);
		        	echo_select_tr('Text Decoration','151',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[151]);
		        	// echo_font_tr('Font Family','152',$styles[152]);
		        	echo_select_tr_with_optgroups('Font Family','152',$fonts_array,$styles[152]);
	        	close_accordion();
	        	create_accordion('Text Shadow','closed');
		        	echo_color_tr('Text Shadow Color:','153',$styles[153]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','154',$styles[154],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','155',$styles[155],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','156',$styles[156],'0','50');
	        	close_accordion();


	        	seperate_tr("Text Inputs Hover State",'','6');
	        	create_accordion('Styles','closed','Shadow, Background Color, Font Color');
	        		echo_color_tr('Background Color Start:','157',$styles[157]);
	        		echo_color_tr('Background Color End:','158',$styles[158]);
	        		echo_color_tr('Text Color:','159',$styles[159]);
	        		echo_color_tr('Text Shadow Color:','160',$styles[160]);
	        		echo_color_tr('Border Color:','161',$styles[161]);
		        	echo_color_tr('Box Shadow Color:','162',$styles[162]);
		        	echo_select_tr('Box Shadow Type','163',array("" => "Default","inset" => "Inset"),$styles[163]);
		        	echo_size_tr('Box Shadow Horizontal Offset:','164',$styles[164],'-80','80');
		        	echo_size_tr('Box Shadow Vertical Offset:','165',$styles[165],'-80','80');
		        	echo_size_tr('Box Shadow Blur Radius:','166',$styles[166],'-120','120');
		        	echo_size_tr('Box Shadow Spread Radius:','167',$styles[167],'-120','120');
	        	close_accordion();

	        	//Label text hover State/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Label Text Focus State",'','13');
	        	create_accordion('Font Styles','closed','');
		        	echo_select_tr('Font Effect','513',$font_effects,$styles[513]);
	        	close_accordion();
	        	
	        	//Error State/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Text Inputs Error State",'','7');
	        	
	        	create_accordion('Input Styles','closed','');
		        	echo_color_tr('Background Color Start:','176',$styles[176]);
		        	echo_color_tr('Background Color End:','177',$styles[177]);
		        	echo_color_tr('Border Color:','178',$styles[178]);
		        	echo_color_tr('Font Color:','179',$styles[179]);
	        	close_accordion();
	        	
	        	create_accordion('Text Shadow','closed');
		        	echo_color_tr('Text Shadow Color:','180',$styles[180]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','181',$styles[181],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','182',$styles[182],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','183',$styles[183],'0','50');
	        	close_accordion();
	        	
	        	create_accordion('Box Shadow','closed');
		        	echo_color_tr('Box Shadow Color:','184',$styles[184]);
		        	echo_select_tr('Box Shadow Type','185',array("" => "Default","inset" => "Inset"),$styles[185]);
		        	echo_size_tr('Box Shadow Horizontal Offset:','186',$styles[186],'-80','80');
		        	echo_size_tr('Box Shadow Vertical Offset:','187',$styles[187],'-80','80');
		        	echo_size_tr('Box Shadow Blur Radius:','188',$styles[188],'-120','120');
		        	echo_size_tr('Box Shadow Spread Radius:','189',$styles[189],'-120','120');
	        	close_accordion();

				//Label Text Error State/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Label Text Error State",'','14');

	        	create_accordion('Font Styles','closed');
		        	echo_color_tr('Font Color:','171',$styles[171]);
		        	echo_select_tr('Font Effect','514',$font_effects,$styles[514]);
		        	echo_color_tr('Text Shadow Color:','172',$styles[172]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','173',$styles[173],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','174',$styles[174],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','175',$styles[175],'0','50');
	        	close_accordion();

	        	//textarea button/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Textarea",'','11');
	        	create_accordion('Styles','closed','');
		        	echo_size_perc_tr('Textarea Width:','169',$styles[169],'10','100');
		        	echo_size_perc_tr('Textarea Width(Left Column):','521',$styles[521],'10','100');
		        	echo_size_perc_tr('Textarea Width(Right Column):','522',$styles[522],'10','100');
		        	echo_size_tr('Textarea Height:','170',$styles[170],'10','500');
		        	echo_size_tr('Textarea Height(Left, Right columns):','523',$styles[523],'10','500');
	        	close_accordion();
	        	
	        	//Heading text/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Heading",'','19');
	        	create_accordion('Styles','closed');
		        	echo_size_tr('Padding Top:','535',$styles[535],'-50','50');
		        	echo_size_tr('Padding Right:','536',$styles[536],'-50','50');
		        	echo_size_tr('Padding Bottom:','537',$styles[537],'-50','50');
		        	echo_size_tr('Padding Left:','538',$styles[538],'-50','50');

		        	echo_size_tr('Margin Top:','539',$styles[539],'-50','50');
		        	echo_size_tr('Margin Bottom:','540',$styles[540],'-50','50');

		        	echo_color_tr('Background Color Start:','541',$styles[541]);
		        	echo_color_tr('Background Color End:','542',$styles[542]);
	        	close_accordion();
	        	create_accordion('Border Styles','closed');
		        	echo_size_tr('Border Top Size:','543',$styles[543],'-50','50');
		        	echo_size_tr('Border Right Size:','544',$styles[544],'-50','50');
		        	echo_size_tr('Border Bottom Size:','545',$styles[545],'-50','50');
		        	echo_size_tr('Border Left Size:','546',$styles[546],'-50','50');

		        	echo_select_tr('Border Style','547',array("solid" => "Solid", "dotted" => "Dotted","dashed" => "Dashed", "double" => "Double", "groove" => "Groove", "ridge" => "Ridge", "inset" => "Inset", "outset" => "Outset"),$styles[547]);

		        	echo_color_tr('Border Top Color:','548',$styles[548]);
		        	echo_color_tr('Border Right Color:','549',$styles[549]);
		        	echo_color_tr('Border Bottom Color:','550',$styles[550]);
		        	echo_color_tr('Border Left Color:','551',$styles[551]);
	        	close_accordion();
	        	create_accordion('Font Styles','closed');
		        	echo_color_tr('Font Color:','524',$styles[524]);
		        	echo_size_tr('Font Size:','525',$styles[525],'8','70');
		        	echo_select_tr('Font Weight','526',array("normal" => "Normal","bold" => "Bold"),$styles[526]);
		        	echo_select_tr('Font Style','527',array("normal" => "Normal","italic" => "Italic"),$styles[527]);
		        	echo_select_tr('Text Decoration','528',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[528]);
		        	echo_select_tr_with_optgroups('Font Family','529',$fonts_array,$styles[529]);
		        	echo_select_tr('Font Effect','530',$font_effects,$styles[530]);
	        	close_accordion();
	        	create_accordion('Text Shadow','closed');
		        	echo_color_tr('Text Shadow Color:','531',$styles[531]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','532',$styles[532],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','533',$styles[533],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','534',$styles[534],'0','50');
	        	close_accordion();

	        	//send button/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Send Button",'','9');
	        	create_accordion('Styles','closed','Background Color, Paddings');
		        	echo_color_tr('Background Color Start:','91',$styles[91]);
		        	echo_color_tr('Background Color End:','50',$styles[50]);
		        	echo_select_tr('Button Alignment','212',array("left" => "Left", "right" => "Right"),$styles[212]);
		        	echo_size_tr('Padding Top,Bottom:','92',$styles[92],'0','30');
		        	echo_size_tr('Padding Left,Right:','93',$styles[93],'0','500');
		        	echo_size_perc_tr('Wrapper Width:','209',$styles[209],'0','100');
	        	close_accordion();
	        	
	        	create_accordion('Border','closed');
		        	echo_color_tr('Border Color:','100',$styles[100]);
		        	echo_size_tr('Border Size:','101',$styles[101],'0','3');
		        	echo_select_tr('Border Style','127',array("solid" => "Solid", "dotted" => "Dotted","dashed" => "Dashed", "double" => "Double", "groove" => "Groove", "ridge" => "Ridge", "inset" => "Inset", "outset" => "Outset"),$styles[127]);
		        	echo_size_tr('Border Top Left Radius:','102',$styles[102],'0','80');
		        	echo_size_tr('Border Top Right Radius:','103',$styles[103],'0','80');
		        	echo_size_tr('Border Bottom Left Radius:','104',$styles[104],'0','80');
		        	echo_size_tr('Border Bottom Right Radius:','105',$styles[105],'0','80');
	        	close_accordion();
	        	
	        	create_accordion('Box Shadow','closed');
		        	echo_color_tr('Box Shadow Color:','94',$styles[94]);
		        	echo_select_tr('Box Shadow Type','95',array("" => "Default","inset" => "Inset"),$styles[95]);
		        	echo_size_tr('Box Shadow Horizontal Offset:','96',$styles[96],'-80','80');
		        	echo_size_tr('Box Shadow Vertical Offset:','97',$styles[97],'-80','80');
		        	echo_size_tr('Box Shadow Blur Radius:','98',$styles[98],'-120','120');
		        	echo_size_tr('Box Shadow Spread Radius:','99',$styles[99],'-120','120');
	        	close_accordion();
	        	
	        	create_accordion('Font Styles','closed');
		        	echo_color_tr('Font Color:','106',$styles[106]);
		        	echo_size_tr('Font Size:','107',$styles[107],'8','70');
		        	echo_select_tr('Font Weight','108',array("normal" => "Normal","bold" => "Bold"),$styles[108]);
		        	echo_select_tr('Font Style','109',array("normal" => "Normal","italic" => "Italic"),$styles[109]);
		        	echo_select_tr('Text Decoration','110',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[110]);
		        	// echo_font_tr('Font Family','112',$styles[112]);
		        	echo_select_tr_with_optgroups('Font Family','112',$fonts_array,$styles[112]);
		        	echo_select_tr('Font Effect','515',$font_effects,$styles[515]);
	        	close_accordion();
	        	create_accordion('Text Shadow','closed');
		        	echo_color_tr('Text Shadow Color:','113',$styles[113]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','114',$styles[114],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','115',$styles[115],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','116',$styles[116],'0','50');
	        	close_accordion();

	        	seperate_tr("Send Button Hover State",'','10');
	        	create_accordion('Hover State','closed','Shadow, Background Color, Font Color');
		        	echo_color_tr('Background Color Start:','51',$styles[51]);
		        	echo_color_tr('Background Color End:','52',$styles[52]);
		        	echo_color_tr('Text Color:','124',$styles[124]);
		        	echo_select_tr('Font Effect','516',$font_effects,$styles[516]);
		        	echo_color_tr('Text Shadow Color:','125',$styles[125]);
		        	echo_color_tr('Border Color:','126',$styles[126]);
		        	echo_color_tr('Box Shadow Color:','117',$styles[117]);
		        	echo_select_tr('Box Shadow Type','118',array("" => "Default","inset" => "Inset"),$styles[118]);
		        	echo_size_tr('Box Shadow Horizontal Offset:','119',$styles[119],'-80','80');
		        	echo_size_tr('Box Shadow Vertical Offset:','120',$styles[120],'-80','80');
		        	echo_size_tr('Box Shadow Blur Radius:','121',$styles[121],'-120','120');
		        	echo_size_tr('Box Shadow Spread Radius:','122',$styles[122],'-120','120');
	        	close_accordion();

	        	seperate_tr("Sections Styles (Icons View)",'','20');
	        	create_accordion('Icons','closed','');
	        		echo_select_tr('Icon Template (no preview)','552',array("1" => "Template 1","2" => "Template 2","3" => "Template 3","4" => "Template 4"),$styles[552]);
	        	close_accordion();	        	
	        	create_accordion('Label Styles','closed','');
	        		echo_color_tr('Font Color:','553',$styles[553]);
		        	echo_size_tr('Font Size:','554',$styles[554],'8','70');
		        	echo_select_tr('Font Weight','555',array("normal" => "Normal","bold" => "Bold"),$styles[555]);
		        	echo_select_tr('Font Style','556',array("normal" => "Normal","italic" => "Italic"),$styles[556]);
		        	echo_select_tr('Text Decoration','596',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[596]);
		        	echo_size_tr('Border Bottom Size:','590',$styles[590],'0','3');
		        	echo_select_tr('Border Bottom Style','591',array("solid" => "Solid", "dotted" => "Dotted","dashed" => "Dashed", "double" => "Double", "groove" => "Groove", "ridge" => "Ridge", "inset" => "Inset", "outset" => "Outset"),$styles[591]);
		        	echo_color_tr('Border Bottom Color:','592',$styles[592]);

		        	echo_color_tr('Text Shadow Color:','558',$styles[558]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','559',$styles[559],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','560',$styles[560],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','561',$styles[561],'0','50');
	        	close_accordion();

	        	seperate_tr("Datepicker Styles (Icons View)",'','21');
	        	create_accordion('Styles','closed','');
	        		$datepicker_icon_styles = array(
	        								"1" => "Style 1 (Blue-Black)",
	        								"2" => "Style 2 (Blue-Black)",
	        								"3" => "Style 3 (Black)",
	        								"4" => "Style 4 (Black)",
	        								"5" => "Style 5 (Black)",
	        								"6" => "Style 6 (Black)",
	        								"7" => "Style 7 (Grey)",
	        								"8" => "Style 8 (Blue)",
	        								"9" => "Style 9 (Blue)",
	        								"10" => "Style 10 (Blue)",
	        								"11" => "Style 11 (Blue)",
	        								"12" => "Style 12 (Blue)",
	        								"13" => "Style 13 (Blue)",
	        								"14" => "Style 14 (Blue)",
	        								"15" => "Style 15 (Blue)",
	        								"16" => "Style 16 (Blue)",
	        								"17" => "Style 17 (Blue)",
	        								"18" => "Style 18 (Blue)",
	        								"19" => "Style 19 (Red)",
	        								"20" => "Style 20 (Red)",
	        								"21" => "Style 21 (Red)",
	        								"22" => "Style 22 (Red)",
	        								"23" => "Style 23 (Red)",
	        								"24" => "Style 24 (Red)",
	        								"25" => "Style 25 (Green)",
	        								"26" => "Style 26 (Green)",
	        								"27" => "Style 27 (Green)",
	        								"28" => "Style 28 (Orange)",
	        								"29" => "Style 29 (Orange)",
	        								"30" => "Style 30 (Orange)"
        									);
	        		echo_select_tr('Datepicker Icon','563',$datepicker_icon_styles,$styles[563]);

	        		$datepicker_styles = array(
	        								"1" => "Style 1 (Grey)",
	        								"2" => "Style 2 (Black)",
	        								"3" => "Style 3 (Melon)",
	        								"4" => "Style 4 (Red)",
	        								"5" => "Style 5 (Lite Green)",
	        								"6" => "Style 6 (Dark Red)",
	        								"7" => "Style 7 (Lite Blue)",
	        								"8" => "Style 8 (Grey - Green buttons)"
        									);
	        		echo_select_tr('Datepicker Style (no preview)','562',$datepicker_styles,$styles[562]);
	        	close_accordion();

	        	seperate_tr("File Upload Button Styles (Icons View)",'','25');
	        	create_accordion('Paddings','closed','');
		        	echo_size_tr('Padding Top, Bottom:','597',$styles[597],'0','200');
		        	echo_size_tr('Padding Left, Right:','598',$styles[598],'0','200');
	        	close_accordion();

	        	seperate_tr("Link Styles (Icons View)",'','22');
	        	create_accordion('Styles','closed','');
	        		echo_color_tr('Font Color:','564',$styles[564]);
		        	echo_select_tr('Font Weight','565',array("normal" => "Normal","bold" => "Bold"),$styles[565]);
		        	echo_select_tr('Font Style','566',array("normal" => "Normal","italic" => "Italic"),$styles[566]);
		        	echo_select_tr('Text Decoration','594',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[594]);
		        	echo_size_tr('Border Bottom Size:','567',$styles[567],'0','3');
		        	echo_select_tr('Border Bottom Style','568',array("solid" => "Solid", "dotted" => "Dotted","dashed" => "Dashed", "double" => "Double", "groove" => "Groove", "ridge" => "Ridge", "inset" => "Inset", "outset" => "Outset"),$styles[568]);
		        	echo_color_tr('Border Bottom Color:','569',$styles[569]);

	        		echo_color_tr('Text Shadow Color:','570',$styles[570]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','571',$styles[571],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','572',$styles[572],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','573',$styles[573],'0','50');
	        	close_accordion();


	        	seperate_tr("Link Styles Hover State (Icons View)",'','23');
	        	create_accordion('Styles','closed','');
	        		echo_color_tr('Font Color:','574',$styles[574]);
	        		echo_select_tr('Text Decoration','595',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[595]);
		        	echo_color_tr('Border Bottom Color:','575',$styles[575]);

	        		echo_color_tr('Text Shadow Color:','576',$styles[576]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','577',$styles[577],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','578',$styles[578],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','579',$styles[579],'0','50');
	        	close_accordion();

	        	seperate_tr("Number Styling Styles (Icons View)",'','24');
	        	create_accordion('Styles','closed','');
	        		echo_color_tr('Font Color:','580',$styles[580]);
		        	echo_select_tr('Font Weight','581',array("normal" => "Normal","bold" => "Bold"),$styles[581]);
		        	echo_select_tr('Font Style','582',array("normal" => "Normal","italic" => "Italic"),$styles[582]);
		        	echo_select_tr('Text Decoration','593',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[593]);

	        		echo_color_tr('Text Shadow Color:','583',$styles[583]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','584',$styles[584],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','585',$styles[585],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','586',$styles[586],'0','50');
	        	close_accordion();

	        	seperate_tr("Custom Rules",'','26');
	        	create_accordion('CSS','closed','');
	        	echo_textarea_tr('Custom Styles:','599',$styles[599],'<div style="font-size: 12px;color: #777;">Note: As images path use <span style="color: rgb(3, 67, 166);font-style: italic;">cfg_img_path</span>, which will load images<br />from following directory: <span style="color: rgb(3, 67, 166);font-style: italic;">ROOT/wp-content/plugins/<br />contact-form-generator/assets/images/bg_images</span></div>');
	        	close_accordion();
	        	create_accordion('JavaScript','closed','');
	        	echo_textarea_tr('Custom Styles:','628',$styles[628],'<div style="font-size: 12px;color: #777;">Note: jQuery is allowed! It inserts scrip in document.ready...</div>');
	        	close_accordion();
	        ?>
	    </table>
	  </div>
    </fieldset>
</div>
 
<div class="clr"></div>
 
<input type="hidden" name="task" value="" id="wpcfg_task">
<input type="hidden" name="id" value="<?php echo $id;?>" >
</form>

<style type="text/css">
	#wpfooter {
		display: none !important;
	}
</style>


<style>

/*// */
.contactformgenerator_wrapper {
	border: <?php echo $styles[2];?>px <?php echo $styles[3];?> <?php echo $styles[1];?>;
	background-color: <?php echo $styles[0];?>;

	<?php if($styles[627] == '1') {?>
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[0];?>', endColorstr='<?php echo $styles[130];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[0];?>), to(<?php echo $styles[130];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[0];?>, <?php echo $styles[130];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[0];?>, <?php echo $styles[130];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[0];?>, <?php echo $styles[130];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[0];?>, <?php echo $styles[130];?>);/* Opera 11.10+ */
	<?php }?>
	
	-moz-box-shadow: <?php echo $styles[9];?> <?php echo $styles[10];?>px <?php echo $styles[11];?>px <?php echo $styles[12];?>px <?php echo $styles[13];?>px  <?php echo $styles[8];?>;
	-webkit-box-shadow: <?php echo $styles[9];?> <?php echo $styles[10];?>px <?php echo $styles[11];?>px <?php echo $styles[12];?>px <?php echo $styles[13];?>px  <?php echo $styles[8];?>;
	box-shadow: <?php echo $styles[9];?> <?php echo $styles[10];?>px <?php echo $styles[11];?>px <?php echo $styles[12];?>px <?php echo $styles[13];?>px  <?php echo $styles[8];?>;
	
	-webkit-border-top-left-radius: <?php echo $styles[4];?>px;
	-moz-border-radius-topleft: <?php echo $styles[4];?>px;
	border-top-left-radius: <?php echo $styles[4];?>px;
	
	-webkit-border-top-right-radius: <?php echo $styles[5];?>px;
	-moz-border-radius-topright: <?php echo $styles[5];?>px;
	border-top-right-radius: <?php echo $styles[5];?>px;
	
	-webkit-border-bottom-left-radius: <?php echo $styles[6];?>px;
	-moz-border-radius-bottomleft: <?php echo $styles[6];?>px;
	border-bottom-left-radius: <?php echo $styles[6];?>px;
	
	-webkit-border-bottom-right-radius: <?php echo $styles[7];?>px;
	-moz-border-radius-bottomright: <?php echo $styles[7];?>px;
	border-bottom-right-radius: <?php echo $styles[7];?>px;
	<?php 

		$cfg_googlefont = 'cfg-googlewebfont-';
		$cfg_font_rule = $styles[131];
		if (strpos($cfg_font_rule,$cfg_googlefont) !== false) {
			$cfg_font_rule = str_replace($cfg_googlefont, '', $cfg_font_rule);
			$cfg_font_rule .= ', sans-serif';
		}
	?>
	font-family: <?php echo $cfg_font_rule;?>;

	color: <?php echo $styles[587]?>;
	font-size: <?php echo $styles[588]?>px;
}
.contactformgenerator_wrapper:hover {
	-moz-box-shadow: <?php echo $styles[15];?> <?php echo $styles[16];?>px <?php echo $styles[17];?>px <?php echo $styles[18];?>px <?php echo $styles[19];?>px  <?php echo $styles[14];?>;
	-webkit-box-shadow: <?php echo $styles[15];?> <?php echo $styles[16];?>px <?php echo $styles[17];?>px <?php echo $styles[18];?>px <?php echo $styles[19];?>px  <?php echo $styles[14];?>;
	box-shadow: <?php echo $styles[15];?> <?php echo $styles[16];?>px <?php echo $styles[17];?>px <?php echo $styles[18];?>px <?php echo $styles[19];?>px  <?php echo $styles[14];?>;
}
.contactformgenerator_header {
	-webkit-border-top-left-radius: <?php echo $styles[4];?>px;
	-moz-border-radius-topleft: <?php echo $styles[4];?>px;
	border-top-left-radius: <?php echo $styles[4];?>px;
	
	-webkit-border-top-right-radius: <?php echo $styles[5];?>px;
	-moz-border-radius-topright: <?php echo $styles[5];?>px;
	border-top-right-radius: <?php echo $styles[5];?>px;
}
.contactformgenerator_footer {
	-webkit-border-bottom-left-radius: <?php echo $styles[6];?>px;
	-moz-border-radius-bottomleft: <?php echo $styles[6];?>px;
	border-bottom-left-radius: <?php echo $styles[6];?>px;
	
	-webkit-border-bottom-right-radius: <?php echo $styles[7];?>px;
	-moz-border-radius-bottomright: <?php echo $styles[7];?>px;
	border-bottom-right-radius: <?php echo $styles[7];?>px;
}

.contactformgenerator_header {
	padding:  <?php echo $styles[603];?>px  <?php echo $styles[604];?>px <?php echo $styles[605];?>px <?php echo $styles[606];?>px;
	border-bottom: <?php echo $styles[607];?>px <?php echo $styles[608];?> <?php echo $styles[609];?>;

	<?php if($styles[600] == '1') {?>
	background-color: <?php echo $styles[601];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[601];?>', endColorstr='<?php echo $styles[602];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[601];?>), to(<?php echo $styles[602];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[601];?>, <?php echo $styles[602];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[601];?>, <?php echo $styles[602];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[601];?>, <?php echo $styles[602];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[601];?>, <?php echo $styles[602];?>);/* Opera 11.10+ */
	<?php }?>

}
.contactformgenerator_body {
	padding:  <?php echo $styles[613];?>px  <?php echo $styles[614];?>px <?php echo $styles[615];?>px <?php echo $styles[616];?>px;

	<?php if($styles[610] == '1') {?>
	background-color: <?php echo $styles[611];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[611];?>', endColorstr='<?php echo $styles[612];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[611];?>), to(<?php echo $styles[612];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[611];?>, <?php echo $styles[612];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[611];?>, <?php echo $styles[612];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[611];?>, <?php echo $styles[612];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[611];?>, <?php echo $styles[612];?>);/* Opera 11.10+ */
	<?php }?>
}
.contactformgenerator_footer {
	padding:  <?php echo $styles[620];?>px  <?php echo $styles[621];?>px <?php echo $styles[622];?>px <?php echo $styles[623];?>px;
	border-top: <?php echo $styles[624];?>px <?php echo $styles[625];?> <?php echo $styles[626];?>;

	<?php if($styles[617] == '1') {?>
	background-color: <?php echo $styles[618];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[618];?>', endColorstr='<?php echo $styles[619];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[618];?>), to(<?php echo $styles[619];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[618];?>, <?php echo $styles[619];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[618];?>, <?php echo $styles[619];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[618];?>, <?php echo $styles[619];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[618];?>, <?php echo $styles[619];?>);/* Opera 11.10+ */
	<?php }?>
}



.contactformgenerator_title {
	color: <?php echo $styles[20];?>;
	font-size: <?php echo $styles[21];?>px;
	font-style: <?php echo $styles[23];?>;
	font-weight: <?php echo $styles[22];?>;
	text-align: <?php echo $styles[25];?>;
	text-decoration: <?php echo $styles[24];?>;
	text-shadow: <?php echo $styles[28];?>px <?php echo $styles[29];?>px <?php echo $styles[30];?>px <?php echo $styles[27];?>;
	<?php 

		$cfg_googlefont = 'cfg-googlewebfont-';
		$cfg_font_rule = $styles[506];
		if (strpos($cfg_font_rule,$cfg_googlefont) !== false) {
			$cfg_font_rule = str_replace($cfg_googlefont, '', $cfg_font_rule);
			$cfg_font_rule .= ', sans-serif';
		}
	?>
	font-family: <?php echo $cfg_font_rule;?>
}

.contactformgenerator_field_name {
	color: <?php echo $styles[31];?>;
	font-size: <?php echo $styles[32];?>px;
	font-style: <?php echo $styles[34];?>;
	font-weight: <?php echo $styles[33];?>;
	text-align: <?php echo $styles[36];?>;
	text-decoration: <?php echo $styles[35];?>;
	text-shadow: <?php echo $styles[38];?>px <?php echo $styles[39];?>px <?php echo $styles[40];?>px <?php echo $styles[37];?>;
	margin:  <?php echo $styles[215];?>px  <?php echo $styles[216];?>px <?php echo $styles[217];?>px <?php echo $styles[218];?>px;
	<?php 

		$cfg_googlefont = 'cfg-googlewebfont-';
		$cfg_font_rule = $styles[507];
		if (strpos($cfg_font_rule,$cfg_googlefont) !== false) {
			$cfg_font_rule = str_replace($cfg_googlefont, '', $cfg_font_rule);
			$cfg_font_rule .= ', sans-serif';
		}
	?>
	font-family: <?php echo $cfg_font_rule;?>
}

.contactformgenerator_field_required {
	color: <?php echo $styles[41];?>;
	font-size: <?php echo $styles[42];?>px;
	font-style: <?php echo $styles[44];?>;
	font-weight: <?php echo $styles[43];?>;
	text-shadow: <?php echo $styles[47];?>px <?php echo $styles[48];?>px <?php echo $styles[49];?>px <?php echo $styles[46];?>;
}
.cfg_button_holder {
	float: <?php echo $styles[212];?>;
}

.contactformgenerator_send {
	background-color: <?php echo $styles[91];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[91];?>', endColorstr='<?php echo $styles[50];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[91];?>), to(<?php echo $styles[50];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[91];?>, <?php echo $styles[50];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[91];?>, <?php echo $styles[50];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[91];?>, <?php echo $styles[50];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[91];?>, <?php echo $styles[50];?>);/* Opera 11.10+ */
	
	padding: <?php echo $styles[92];?>px <?php echo $styles[93];?>px;
	-moz-box-shadow: <?php echo $styles[95];?> <?php echo $styles[96];?>px <?php echo $styles[97];?>px <?php echo $styles[98];?>px <?php echo $styles[99];?>px  <?php echo $styles[94];?>;	
	-webkit-box-shadow: <?php echo $styles[95];?> <?php echo $styles[96];?>px <?php echo $styles[97];?>px <?php echo $styles[98];?>px <?php echo $styles[99];?>px  <?php echo $styles[94];?>;	
	box-shadow: <?php echo $styles[95];?> <?php echo $styles[96];?>px <?php echo $styles[97];?>px <?php echo $styles[98];?>px <?php echo $styles[99];?>px  <?php echo $styles[94];?>;	
	border-style: <?php echo $styles[127];?>;
	border-width: <?php echo $styles[101];?>px;
	border-color: <?php echo $styles[100];?>;
	
	-webkit-border-top-left-radius: <?php echo $styles[102];?>px;
	-moz-border-radius-topleft: <?php echo $styles[102];?>px;
	border-top-left-radius: <?php echo $styles[102];?>px;
	
	-webkit-border-top-right-radius: <?php echo $styles[103];?>px;
	-moz-border-radius-topright: <?php echo $styles[103];?>px;
	border-top-right-radius: <?php echo $styles[103];?>px;
	
	-webkit-border-bottom-left-radius: <?php echo $styles[104];?>px;
	-moz-border-radius-bottomleft: <?php echo $styles[104];?>px;
	border-bottom-left-radius: <?php echo $styles[104];?>px;
	
	-webkit-border-bottom-right-radius: <?php echo $styles[105];?>px;
	-moz-border-radius-bottomright: <?php echo $styles[105];?>px;
	border-bottom-right-radius: <?php echo $styles[105];?>px;
	float: <?php echo $styles[212];?>;

	font-size: <?php echo $styles[107];?>px;
	color: <?php echo $styles[106];?>;
	font-style: <?php echo $styles[109];?>;
	font-weight: <?php echo $styles[108];?>;
	text-decoration: <?php echo $styles[110];?>;
	text-shadow: <?php echo $styles[114];?>px <?php echo $styles[115];?>px <?php echo $styles[116];?>px <?php echo $styles[113];?>;
	<?php 

		$cfg_googlefont = 'cfg-googlewebfont-';
		$cfg_font_rule = $styles[112];
		if (strpos($cfg_font_rule,$cfg_googlefont) !== false) {
			$cfg_font_rule = str_replace($cfg_googlefont, '', $cfg_font_rule);
			$cfg_font_rule .= ', sans-serif';
		}
	?>
	font-family: <?php echo $cfg_font_rule;?>

}
.contactformgenerator_send_hovered {
	background-color: <?php echo $styles[51];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[51];?>', endColorstr='<?php echo $styles[52];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[51];?>), to(<?php echo $styles[52];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[51];?>, <?php echo $styles[52];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[51];?>, <?php echo $styles[52];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[51];?>, <?php echo $styles[52];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[51];?>, <?php echo $styles[52];?>);/* Opera 11.10+ */
	
	color: <?php echo $styles[124];?>;
	text-shadow: <?php echo $styles[114];?>px <?php echo $styles[115];?>px <?php echo $styles[116];?>px <?php echo $styles[125];?>;
	-moz-box-shadow: <?php echo $styles[118];?> <?php echo $styles[119];?>px <?php echo $styles[120];?>px <?php echo $styles[121];?>px <?php echo $styles[122];?>px  <?php echo $styles[117];?>;
	-webkit-box-shadow: <?php echo $styles[118];?> <?php echo $styles[119];?>px <?php echo $styles[120];?>px <?php echo $styles[121];?>px <?php echo $styles[122];?>px  <?php echo $styles[117];?>;
	box-shadow: <?php echo $styles[118];?> <?php echo $styles[119];?>px <?php echo $styles[120];?>px <?php echo $styles[121];?>px <?php echo $styles[122];?>px  <?php echo $styles[117];?>;
	border-style: <?php echo $styles[127];?>;
	border-width: <?php echo $styles[101];?>px;
	border-color: <?php echo $styles[126];?>;
}
.cfg_fileupload {
	padding: <?php echo $styles[597];?>px <?php echo $styles[598];?>px;
}
		        	
.contactformgenerator_submit_wrapper {
	width: 	<?php echo $styles[209];?>%;
}


.contactformgenerator_field_box_inner {
	width:<?php echo $styles[168];?>%;
	<?php $box_margin = $styles[501] == 'right' ? '0 0 0 auto' : ($styles[501] == 'center' ? '0 auto' : '0');  ?>
	margin: <?php echo $box_margin;?>;
}
.contactformgenerator_input_element {
	
	background-color: <?php echo $styles[132];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[132];?>', endColorstr='<?php echo $styles[133];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[132];?>), to(<?php echo $styles[133];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[132];?>, <?php echo $styles[133];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[132];?>, <?php echo $styles[133];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[132];?>, <?php echo $styles[133];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[132];?>, <?php echo $styles[133];?>);/* Opera 11.10+ */
	
	-moz-box-shadow: <?php echo $styles[142];?> <?php echo $styles[143];?>px <?php echo $styles[144];?>px <?php echo $styles[145];?>px <?php echo $styles[146];?>px  <?php echo $styles[141];?>;	
	-webkit-box-shadow: <?php echo $styles[142];?> <?php echo $styles[143];?>px <?php echo $styles[144];?>px <?php echo $styles[145];?>px <?php echo $styles[146];?>px  <?php echo $styles[141];?>;		
	box-shadow: <?php echo $styles[142];?> <?php echo $styles[143];?>px <?php echo $styles[144];?>px <?php echo $styles[145];?>px <?php echo $styles[146];?>px  <?php echo $styles[141];?>;		
	border-style: <?php echo $styles[136];?>;
	border-width: <?php echo $styles[135];?>px;
	border-color: <?php echo $styles[134];?>;
	
	-webkit-border-top-left-radius: <?php echo $styles[137];?>px;
	-moz-border-radius-topleft: <?php echo $styles[137];?>px;
	border-top-left-radius: <?php echo $styles[137];?>px;
	
	-webkit-border-top-right-radius: <?php echo $styles[138];?>px;
	-moz-border-radius-topright: <?php echo $styles[138];?>px;
	border-top-right-radius: <?php echo $styles[138];?>px;
	
	-webkit-border-bottom-left-radius: <?php echo $styles[139];?>px;
	-moz-border-radius-bottomleft: <?php echo $styles[139];?>px;
	border-bottom-left-radius: <?php echo $styles[139];?>px;
	
	-webkit-border-bottom-right-radius: <?php echo $styles[140];?>px;
	-moz-border-radius-bottomright: <?php echo $styles[140];?>px;
	border-bottom-right-radius: <?php echo $styles[140];?>px;

}
.contactformgenerator_input_element input,.contactformgenerator_input_element textarea{
	font-size: <?php echo $styles[148];?>px;
	color: <?php echo $styles[147];?>;
	font-style: <?php echo $styles[150];?>;
	font-weight: <?php echo $styles[149];?>;
	text-decoration: <?php echo $styles[151];?>;
	text-shadow: <?php echo $styles[154];?>px <?php echo $styles[155];?>px <?php echo $styles[156];?>px <?php echo $styles[153];?>;
	text-align: <?php echo $styles[500];?>;
	<?php 

		$cfg_googlefont = 'cfg-googlewebfont-';
		$cfg_font_rule = $styles[152];
		if (strpos($cfg_font_rule,$cfg_googlefont) !== false) {
			$cfg_font_rule = str_replace($cfg_googlefont, '', $cfg_font_rule);
			$cfg_font_rule .= ', sans-serif';
		}
	?>
	font-family: <?php echo $cfg_font_rule;?>
}

/*.contactformgenerator_input_element:hover,.contactformgenerator_input_element:focus,.contactformgenerator_input_element.focused {*/
.contactformgenerator_input_element_hovered {
	background-color: <?php echo $styles[157];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[157];?>', endColorstr='<?php echo $styles[158];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[157];?>), to(<?php echo $styles[158];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[157];?>, <?php echo $styles[158];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[157];?>, <?php echo $styles[158];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[157];?>, <?php echo $styles[158];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[157];?>, <?php echo $styles[158];?>);/* Opera 11.10+ */
	
	-moz-box-shadow: <?php echo $styles[163];?> <?php echo $styles[164];?>px <?php echo $styles[165];?>px <?php echo $styles[166];?>px <?php echo $styles[167];?>px  <?php echo $styles[162];?>;
	-webkit-box-shadow: <?php echo $styles[163];?> <?php echo $styles[164];?>px <?php echo $styles[165];?>px <?php echo $styles[166];?>px <?php echo $styles[167];?>px  <?php echo $styles[162];?>;
	box-shadow: <?php echo $styles[163];?> <?php echo $styles[164];?>px <?php echo $styles[165];?>px <?php echo $styles[166];?>px <?php echo $styles[167];?>px  <?php echo $styles[162];?>;
	border-style: <?php echo $styles[136];?>;
	border-width: <?php echo $styles[135];?>px;
	border-color: <?php echo $styles[161];?>;
}
/*.contactformgenerator_input_element input:hover,.contactformgenerator_input_element input:focus,.contactformgenerator_input_element textarea:hover,.contactformgenerator_input_element textarea:focus,.contactformgenerator_input_element.focused input,.contactformgenerator_input_element.focused textarea {*/
.contactformgenerator_input_element_hovered input {
	color: <?php echo $styles[159];?>;
	text-shadow: <?php echo $styles[154];?>px <?php echo $styles[155];?>px <?php echo $styles[156];?>px <?php echo $styles[160];?>;
}
.contactformgenerator_field_box_textarea_inner {
	width:<?php echo $styles[169];?>%;
	<?php $box_margin = $styles[501] == 'right' ? '0 0 0 auto' : ($styles[501] == 'center' ? '0 auto' : '0');  ?>
	margin: <?php echo $box_margin;?>;
}
div.cfg_textarea_wrapper {
	width:100% !important;
	height:<?php echo $styles[170];?>px;
}

.contactformgenerator_error .contactformgenerator_field_name,.contactformgenerator_error .contactformgenerator_field_name:hover {
	color: <?php echo $styles[171];?>;
	text-shadow: <?php echo $styles[173];?>px <?php echo $styles[174];?>px <?php echo $styles[175];?>px <?php echo $styles[172];?>;
}
.contactformgenerator_error .contactformgenerator_input_element,.contactformgenerator_error .contactformgenerator_input_element:hover {
	background-color: <?php echo $styles[176];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[176];?>', endColorstr='<?php echo $styles[177];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[176];?>), to(<?php echo $styles[177];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[176];?>, <?php echo $styles[177];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[176];?>, <?php echo $styles[177];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[176];?>, <?php echo $styles[177];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[176];?>, <?php echo $styles[177];?>);/* Opera 11.10+ */
	
	-moz-box-shadow: <?php echo $styles[185];?> <?php echo $styles[186];?>px <?php echo $styles[187];?>px <?php echo $styles[188];?>px <?php echo $styles[189];?>px  <?php echo $styles[184];?>;	
	-webkit-box-shadow: <?php echo $styles[185];?> <?php echo $styles[186];?>px <?php echo $styles[187];?>px <?php echo $styles[188];?>px <?php echo $styles[189];?>px  <?php echo $styles[184];?>;		
	box-shadow: <?php echo $styles[185];?> <?php echo $styles[186];?>px <?php echo $styles[187];?>px <?php echo $styles[188];?>px <?php echo $styles[189];?>px  <?php echo $styles[184];?>;		
	border-color: <?php echo $styles[178];?>;
	
}
.contactformgenerator_error input,.contactformgenerator_error input:hover, .contactformgenerator_error .focused input:hover, .contactformgenerator_error .focused input, .contactformgenerator_error textarea,.contactformgenerator_error textarea:hover {
	
	color: <?php echo $styles[179];?>;
	text-shadow: <?php echo $styles[181];?>px <?php echo $styles[182];?>px <?php echo $styles[183];?>px <?php echo $styles[180];?>;
}

.contactformgenerator_pre_text {
	margin-top: <?php echo $styles[190];?>px;
	margin-bottom: <?php echo $styles[191];?>px;

	<?php $mr =$styles[502] == 'right' ? '0' : ($styles[502] == 'center' ? 'auto' : '0');?>
	<?php $ml = $styles[502] == 'right' ? 'auto' : ($styles[502] == 'center' ? 'auto' : '0');?>
	margin-right: <?php echo $mr;?>;
	margin-left: <?php echo $ml;?>;

	padding: <?php echo $styles[193];?>px 0 0 0;
	width: <?php echo $styles[192];?>%;
	
	font-size: <?php echo $styles[198];?>px;
	color: <?php echo $styles[197];?>;
	font-style: <?php echo $styles[200];?>;
	font-weight: <?php echo $styles[199];?>;
	text-decoration: <?php echo $styles[201];?>;
	text-shadow: <?php echo $styles[204];?>px <?php echo $styles[205];?>px <?php echo $styles[206];?>px <?php echo $styles[203];?>;
	text-align: <?php echo $styles[502];?>;
	
	border-top: <?php echo $styles[194];?>px <?php echo $styles[196];?> <?php echo $styles[195];?>;
	<?php 

		$cfg_googlefont = 'cfg-googlewebfont-';
		$cfg_font_rule = $styles[202];
		if (strpos($cfg_font_rule,$cfg_googlefont) !== false) {
			$cfg_font_rule = str_replace($cfg_googlefont, '', $cfg_font_rule);
			$cfg_font_rule .= ', sans-serif';
		}
	?>
	font-family: <?php echo $cfg_font_rule;?>
}
.contactformgenerator_wrapper .tooltip_inner {
	<?php 

		$cfg_googlefont = 'cfg-googlewebfont-';
		$cfg_font_rule = $styles[508];
		if (strpos($cfg_font_rule,$cfg_googlefont) !== false) {
			$cfg_font_rule = str_replace($cfg_googlefont, '', $cfg_font_rule);
			$cfg_font_rule .= ', sans-serif';
		}
	?>
	font-family: <?php echo $cfg_font_rule;?>
}
.contactformgenerator_field_required {
	<?php 

		$cfg_googlefont = 'cfg-googlewebfont-';
		$cfg_font_rule = $styles[509];
		if (strpos($cfg_font_rule,$cfg_googlefont) !== false) {
			$cfg_font_rule = str_replace($cfg_googlefont, '', $cfg_font_rule);
			$cfg_font_rule .= ', sans-serif';
		}
	?>
	font-family: <?php echo $cfg_font_rule;?>
}
/*************************************************RTL rules*******************************************************************************************/

<?php
if($styles[501] == 'right') {?>
.contactformgenerator_wrapper .answer_name {
	float: right!important;
	text-align: right !important;
}
 .answer_input {
	float: right !important;
	margin-right: -100%;
}
 .contactformgenerator_field_required {
	left: -12px !important;
}
 .the-tooltip.right > .tooltip_inner {
left: 0 !important;
padding: 3px 16px 4px 8px;
text-align: right;
}
 .the-tooltip.right > .tooltip_inner:after, .the-tooltip.right > .tooltip_inner:before {
	left: 0;
}
 .cfg_input_dummy_wrapper img.ui-datepicker-trigger {
	left: -29px;
}

/***fileupload**/
 .cfg_progress .bar {
float: right;
}
 .cfg_fileupload_wrapper {
	text-align: right;
}
 .cfg_uploaded_file {
	float: right;	
}
 .cfg_remove_uploaded {
	float: right;	
}
 .cfg_uploaded_icon {
	float: right;
}
/***captcha**/
 img.cfg_captcha{
	float: right;
	margin: 3px 0px 5px 5px !important;
}
 .reload_cfg_captcha {
	float: right;
}
 .cfg_timing_captcha  {
	text-align: right;
}
<?php }
else { ?>
.contactformgenerator_wrapper .answer_name {
	float: left!important;
	text-align: left !important;
}
 .answer_input {
	float: left !important;
	margin-left: -100%;
}
 .contactformgenerator_field_required {
	right: -12px !important;
}
 .the-tooltip.right > .tooltip_inner {
right: 0 !important;
padding: 3px 16px 4px 8px;
text-align: left;
}
 .the-tooltip.right > .tooltip_inner:after, .the-tooltip.right > .tooltip_inner:before {
	right: 0;
}
 .cfg_input_dummy_wrapper img.ui-datepicker-trigger {
	right: -29px;
}
/***fileupload**/
 .cfg_progress .bar {
float: left;
}
 .cfg_fileupload_wrapper {
	text-align: left;
}
.cfg_uploaded_file {
	float: left;	
}
 .cfg_remove_uploaded {
	float: left;	
}
 .cfg_uploaded_icon {
	float: left;
}
/***captcha**/
 img.cfg_captcha{
	float: left;
	margin: 3px 5pxpx 5px 0px !important;
}
 .reload_cfg_captcha {
	float: left;
}
 .cfg_timing_captcha  {
	text-align: left;
}
<?php }?>
.contactformgenerator_heading { 
	width: 100% !important;
}
.contactformgenerator_heading_inner {
	margin: <?php echo $styles[535];?>px <?php echo $styles[536];?>px <?php echo $styles[537];?>px <?php echo $styles[538];?>px;
	
}
.contactformgenerator_heading {
	line-height: 1;
	overflow: hidden;
	font-size: <?php echo $styles[525];?>px;
	color: <?php echo $styles[524];?>;
	font-style: <?php echo $styles[527];?>;
	font-weight: <?php echo $styles[526];?>;
	text-decoration: <?php echo $styles[528];?>;
	text-shadow: <?php echo $styles[532];?>px <?php echo $styles[533];?>px <?php echo $styles[534];?>px <?php echo $styles[531];?>;

	margin: <?php echo $styles[539];?>px 0 <?php echo $styles[540];?>px 0;
	
	border-top: <?php echo $styles[543];?>px <?php echo $styles[547];?> <?php echo $styles[548];?>;
	border-right: <?php echo $styles[544];?>px <?php echo $styles[547];?> <?php echo $styles[549];?>;
	border-bottom: <?php echo $styles[545];?>px <?php echo $styles[547];?> <?php echo $styles[550];?>;
	border-left: <?php echo $styles[546];?>px <?php echo $styles[547];?> <?php echo $styles[551];?>;

	background-color: <?php echo $styles[541];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[541];?>', endColorstr='<?php echo $styles[542];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[541];?>), to(<?php echo $styles[542];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[541];?>, <?php echo $styles[542];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[541];?>, <?php echo $styles[542];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[541];?>, <?php echo $styles[542];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[541];?>, <?php echo $styles[542];?>);/* Opera 11.10+ */

	<?php 

		$cfg_googlefont = 'cfg-googlewebfont-';
		$cfg_font_rule = $styles[529];
		if (strpos($cfg_font_rule,$cfg_googlefont) !== false) {
			$cfg_font_rule = str_replace($cfg_googlefont, '', $cfg_font_rule);
			$cfg_font_rule .= ', sans-serif';
		}
	?>
	font-family: <?php echo $cfg_font_rule;?>
}



/* **************************** Sections ,Links ,number styles*******************************************************************/
.cfg_content_element_label {
	font-size: <?php echo $styles[554];?>px;
	color: <?php echo $styles[553];?>;
	font-style: <?php echo $styles[556];?>;
	font-weight: <?php echo $styles[555];?>;
	text-shadow: <?php echo $styles[559];?>px <?php echo $styles[560];?>px <?php echo $styles[561];?>px <?php echo $styles[558];?>;
	border-bottom: <?php echo $styles[590];?>px <?php echo $styles[591];?> <?php echo $styles[592];?>;
	text-decoration: <?php echo $styles[596];?>;
}
a.cfg_link {
	color: <?php echo $styles[564];?>;
	font-style: <?php echo $styles[566];?>;
	font-weight: <?php echo $styles[565];?>;
	text-shadow: <?php echo $styles[571];?>px <?php echo $styles[572];?>px <?php echo $styles[573];?>px <?php echo $styles[570];?>;
	border-bottom: <?php echo $styles[567];?>px <?php echo $styles[568];?> <?php echo $styles[569];?>;

	text-decoration: <?php echo $styles[594];?>;
}
a.cfg_link:hover {
	color: <?php echo $styles[564];?>;
	font-style: <?php echo $styles[566];?>;
	font-weight: <?php echo $styles[565];?>;
	text-shadow: <?php echo $styles[571];?>px <?php echo $styles[572];?>px <?php echo $styles[573];?>px <?php echo $styles[570];?>;
	border-bottom: <?php echo $styles[567];?>px <?php echo $styles[568];?> <?php echo $styles[569];?>;

	text-decoration: <?php echo $styles[594];?>;
}
a.cfg_link_hovered {
	color: <?php echo $styles[574];?>;
	text-shadow: <?php echo $styles[577];?>px <?php echo $styles[578];?>px <?php echo $styles[579];?>px <?php echo $styles[576];?>;
	border-bottom: <?php echo $styles[567];?>px <?php echo $styles[568];?> <?php echo $styles[575];?>;

	font-style: <?php echo $styles[566];?>;
	font-weight: <?php echo $styles[565];?>;
	text-decoration: <?php echo $styles[595];?>;
}
a.cfg_link_hovered:hover {
	color: <?php echo $styles[574];?>;
	text-shadow: <?php echo $styles[577];?>px <?php echo $styles[578];?>px <?php echo $styles[579];?>px <?php echo $styles[576];?>;
	border-bottom: <?php echo $styles[567];?>px <?php echo $styles[568];?> <?php echo $styles[575];?>;

	font-style: <?php echo $styles[566];?>;
	font-weight: <?php echo $styles[565];?>;
	text-decoration: <?php echo $styles[595];?>;
}

.cfg_content_styling {
	color: <?php echo $styles[580];?>;
	font-style: <?php echo $styles[582];?>;
	font-weight: <?php echo $styles[581];?>;
	text-shadow: <?php echo $styles[584];?>px <?php echo $styles[585];?>px <?php echo $styles[586];?>px <?php echo $styles[583];?>;
	text-decoration: <?php echo $styles[593];?>;
}


/*custom styles*/
<?php 
$custom_styles = str_replace('cfg_img_path',WPCFG_PLUGIN_PATH.'/includes/assets/images/bg_images',$styles[599]);
echo $custom_styles = str_replace('.cfg_form_FORM_ID','',$custom_styles);
?>

</style>