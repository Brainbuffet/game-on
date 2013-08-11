<?php

function go_ranks() {
global $wpdb;
$dir = plugin_dir_url(__FILE__);
add_menu_page('Ranks options', 'Ranks', 'manage_options', 'go_ranks_settings', 'go_ranks_menu');
}

function go_ranks_menu() {
		global $wpdb;
	if (!current_user_can('manage_options'))  { 
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	else{
		
		$ranks = get_option('go_ranks',false);
		if(!$ranks){
			$ranks = array('Level 1'=>0);
			}
			
		
			
			
		?>
     <div>   <table style="width:250px;" id="ranks_table" class="widefat">
        <th style="width:125px;">Rank</th>
        <th style="width:125px;"><?php echo get_option('go_points_name'); ?></th><tbody id="table_rows">
        <?php  
		foreach($ranks as $level => $points){
			echo '<tr><td>'.$level.'</td><td>'.$points.'</td><td><button onclick="go_remove_ranks(\''.$level.'\');">Remove</button></td></tr>';
			
			}
		?>
      </tbody>
        </table>
        </div>
        <div class="widefat">
        Ranks: <textarea id="ranks"></textarea>
        <?php echo get_option('go_points_name');?>: <textarea id="points"></textarea>
        Separator: <textarea id="separator"></textarea><button onclick="go_add_ranks();" >+</button>
        </div>
        <script language="javascript">
function go_add_ranks(){
ajaxurl = '<?= get_site_url() ?>/wp-admin/admin-ajax.php';
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'go_add_ranks', ranks: jQuery('#ranks').val(), points: jQuery('#points').val(), separator: jQuery('#separator').val()},
		success: function(html){
			jQuery('#table_rows').html(html);;
		}
	}); }
	
	function go_remove_ranks(rank_key){
ajaxurl = '<?= get_site_url() ?>/wp-admin/admin-ajax.php';
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'go_remove_ranks', ranks: rank_key},
		success: function(html){
			jQuery('#table_rows').html(html);;
		}
	}); }
</script>
        <?php
		
		}
	
	}
	
function go_add_ranks(){
	global $wpdb;
	$new_ranks = $_POST['ranks'];
	$points = $_POST['points'];
	$separator = $_POST['separator'];
	$ranks = get_option('go_ranks',false);
	if(!$ranks){
		$ranks = array('Level 1'=> 0);
		} 
	if($separator == ''){
		if(is_numeric($points)){
		$ranks[$new_ranks] =  $points;
		}}
	else{
		$new_ranks = explode($separator,$new_ranks);
		$points = explode($separator,$points);
		foreach($new_ranks as $index => $new_ranks){
			$ranks[$new_ranks] = $points[$index];
			}
		}
	
	
	asort($ranks);
	update_option( 'go_ranks', $ranks );
	foreach($ranks as $ranks => $points){
		echo '<tr><td>'.$ranks.'</td><td>'.$points.'</td><td><button onclick="go_remove_ranks(\''.$ranks.'\');">Remove</button></td></tr>';
		}
		die();
	}	

function go_remove_ranks(){
	global $wpdb;
	$new_ranks = $_POST['ranks'];
	$ranks = get_option('go_ranks',false);
	unset($ranks[$new_ranks]);
		update_option( 'go_ranks', $ranks );
foreach($ranks as $ranks => $points){
		echo '<tr><td>'.$ranks.'</td><td>'.$points.'</td><td><button onclick="go_remove_ranks(\''.$ranks.'\');">Remove</button></td></tr>';
		}
		die();
	}
	
function go_update_ranks($user_id, $total_points){
	global $wpdb;
	global $current_rank;
	go_get_rank($user_id);
	global $current_rank_points;
	global $next_rank;
	global $next_rank_points;
	global $current_points;
	if($next_rank != ''){
	if($total_points >= $next_rank_points){
		
		$ranks = get_option('go_ranks');
		$ranks_keys = array_keys($ranks);
		$new_rank_key = array_search($next_rank, $ranks_keys);
		$new_next_rank = $ranks_keys[($new_rank_key+1)];
		
		$new_rank = array(array($next_rank, $next_rank_points),	array($new_next_rank, $ranks[$new_next_rank]));
		update_user_meta($user_id, 'go_rank', $new_rank);
		$update = true;}}
		else {
			$ranks = get_option('go_ranks', false);
 $current_points = go_return_points($uids);
 while($current_points >= current($ranks)){
	 next($ranks);
	 }
 $next_rank_points = current($ranks);
 $next_rank = array_search($next_rank_points, $ranks);
 $rank_points = prev($ranks);
 $new_rank = array_search($rank_points, $ranks);
 $new_rank_array= array(array($new_rank, $rank_points),array($next_rank, $next_rank_points));
  update_user_meta($uids,'go_rank', $new_rank_array );
		$update = true;}
			if($update){
		go_get_rank($user_id);
		global $current_rank;
	global $current_rank_points;
	global $next_rank;
	global $next_rank_points;
		global $counter;
	$counter++;
	$space = $counter*85;
	echo '<div id="go_notification" class="go_notification" style="top: '.$space.'px; color: #FFD700;"> '.$current_rank.'!</div><script type="text/javascript" language="javascript">go_notification();
		jQuery("#go_admin_bar_rank").html("'.$current_rank.'");
	</script>';
		
		
	}
	}

function go_get_rank($user_id) {
	global $wpdb;
	$rank = get_user_meta($user_id, 'go_rank');
	global $current_rank;
	global $current_rank_points;
	global $next_rank;
	global $next_rank_points;
		$current_rank = $rank[0][0][0];
	$current_rank_points = $rank[0][0][1];
	$next_rank = $rank[0][1][0];
	$next_rank_points = $rank[0][1][1];
}
function go_get_all_ranks() {
	$all_ranks = get_option('go_ranks');
	$all_ranks_sorted = array();
	 foreach($all_ranks as $level => $points) {
		 $all_ranks_sorted[] = array('name' => $level , 'value' => $points);
		 }
	return $all_ranks_sorted;
}
function go_clean_ranks() {
	$all_ranks = get_option('go_ranks');
	$all_ranks_sorted = array();
	foreach($all_ranks as $level => $points) {
    	echo '<option value="'.$points.'">'.$level.'</option>';
	}
}
function go_get_rank_key($points) {
	global $wpdb;
	$ranks = get_option('go_ranks',false);
	foreach ($ranks as $key => $rank ) {
		switch($rank) {
			case $points:
				return $key;
				break;
		}
	}
}
?>
