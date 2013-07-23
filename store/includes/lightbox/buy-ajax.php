<?php
add_action('wp_enqueue_scripts', 'cb_buy_the_item'); //add plugin script; 

function cb_buy_the_item(){ 
    if(!is_admin()){ 
        wp_enqueue_script('more-posts', plugins_url( 'js/buy_the_item.js' , __FILE__ ), array('jquery'), 1.0, true); 
        wp_localize_script('more-posts', 'buy_item', array('ajaxurl' => admin_url('admin-ajax.php'))); //create ajaxurl global for front-end AJAX call; 
    } 
} 

add_action('wp_ajax_buy_item', 'cb_buy_item'); //fire cb_buy_item on AJAX call for logged-in users; 
add_action('wp_ajax_nopriv_buy_item', 'cb_buy_item'); //fire cb_buy_item on AJAX call for all other users; 

function cb_buy_item(){ 
    $the_id = $_POST["the_id"];
	$user_ID = get_current_user_id(); // Current User ID
	$user_gold = display_cg_total($user_ID); // User Gold
	$retrieve = get_post_custom($the_id); // prefaces all retrieves below
	$set_ranks = (array)get_option('cp_module_ranks_data'); // All Possible Ranks defined by admin, least to greatest
	$user_rank = cp_module_ranks_getRank($student_id); // Rank of current user
	$user_rank_key = array_search($user_rank, $set_ranks); // Order of current user rank out of all possible ranks
	$cb_gold_req = $retrieve["cbs_gold_req"][0]; // Gold required to buy item
	$cb_repeat = $retrieve["cbs_repeat"][0]; // Check if repeatable buy is on
	$cb_rank = $retrieve["cbs_rank"][0]; // Rank required to buy item
	$cb_rank_key = array_search($cb_rank, $set_ranks); // Order of rank required out of all possible ranks
	$user_ID = get_current_user_id(); // Current User ID
	$user_points = cp_getPoints( $user_ID ); // Current CubePoints points
	if ($user_gold >= $cb_gold_req && $user_points >= $cb_rank_key) {
		echo 'Purchased';
	} else {
		if ($cb_gold_req > $user_gold) {
			echo 'Insuffcient Funds'; 
		} elseif ($user_points < $cb_rank_key) { 
			echo 'Rank Too Low';
		} else {
		}
	}
    die(); 
}
?>