jQuery('#sortable_go_periods').sortable({axis:"y"});
function go_periods_new_input(){
	jQuery('#sortable_go_periods').append(' <li class="ui-state-default" class="go_list"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><input id="go_periods_input" type="text" value=""/></li>');
	}
function go_periods_save(){
	var values = jQuery("input[id='go_periods_input']")
              .map(function(){return jQuery(this).val();}).get();
	jQuery.ajax({
		type: "post",url: MyAjax.ajaxurl,data: { 
		action: 'go_periods_save',
		periods_array: values},
		success: function(html){
			jQuery('#sortable_go_periods').html(html);
		}
	});
	}