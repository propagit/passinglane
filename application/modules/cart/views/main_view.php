<div class="container">
	<div class="content-wrap">
        <div class="inner-content top-padding">
            <div class="col-md-12 remove-left-gutter">
                <?=modules::run('pages/keep_shopping');?>
                <h1>YOUR CART <i class="fa fa-shopping-cart"></i></h1>
                <p class="short-desc">Manage Your shopping cart before proceeding to checkout <span class="cart-terms right pull">Prices listed include GST.</span></p>
            </div>
            
			<div class="col-md-12 remove-left-gutter top-padding bottom-padding push">
            	<?php echo modules::run('cart/cart_contents'); ?>
                <?php if(isset($cart_items) && $cart_items){ ?>
                <div class="col-md-8 remove-gutters cart-terms-checkbox-wrap">
                    <input id="accept-terms" type="checkbox" class="push"/><span class="cart-terms push">By ticking this checkbox & proceeding to purchase you agree and have understood our Terms + Conditions</span>
                </div>
                <div class="col-md-4 remove-gutters right">
                    <button class="btn btn-primary btn-lg" id="update-cart"><i class="fa fa-refresh"></i> UPDATE CART</button>
                    <button id="checkout" class="btn btn-primary-inverse btn-lg"><i class="fa fa-shopping-cart"></i> CHECKOUT</button>
                </div>
                <?php } ?>
            </div>
            
        </div>
    </div>
</div>
<script>
$j(function(){
	//update cart item quantities
	$j('#update-cart').on('click',function(){
		var data = {};
		$j('.cart-qty').each(function(){
			data[$j(this).attr('data-rowid')] = $j(this).val();
		});
		cart.update_cart(data);
	});
	
	//go to checkout page
	$j('#checkout').on('click',function(){
		if($j('#accept-terms').is(':checked')){
			window.location.href = "<?=base_url();?>cart/checkout";	
		}else{
			$j('#accept-terms').next().addClass('ui-state-highlight');	
		}
	});
});
</script>