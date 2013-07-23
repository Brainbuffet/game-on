<?php
if (is_admin()) {
add_action('wp_enqueue_scripts', 'cb_cat_the_item'); //add plugin script; 

function cb_cat_the_item(){ 
    if(!is_admin()){ 
        wp_enqueue_script('more-posts', plugins_url( 'js/cat_the_item.js' , __FILE__ ), array('jquery'), 1.0, true); 
        wp_localize_script('more-posts', 'cat_item', array('ajaxurl' => admin_url('admin-ajax.php'))); //create ajaxurl global for front-end AJAX call; 
    } 
} 

add_action('wp_ajax_cat_item', 'cb_cat_item'); //fire cb_cat_item on AJAX call for logged-in users; 
add_action('wp_ajax_nopriv_cat_item', 'cb_cat_item'); //fire cb_cat_item on AJAX call for all other users; 

function cb_cat_item(){
	$the_id = $_POST["the_item_id"]; 
    echo 'hello';
    die(); 
}
}
?>