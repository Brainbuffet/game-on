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
		'title'      => get_option('go_tasks_name').' Options',
		'pages'      => array( 'tasks' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Quick Description',
				'desc' => 'Enter a quick description for what this is about',
				'id' => $prefix . 'quick_desc',
				'type' => 'wysiwyg',
        		'options' => array(
           			'wpautop' => true,
          			'textarea_rows' => '5',
           		),
			),
			array(
				'name' => 'Required Rank',
				'desc' => 'rank required to begin '.get_option('go_tasks_name'),
				'id'   => $prefix . 'req_rank',
				'type' => 'select',
				'options' => go_get_all_ranks()
			),
			array(
				'name' => 'Points',
				'desc' => 'points awarded for encountering, accepting, completing, and mastering the '.get_option('go_tasks_name').'. (comma seperated, e.g. 10,20,50,70)',
				'id'   => $prefix . 'task_points',
				'type' => 'text',
			),
			array(
				'name' => 'Currency',
				'desc' => 'currency awarded for encountering, accepting, completing, and mastering the '.get_option('go_tasks_name').'. (comma seperated, e.g. 10,20,50,70)',
				'id'   => $prefix . 'task_currency',
				'type' => 'text',
			),
			array(
				'name' => 'Completion Message (Optional)',
				'desc' => 'Enter a message for the user to recieve when they have <i>completed</i> the '.get_option('go_tasks_name'),
				'id' => $prefix . 'complete_message',
				'type' => 'wysiwyg',
        		'options' => array(
           			'wpautop' => true,
           			'textarea_rows' => '5',
         		),
				),
			array(
				'name' => 'Mastery Message (Optional)',
				'desc' => 'Enter a message for the user to recieve when they have <i>mastered</i> the '.get_option('go_tasks_name'),
				'id' => $prefix . 'mastery_message',
				'type' => 'wysiwyg',
        		'options' => array(
           			'wpautop' => true,
           			'textarea_rows' => '5',
         		),
				),
			array(
					'name' => 'Repeatable',
					'desc' => ' Select to make '.get_option('go_tasks_name').' repeatable',
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
