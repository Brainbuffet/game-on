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

function go_sub_option($explanation_name, $explanation, $title, $field_name, $option_name, $explanation_question){ ?>
	    <div class="pa">
            	<?php go_opt_help($explanation_name,$explanation); ?> 
            	<strong><?php echo $title; ?>:</strong><br />  
                <input type="text" name="<?php echo $field_name; ?>" size="45" value="<?php echo get_option($option_name); ?>" /><br />
                <i><?php echo $explanation_question; ?></i> 
            </div> <?php
            
	}
	
function go_sub_option_radio($explanation_name, $explanation, $title, $field_name, $option_name, $explanation_question){ ?>
	    <div class="pa">
            	<?php go_opt_help($explanation_name,$explanation); ?> 
            	<strong><?php echo $title; ?>:</strong><br />  
                   On:<input type="radio" <?php if(get_option($option_name) == 'On'){echo 'checked="checked"';} ?> name="<?php echo $option_name; ?>" size="45" value="On" /><br />
                Off:<input type="radio" <?php if(get_option($option_name) == 'Off'){echo 'checked="checked"';} ?> name="<?php echo $option_name; ?>" size="45" value="Off" /><br />
                <i><?php echo $explanation_question; ?></i> 
            </div> <?php
            
	}	
add_action('go_sub_option','go_sub_option');
add_action('go_sub_option_radio','go_sub_option_radio');
function game_on_options() { ?>  
    <div class="go-wrap">  
        <h2>Game On Options</h2>  
        <form method="post" action="options.php">  
            <?php wp_nonce_field('update-options') ?> 
            <div id="tsk" class="opt-box">
            <h3>Task Settings</h3>
            <?php
			echo	go_sub_option( 'tasks_name', 'This is the word that will be used in place of Task all over your website. Make sure that it is singular (e.g. Assignment, Quest)', 'Singular Tasks Name', 'go_tasks_name', 'go_tasks_name', 'what would you like tasks to be called? (singular)' );
			echo	go_sub_option('tasks_plural_name','This is the word used in place of Task all over your website. Use only plural words here (e.g. Assignments, Quests)','Plural Tasks Name', 'go_tasks_plural_name', 'go_tasks_plural_name', 'what would you like tasks to be called? (plural)' );
		
			echo	go_sub_option( 'first_stage_name', 'This is the word that will be used for the first stage of the Task stages which is triggered upon visting the page for the first time. Such as Encountered.', 'First Stage Name', 'go_first_stage_name', 'go_first_stage_name', 'What would you like the first stage to be called?'  );
			echo	go_sub_option( 'second_stage_name', 'This is the word that will be used for the second stage of Task stages. Such as Accepted.', 'Second Stage Name', 'go_second_stage_name','go_second_stage_name', 'What would you like the second stage to be called?' );
			echo	go_sub_option('second_stage_button', 'This is the word that will be displayed on the button for the second stage of Task stages. Such as Accept', 'Second Stage Button', 'go_second_stage_button', 'go_second_stage_button', 'What would you like the button for the second stage to say?');
			echo	go_sub_option( 'third_stage_name', 'This is the word that will be used for the third stage of Task stages. Such as Completed.', 'Third Stage Name', 'go_third_stage_name','go_third_stage_name', 'What would you like the third stage to be called?' );
			echo	go_sub_option('third_stage_button', 'This is the word that will be displayed on the button for the third stage of Task stages. Such as Complete', 'Third Stage Button', 'go_third_stage_button', 'go_third_stage_button', 'What would you like the button for the third stage to say?');
			echo	go_sub_option( 'fourth_stage_name', 'This is the word that will be used for the fourth stage of Task stages. Such as Mastered.', 'Fourth Stage Name', 'go_fourth_stage_name','go_fourth_stage_name', 'What would you like the fourth stage to be called?' );
			echo	go_sub_option('fourth_stage_button', 'This is the word that will be displayed on the button for the fourth stage of Task stages. Such as Master', 'Fourth Stage Button', 'go_fourth_stage_button', 'go_fourth_stage_button', 'What would you like the button for the fourth stage to say?');

?> 
        
           
            </div>
            <br />
            <div id="curr" class="opt-box">
            <h3>Currency Settings</h3>
            <?php 
            
           echo  go_sub_option('currency_name', 'This is what your currency will be called. Use a name like Dollars, or Gold.','Currency Name','go_currency_name', 'go_currency_name', 'what would you like currency to be called?' ); 
			echo go_sub_option( 'tasks_currency_prefix', 'The prefix symbol used to represent your currency, such as a dollar sign.', 'Currency Prefix', 'go_currency_prefix', 'go_currency_prefix', 'what prefix would you like associated with currency? (Optional)' ); 
			echo go_sub_option( 'tasks_currency_suffix', 'The suffix symbol used to represent your currency, such as Dollar.', 'Currency Suffix', 'go_currency_suffix', 'go_currency_suffix', 'what suffix would you like associated with currency? (Optional)' ); 
            ?>
        
            
            
            
            </div><br />

             
            
         
            
            
            
            
            
            
            

            <br />
            <div id="poi" class="opt-box">       
            <h3>Points Settings</h3>
           <?php echo go_sub_option('tasks_points_name', 'This is what your points will be called. Use a name like Points, or Experience.', 'Points Name', 'go_points_name', 'go_points_name', 'what would you like points to be called?');
          echo  go_sub_option( 'tasks_points_prefix', 'The prefix symbol used to represent your points, such as a dollar sign.', 'Points Prefix', 'go_points_sym', 'go_points_prefix', 'what prefix would you like associated with points? (Optional)' ); 
			echo go_sub_option( 'tasks_points_suffix', 'The suffix symbol used to represent your points, such as Exp.', 'Points Suffix', 'go_points_suffix', 'go_points_suffix', 'what suffix would you like associated with points? (Optional)' );  ?>
          
          
            </div>
            
            
              <br />
            <div class="opt-box">       
            <h3> Admin Bar Settings</h3>
       
          <?php
		 echo go_sub_option_radio( 'admin_bar_add_trigger', 'Turn on and off the add section of the admin bar.','Add Switch', 'go_admin_bar_add_switch','go_admin_bar_add_switch', 'Would you like to have the Add section of the admin bar?');
		   ?><br />

            </div>
                   <div class="opt-box">       
            <h3> Classifications </h3>
       <div class="pa">
        
       		<ul id="sortable_go_periods">
       <?php
	   $periods = get_option('go_periods',false);
	   if($periods){
		   foreach($periods as $key=>$value){ 
	    ?>
       <li class="ui-state-default" class="go_list"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><input id="go_periods_input" type="text" value="<?php echo $value; ?>"/></li> 
<?php     }
	   } 
?>
       </ul>
       <input type="button" style="width:100%;" onclick="go_periods_new_input();" id="go_periods_add_input" value="New" />
       <input type="button" style="width:100%;" onclick="go_periods_save();" id="go_periods_add_input" value="Save Classifications" />
        </div>
   <?php
go_style_periods();
go_jquery_periods();  
		  ?>
            </div>
            
            
            <span class="opt-inp"><input type="submit" name="Submit" value="Save Options" /> </span> 
            <input type="hidden" name="action" value="update" />  
            <input type="hidden" name="page_options" value="go_tasks_name,go_tasks_plural_name,go_currency_name,go_points_name,go_first_stage_name,go_second_stage_name,go_second_stage_button,go_third_stage_name,go_third_stage_button,go_fourth_stage_name,go_fourth_stage_button,go_currency_prefix,go_currency_suffix, go_points_prefix, go_points_suffix, go_admin_bar_add_switch" />  
        </form>
        <?php /*
      */
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
       <li class="ui-state-default" class="go_list"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><input id="go_periods_input" type="text" value="<?php echo $value; ?>"/></li> <?php }} 
die();
}
?>