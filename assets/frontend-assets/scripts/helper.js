// JavaScript Document
/* * 
	Helper Script 
	v 1.0

*/

var help = {
	
	validate_email:function(emailAddress){
		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	
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
	
	//form validator
	//validates input, email, textarea, select
	// use <input data="required" />
	//email <input data="email" />
	validate_form:function(form_id){
		var valid = true;
		var validation_rule = '';
		$j('#'+form_id+' input,#'+form_id+' textarea,#'+form_id+' select').each(function(){
			validation_rule = $j(this).attr('data');
			switch(validation_rule){
				case 'required':
					if(!$j(this).val()){
						valid = false;
						$j(this).parent().addClass('has-error');	
					}else{
						$j(this).parent().removeClass('has-error');
					}
				break;
				
				case 'email':
					if(!$j(this).val()){
						valid = false;	
						$j(this).parent().addClass('has-error');
					}else{
						if(!help.validate_email($j(this).val())){
							valid = false;
							$j(this).parent().addClass('has-error');	
						}else{
							$j(this).parent().removeClass('has-error');
						}
					}
				break;
				
				case 'checked':
					if(!$j(this).is(':checked')){
						valid = false;	
						$j(this).parent().addClass('has-error');
					}else{
						$j(this).parent().removeClass('has-error');
					}
				break;	
			}
		});
		
		if(valid){
			return valid;
			//$j('#'+form_id).submit();	
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
	
	//a simple accordion
	my_accordion:function(selector){
		$j(selector+' h3').click(function() {
			//set all elements as inactive
			$j(selector+' h3').removeClass('active');
			$j(selector+' h3').find('i').replaceWith('<i class="fa fa-plus pull-right"></i>');
			
			//evaluate and toggle accordingly
			if($j(this).next('div').is(':visible')){
				$j(this).next('div').slideUp();   
			}else{
				$j(selector+' h3').next('div').slideUp();
				$j(this).next('div').slideToggle();
				$j(this).addClass('active');
				$j(this).find('i').replaceWith('<i class="fa fa-minus pull-right"></i>');
			}
		});
	},
	
	/* *
	
	--> loading function needs these css rules
	
	#loading{
	background-color:rgba(0,0,0,0.8);
	position:absolute;
	top:0;
	z-index:2000;
	}
	
	#loading .loading-inner-box{
		background-color:#fff;
		border-radius:6px;
		width:100px;
		height:80px;
		margin:auto;
	}
	
	#loading .loading-inner-box .fa{
		position: relative;
		float: left;
		margin: 25px 0 0 38px;
		font-size: 30px;
	}
	
	*/
	
	loading:function(){
		var h = $j(document).height();
		var mt = $j(window).scrollTop() + 300;
		var w = $j(document).width();
		$j('body').append('<div id="loading" style="height:' + h + 'px;width:' + w + 'px;line-height:' + h + 'px;"><div style="margin-top:'+mt+'px" class="loading-inner-box"><i class="fa fa-spinner fa-spin"></i></div></div>');
	},
	
	remove_loading:function(){
		$j('#loading').remove();
	}
	
	

};
