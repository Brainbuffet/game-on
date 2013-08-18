<?php
// Includes
include('meta-boxes.php');
// Task custom post type
function register_cpt_task() {
    $labels = array( 
        'name' => _x( 'Tasks', 'task' ),
        'singular_name' => _x( 'Task', 'task' ),
        'add_new' => _x( 'Add New Task', 'task' ),
        'add_new_item' => _x( 'Add New Task', 'task' ),
        'edit_item' => _x( 'Edit Task', 'task' ),
        'new_item' => _x( 'New Task', 'task' ),
        'view_item' => _x( 'View Task', 'task' ),
        'search_items' => _x( 'Search Tasks', 'task' ),
        'not_found' => _x( 'No tasks found', 'task' ),
        'not_found_in_trash' => _x( 'No tasks found in Trash', 'task' ),
        'parent_item_colon' => _x( 'Parent Task:', 'task' ),
        'menu_name' => _x( 'Tasks', 'task' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Tasks',
        'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes' ),
        'taxonomies' => array( 'task_categories' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => plugins_url( '/ico.png' , __FILE__ ),
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'tasks', $args );
}

add_action( 'init', 'register_cpt_task' );

add_action( 'init', 'register_taxonomy_task_categories' );

function register_taxonomy_task_categories() {

    $labels = array( 
        'name' => _x( 'Task Categories', 'task_categories' ),
        'singular_name' => _x( 'Task Category', 'task_categories' ),
        'search_items' => _x( 'Search Task Categories', 'task_categories' ),
        'popular_items' => _x( 'Popular Task Categories', 'task_categories' ),
        'all_items' => _x( 'All Task Categories', 'task_categories' ),
        'parent_item' => _x( 'Task Category Parent', 'task_categories' ),
        'parent_item_colon' => _x( 'Parent Task Category:', 'task_categories' ),
        'edit_item' => _x( 'Edit Task Category', 'task_categories' ),
        'update_item' => _x( 'Update Task Category', 'task_categories' ),
        'add_new_item' => _x( 'Add New Task Category', 'task_categories' ),
        'new_item_name' => _x( 'New Task Category', 'task_categories' ),
        'separate_items_with_commas' => _x( 'Separate task categories with commas', 'task_categories' ),
        'add_or_remove_items' => _x( 'Add or remove task categories', 'task_categories' ),
        'choose_from_most_used' => _x( 'Choose from the most used task categories', 'task_categories' ),
        'menu_name' => _x( 'Task Categories', 'task_categories' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => false,
        'hierarchical' => true,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'task_categories', array('tasks'), $args );
}
?>