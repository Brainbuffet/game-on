<?php
// Task Shortcode
function go_task_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => '', // ID defined in Shortcode
		'cats' => '', // Cats defined in Shortcode
	), $atts) );
	$user_ID = get_current_user_id(); // User ID
	if ($id) {
		$the_meta_key = 'go_task_'.$id.'_stage'; // Task stage key
		$the_stage = get_user_meta($user_ID, $the_meta_key, true); // Task stage value (1:encountered, 2:accepted, 3:completed, 4:mastered)
		$custom_fields = get_post_custom($id); // Just gathering some data about this task with its post id
		$req_rank = $custom_fields['go_mta_req_rank'][0]; // Required Rank to accept Task
		$task_currency = $custom_fields['go_mta_task_currency'][0]; // Currency granted after each stage of task
		$task_points = $custom_fields['go_mta_task_points'][0]; // Points granted after each stage of task
		$repeat = $custom_fields['go_mta_task_repeat'][0]; // Whether or not you can repeat the task
		$currency_array = explode(',', $task_currency); // Makes an array out of currency values for each stage
		$points_array = explode(',', $task_points); //Makes an array out of currency values for each stage
		// Stage Stuff
		switch ($the_stage) {
			case '': // This one's for those First Timers out there...
				add_user_meta($user_ID, $the_meta_key, '1', false); // Make the task stage value 1 (1:encountered, 2:accepted, 3:completed, 4:mastered)
				break;
			case '1': // Encountered
				
				break;
			case '2': // Accepted
				
				break;
			case '3': // Completed
				
				break;
			case '4': // Mastered
				
				break;
			
		}
		echo $the_stage; // Just for Testing Purposes
	}
}
add_shortcode('go_task','go_task_shortcode');
?>