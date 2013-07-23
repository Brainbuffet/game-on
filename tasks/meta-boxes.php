<?php
function go_init_mtbxs() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';
}
function go_mta_con_meta( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'go_tsk_mta_';

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
				'name' => 'Repeatable',
				'desc' => ' wether or not the task can be repeated',
				'id'   => $prefix . 'repeat',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Points',
				'desc' => 'points awarded for encountering, accepting, completing, and mastering the task. (comma seperated, e.g. 10,20,50,70)',
				'id'   => $prefix . 'points',
				'type' => 'text',
			),
			array(
				'name' => 'Currency',
				'desc' => 'currency awarded for encountering, accepting, completing, and mastering the task. (comma seperated, e.g. 10,20,50,70)',
				'id'   => $prefix . 'currency',
				'type' => 'text',
			),
		),
	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'go_mta_con_meta' );
add_action( 'init', 'go_init_mtbxs', 9999 );
?>