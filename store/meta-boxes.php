<?php
$ifmetaid = $_GET['post'];
$cb_the_post_type = get_post_type( $ifmetaid );
if ( $cb_the_post_type == 'cb_store') {
add_action("admin_init", "cb_store_admin_init");
add_action('save_post', 'save_cb_store_meta');

function cb_store_admin_init(){
	add_meta_box("cb_store_info_meta", "Store Options", "cb_store_meta_options", "cb_store", "side", "high");
}

function cb_store_meta_options(){
		global $post;
		$cb_store_deliver = get_post_custom($post->ID);
		$cbs_gold_req = $cb_store_deliver["cbs_gold_req"][0];
		$cbs_repeat = $cb_store_deliver["cbs_repeat"][0];
		$cbs_rank = $cb_store_deliver["cbs_rank"][0];
		

// Gets List of Ranks
$ranks = get_option('go_ranks',false);
	if($ranks[0]==''){
		$ranks[0] = __('Newbie', 'cp');
		update_option('cp_module_ranks_data', $ranks);
}
// Sorts Ranks
ksort($ranks); 	
?>
<label>Required Gold</label><input type="text" name="cbs_gold_req" class="widefat" value="<?php echo $cbs_gold_req; ?>" />
	
    <label for="cb_filter">Required Rank</label><br />
		<select id="cb_filter">
			<script type="text/javascript">
				document.getElementById('cb_filter').onchange = function () {
    				document.getElementById('rank_cb').value = event.target.value  
}
			</script>
<option value="<?php echo $cbs_rank; ?>" selected="selected"><?php echo $cbs_rank; ?></option>
<?php
foreach($ranks as $points=>$rank){
	echo '<option value="'.$rank.'">'.$rank.'</option>'; 
} 
?>
</select>
<input id="rank_cb" type="hidden" name="cbs_rank" value="<?php echo $cbs_rank; ?>"/><br />
<!-- -->
<label for="cb_rep_filter">Repeat</label><br />
<select id="cb_rep_filter">
<script type="text/javascript">
document.getElementById('cb_rep_filter').onchange = function () {
    document.getElementById('cbs_repeat').value = event.target.value  
}
</script>
    <option value="<?php echo $cbs_repeat; ?>" selected="selected"><?php echo ucfirst($cbs_repeat); ?></option>
	<option value="on">On</option>
	<option value="off">Off</option>
</select>
<input id="cbs_repeat" type="hidden" name="cbs_repeat" class="widefat" value="<?php echo $cbs_repeat; ?>"/>
<br />
Shortcode
<br />   
<?php  
 	 echo '<input value=\'[cb_store id="'.$_GET["post"].'"]\' onclick="this.select();"/>'; 
	}
function save_cb_store_meta(){
	global $post;
	$cbs_meta_array = array('cbs_gold_req', 'cbs_rank', 'cbs_repeat');
	foreach ($cbs_meta_array as $cb_meta_name) {
	update_post_meta($post->ID, $cb_meta_name, $_POST[$cb_meta_name]);
	}	
}
}
?>