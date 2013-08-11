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

	if($status == 0){
		$wpdb->insert($table_name_go, array('uid'=> $user_id, 'post_id'=> $post_id, 'status'=> 1, 'points'=> $points, 'currency'=>$currency));
		} else {
			$old_points = $wpdb->get_results("select points, currency from ".$table_name_go." where uid = $user_id and post_id = $post_id ");
			$wpdb->update($table_name_go,array('status'=>$status, 'points'=>$points+ $old_points['points'], 'currency'=> $currency+$old_points['currency']), array('uid'=>$user_id, 'post_id'=>$post_id));
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
	go_update_totals($user_id,0,0,$minutes);
	}
	
	
function go_notify($type, $points='', $currency='', $time='') {
	if ($points < 0 || $currency < 0) {
		$sym = '-';
	} else {
		$sym = '+';
	}
	global $counter;
	$counter++;
	$space = $counter*85;
	echo '<div id="go_notification" class="go_notification" style="top: '.$space.'px">'.$sym.$points.' '.$type.'</div><script type="text/javascript" language="javascript">go_notification();</script>';
}

function go_update_admin_bar($type, $title, $points_currency){
	echo '<script language="javascript">
		jQuery("#go_admin_bar_'.$type.'").html("'.$points_currency.' '.$title.'");
	</script>';
	}


//Update totals
function go_update_totals($user_id,$points, $currency, $minutes){
	global $wpdb;
	if($points != 0){
		
		$table_name_go_totals = $wpdb->prefix . "go_totals";
		$totalpoints = go_return_points($user_id);
		$wpdb->update($table_name_go_totals, array('points'=> $totalpoints+$points), array('uid'=>$user_id));
		go_update_ranks($user_id, ($totalpoints+$points));
		go_notify(get_option('go_points_name'), $points);
		$p = (string)($totalpoints+$points);
		go_update_admin_bar(strtolower(get_option('go_points_name')),get_option('go_points_name'),$p);
		}
	if($currency != 0){
		$table_name_go_totals = $wpdb->prefix . "go_totals";
		$totalcurrency = go_return_currency($user_id);
		$wpdb->update($table_name_go_totals, array('currency'=> $totalcurrency+$currency), array('uid'=>$user_id));
		go_notify(get_option('go_currency_name'), $currency);
		go_update_admin_bar(strtolower(get_option('go_currency_name')), get_option('go_currency_name'), ($totalcurrency+$currency));
		}
	if($minutes != 0){
		$table_name_go_totals = $wpdb->prefix . "go_totals";
		$totalminutes = go_return_minutes($user_id);
		$wpdb->update($table_name_go_totals, array('minutes'=> $totalminutes+$minutes), array('uid'=>$user_id));
		go_notify('Minutes', $minutes);
		}
	}

?>