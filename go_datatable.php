<?php

//Creates table for indivual logs.

function go_table_individual() {
   global $wpdb;

   $table_name = $wpdb->prefix . "go";
      
   $sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  uid INT,
  status INT,
  post_id INT,
  points INT,
  currency INT,
  minutes VARCHAR (200),
  reason VARCHAR (200),
  UNIQUE KEY  id (id)
    );";

   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
 
}



//Creates a table for totals.

function go_table_totals() {
   global $wpdb;

   $table_name = $wpdb->prefix . "go_totals";
      
   $sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  uid  INT,
  currency  INT,
  points  INT,
  minutes  VARCHAR (200),
  UNIQUE KEY  id (id)
    );";

   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
 
}



//Updates the totals upon activation of plugin.
function go_ranks_registration(){
	global $wpdb;
	$ranks = get_option('go_ranks',false);
		if(!$ranks){
			$ranks = array('Level 1'=>0);
			update_option('go_ranks',$ranks);
			}
	}

function go_install_data(){
	
	global $wpdb;
	 $table_name_user_meta = $wpdb->prefix . "usermeta";
	 $table_name_go_totals = $wpdb->prefix . "go_totals";

	$role = get_option('go_role','student');
	$uid = $wpdb->get_results("SELECT user_id
FROM ".$table_name_user_meta."
WHERE meta_key =  'wp_capabilities'
AND meta_value LIKE  '%student%'");
 foreach($uid as $id){
 foreach($id as $uids){
	 
	 
	 
 $rank_check =	get_user_meta($uids, 'go_rank');
 if(empty($rank_check)){ 
 $ranks = get_option('go_ranks', false);
 
  update_user_meta($uids,'go_rank' );
}




			$check = (int)$wpdb->get_var("select uid from ".$table_name_go_totals." where uid = $uids ");
				if($check == 0){
					$wpdb->insert( $table_name_go_totals,array( 'uid' => $uids ), array(  '%d' ) );
						} else {
		 					$wpdb->update( $table_name_go_totals, array( 'uid' => $uids), array( 'uid' => $uids ), array('%d'), array( '%d') ) ;
								}
				}
		}
}
	
//Adds user id to the totals table upon user creation.
function go_user_registration($user_id) {
 global $wpdb;
 global $role_default;
 $table_name_go_totals = $wpdb->prefix . "go_totals";
 $table_name_user_meta = $wpdb->prefix . "usermeta";
 $role = get_option('go_role',$role_default);
 $user_role = get_user_meta($user_id,'wp_capabilities', true);
 if(array_search(1, $user_role) == $role){
 $ranks = get_option('go_ranks', false);
 $wpdb->insert( $table_name_go_totals,array( 'uid' => $user_id ),  array(  '%s' ) );
 update_user_meta($user_id,'go_rank');
 }
}	


//Deltes all rows related to a user in the individual and total tables upon deleting said user.
function go_user_delete($user_id){
 	global $wpdb;
	$table_name_go_totals = $wpdb->prefix . "go_totals";
	$table_name_go = $wpdb->prefix . "go";

	$wpdb->delete( $table_name_go_totals, array('uid'=> $user_id));
	$wpdb->delete( $table_name_go, array('uid'=> $user_id) );
	

}


?>