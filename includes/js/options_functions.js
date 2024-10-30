(function($) {
$(document).ready(function() {
	
	$('.load_countries_data').click(function() {
		var agree=confirm("Load countries?");
		if (agree) {
			var path = window.location;
			path += '&load_countries=1';
			window.location.href = path;
		}
	});

	function make_sortable() {
		if($("#sortable_menu").find('.menu_moove').hasClass('disabledordering')) {
			return false;
		}
		// 2.5.0 fix
		var cfg_token = $("#cfg_token").val();

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
						{order: order,type: 'reorder_options',cfg_token: cfg_token},
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
	
	$(".disabledordering").attr("title","Order options by Custom to enable ordering");

	
	//ajax functions
	// $(".menu_tree div.edit").on('click', function()
	$("body").on('click', '.menu_tree div.edit', function(e)
	{
		id = $(this).attr("menu_id");
		$("#menu_id").val(id);
		$("#edit_menu_data").show();
		$("#dialog_inner_wrapper").html('');
		$("#edit_menu_data").dialog({modal: true,width:500,height: 300,title:'Option parameters'});

		// 2.5.0 fix
		var cfg_token = $("#cfg_token").val();
		
		$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);
		$.post
		(
			"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
			{menu_id: id,type: 'get_data',cfg_token: cfg_token},
			function(data)
			{
				$("#dialog_inner_wrapper").html(data);
				$("#menus_info_tabs").tabs();
				$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
			}
		);
	});
	
	// $(".new_submenu_img").on('click', function()
	$("body").on('click', '.new_submenu_img', function(e)
	{
		id = $(this).attr("menu_id");
		$("#menu_id").val(id);
		$("#edit_menu_data").show();
		$("#dialog_inner_wrapper").html('');
		$("#edit_menu_data").dialog({modal: true,width:500,height: 250,title:'New option'});

		// 2.5.0 fix
		var cfg_token = $("#cfg_token").val();
		
		$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);
		$.post
		(
				"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
				{menu_id: id,type: 'new_option_data',cfg_token: cfg_token},
				function(data)
				{
					$("#dialog_inner_wrapper").html(data);
					$("#menus_info_tabs").tabs();
					$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
					$("#new_title").focus();
				}
		);
	});
	//$("#submit_options_form").on('click', function(e)
	$("body").on('click', '#submit_options_form', function(e)
	{
		e.preventDefault();
		id = $("#menu_id").val();
		var name = $.trim($("#edit_menu_data #new_title").val());
		var value = $.trim($("#edit_menu_data #new_value").val());
		var selected_val = $("#edit_menu_data input[name='option_selected']:checked").val();

		// 2.5.0 fix
		var cfg_token = $("#cfg_token").val();

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
				{menu_id: id,type: 'save_data', name: name,value: value,selected:selected_val,cfg_token: cfg_token},
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
	//$("#submit_new_option_form").on('click', function(e)
	$("body").on('click', '#submit_new_option_form', function(e)
	{
		e.preventDefault();
		id = $("#menu_id").val();
		var name = $.trim($("#edit_menu_data #new_title").val());
		var selected_val = $("#edit_menu_data input[name='option_selected']:checked").val();

		// 2.5.0 fix
		var cfg_token = $("#cfg_token").val();

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
					{menu_id: id,type: 'save_new_option_data', name: name,selected:selected_val,cfg_token: cfg_token},
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
	
	// $(".menu_tree div.hide").on('click', function()
	$("body").on('click', '.menu_tree div.hide', function(e)
	{
		id = $(this).attr("menu_id");
		$("#menu_id").val(id);

		// 2.5.0 fix
		var cfg_token = $("#cfg_token").val();
		
		$("#edit_menu_data").dialog({modal: true,width:300,height: 150,title:'Unpublish option'});
		
		$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);
		$.post
		(
			"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
			{type: 'show_unpublish_wrapper',cfg_token: cfg_token},
			function(data)
			{
				$("#dialog_inner_wrapper").html(data);
				$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
			}
		);
	});
	
	//$("#submit_hide_option").on('click', function(e)
	$("body").on('click', '#submit_hide_option', function(e)
	{
		console.log('submit_hide_option');
		e.preventDefault();
		id = $("#menu_id").val();
		$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);

		// 2.5.0 fix
		var cfg_token = $("#cfg_token").val();

		$.post
		(
				"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
				{menu_id: id,type: 'unpublish_data',cfg_token: cfg_token},
				"json"
		)
		.done(function(data)
		{
			console.log('ajax loaded');
			$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
			$("#showrow_" + id).removeClass('hide').addClass('show');
			$("#showrow_" + id).attr('title','Publish option');
			$("#edit_menu_data").dialog('close');
			//window.location.reload();
			return false;
		});
	});
	// $(".menu_tree div.show").on('click', function()
	$("body").on('click', '.menu_tree div.show', function(e)
	{
		id = $(this).attr("menu_id");
		$("#menu_id").val(id);
		
		$("#edit_menu_data").dialog({modal: true,width:300,height: 150,title:'Publish option'});

		// 2.5.0 fix
		var cfg_token = $("#cfg_token").val();
		
		$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);
		$.post
		(
			"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
			{type: 'show_publish_wrapper',cfg_token: cfg_token},
			function(data)
			{
				$("#dialog_inner_wrapper").html(data);
				$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
			}
		);
	});
	
	// $("#submit_show_option").on('click', function(e)
	$("body").on('click', '#submit_show_option', function(e)
	{
		e.preventDefault();
		id = $("#menu_id").val();
		$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);

		// 2.5.0 fix
		var cfg_token = $("#cfg_token").val();

		$.post
		(
				"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
				{menu_id: id,type: 'publish_data',cfg_token: cfg_token}
		)
		.done(function(data)
		{
			$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
			$("#showrow_" + id).removeClass('show').addClass('hide');
			$("#showrow_" + id).attr('title','Unpublish option');
			$("#edit_menu_data").dialog('close');
			//window.location.reload();
			return false;
		}
	)
	});
	// $(".menu_tree div.delete").on('click', function()
	$("body").on('click', '.menu_tree div.delete', function(e)
	{
		id = $(this).attr("menu_id");
		$("#menu_id").val(id);
		
		$("#edit_menu_data").dialog({modal: true,width:300,height: 150,title:'Delete option'});

		// 2.5.0 fix
		var cfg_token = $("#cfg_token").val();

		
		$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);
		$.post
		(
				"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
				{type: 'show_delete_wrapper',cfg_token: cfg_token},
				function(data)
				{
					$("#dialog_inner_wrapper").html(data);
					$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
				}
		);
	});
	
	// $("#submit_delete_option").on('click', function(e)
	$("body").on('click', '#submit_delete_option', function(e)
	{
		e.preventDefault();
		id = $("#menu_id").val();
		$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);

		// 2.5.0 fix
		var cfg_token = $("#cfg_token").val();

		$.post
		(
				"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
				{menu_id: id,type: 'delete_data',cfg_token: cfg_token},
				function(data)
				{
					$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
					$("#option_li_" + id).remove();
					$("#edit_menu_data").dialog('close');
					//window.location.reload();
					return false;
				}
		);
	});

	// extra
	// $(".menu_tree_migrated div.delete_lt").on('click', function()
	$("body").on('click', '.menu_tree_migrated div.delete_lt', function(e)
	{
		id = $(this).attr("menu_id");
		$("#menu_id").val(id);
		$("#menu_id").attr("id_added", id);
		
		$("#edit_menu_data").dialog({modal: true,width:300,height: 150,title:'Delete option'});

		// 2.5.0 fix
		var cfg_token = $("#cfg_token").val();
		
		$("#ajax_loader").css({'opacity': '0','display': 'block'}).stop().fadeTo(100,1);
		$.post
		(
				"admin.php?page=cfg_forms&act=cfg_submit_data&holder=cfg_ajax",
				{type: 'show_delete_wrapper',cfg_token: cfg_token},
				function(data)
				{
					$("#dialog_inner_wrapper").html(data);
					$("#ajax_loader").stop().fadeTo(100,0,function() {$(this).hide();});
				}
		);
	});
})
})(jQuery);