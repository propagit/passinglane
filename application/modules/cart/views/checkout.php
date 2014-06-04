<div class="container">
	<div class="content-wrap">
        <div class="inner-content top-padding">
            <div class="col-md-12 remove-gutters push">
            	<div class="col-md-7 push remove-gutters">
                    <a class="back-link"><i class="fa fa-angle-left"></i>Keep Shopping</a>
                    <h1>CHECKOUT <i class="fa fa-shopping-cart"></i></h1>
                    <p class="short-desc">Review your order</p>
                </div>
                <div class="col-md-5 checkout-stages pull">
                    <?php echo modules::run('cart/checkout_stage',checkout_stage_review);?>
                </div>
            </div>

			<div class="col-md-12 remove-left-gutter top-padding push checkout-cart-review-wrap">
            	<?php echo modules::run('cart/cart_contents',false); ?>
            </div>
            <div class="col-md-12 push right bottom-padding">
              <a href="<?=base_url();?>order/payment"><div class="btn btn-primary btn-lg"><i class="fa fa-arrow-circle-right"></i> PAY NOW</div></a>
          	</div>

        </div>
    </div>
</div>

<script>
$j(function(){
	cart.load_checkout_options(true);
});
</script>
