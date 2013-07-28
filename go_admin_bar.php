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
		'title' => '<div id="go_admin_bar_points">'.$current_points.' Points</div>',
		'href' => false,
		'id' => 'go_info',
	));
	
		if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => '<div id="go_admin_bar_currency">'.$current_currency. ' Currency </div>',
		'href' => false,
		'parent' => 'go_info',
	));
	if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => '<div id="go_admin_bar_rank">'.$current_rank.'</div>',
		'href' => false,
		'parent' => 'go_info',
	));

	
}
?>