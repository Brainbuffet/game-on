<?php
if (is_admin()) {
function go_opt_help($field, $title) {
	echo '<a id="go_help_'.$field.'" class="go_opt_help" onclick="" title="'.$title.'">?</a>';
}
function go_opt_style() {
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
            <div class="pa">
            	<?php go_opt_help('tasks_name', 'This is the word that will be used in place of Task all over your website. Make sure that it is singular (e.g. Assignment, Quest)'); ?> 
            	<strong>Singular Tasks Name:</strong><br />
                <input type="text" name="go_tasks_name" size="45" value="<?php echo get_option('go_tasks_name'); ?>" /><br />
                <i>what would you like tasks to be called? (singular)</i> 
            </div>
            <div class="pa">
            	<?php go_opt_help('tasks_plural_name', 'This is the word used in place of Task all over your website. Use only plural words here (e.g. Assignments, Quests)'); ?> 
            	<strong>Plural Tasks Name:</strong><br />  
                <input type="text" name="go_tasks_plural_name" size="45" value="<?php echo get_option('go_tasks_plural_name'); ?>" /><br />
                <i>what would you like tasks to be called? (plural)</i> 
            </div>
            </div>
            <br />
            <div id="curr" class="opt-box">
            <h3>Currency Settings</h3>
            <div class="pa">
            	<?php go_opt_help('tasks_currency_name','This is what your currency will be called. It could be everything from Bread to Franks.'); ?> 
            	<strong>Currency Name:</strong><br />  
                <input type="text" name="go_currency_name" size="45" value="<?php echo get_option('go_currency_name'); ?>" /><br />
                <i>what would you like currency to be called?</i> 
            </div>
            <div class="pa">
            	<?php go_opt_help('tasks_currency_sym', 'The symbol used to represent your currency, such as a dollar sign.'); ?> 
            	<strong>Currency Symbol:</strong><br />  
                <input type="text" name="go_currency_sym" size="45" value="<?php echo get_option('go_currency_sym'); ?>" /><br /> 
                <i>what symbol would you like associated with points?</i> 
            </div>
            </div>
            <br />
            <div id="poi" class="opt-box">       
            <h3>Points Settings</h3>
            <div class="pa">
            	<?php go_opt_help('tasks_points_name', 'This is what your points will be called. Use a name like Points, or Experience.'); ?> 
            	<strong>Points Name:</strong><br /> 
                <input type="text" name="go_points_name" size="45" value="<?php echo get_option('go_points_name'); ?>" /><br />
                <i>what would you like points to be called?</i> 
            </div>
            <div class="pa">
            	<?php go_opt_help('tasks_points_sym', 'This is optional. You can use a symbol for points just like you do for currency.'); ?> 
                <strong>Points Symbol:</strong><br />  
                <input type="text" name="go_points_sym" size="45" value="<?php echo get_option('go_points_sym'); ?>" /><br />
                <i>what symbol would you like associated with points?</i>   
            </div>
            </div>
            <span class="opt-inp"><input type="submit" name="Submit" value="Save Options" /> </span> 
            <input type="hidden" name="action" value="update" />  
            <input type="hidden" name="page_options" value="go_tasks_name,go_tasks_plural_name,go_currency_name,go_currency_sym,go_points_name,go_points_sym" />  
        </form>
        <div id="periods_container">
       		<ul id="sortable_go_periods">
       <?php
	   $periods = get_option('go_periods',false);
	   if($periods){
		   foreach($periods as $key=>$value){ 
	    ?>
       <li class="ui-state-default" class="go_list"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><input id="go_periods_input" type="text" value="<?= $value ?>"/></li> 
<?php     }
	   } 
?>
       </ul>
       <button style="width:170px;" onclick="go_periods_new_input();" id="go_periods_add_input">New</button>
       <button style="width:170px;" onclick="go_periods_save();" id="go_periods_add_input">Save</button>
        </div>
    
<?php
go_style_periods();
go_jquery_periods();
}
function add_game_on_options() {  
    add_menu_page('Game On', 'Game On', 'manage_options', 'game-on-options.php','game_on_options', plugins_url( 'images/ico.png' , __FILE__ ), '81');  
}
add_action('admin_menu', 'add_game_on_options');
}

function go_periods_save(){
	$array = $_POST['periods_array'];
	foreach($array as $key=>$value){
		if ($value == ''){unset($array[$key]);}
	} 
update_option('go_periods',$array);
 $periods = get_option('go_periods',false);
	   if($periods){foreach($periods as $key=>$value){
		  
	    ?>
       <li class="ui-state-default" class="go_list"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><input id="go_periods_input" type="text" value="<?= $value ?>"/></li> <?php }} 
die();
}
?>