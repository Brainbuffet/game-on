<?php
//Task Includes
include('tasks/task.php');

//Store Includes
include('store/super-store.php');

// Meta Boxes
function go_init_mtbxs() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';
}
function go_mta_con_meta( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'go_mta_';
	// Tasks Meta Boxes
	$meta_boxes[] = array(
		'id'         => 'go_mta_metabox',
		'title'      => 'Task Options',
		'pages'      => array( 'tasks' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Required Rank',
				'desc' => 'rank required to begin task',
				'id'   => $prefix . 'req_rank',
				'type' => 'select',
				'options' => go_get_all_ranks()
			),
			array(
				'name' => 'Points',
				'desc' => 'points awarded for encountering, accepting, completing, and mastering the task. (comma seperated, e.g. 10,20,50,70)',
				'id'   => $prefix . 'task_points',
				'type' => 'text',
			),
			array(
				'name' => 'Currency',
				'desc' => 'currency awarded for encountering, accepting, completing, and mastering the task. (comma seperated, e.g. 10,20,50,70)',
				'id'   => $prefix . 'task_currency',
				'type' => 'text',
			),
			array(
				'name' => 'Mastery Message (Optional)',
				'desc' => 'Enter a message for the user to recieve when they have completed the task',
				'id' => $prefix . 'mastery_message',
				'type' => 'wysiwyg',
				'options' => array(
	    			'wpautop' => true, // use wpautop?
	    			'media_buttons' => true, // show insert/upload button(s)
	    			'textarea_name' => 'mastery_message', // set the textarea name to something different, square brackets [] can be used here
	    			'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
	    			'teeny' => false, // output the minimal editor config used in Press This
	    			'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
	    			'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
	    			'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()	
					),
				),
				array(
					'name' => 'Repeatable',
					'desc' => ' wether or not the task can be repeated',
					'id'   => $prefix . 'task_repeat',
					'type' => 'checkbox'
				),
			),
		);
	// Store Meta Boxes
	$meta_boxes[] = array(
		'id'         => 'go_mta_metabox',
		'title'      => 'Store Item Options',
		'pages'      => array( 'go_store' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Required Rank',
				'desc' => 'rank required to purchase the item',
				'id'   => $prefix . 'store_rank',
				'type' => 'select',
				'options' => go_get_all_ranks()
			),
			array(
				'name' => 'Price',
				'desc' => 'currency required to purchase the item',
				'id'   => $prefix . 'store_currency',
				'type' => 'text',
			),
			array(
				'name' => 'Repeatable',
				'desc' => ' wether or not the item can be bought more than once',
				'id'   => $prefix . 'store_repeat',
				'type' => 'checkbox'
			),
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'go_mta_con_meta' );
add_action( 'init', 'go_init_mtbxs', 9999 );

?>