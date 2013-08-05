<?php function go_options() {
global $wpdb;
$dir = plugin_dir_url(__FILE__);
add_menu_page('GameOn Options', 'Options', 'manage_options', 'go_options', 'go_options_menu');
}

function go_options_menu() {
		global $wpdb;
	if (!current_user_can('manage_options'))  { 
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	else{
		
		
		?>
        <h1>GameOn Options Page</h1>
        
        
        
        <?php
		
		
	} 
}
	?>