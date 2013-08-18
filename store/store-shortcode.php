<?php
include('includes/lightbox/frontend-lightbox.php');
// Store Shortcode
function go_gold_store_sc ($atts, $content = null) {
	$user_ID = get_current_user_id(); // Current User ID
	$user_gold = 50;
	$user_points = go_return_points( $user_ID ); // Current CubePoints points
	$args = array( 'post_type' => 'go_store', 'posts_per_page' => 10 ); // Defines args used to get custom post type content
	$loop = new WP_Query( $args ); // Loops in custom post type content
	if ( $loop->have_posts() ) : $loop->the_post(); //
	extract( shortcode_atts( array(
		'cats' => '',
		'id' => ''
	), $atts ) );
	if ($cats) { // Checks if there are categories defined
		$the_cats = explode(',', $cats); // gets the string from cats="HERE"
		foreach ($the_cats as $cat) { // for every one of the categories...
			$the_id = get_term_by('name', $cat, 'store_types')->term_id; // get the term's ID
			$the_args = array('orderby' => 'name'); // an array, telling the_items how to display
			$the_items = get_objects_in_term( $the_id, 'store_types', $the_args ); // gets all items under category
			echo $cat.'<br />';
			foreach ($the_items as $item) {
				// Definitions
				$set_ranks = (array)get_option('cp_module_ranks_data'); // All Possible Ranks defined by admin, least to greatest
				$user_rank = go_get_rank($student_id); // Rank of current user
				$user_rank_key = array_search($user_rank, $set_ranks); // Order of current user out of all possible ranks
				$retrieve = get_post_custom($item); // prefaces all retrieves below
				$go_gold_req = $retrieve["gos_gold_req"][0]; // Gold required to buy item
				$go_repeat = $retrieve["gos_repeat"][0]; // 
				$go_rank = $retrieve["gos_rank"][0]; // Rank required to buy item
				$go_rank_key = array_search($go_rank, $set_ranks); // Order of rank required out of all possible ranks
				$the_title = get_the_title($item); // get item title
				echo '<a onclick="go_lb_opener('.$item.');">'.$the_title.' ('.$go_gold_req.')</a><br />';
			}
		}
	}
	?>
	<!-- <form>
    	<label for="go_store">
		<input type="submit" value="<?php //the_title(); echo ' ('.$go_gold_req.')'; ?>" <?php //if ($user_points >= $go_rank_key) { } else { echo "disabled"; } ?> />
    	</label>
    </form>
    -->
<?php
endif;
}
add_shortcode ('go_store', 'go_gold_store_sc');
?>