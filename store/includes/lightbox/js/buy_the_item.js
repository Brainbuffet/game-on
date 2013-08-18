function cbBuytheItem(id, buyColor) {
jQuery(document).ready(function(jQuery){
	var cbtoBuy = {
                action:'buy_item',
                nonce: "",
				the_id: id,
    };
	jQuery.ajax({
		url: buy_item.ajaxurl,
		type: "POST",
		data: cbtoBuy,
		beforeSend: function() {
			jQuery("#cblb-fr-buy").innerHTML = "";
			jQuery("#cblb-fr-buy").html(''); 
			jQuery("#cblb-fr-buy").append('<div id="cb-buy-loading" class="buy_'+buyColor+'"></div>');
					},
		dataType: "html",
		success: function(response){
			if (response == 'Insuffcient Funds') {
				alert('Purchase Denied. Reason: '+response);
			} else if (response == 'Rank Too Low') {
				alert('Purchase Denied. Reason: '+response);
			}
			jQuery("#cblb-fr-buy").innerHTML = "";
			jQuery("#cblb-fr-buy").html('');  
			jQuery("#cblb-fr-buy").append('<span>'+response+'</span>');
		}
	});
});
}