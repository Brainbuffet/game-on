<?php
/////////////////////////////////////////////
//////////// Front-End Lightbox /////////////
///////// Module by Vincent Astolfi /////////
/////////////////////////////////////////////
///////////// Special Thanks To /////////////
///////// http://www.ajaxload.info //////////
////////////// For Loading Icons ////////////
/////////////////////////////////////////////
//Includes
include ('buy-ajax.php'); // Ajax run when buying something
// Main Lightbox Ajax Function
function cb_the_lb_ajax(){
    check_ajax_referer( 'cb_lb_ajax_referall', 'nonce' );
	$the_id = $_POST["the_item_id"];
	$the_post = get_post($the_id);
    $the_title = $the_post->post_title;
	$the_content = get_post_field('post_content', $the_id);
	$set_ranks = get_option('go_ranks',false);// All Possible Ranks defined by admin, least to greatest
	$user_rank = cp_module_ranks_getRank($student_id); // Rank of current user
	$user_rank_key = array_search($user_rank, $set_ranks); // Order of current user rank out of all possible ranks
	$retrieve = get_post_custom($the_id); // prefaces all retrieves below
	$cb_gold_req = $retrieve["cbs_gold_req"][0]; // Gold required to buy item
	$cb_repeat = $retrieve["cbs_repeat"][0]; // Check if repeatable buy is on
	$cb_rank = $retrieve["cbs_rank"][0]; // Rank required to buy item
	$cb_rank_key = array_search($cb_rank, $set_ranks); // Order of rank required out of all possible ranks
	$user_ID = get_current_user_id(); // Current User ID
	$user_points = cp_getPoints( $user_ID ); // Current CubePoints points
	$user_gold = go_return_currency($user_ID); // Current CubeGold gold
	echo '<h2>'.$user_gold.'</h2>';
	echo '<div id="cb-lb-the-content">'.$the_content.'</div>';
	if ($user_points >= $cb_rank_key) { $lvl_color = "g"; } else { $lvl_color = "r"; }
	if ($user_gold >= $cb_gold_req) { $gold_color = "g"; } else { $gold_color = "r"; }
	if ($lvl_color == "g" && $gold_color == "g") { $buy_color = "g"; } else { $buy_color = "r"; };

?>
	<div id="cblb-fr-price" class="cblb-fr-boxes-<?php echo $gold_color; ?>">Price: <?php echo $cb_gold_req; ?></div>
    <div id="cblb-fr-lvl" class="cblb-fr-boxes-<?php echo $lvl_color; ?>">Required Rank: <span><?php echo $cb_rank; ?></span></div>
	<div id="cblb-fr-buy" class="cblb-fr-boxes-<?php echo $buy_color; ?>" onclick="cbBuytheItem('<?php echo $the_id; ?>', '<?php echo $buy_color; ?>');">Buy</div>

<?php
	
    die;
}
add_action('wp_ajax_cb_lb_ajax', 'cb_the_lb_ajax');
add_action('wp_ajax_nopriv_cb_lb_ajax', 'cb_the_lb_ajax');
////////////////////////////////////////////////////
function cb_frontend_lightbox_css() {
	$cb_lb_css_dir = plugins_url( '/css/cb-lightbox.css' , __FILE__ );
	echo '<link rel="stylesheet" href="'.$cb_lb_css_dir.'" />';
}
add_action('wp_head', 'cb_frontend_lightbox_css');

function cb_frontend_lightbox_html() {
?>
<script type="text/javascript">
var add_cb_the_loader = $('#lb-content').append('<div class="cb-the-loader"></div>');
var remove_cb_the_loader = $('.cb-the-loader').remove();

function cb_lb_closer() {
	document.getElementById('light').style.display='none';
	document.getElementById('fade').style.display='none';
	document.getElementById('lb-content').innerHTML = '';
}
function cb_lb_opener(id) {
	document.getElementById('light').style.display='block';
	document.getElementById('fade').style.display='block';
	if( !$.trim( $('#lb-content').html() ).length ) {
	var get_id = id;
	var cbtoSend = {
                action:"cb_lb_ajax",
                nonce: "<?php echo esc_js( wp_create_nonce('cb_lb_ajax_referall') ); ?>",
				the_item_id: get_id,
    };
	url_action = "<?php echo admin_url('/admin-ajax.php'); ?>";
            $.ajaxSetup({cache:true});
            $.ajax({
                url: url_action,
                type:'POST',
                data: cbtoSend,
				beforeSend: function() {
				jQuery("#lb-content").append('<div class="cb-lb-loading"></div>');
					},
                cache: false,
                success:function(results, textStatus, XMLHttpRequest){  
  				jQuery("#lb-content").innerHTML = "";
				jQuery("#lb-content").html('');  
  				jQuery("#lb-content").append(results);  
  				},
            });
	}
}
</script>
	<div id="light" class="white_content">
    	<a href="javascript:void(0)" onclick="cb_lb_closer();" class="cb_lb_closer">Close</a>
        <div id="lb-content"></div>
    </div>
	<div id="fade" class="black_overlay"></div>
<?php
}
add_action('wp_head', 'cb_frontend_lightbox_html');
?>