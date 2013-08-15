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
jQuery('#go_stats_page').html(html);
		}
	});
		}
function go_stats_close(){
	jQuery('#go_stats_lay').remove();
	
	}