<?php

function testbutton(){
	?>
    <form method="post" action="">
    <input type="submit" name="button" />
    </form>
    <?php
	
	if(isset($_POST['button'])){
update_totals( 15, 0, 11, 0);		}
	
	
	}

//adds currency and points for reasons that are not post tied.


function go_add_currency($user_id, $reason, $status, $points, $currency, $update){
	
	global $wpdb;
	   $table_name_go = $wpdb->prefix . "go";

	if($update == false){
		$wpdb->insert($table_name_go, array('uid'=> $user_id, 'reason'=> $reason, 'status'=> $status, 'points'=> $points, 'currency'=>$currency));
		} else if($update == true) {
			$wpdb->update($table_name_go,array('status'=>$status, 'points'=>$points, 'currency'=> $currency), array('uid'=>$user_id, 'reason'=>$reason));
			}
	
	}




// Adds currency and points for reasons that are post tied.

function go_add_post($user_id, $post_id, $status, $points, $currency){
	
	global $wpdb;
	   $table_name_go = $wpdb->prefix . "go";

	if($status == 1){
		$wpdb->insert($table_name_go, array('uid'=> $user_id, 'post_id'=> $post_id, 'status'=> $status, 'points'=> $points, 'currency'=>$currency));
		} else {
			$wpdb->update($table_name_go,array('status'=>$status, 'points'=>$points, 'currency'=> $currency), array('uid'=>$user_id, 'post_id'=>$post_id));
			}
	
	
	go_update_totals($user_id,$points,$currency,0);
	
	}
	
// Adds minutes.

function go_add_minutes($user_id, $minutes, $reason){
	global $wpdb;
	$table_name_go = $wpdb->prefix . "go";
	$time = date('m/d@H:i',current_time('timestamp',0));
	$minutes_reason = array('reason'=>$reason, 'time'=>$time);
	$minutes_reason_serialized = serialize($minutes_reason);
	$wpdb->insert($table_name_go, array('uid'=> $user_id, 'minutes'=> $minutes, 'reason'=> $minutes_reason_serialized) );
	}
	
	
//Update totals
function go_update_totals($user_id,$points, $currency, $minutes){
	global $wpdb;
	if($points != 0){
		$table_name_go_totals = $wpdb->prefix . "go_totals";
		$totalpoints = go_return_points($user_id);
		$wpdb->update($table_name_go_totals, array('points'=> $totalpoints+$points), array('uid'=>$user_id));
		go_update_ranks($user_id, $points);
		}
	if($currency != 0){
		$table_name_go_totals = $wpdb->prefix . "go_totals";
		$totalcurrency = go_return_currency($user_id);
		$wpdb->update($table_name_go_totals, array('currency'=> $totalcurrency+$currency), array('uid'=>$user_id));
		}
	if($minutes != 0){
		$table_name_go_totals = $wpdb->prefix . "go_totals";
		$totalminutes = go_return_minutes($user_id);
		$wpdb->update($table_name_go_totals, array('minutes'=> $totalminutes+$minutes), array('uid'=>$user_id));
		}
	}

?>