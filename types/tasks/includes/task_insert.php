<?php
include('the_lightbox.php');
$item_id = $_GET["post"];
$go_post_type = get_post_type($item_id);
if ($go_post_type === 'tasks') {
function go_task_insert_bttn( $arg, $post_id ){
	global $is_resetable;
	if( ereg('edit-slug', $arg) ){
		$is_resetable = true;
		$arg .= '<span id="edit-slug button button-small hide-if-no-js"><a href="javascript:void(0);" onclick="tsk_admn_opnr();" class="button button-small" >Display Task... </a></span> ';
	}
	return $arg;
} 
add_filter( 'get_sample_permalink_html', 'go_task_insert_bttn',5,2 );
////////////////////////////////////////////////////////////////////////////////

function go_task_insert_link( $arg, $post_id ){
	global $is_resetable;
	global $wpdb;
if( ereg('edit-slug', $arg) ){
		$is_resetable = true;
		
			$go_page_ids = (int)$wpdb->get_var("SELECT `ID` FROM `".$wpdb->prefix.'posts'."` WHERE `post_parent` = 0 and `post_content` like '%go_task id=\'".$_GET['post']."\'%' limit 1");
			$option = '<a class="button button-small" target="_blank" href="'.get_permalink($go_page_ids) .'">'. get_the_title($go_page_ids).'</a>';
			$arg .= '<span id="edit-slug button button-small">'.$option.'
		</span> ';
		}
		
return $arg;
} 
add_filter( 'get_sample_permalink_html', 'go_task_insert_link',5,2 );

/////////////////////////////////////////////////////////////////////////////////
} else {
// Includes
include('pop-task.php');
function go_task_insert_bttn( $arg, $post_id ){
	global $is_resetable;
	if( ereg('edit-slug', $arg) ){
		$is_resetable = true;
		$arg .= '<span id="edit-slug button button-small hide-if-no-js"><a href="javascript:void(0)" onclick="tsk_admn_opnr();" class="button button-small" >Insert Task</a></span> ';
	}
	return $arg;
} 
add_filter( 'get_sample_permalink_html', 'go_task_insert_bttn',5,2 );
}
?>