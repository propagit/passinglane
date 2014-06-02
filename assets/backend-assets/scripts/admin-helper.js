// JavaScript Document
/* * 
	Helper Script 
	v 1.0

*/

var help = {
	
	validate_email:function(emailAddress){
		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$j)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$j)/i);
	
		return pattern.test(emailAddress);
	},
	
	check_numeric:function(field, event,type){
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		//numeric with dot 0-9,.
		if(type=="nd"){
			if((keyCode >=48 && keyCode<=57)||keyCode==46||keyCode==8||keyCode==9){return true;} 
			else{return false;}
		}
		//numeric without dot		
		if(type=="n"){
			if((keyCode >=48 && keyCode<=57) || keyCode==8 || keyCode==9){return true;} 
			else{return false;}
		}
	},
	
	validate_form:function(form_id){
		var valid = true;
		var validation_rule = '';
		$j('#'+form_id+' input,#'+form_id+' textarea,#'+form_id+' select').each(function(){
			validation_rule = $j(this).attr('data');
			switch(validation_rule){
				case 'required':
					if(!$j(this).val()){
						valid = false;
						$j(this).addClass('error');	
					}else{
						$j(this).removeClass('error');
					}
				break;
				
				case 'email':
					if(!$j(this).val()){
						valid = false;	
						$j(this).addClass('error');
					}else{
						if(!help.validate_email($j(this).val())){
							valid = false;
							$j(this).addClass('error');	
						}else{
							$j(this).removeClass('error');
						}
					}
				break;
				
				case 'checked':
					if(!$j(this).is(':checked')){
						valid = false;	
						$j(this).addClass('error');
					}else{
						$j(this).removeClass('error');
					}
				break;	
			}
		});
		
		if(valid){
			$j('#'+form_id).submit();	
		}
		
	},
	
	
	//set height of an element to the max height
	//eg find elements with same class name and set height to the max height
	unify_height:function(selector){
		$j(selector).css({'min-height':0});
		var maxHeight = 0;
		$j(selector)
		  .each(function() { maxHeight = Math.max(maxHeight, $j(this).height()); })
		  .css({'min-height':maxHeight});	
	},
	
	
	go_to_top:function(selector){			
		$j(window).scroll(function(){
			$j(window).scrollTop() ? $j(selector).removeClass('hidden')  : $j(selector).addClass('hidden');
		});
		
		$j(selector).click(function(){
			$j('html, body').animate({ scrollTop:0},300);
		});
	},
	
		//custom checkbox
	custom_checkbox:function(selector){
		$j(selector).click(function(){
			 $j(this).children('span').toggleClass('checked');  
			 if($j(this).is(':checked')){
				$j(this).attr('checked', false); 
			 }else{
				$j(this).attr('checked', true);
			 }
	  	});	
		
	},
	
	//create permalink
	make_permalink:function(main_text_selector,permalink_selector){
		$j(main_text_selector).keyup(function(){
			var main_text = $j(main_text_selector).val();
			if(main_text){
				$j(permalink_selector).val(help.format_to_link(main_text));	
			}else{
				$j(permalink_selector).val('');
			}
		});
	},

	//permalink generator
	format_to_link:function(text){
		text = text.toLowerCase();
		var   spec_chars = {a:/\u00e1/g,e:/u00e9/g,i:/\u00ed/g,o:/\u00f3/g,u:/\u00fa/g,n:/\u00f1/g}
		for (var i in spec_chars) text = text.replace(spec_chars[i],i);
		var hyphens = text.replace(/\s/g,'-');
		var permalink = hyphens.replace(/[^a-zA-Z0-9\-]/g,'');
		permalink = permalink.toLowerCase();
		return permalink;
	},
	
	permalink_exists:function(controller_url,permalink,permalink_input){
		$j.ajax({
			type:'post',
			url:controller_url,
			data:{permalink:permalink},
			success:function(html){
				if(html == 'exists'){
					$j(permalink_input).addClass('error');	
				}else{
					$j(permalink_input).removeClass('error');
				}
			},
			error:function(){
				alert('Something went wrong! Please try again!!!');
			}
		});//ajax		
	},
	
	get_dash_components:function(controller_url,display_container,checkbox_selector){
		$j('#dash-components').modal('show');
		$j(display_container).addClass('loading').html('');
		$j.ajax({
			type:'post',
			url:controller_url,
			dataType: "json",
			success:function(data){
				$j(display_container).removeClass('loading').html(data['modules']);
				help.custom_checkbox(checkbox_selector);	
			},
			error:function(){
				//alert('Something went wrong! Please try again!!!');
				location.reload();
			}
		});//ajax	
	},
	
	//a generalized function for confirm delete modal
	confirm_delete:function(title,message,callback){
		var delete_modal = '<div class="modal fade" id="confirm_action_modal" tabindex="-1" role="dialog" aria-labelledby="editRoleLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><h4 class="modal-title">'+title+'</h4></div><input type="hidden" name="role_id" id="role_id" /><div class="modal-body"><div id="modal-delete-msg">'+message+'</div></div><div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">No</button><button type="button" class="btn btn-info confirm-action">Yes</button></div></div></div></div>';
		$j('body').append(delete_modal);
		$j('#confirm_action_modal').modal('show');
		$j('.confirm-action').on('click',function(){
			callback(true);
			$j('#confirm_action_modal').modal('hide');
		});
	},
	
	//a generalized function for confirm delete modal
	message_modal:function(title,message){
		var message_modal = '<div class="modal fade" id="message_modal" tabindex="-1" role="dialog" aria-labelledby="editRoleLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><h4 class="modal-title">'+title+'</h4></div><input type="hidden" name="role_id" id="role_id" /><div class="modal-body"><div id="modal-delete-msg">'+message+'</div></div><div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">Close</button></div></div></div></div>';
		$j('body').append(message_modal);
		$j('#message_modal').modal('show');
	}
	
	

};



