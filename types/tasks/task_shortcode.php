<?php
// Task Shortcode
function go_task_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => '', // ID defined in Shortcode
		'cats' => '', // Cats defined in Shortcode     
	), $atts) );
	$user_ID = get_current_user_id(); // User ID
	if ($id) {
		$custom_fields = get_post_custom($id); // Just gathering some data about this task with its post id
		$req_rank = $custom_fields['go_mta_req_rank'][0]; // Required Rank to accept Task
		global $current_points;
		if ($current_points < $req_rank) {
			$points = $req_rank - $current_points;
			echo 'You need '.$points.' points to begin this task.';
		} else {
		$task_currency = $custom_fields['go_mta_task_currency'][0]; // Currency granted after each stage of task
		$task_points = $custom_fields['go_mta_task_points'][0]; // Points granted after each stage of task
		$repeat = $custom_fields['go_mta_task_repeat'][0]; // Whether or not you can repeat the task
		$completion_message = $custom_fields['go_mta_complete_message'][0]; // Completion Message
		$mastery_message = $custom_fields['go_mta_mastery_message'][0]; // Mastery Message
		$description = $custom_fields['go_mta_quick_desc'][0]; // Description
		$currency_array = explode(',', $task_currency); // Makes an array out of currency values for each stage
		$points_array = explode(',', $task_points); //Makes an array out of currency values for each stage
		// Stage Stuff
		$content_post = get_post($id);
		$task_content = $content_post->post_content;
		global $wpdb;
	$user_ID = get_current_user_id(); // User ID
	$go_table_ind = $wpdb->prefix.'go';
$status = (int)$wpdb->get_var("select status from ".$go_table_ind." where post_id = $id and uid = $user_ID");
?> <div id="go_description"> <?php echo  do_shortcode(wpautop($description)) ;?> </div><?php
		switch ($status) {
			case '': // This one's for you First Timers out there...
				go_add_post($user_ID, $id, 0, $points_array[0], $currency_array[0]);
?>
				<div id="go_content"> <br />
				<button id="go_button" status="2" onclick="task_stage_change();"><?= get_option('go_second_stage_button') ?></button>
            	</div>
<?php			break;
			case '1': // Encountered
?>
				<div id="go_content"> <br />
				<button id="go_button" status= "2" onclick="task_stage_change();"><?= get_option('go_second_stage_button') ?></button>
         		</div>   
<?php
				break;
			case '2': // Accepted
				echo '<div id="go_content">'. do_shortcode(wpautop($task_content)).'<br /> <button id="go_button" status="3" onclick="task_stage_change();">'.get_option('go_third_stage_button').'</button></div>';
				break;
			case '3': // Completed
				echo '<div id="go_content">'. do_shortcode(wpautop($task_content)).''.do_shortcode(wpautop($completion_message)).'<br /> <button id="go_button" status="4" onclick="task_stage_change();">'.get_option('go_fourth_stage_button').'</button></div>';
				break;
			case '4': // Mastered 
				echo'<div id="go_content">'. do_shortcode(wpautop($task_content)).do_shortcode(wpautop($completion_message));
				do_shortcode(wpautop($mastery_message));
				if ($repeat == 'on') {
				echo '<button id="go_button" status="1" onclick="task_stage_change();">Repeat</button></div>';
					} else {
				echo '</div>';
				}
				break;		
		}
?>
		
	<script language="javascript">
		function task_stage_change(){
			ajaxurl = '<?php echo get_site_url() ?>/wp-admin/admin-ajax.php';
			jQuery.ajax({
			type: "post",
			url: ajaxurl,
			data: { 
				action: 'task_change_stage', 
				post_id: <?php echo $id ?>, 
				user_id: <?php echo $user_ID ?>, 
				status: jQuery('#go_button').attr('status')  },
				success: function(html){
					jQuery('#go_content').html(html);
				}
			});	
		}
	</script>
		
<?php
		echo $the_stage; // Just for Testing Purposes
		edit_post_link('Edit '.get_option('go_tasks_name'), '<br />
<p>', '</p>', $id);
	}
	}
}
add_shortcode('go_task','go_task_shortcode');
function task_change_stage(){
	global $wpdb;
	$task_id = $_POST['post_id'];
	$user_id = $_POST['user_id'];
	$status = $_POST['status'];
		$custom_fields = get_post_custom($task_id); // Just gathering some data about this task with its post id
		$req_rank = $custom_fields['go_mta_req_rank'][0]; // Required Rank to accept Task
		$task_currency = $custom_fields['go_mta_task_currency'][0]; // Currency granted after each stage of task
		$task_points = $custom_fields['go_mta_task_points'][0]; // Points granted after each stage of task
		$repeat = $custom_fields['go_mta_task_repeat'][0]; // Whether or not you can repeat the task
		$completion_message = $custom_fields['go_mta_complete_message'][0]; // Completion Message
		$mastery_message = $custom_fields['go_mta_mastery_message'][0]; // Mastery Message
		$description = $custom_fields['go_mta_quick_desc'][0]; // Description
		$currency_array = explode(',', $task_currency); // Makes an array out of currency values for each stage
		$points_array = explode(',', $task_points); //Makes an array out of currency values for each stage
		// Stage Stuff
		$content_post = get_post($task_id);
		$task_content = $content_post->post_content;
	go_add_post($user_id, $task_id, $status, $points_array[$status-1], $currency_array[$status-1]  );
	switch($status) {
		case 1:
			echo '<div id="go_content">'.do_shortcode(wpautop($task_content, false)).' <button id="go_button" status="2" onclick="task_stage_change();">'.get_option('go_second_stage_button').'</button></div>';
			break;
		case 2:
			echo '<div id="go_content">'.do_shortcode(wpautop($task_content, false)).' <button id="go_button" status="3" onclick="task_stage_change();">'.get_option('go_third_stage_button').'</button></div>';
			break;
		case 3:
			echo '<div id="go_content">'.do_shortcode(wpautop($task_content, false)).do_shortcode(wpautop($completion_message)).' <button id="go_button" status="4" onclick="task_stage_change();">'.get_option('go_fourth_stage_button').'</button</div>';
			break;
		case 4:
			echo '<div id="go_content">'.do_shortcode(wpautop($task_content, false)).do_shortcode(wpautop($completion_message));
			do_shortcode(wpautop($mastery_message));
			if ($repeat == 'on') {
				echo '<button id="go_button" status="1" onclick="task_stage_change();">Repeat</button></div>';
			} else {
				echo '</div>';
			}
			break;
	}
die();
}
?>