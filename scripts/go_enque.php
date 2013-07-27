<?php

function go_jquery() {
    wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'go_jquery', plugin_dir_url(__FILE__).'go_test_jquery.js');
	wp_enqueue_script( 'go_notification', plugin_dir_url(__FILE__).'go_notification.js');
}

?>