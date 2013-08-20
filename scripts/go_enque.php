<?php
function go_jquery() {
    wp_enqueue_script( 'jquery' );
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script( 'go_jquery', plugin_dir_url(__FILE__).'go_test_jquery.js');
	wp_enqueue_script( 'go_notification', plugin_dir_url(__FILE__).'go_notification.js');
	wp_enqueue_script( 'go_everypage', plugin_dir_url(__FILE__).'go_everypage.js');
	wp_localize_script( 'go_everypage', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'go_css_pie', plugin_dir_url(__FILE__).'CSSpie.js');
	
		wp_enqueue_script('jquery-ui-progressbar');
	
	
}
function go_jquery_periods() {
    wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'go_jquery_periods', plugin_dir_url(__FILE__).'go_periods.js');
	wp_localize_script( 'go_jquery_periods', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'jquery-ui-accordion' );
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-draggable' );
	wp_enqueue_script( 'jquery-ui-sortable' );
	
	
}
?>