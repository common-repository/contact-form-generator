(function($) {
$(document).ready(function() {
	
	/////////////////////////////////////////////////////////////////////////TASKS///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//check/uncheck all
	$("#wpcfg_check_all").click(function() {
		if($(this).is(":checked")) {
			$('.wpcfg_row_ch').attr('checked',true);
		}
		else {
			$('.wpcfg_row_ch').attr('checked',false);
		}
		
		wpcfg_check_the_selection();
	});
	
	//unpublish task
	$(".wpcfg_unpublish").click(function() {
		var id = $(this).attr("wpcfg_id");
		$("#wpcfg_def_id").val(id);
		$("#wpcfg_task").val('unpublish');
		$("#wpcfg_form").submit();
		return false;
	});
	//publish task
	$(".wpcfg_publish").click(function() {
		var id = $(this).attr("wpcfg_id");
		$("#wpcfg_def_id").val(id);
		$("#wpcfg_task").val('publish');
		$("#wpcfg_form").submit();
		return false;
	});
	//publish list task
	$("#wpcfg_publish_list").click(function(e) {
		e.preventDefault();
		var l = parseInt($('.wpcfg_row_ch:checked').length);
		if(l > 0) {
			$("#wpcfg_task").val('publish');
			$("#wpcfg_form").submit();
			return false;
		}
		else {
			alert('Please first make a selection from the list');
			return false;
		}
	});
	//unpublish list task
	$("#wpcfg_unpublish_list").click(function(e) {
		e.preventDefault();
		var l = parseInt($('.wpcfg_row_ch:checked').length);
		if(l > 0) {
			$("#wpcfg_task").val('unpublish');
			$("#wpcfg_form").submit();
			return false;
		}
		else {
			alert('Please first make a selection from the list');
			return false;
		}
	});
	//edit list task
	$("#wpcfg_edit").click(function(e) {
		e.preventDefault();
		var l = parseInt($('.wpcfg_row_ch:checked').length);
		if(l > 0) {
			var id = $('.wpcfg_row_ch:checked').first().val();
			var url_part1 =$("#wpcfg_form").attr("action");
			var url = url_part1 + '&act=edit&id=' + id;
			window.location.replace(url);
			return false;
		}
		else {
			alert('Please first make a selection from the list');
			return false;
		}
	});
	//delete task
	$("#wpcfg_delete").click(function(e) {
		e.preventDefault();
		var l = parseInt($('.wpcfg_row_ch:checked').length);
		if(l > 0) {
			if(confirm('Delete selected items?')) {
				$("#wpcfg_task").val('delete');
				$("#wpcfg_form").submit();
			}
			return false;
		}
		else {
			alert('Please first make a selection from the list');
			return false;
		}
	});
	
	
	//filter select
	$(".wpcfg_select").change(function() {
		$("#wpcfg_form").submit();
	});
	//filter search
	$("#wpcfg_filter_search_submit").click(function() {
		$("#wpcfg_form").submit();
	});
	
	//list of checkbox
	$('.wpcfg_row_ch').click(function() {
		if(!($(this).is(':checked'))) {
			$("#wpcfg_check_all").attr('checked',false);
		}
		wpcfg_check_the_selection();
	});
	
	function wpcfg_check_the_selection() {
		var l = parseInt($('.wpcfg_row_ch:checked').length);
		if(l == 0) {
			$('.wpcfg_disabled').addClass('button-disabled');
			$('.wpcfg_disabled').attr('title','Please make a selection from the list, to activate this button');
		}
		else {
			$('.wpcfg_disabled').removeClass('button-disabled');
			$('.wpcfg_disabled').attr('title','');
		}
	};
	
	/////////////////////////////////////////////////////Add form//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$("#wpcfg_form_save").click(function() {
		if(!wpcfg_validate_form())
			return false;
		$("#wpcfg_task").val('save');
		$("#wpcfg_form").submit();
		return false;
	});
	$("#wpcfg_form_save_close").click(function() {
		if(!wpcfg_validate_form())
			return false;
		$("#wpcfg_task").val('save_close');
		$("#wpcfg_form").submit();
		return false;
	});
	$("#wpcfg_form_save_new").click(function() {
		if(!wpcfg_validate_form())
			return false;
		$("#wpcfg_task").val('save_new');
		$("#wpcfg_form").submit();
		return false;
	});
	$("#wpcfg_form_save_copy").click(function() {
		alert('Please upgrade to PRO version to use this option!');
		return false;
	});
	
	//function to validate forms form
	function wpcfg_validate_form() {
		var tested = true;
		$("#wpcfg_form").find('.required').each(function() {
			var val = $.trim($(this).val());
			if(val == '') {
				$(this).addClass('wpcfg_error');
				tested = false;
			}
			else
				$(this).removeClass('wpcfg_error');
		});
		if(tested)
			return true;
		else
			return false;
	};
	
	//////////////////////////////////////////////////Table list sortable///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	var wpcfg_selected_tr_id = 0;
	function wpcfg_make_sortable() {
		var table_name = $("#wpcfg_sortable").attr("table_name");
		var reorder_type = $("#wpcfg_sortable").attr("reorder_type");

		// 2.5.0 fix
		var cfg_token = $("#cfg_token").val();

		if(!$("#wpcfg_sortable").length)
			return;
		
		//sortable
		$("#wpcfg_sortable").sortable();
		$("#wpcfg_sortable").disableSelection();
		$("#wpcfg_sortable").sortable( "option", "disabled", true );
		$("#wpcfg_sortable .wpcfg_reorder").mousedown(function()
		{
			wpcfg_selected_tr_id = $(this).parents('tr').attr("id");
			$( "#wpcfg_sortable" ).sortable( "option", "disabled", false );
		});
		$( "#wpcfg_sortable" ).sortable(
		{
			update: function(event, ui) 
			{
				var order = $("#wpcfg_sortable").sortable('toArray').toString();
				$.post
				(
						"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
						{order: order,type: reorder_type,table_name: table_name,cfg_token: cfg_token},
						function(data)
						{
							//window.location.reload();
							return false;
						}
				);
			}
		});
		$( "#wpcfg_sortable" ).sortable(
		{
			stop: function(event, ui) 
			{
				$( "#wpcfg_sortable" ).sortable( "option", "disabled", true );
			}
		});
	}
	wpcfg_make_sortable();
	
	function wpcfg_generate_td_width() {
		$('.ui-state-default').each(function() {
			$(this).find('td').each(function(i) {
				if(i == $(this).find('td').length)
					var w = $(this).width()-2;
				else
					var w = $(this).width();
				$(this).attr("w",w);
				$(this).css('width',w);
			});
		})
	};
	wpcfg_generate_td_width();
	
	//field type limit
	var cfg_type_id = parseInt($("#wpcfg_id_type").val());
	$("#wpcfg_id_type").change(function() {
		var id = $(this).val();
		if(id == 13 || id == 14 || id == 15 || id == 16 || id == 17 || id == 18 || id == 19 || id == 20 || id == 21) {
			alert('Please Upgrade to PRO Version to use this field type');
			$(this).val(cfg_type_id);
			return false;
		}
		cfg_type_id = id;
	});
	$("#wpcfg_column_type").change(function() {
		var id = $(this).val();
		if(id == 1 || id == 2) {
			alert('Please Upgrade to PRO Version to use this option');
			$(this).val(0);
			return false;
		}
	});

	//check/uncheck all
	$("#wpcfg_close_rate_us_dialog").click(function() {
			$(".wpcfg_rate_us_wrapper").hide();
			$.post
				(
						"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
						{type: 'hide_rate_us'},
						function(data)
						{
							return false;
						}
				);
	});
	
					
});
})(jQuery);