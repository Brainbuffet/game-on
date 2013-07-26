<?php

function go_admin_bar(){
	global $wp_admin_bar;
	global $current_points;
	global $current_currency;
	global $current_rank;
	global $next_rank_points;
		if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => $current_points.' Points',
		'href' => false,
		'id' => 'go_info',
	));
	
		if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => $current_currency. ' Currency',
		'href' => false,
		'parent' => 'go_info',
	));
	if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => $current_rank,
		'href' => false,
		'parent' => 'go_info',
	));

	
}
?>