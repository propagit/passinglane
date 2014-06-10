// JavaScript Document

var cart = {


	/* *
		The default values of the wrapper that is used in the script

		header_cart_item_coun_wrap = id of the wrap that shows the total item in the cart in the header section of the website
		cart_item_row = id of the table row when cart items are listed for review or in the view cart view file, the rowid is added after the last dash eg: #cart-item-row-12,#cart-item-row-13 etc
		cart_total_amount = id of the wrap that holds the cart total amount in the view file that lists the cart contents.
		cart_checkout_options_wrap_id = id of the wrap that holds the additional cart options - mostly to populate during checkout such as shipping, subtotals etc
	*/

	header_cart_item_count_wrap_id:'#header-cart-item-count',
	cart_item_row_id:'#cart-item-row-',
	cart_total_amount_wrap_id:'#cart-total-amount',
	cart_checkout_options_wrap_id:'#cart-checkout-options',


	add:function(product_id,quantity){
		cart.loading();
		$j.ajax({
		type: "POST",
		url: base_url+"cart/ajax/add_to_cart",
		data: {product_id:product_id,quantity:quantity},
		dataType: "JSON",
		success: function(data) {
				cart.remove_loading();
				cart.update_item_count();
				cart.item_added_to_cart();
		  	}
		});

	},

	update_item_count:function(){
		$j.ajax({
		type: "POST",
		url: base_url+"cart/ajax/get_item_count",
		dataType: "JSON",
		success: function(data) {
				$j(cart.header_cart_item_count_wrap_id).html((data['total_items'] > 0 ? data['total_items'] : '<i class="fa fa-shopping-cart"></i>'));
		  	}
		});
	},

	update_cart:function(data){
		cart.loading();
		$j.ajax({
		type: "POST",
		url: base_url+"cart/ajax/update_cart",
		data: {data:data},
		dataType: "JSON",
		success: function(data) {
				if(data['status']){
					cart.remove_loading();
					cart.get_total();
					cart.update_item_count();
				}else{
					alert('Update Failed! Please try again');
				}
		  	}
		});
	},

	remove_item:function(rowid){
		cart.loading();
		$j.ajax({
		type: "POST",
		url: base_url+"cart/ajax/remove_cart_item",
		data: {rowid:rowid},
		dataType: "JSON",
		success: function(data) {
				cart.remove_loading();
				if(data['status']){
					window.location.reload();
					//$j(cart.cart_item_row_id+rowid).remove();
					//cart.get_total();
					//cart.update_item_count();
				}else{
					alert('Deletion Failed! Please try again');
				}
		  	}
		});
	},

	get_total:function(){
		$j(cart.cart_total_amount_wrap_id).html('<i class="fa fa-spinner fa-spin"></i>');
		$j.ajax({
		type: "POST",
		url: base_url+"cart/ajax/get_total",
		dataType: "JSON",
		success: function(data) {
				if(!data['is_empty']){
					$j(cart.cart_total_amount_wrap_id).html(data['total']);
				}else{
					window.location.reload();
				}
		  	}
		});
	},

	load_checkout_options:function(show_discount_input){
		$j(cart.cart_checkout_options_wrap_id).html('<i class="fa fa-spinner fa-spin"></i>');
		$j.ajax({
		type: "POST",
		url: base_url+"cart/ajax/get_cart_checkout_options",
		dataType: "JSON",
		data:{show_discount_input:show_discount_input},
		success: function(data) {
				$j(cart.cart_checkout_options_wrap_id).html(data['html']);
		  	}
		});

	},

	update_shipping:function(shipping_id){
		cart.loading();
		$j.ajax({
		type: "POST",
		url: base_url+"cart/ajax/update_shipping",
		data: {shipping_id:shipping_id},
		dataType: "JSON",
		success: function(data) {
				cart.remove_loading();
				cart.load_checkout_options(true);
				cart.get_total();
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

	item_added_to_cart:function(){
		$j('body').append('<div id="cart-success-msg" class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header cart-success-modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button></div><div class="modal-body center"><p>Item successfully added to cart</p></div></div></div></div>');
		$j('#cart-success-msg').modal('show');
	},

	processing_payment_msg:function(){
		$j('body').append('<div id="processing-payment-msg" class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header cart-success-modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button></div><div class="modal-body center"><p>Please wait while we process your payment. Once your payment is confirmed the page will automatically redirect to your orders page.</p></div></div></div></div>');
		$j('#processing-payment-msg').modal('show');
	}







};
