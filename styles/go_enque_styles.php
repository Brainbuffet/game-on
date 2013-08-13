<?php
function go_style_everypage() {
        wp_register_style( 'go_style_everypage', plugin_dir_url( __FILE__).'go_every_page.css' );
        wp_enqueue_style( 'go_style_everypage' );
}

function go_style_periods() {
        wp_register_style( 'go_style_periods', plugin_dir_url( __FILE__).'go_periods.css' );
        wp_enqueue_style( 'go_style_periods' );
		 wp_register_style( 'jquery-ui', 'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' );
        wp_enqueue_style( 'jquery-ui' );
		
}
?>