<?php
if (is_admin()) {
function go_opt_style(){
    wp_register_style( 'go_opt_css', plugins_url( 'css/options.css' , __FILE__ ), false, '1.0.0' );
    wp_enqueue_style( 'go_opt_css' );
}
add_action('admin_enqueue_scripts', 'go_opt_style');
function game_on_options() { ?>  
    <div class="go-wrap">  
        <h2>Game On Options</h2>  
        <form method="post" action="options.php">  
            <?php wp_nonce_field('update-options') ?> 
            <div id="tsk" class="opt-box">
            <h3>Task Settings</h3>
            <p><strong>Singular Tasks Name:</strong><br />  
                <input type="text" name="go_tasks_name" size="45" value="<?php echo get_option('go_tasks_name'); ?>" /><br />
                <i>what would you like tasks to be called? (singular)</i> 
            </p>
            <p><strong>Plural Tasks Name:</strong><br />  
                <input type="text" name="go_tasks_plural_name" size="45" value="<?php echo get_option('go_tasks_plural_name'); ?>" /><br />
                <i>what would you like tasks to be called? (plural)</i> 
            </p>
            </div>
            <br />
            <div id="curr" class="opt-box">
            <h3>Currency Settings</h3>
            <p><strong>Currency Name:</strong><br />  
                <input type="text" name="go_currency_name" size="45" value="<?php echo get_option('go_currency_name'); ?>" /><br />
                <i>what would you like currency to be called?</i> 
            </p>
            <p><strong>Currency Symbol:</strong><br />  
                <input type="text" name="go_currency_sym" size="45" value="<?php echo get_option('go_currency_sym'); ?>" /><br /> 
                <i>what symbol would you like associated with points?</i> 
            </p>
            </div>
            <br />
            <div id="poi" class="opt-box">       
            <h3>Points Settings</h3>
            <p><strong>Points Name:</strong><br /> 
                <input type="text" name="go_points_name" size="45" value="<?php echo get_option('go_points_name'); ?>" /><br />
                <i>what would you like points to be called?</i> 
            </p>
            <p><strong>Points Symbol:</strong><br />  
                <input type="text" name="go_points_sym" size="45" value="<?php echo get_option('go_points_sym'); ?>" /><br />
                <i>what symbol would you like associated with points?</i>   
            </p>
            </div>
            <span class="opt-inp"><input type="submit" name="Submit" value="Store Options" /> </span> 
            <input type="hidden" name="action" value="update" />  
            <input type="hidden" name="page_options" value="go_tasks_name,go_tasks_plural_name,go_currency_name,go_currency_sym,go_points_name,go_points_sym" />  
        </form>  
    </div>  
<?php  
}
function add_game_on_options() {  
    add_menu_page('Game On', 'Game On', 'manage_options', 'game-on-options.php','game_on_options', plugins_url( 'images/ico.png' , __FILE__ ), '79');  
}
add_action('admin_menu', 'add_game_on_options');
}
?>