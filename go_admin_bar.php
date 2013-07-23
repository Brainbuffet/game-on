<?php

function go_admin_bar(){
	global $wp_admin_bar;
		if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => 'Add',
		'href' => false,
		'id' => 'gold_links',
	));
}
?>