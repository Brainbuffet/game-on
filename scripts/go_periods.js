jQuery('#sortable_go_class_a').sortable({axis:"y"});
function go_class_a_new_input(){
	jQuery('#sortable_go_class_a').append(' <li class="ui-state-default" class="go_list"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><input id="go_class_a_input" type="text" value=""/></li>');
	}
function go_class_a_save(){
	var values = jQuery("input[id='go_class_a_input']")
              .map(function(){return jQuery(this).val();}).get();
	jQuery.ajax({
		type: "post",url: MyAjax.ajaxurl,data: { 
		action: 'go_class_a_save',
		class_a_array: values},
		success: function(html){
			jQuery('#sortable_go_class_a').html(html);
		}
	});
	}
	
	
	
	
	
jQuery('#sortable_go_class_b').sortable({axis:"y"});
function go_class_b_new_input(){
	jQuery('#sortable_go_class_b').append(' <li class="ui-state-default" class="go_list"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><input id="go_class_b_input" type="text" value=""/></li>');
	}
function go_class_b_save(){
	var values = jQuery("input[id='go_class_b_input']")
              .map(function(){return jQuery(this).val();}).get();
	jQuery.ajax({
		type: "post",url: MyAjax.ajaxurl,data: { 
		action: 'go_class_b_save',
		class_b_array: values},
		success: function(html){
			jQuery('#sortable_go_class_b').html(html);
		}
	});
	}