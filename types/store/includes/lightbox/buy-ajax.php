<?php
add_action('wp_enqueue_scripts', 'go_buy_the_item'); //add plugin script; 

function go_buy_the_item(){ 
    if(!is_admin()){ 
        wp_enqueue_script('more-posts', plugins_url( 'js/buy_the_item.js' , __FILE__ ), array('jquery'), 1.0, true); 
        wp_localize_script('more-posts', 'buy_item', array('ajaxurl' => admin_url('admin-ajax.php'))); //create ajaxurl global for front-end AJAX call; 
    } 
} 

add_action('wp_ajax_buy_item', 'go_buy_item'); //fire go_buy_item on AJAX call for logged-in users; 
add_action('wp_ajax_nopriv_buy_item', 'go_buy_item'); //fire go_buy_item on AJAX call for all other users; 

function go_buy_item(){ 
    $the_id = $_POST["the_id"];
	$user_ID = get_current_user_id(); // Current User ID
	$custom_fields = get_post_custom($the_id);
	$req_points = $custom_fields['go_mta_store_rank'][0];
	$req_currency = $custom_fields['go_mta_store_currency'][0];
	$user_points = go_return_points($user_ID);
	$user_currency = go_return_currency($user_ID);
	if ($user_currency >= $req_currency && $user_points >= $req_points) {
		echo 'Purchased for '.$req_currency;
		go_add_post($user_ID, $the_id, -1, '' , -$req_currency);
	} else {
		if ($req_currency > $user_currency) {
			echo 'Insuffcient Funds'; 
		} elseif ($user_points < $req_points) { 
			echo 'Rank Too Low';
		} else {
		}
	}
    die(); 
}
?>