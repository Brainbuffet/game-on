<?php
/*
Plugin Name: Game-On
Description: Adds support for a point system and currency for your users.
Author: Semar Yousif, Vincent Astolfi
Author URI: http://maclab.guhsd.net/
Version: 0.0.1
*/
//include("store/super-store.php");
include('tasks/task.php');
include("go_datatable.php");
include("go_pnc.php");
include("go_returns.php");
include('go_ranks.php');
include('scripts/go_enque.php');
include('go_globals.php');
register_activation_hook( __FILE__, 'go_table_totals' );
register_activation_hook( __FILE__, 'go_table_individual' );
register_activation_hook( __FILE__, 'go_install_data' );
register_activation_hook( __FILE__, 'go_ranks_registration' );
add_action('user_register', 'go_user_registration');
add_action( 'delete_user', 'go_user_delete' );
add_action('go_add_post','go_add_post');
add_action('go_add_currency','go_add_currency');
add_action('go_add_minutes','go_add_minutes');
add_action('go_return_currency','go_return_currency');
add_action('go_return_points','go_return_points');
add_action('go_return_minutes','go_return_minutes');
add_action('admin_menu', 'go_ranks', $capability, $menu_slug, $function);
add_action( 'init', 'go_jquery' );
add_action('wp_ajax_go_add_ranks', 'go_add_ranks');
add_action('wp_ajax_go_remove_ranks', 'go_remove_ranks');
add_shortcode('testbutton','testbutton');
add_action('init','go_global_defaults');
//add_action('init','go_global_info');
add_action('go_get_all_ranks','go_get_all_ranks');
?>