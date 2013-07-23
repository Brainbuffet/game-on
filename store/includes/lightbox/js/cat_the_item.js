function cbCattheItem(the_cat_id) {
jQuery(document).ready(function(jQuery){
	var cbtoCat = {
                action:'cat_item',
                nonce: "",
    };
	jQuery.ajax({
		url: cat_item.ajaxurl,
		type: "POST",
		data: cbtoCat,
		beforeSend: function() { 
			jQuery("#cblb-fr-cat").append('<div id="cb-cat-loading" class="cat_loader"></div>');
					},
		dataType: "html",
		success: function(response){
			jQuery("#cblb-fr-cat").innerHTML = "";
			jQuery("#cblb-fr-cat").html('');  
			jQuery("#cblb-fr-cat").append('<span>'+response+'</span>');
		}
	});
});
}