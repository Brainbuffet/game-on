<?php

function go_admin_bar(){
	global $wp_admin_bar;
	global $current_points;
	global $current_currency;
	global $current_rank;
	global $next_rank_points;
	global $current_rank_points;
	$dom = ($next_rank_points-$current_rank_points);
	if($dom <= 0){ $dom = 1;}
	$percentage = ($current_points-$current_rank_points)/$dom*100;
	if($percentage <= 0){ $percentage = 0;} else if($percentage >= 100){$percentage = 100;}
	
	if (!is_admin_bar_showing() && !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => '<div style="padding-top:5px;"><div id="go_admin_bar_progress_bar_border"><div id="go_admin_bar_progress_bar" style="width: '.$percentage.'%"></div></div></div>',
		'href' => false,
		'id' => 'go_info',
	));
	
		if (!is_admin_bar_showing() && !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => '<div id="go_admin_bar_points">'.get_option('go_points_name').': '.get_option('go_points_prefix').$current_points.get_option('go_points_suffix').'</div>',
		'href' => false,
		'parent' => 'go_info',
	));
	
		if (!is_admin_bar_showing() && !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => '<div id="go_admin_bar_currency">'.get_option('go_currency_name').': '.go_display_currency($current_currency).'</div>',
		'href' => false,
		'parent' => 'go_info',
	));
	if (!is_admin_bar_showing() && !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => '<div id="go_admin_bar_rank">'.$current_rank.'</div>',
		'href' => false,
		'parent' => 'go_info',
	));
	if (!is_admin_bar_showing() && !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => '<div id="go_admin_bar_rank_left">'.go_display_points($next_rank_points-$current_points).' Left</div>',
		'href' => false,
		'parent' => 'go_info',
	));
	
	
////////////////////////////////////////////////////////////////////////	
	
	if (!is_admin_bar_showing() && !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => 'Add',
		'href' => false,
		'id' => 'go_add',
	));
	
		if (!is_admin_bar_showing() && !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => 
		'<div id="go_admin_bar_title">Points</div>
		<div id="go_admin_bar_input"><input type="text" class="go_admin_bar_points" id="go_admin_bar_points_points"/> For <input type="text" class="go_admin_bar_reason" id="go_admin_bar_points_reason"/></div>
		<div id="go_admin_bar_title">'.get_option('go_currency_name').'</div>
		<div id="go_admin_bar_input"><input type="text" class="go_admin_bar_points" id="go_admin_bar_currency_points"/> For <input type="text" class="go_admin_bar_reason" id="go_admin_bar_currency_reason"/></div>
		<div id="go_admin_bar_title">Minutes</div>
		<div id="go_admin_bar_input"><input type="text" class="go_admin_bar_points" id="go_admin_bar_minutes_points"/> For <input type="text" class="go_admin_bar_reason" id="go_admin_bar_minutes_reason"/></div>
		<div><input type="button" style="width:250px; height: 20px;margin-top: 7px;" name="go_admin_bar_submit" onclick="go_admin_bar_add();" value="Add"><div id="admin_bar_add_return"></div></div>',
		'href' => false,
		'parent' => 'go_add',
	));

///////////////////////////////////////////////////////////////////////////

if (!is_admin_bar_showing() && !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => '<div onclick="go_admin_bar_stats_page_button();">Stats Page</div><div id="go_stats_page"></div>',
		'href' => false,
		'id' => 'go_stats',
	));
	
}
?>