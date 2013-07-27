<?php
function go_style_everypage() {
        wp_register_style( 'go_style_everypage', plugin_dir_url( __FILE__).'go_every_page.css' );
        wp_enqueue_style( 'go_style_everypage' );
}
?>