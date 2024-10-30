(function($) {
$(document).ready(function() {

	function make_sortable() {
		if($("#sortable_menu").find('.menu_moove').hasClass('disabledordering')) {
			return false;
		}
		//sortable
		$("#sortable_menu").sortable();
		$("#sortable_menu").disableSelection();
		$("#sortable_menu").sortable( "option", "disabled", true );
		$("#sortable_menu .menu_moove").mousedown(function()
		{
			$( "#sortable_menu" ).sortable( "option", "disabled", false );
		});
		$( "#sortable_menu" ).sortable(
		{
			update: function(event, ui) 
			{
				var order = $("#sortable_menu").sortable('toArray').toString();
				$.post
				(
						"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
						{order: order,type: 'reorder_options'},
						function(data)
						{
							//window.location.reload();
							return false;
						}
				);
			}
		});
		$( "#sortable_menu" ).sortable(
		{
			stop: function(event, ui) 
			{
				$( "#sortable_menu" ).sortable( "option", "disabled", true );
			}
		});
	}
	make_sortable();
	// setTimeout(function() {
	// },1200);
	
	$(".disabledordering").attr("title","Order options by Custom to enable ordering");
	
	$(".new_submenu_img").live('click', function()
	{
		id = $(this).attr("menu_id");
		$("#menu_id").val(id);
		$("#edit_menu_data").show();
		$("#dialog_inner_wrapper").html('');
		$("#edit_menu_data").dialog({modal: true,width:500,height: 250,title:'New option'});
		
		$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);
		$.post
		(
				"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
				{menu_id: id,type: 'new_option_data'},
				function(data)
				{
					$("#dialog_inner_wrapper").html(data);
					$("#menus_info_tabs").tabs();
					$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
					$("#new_title").focus();
				}
		);
	});
	$("#submit_options_form").live('click', function(e)
	{
		e.preventDefault();
		id = $("#menu_id").val();
		var name = $.trim($("#edit_menu_data #new_title").val());
		var value = $.trim($("#edit_menu_data #new_value").val());
		var selected_val = $("#edit_menu_data input[name='option_selected']:checked").val();
		if(value == '' || name == '')
		{
			alert("Option must have a name and value.");
			return false;
		}
		else
		{
			$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);
			$.post
			(
				"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
				{menu_id: id,type: 'save_data', name: name,value: value,selected:selected_val},
				function(data)
				{
					$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
					$("#option_" + id).html(name);
					$("#edit_menu_data").dialog('close');
					//window.location.reload();
					return false;
				}
			);
		}
	});

	$(".disabledordering").attr("alfa","1");

	$("#submit_new_option_form").live('click', function(e)
	{
		e.preventDefault();
		id = $("#menu_id").val();
		var name = $.trim($("#edit_menu_data #new_title").val());
		var selected_val = $("#edit_menu_data input[name='option_selected']:checked").val();
		if(name == '')
		{
			alert("Option must have a name.");
			return false;
		}
		else
		{
			$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);
			$.post
			(
					"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
					{menu_id: id,type: 'save_new_option_data', name: name,selected:selected_val},
					function(data)
					{
						$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
						$("#edit_menu_data").dialog('close');
						$("#sortable_menu").append(data);
						make_sortable();
						//window.location.reload();
					}
			);
		}
	});
	
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
						{order: order,type: reorder_type,table_name: table_name},
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


	//unpublish added task
	$("#wpcfg_added_list").click(function(e) {
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

	function wpcfg_generate_tr_width() {
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

	setTimeout(function() {
		wpcfg_generate_tr_width();
	},1500);


	//ajax functions
	$(".menu_tree_migrated div.edit").on('click', function()
	{
		id = $(this).attr("menu_id");
		$("#menu_id").val(id);
		$("#edit_menu_data").show();
		$("#dialog_inner_wrapper").html('');
		$("#edit_menu_data").dialog({modal: true,width:500,height: 300,title:'Option parameters'});
		
		$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);
		$.post
		(
			"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
			{menu_id: id,type: 'get_data'},
			function(data)
			{
				$("#dialog_inner_wrapper").html(data);
				$("#menus_info_tabs").tabs();
				$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
			}
		);
	});

		//publish task
	$(".wpcfg_publish_cfg").click(function() {
		var id = $(this).attr("wpcfg_id");
		$("#wpcfg_def_id").val(id);
		$("#wpcfg_task").val('publish');
		$("#wpcfg_form").submit();
		return false;
	});

	$(".new_submenu_img_generated").on('click', function()
	{
		id = $(this).attr("menu_id");
		$("#menu_id").val(id);
		$("#edit_menu_data").show();
		$("#dialog_inner_wrapper").html('');
		$("#edit_menu_data").dialog({modal: true,width:500,height: 250,title:'New option'});
		
		$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);
		$.post
		(
				"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
				{menu_id: id,type: 'new_option_data'},
				function(data)
				{
					$("#dialog_inner_wrapper").html(data);
					$("#menus_info_tabs").tabs();
					$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
					$("#new_title").focus();
				}
		);
	});

	// $("#wpcfg_check_exceptions").click(function() {
	// 	if($(this).is(":checked")) {
	// 		$('.wpcfg_row_ch').attr('checked',true);
	// 	}
	// 	else {
	// 		$('.wpcfg_row_ch').attr('checked',false);
	// 	}
		
	// 	wpcfg_check_the_selection();
	// });

	function wpcfg_make_sortable_list() {
		var table_name = $("#wpcfg_sortable").attr("table_name");
		var reorder_type = $("#wpcfg_sortable").attr("reorder_type");
		
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
						{order: order,type: reorder_type,table_name: table_name},
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

		//check/uncheck all
	$("#wpcfg_check_ex_all").click(function() {
		if($(this).is(":checked")) {
			$('.wpcfg_row_ch').attr('checked',true);
		}
		else {
			$('.wpcfg_row_ch').attr('checked',false);
		}
		
		wpcfg_check_the_selection();
	});

	$("#wpcfg_form_save_inset").click(function() {
		alert('Please upgrade to PRO version to use this option!');

		//sortable
		$("#wpcfg_sortable").sortable();
		$("#wpcfg_sortable").disableSelection();
		$("#wpcfg_sortable").sortable( "option", "disabled", true );
		
		return false;
	});

	//ajax functions
	$(".menu_tree_item div.edit").live('click', function()
	{
		id = $(this).attr("menu_id");
		$("#menu_id").val(id);
		$("#edit_menu_data").show();
		$("#dialog_inner_wrapper").html('');
		$("#edit_menu_data").dialog({modal: true,width:500,height: 300,title:'Option parameters'});
		
		$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);
		$.post
		(
			"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
			{menu_id: id,type: 'get_data'},
			function(data)
			{
				$("#dialog_inner_wrapper").html(data);
				$("#menus_info_tabs").tabs();
				$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
			}
		);
	});

	$("#submit_options_form").on('click', function(e)
	{
		e.preventDefault();
		id = $("#menu_id").val();
		var name = $.trim($("#edit_menu_data #new_title").val());
		var value = $.trim($("#edit_menu_data #new_value").val());
		var selected_val = $("#edit_menu_data input[name='option_selected']:checked").val();
		if(value == '' || name == '')
		{
			alert("Option must have a name and value.");
			return false;
		}
		else
		{
			$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);
			$.post
			(
				"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
				{menu_id: id,type: 'save_data', name: name,value: value,selected:selected_val},
				function(data)
				{
					$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
					$("#option_" + id).html(name);
					$("#edit_menu_data").dialog('close');
					//window.location.reload();
					return false;
				}
			);
		}
	});
	
					
});
})(jQuery);