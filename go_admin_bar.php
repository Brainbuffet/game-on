<?php

function go_admin_bar(){
	global $wp_admin_bar;
	global $current_points;
	global $current_currency;
	global $current_rank;
	global $next_rank_points;
	global $current_rank_points;
	$percentage = ($current_points-$current_rank_points)/($next_rank_points-$current_rank_points)*100;
	
	if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => '<div style="padding-top:5px;"><div id="go_admin_bar_progress_bar_border"><div id="go_admin_bar_progress_bar" style="width: '.$percentage.'%"></div></div></div>',
		'href' => false,
		'id' => 'go_info',
	));
	
		if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => '<div id="go_admin_bar_points">'.get_option('go_points_name').': '.$current_points.get_option('go_points_sym').'</div>',
		'href' => false,
		'parent' => 'go_info',
	));
	
		if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => '<div id="go_admin_bar_currency">'.get_option('go_currency_sym').$current_currency. ' '.get_option('go_currency_name').' </div>',
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
	if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => '<div id="go_admin_bar_rank_left">'.($next_rank_points-$current_points).get_option('go_points_sym').' '.get_option('go_points_name').' Left</div>',
		'href' => false,
		'parent' => 'go_info',
	));
	
	
////////////////////////////////////////////////////////////////////////	
	
	if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => 'Add',
		'href' => false,
		'id' => 'go_add',
	));
	
		if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => 
		'<form method="post" action=""><div id="go_admin_bar_title">Points</div>
		<div id="go_admin_bar_input"><input type="text" id="go_admin_bar_points" name="go_admin_bar_points_points"/> For <input type="text" id="go_admin_bar_reason" name="go_admin_bar_points_reason"/></div>
		<div id="go_admin_bar_title">'.get_option('go_currency_name').'</div>
		<div id="go_admin_bar_input"><input type="text" id="go_admin_bar_points" name="go_admin_bar_currency_points"/> For <input type="text" id="go_admin_bar_reason" name="go_admin_bar_currency_reason"/></div>
		<div id="go_admin_bar_title">Minutes</div>
		<div id="go_admin_bar_input"><input type="text" id="go_admin_bar_points" name="go_admin_bar_minutes_points"/> For <input type="text" id="go_admin_bar_reason" name="go_admin_bar_minutes_reason"/></div>
		<div><input type="submit" style="width:250px; height: 20px;margin-top: 7px;" name="go_admin_bar_submit"></div></form>',
		'href' => false,
		'parent' => 'go_add',
	));

///////////////////////////////////////////////////////////////////////////////////////////
$points_points = $_POST['go_admin_bar_points_points'];
$points_reason = $_POST['go_admin_bar_points_reason'];

$currency_points = $_POST['go_admin_bar_currency_points'];
$currency_reason = $_POST['go_admin_bar_currency_reason'];

$minutes_points = $_POST['go_admin_bar_minutes_points'];
$minutes_reason = $_POST['go_admin_bar_minutes_reason'];
	$user_id = get_current_user_id();

if($points_points != ''&& $points_reason != ''){
	go_add_currency($user_id,$points_reason, 6, $points_points, 0, false);
	}
if($currency_points!= ''&&$currency_reason!= ''){
	go_add_currency($user_id, $currency_reason, 6, 0, $currency_points, false);

	}
if($minutes_points!= ''&&$minutes_reason != ''){
	go_add_minutes($user_id, $minutes_points, $minutes_reason);
	}
	
}
?>