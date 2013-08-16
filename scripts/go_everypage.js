function go_admin_bar_add(){
	ajaxurl = 'http://'+location.host+'/wp-admin/admin-ajax.php';
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { 
		action: 'go_admin_bar_add',
		go_admin_bar_points_points:jQuery('#go_admin_bar_points_points').val(),
		go_admin_bar_points_reason:jQuery('#go_admin_bar_points_reason').val(),
		go_admin_bar_currency_points:jQuery('#go_admin_bar_currency_points').val(),
		go_admin_bar_currency_reason:jQuery('#go_admin_bar_currency_reason').val(),
		go_admin_bar_minutes_points:jQuery('#go_admin_bar_minutes_points').val(),
		go_admin_bar_minutes_reason:jQuery('#go_admin_bar_minutes_reason').val()},
		success: function(html){
	    jQuery('#go_admin_bar_points_points').val('');
		jQuery('#go_admin_bar_points_reason').val('');
		jQuery('#go_admin_bar_currency_points').val('');
		jQuery('#go_admin_bar_currency_reason').val('');
		jQuery('#go_admin_bar_minutes_points').val('');
		jQuery('#go_admin_bar_minutes_reason').val('');
		jQuery('#admin_bar_add_return').html(html);
		}
	});
	
	}
	
function go_admin_bar_stats_page_button(){
	ajaxurl = 'http://'+location.host+'/wp-admin/admin-ajax.php';
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { 
		action: 'go_admin_bar_stats'},
		success: function(html){
jQuery('#go_stats_white_overlay').html(html);
jQuery('#go_stats_page_black_bg').show();
jQuery('#go_stats_white_overlay').show();
		}
	});
		}
function go_stats_close(){
	jQuery('#go_stats_white_overlay').hide();
	jQuery('#go_stats_page_black_bg').hide();
	jQuery('#go_stats_lay').hide();

	
	}
	
	
function go_stats_task_list(){
	ajaxurl = 'http://'+location.host+'/wp-admin/admin-ajax.php';
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { 
		action: 'go_stats_task_list', stage:1},
		success: function(html){
jQuery('#go_stats_encountered_list').html(html);
		}
	});

	jQuery.ajax({
		type: "post",url: ajaxurl,data: { 
		action: 'go_stats_task_list', stage:2},
		success: function(html){
jQuery('#go_stats_accepted_list').html(html);
		}
	});

	jQuery.ajax({
		type: "post",url: ajaxurl,data: { 
		action: 'go_stats_task_list', stage:3},
		success: function(html){
jQuery('#go_stats_completed_list').html(html);
		}
	});

	jQuery.ajax({
		type: "post",url: ajaxurl,data: { 
		action: 'go_stats_task_list', stage:4},
		success: function(html){
jQuery('#go_stats_mastered_list').html(html);
		}
	});
	
	}
	
	
function go_stats_third_tab(){
jQuery.ajax({
		type: "post",url: ajaxurl,data: { 
		action: 'go_stats_points'},
		success: function(html){
jQuery('#go_stats_points').html(html);
		}
	});	
jQuery.ajax({
		type: "post",url: ajaxurl,data: { 
		action: 'go_stats_currency'},
		success: function(html){
jQuery('#go_stats_currency').html(html);
		}
	});
jQuery.ajax({
		type: "post",url: ajaxurl,data: { 
		action: 'go_stats_minutes'},
		success: function(html){
jQuery('#go_stats_minutes').html(html);
		}
	});
	
	}
