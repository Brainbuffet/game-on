<?php
// Stylesheet
function tsk_lb_style(){
    wp_register_style( 'tsk_lb_css', plugins_url( 'css/lb-style.css' , __FILE__ ), false, '1.0.0' );
    wp_enqueue_style( 'tsk_lb_css' );
}
add_action('admin_enqueue_scripts', 'tsk_lb_style');
//
function tsk_new_ajx(){
	global $user_id;
	$title = $_POST['theTitle'];
	$content = $_POST['theContent'];
	$description = $_POST['theDesc'];
	$rank = $_POST['theRank'];
	$points = $_POST['thePoints'];
	$currency = $_POST['theCurrency'];
	$mastery_message = $_POST['theMessage'];
	$repeat = $_POST['theRepeat'];
	if ($repeat == true) {
		$repeats = 'on';
	} else {
		$repeats = 'off';
	}
	$go_new_task = array(
		'post_title'    => $title,
		'post_content'  => $content,
		'post_status'   => 'publish',
		'post_author'   => $user_id,
		'post_category' => '',
		'post_type'     => 'tasks'
	);
	// Insert the post into the database
	$new_task_id = wp_insert_post($go_new_task);
	update_post_meta($new_task_id, 'go_mta_quick_desc', $description);
	update_post_meta($new_task_id, 'go_mta_req_rank', $rank);
	update_post_meta($new_task_id, 'go_mta_task_points', $points);
	update_post_meta($new_task_id, 'go_mta_task_currency', $currency);
	update_post_meta($new_task_id, 'go_mta_mastery_message', $mastery_message);
	update_post_meta($new_task_id, 'go_mta_task_repeat', $repeats);
	echo $new_task_id;
	die();
}
add_action('wp_ajax_tsk_new_ajx', 'tsk_new_ajx');
function task_admin_lb($the_task_id, $task_check) {
?>
<script type="text/javascript">
function tsk_admn_opnr() {
	document.getElementById('tsk_admin_light').style.display='block';;
	document.getElementById('tsk_admin_fade').style.display='block';;
}
function tsk_admn_clsr() {
	document.getElementById('tsk_admin_light').style.display='none';;
	document.getElementById('tsk_admin_fade').style.display='none';;
}

function new_task_ajax() {
	var lite_tsk_title = jQuery("#lte_tsk_title").val();
	var lite_tsk_content = jQuery("#lte_tsk_content").val();
	var lite_tsk_desc = jQuery("#lte_tsk_desc").val();
	var lite_tsk_rank = jQuery('#lte_tsk_rank option:selected').val();
	var lite_tsk_points = jQuery("#lte_tsk_points").val();
	var lite_tsk_currency = jQuery("#lte_tsk_currency").val();
	var lite_tsk_mastery_message = jQuery("#lte_tsk_mastery_message").val();
	var lite_tsk_repeat = jQuery('#lte_tsk_repeat').is(':checked');
	
	jQuery.ajax({
		type:"POST",
		url: ajaxurl,
		data: {  
  			action: 'tsk_new_ajx',
			theTitle: lite_tsk_title,
			theContent: lite_tsk_content,
			theDesc: lite_tsk_desc,
			theRank: lite_tsk_rank,
			thePoints: lite_tsk_points,
			theCurrency: lite_tsk_currency,
			theMessage: lite_tsk_mastery_message,
			theRepeat: lite_tsk_repeat,
  		},
		dataType : 'html',
		success:function(results){
			window.parent.send_to_editor('[go_task id="'+results+'"]');
			tsk_admn_clsr();
		},
		error: function(MLHttpRequest, textStatus, errorThrown){  
  			alert(errorThrown);
  		}
		});
}
</script>

        <div id="tsk_admin_light" class="tsk_content_light">
        	<div class="tsk_light_head">
        		<a class="tsk_light_closer" href="javascript:void(0);" onclick="tsk_admn_clsr();">Close</a>
        	</div>
            <div class="tsk_body_light">
            <?php if ($task_check == false) { ?>
                <form id="lite_new_tsk">
                	<table class="form-table cmb_metabox">
                	   <tr>
                        	<th style="width:18%">
                            	<label for="lte_tsk_title">Task Title</label>
                            </th> 
                          	<td>
                            	<input type="text" id="lte_tsk_title" />
                                <p class="cmb_metabox_description">Title of the Task</p>
                            </td>
                       </tr>
                    
                       <tr>
                       		<th style="width:18%">
                            	<label for="lte_tsk_content">Task Content</label>
                            </th> 
                            <td>
                            	<textarea id="lte_tsk_content" rows="4" cols="50"></textarea>
                                <p class="cmb_metabox_description">The main body content for your task</p>
                            </td>
                      </tr>
                    
                    <tr>
                    	<th style="width:18%">
                    		<label for="lte_tsk_desc">Quick Description</label>
                    	</th> <br>

						<td>
                    		<textarea id="lte_tsk_desc" rows="4" cols="50"></textarea>
                            <p class="cmb_metabox_description">Enter a (quick!) description of the task</p>
                   		</td>		
                    </tr>
                    
                    <tr>
                    	<th style="width:18%">
                        	<label for="lte_tsk_rank">Required Rank</label>
                        </th> 
                    	<td>
                    		<select id="lte_tsk_rank">
								<?php go_clean_ranks(); ?>
                    		</select>
                            <p class="cmb_metabox_description">rank required to begin task</p>
                    	</td>
                    </tr>
                    
                    <tr>
                    	<th style="width:18%">
                        	<label for="lte_tsk_points">Points</label>
                            
                        </th> 
                        <td>
                        	<input type="text" id="lte_tsk_points" />
                            <p class="cmb_metabox_description">points awarded for encountering, accepting, completing, and mastering the task. (comma seperated, e.g. 10,20,50,70)</p>
                        </td>
                    </tr>
                    
                    <tr>
                    	<th style="width:18%">
                    		<label for="lte_tsk_currency">Currency</label>
                        </th>
                        <td>
                        	<input type="text" id="lte_tsk_currency">
                        	<p class="cmb_metabox_description">currency awarded for encountering, accepting, completing, and mastering the task. (comma seperated, e.g. 10,20,50,70)</p>
                        </td>
                    </tr>
                    
                    <tr>
                       		<th style="width:18%">
                            	<label for="lte_tsk_mastery_message">Mastery Message</label>
                            </th> 
                            <td>
                            	<textarea id="lte_tsk_mastery_message" rows="4" cols="50"></textarea>
                                <p class="cmb_metabox_description">Enter a message for the user to recieve when they have mastered the task</p>
                            </td>
                      </tr>
                      
                    <tr>
                    	<th style="width:18%">
                    		<label for="lte_tsk_repeat">Repeatable</label>
                    	</th>
                    	<td>
                    		<input type="checkbox" id="lte_tsk_repeat">
                    		<span class="cmb_metabox_description">Select to make task repeatable</span>
                    	</td>
                    </tr>
                    
                </table>
                </form>
                <br />
                <div id="tsk_shortcode"></div>
                <a id="lte_tsk_submit" class="tsk_submitter" onclick="new_task_ajax();">Create Task</a>
                <br />
            <?php } elseif ($task_check == true) { ?>
            	<span>Select a task to insert!</span>
            <?php } ?>
            </div>
        </div>
        
        <div id="tsk_admin_fade" class="tsk_dark" onclick="tsk_admn_clsr();"></div>
<?php
}
function task_admin_lightbox_incl() {
	$task_id = $_GET["post"];
	$go_post_type = get_post_type($task_id);
		if ($go_post_type == 'tasks') {
			task_admin_lb($task_id, true);
		} else {
			task_admin_lb($task_id, false);
		}
}
add_action('admin_head', 'task_admin_lightbox_incl');
?>