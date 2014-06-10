<div class="container">
	<div class="content-wrap">
        <div class="inner-content top-padding">
            <div class="col-md-12 remove-gutters push">
            	<div class="col-md-7 push remove-gutters">
                    <?=modules::run('pages/keep_shopping');?>
                    <h1>PAYMENT DETAILS <i class="fa fa-shopping-cart"></i></h1>
                    <p class="short-desc">Review your order</p>
                </div>
                <div class="col-md-5 checkout-stages pull">
                    <?php echo modules::run('order/checkout_stage',checkout_stage_payment);?>
                </div>
            </div>

			<div class="col-md-12 remove-left-gutter top-padding push">
            	<table class="table table-striped cart-table">
                    <thead>
                        <tr>
                            <th class="left" colspan="5">ORDER DETAILS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="no-padding" colspan="5">
                                <?php echo modules::run('cart/get_cart_checkout_options',false,false); ?>
                            </td>
                        </tr>
                        <tr>
							<?php echo modules::run('cart/cart_total_table_row', 'payment');?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <form id="payment-form" method="post" action="<?=base_url();?>order/process_order">
            <div class="col-md-12 payments-info-wrap remove-gutters">
				<div class="col-md-6 remove-left-gutter">
                	<h3 class="grey-text">DELIVERY DETAILS</h3>
                    <p><input id="same-as-billing-address" type="checkbox" /> Same as my account billing details</p>
                	<div id="delivery-details-form-wrap" class="custom-form-wrap grey-bg push no-padding">
                		<?php echo modules::run('order/load_delivery_details_form');?>
                 	</div>
                </div>

                <div class="col-md-6 remove-left-gutter">
                	<h3 class="grey-text">PAYMENT DETAILS</h3>
                    <p>Enter your payment details to complete checkout</p>
                	<div class="custom-form-wrap grey-bg push no-padding">
                		<?php echo modules::run('order/load_payment_details_form');?>
                 	</div>
                </div>
          	</div>
            </form>

        </div>
    </div>
</div>

<script>
$j(function(){
	//init select
	$j('.custom-select').select2();
	set_same_billing_details();
	//populate delivery details same as the billing address or empty those fields
	$j('#same-as-billing-address').on('click',function(){
		set_same_billing_details();
	});

	//process payment
	$j('#process-payment').on('click',function(){
		var type = $j('#payment-type').val();
		if (type == "cc") {
			if(help.validate_form('payment-form')){
				$j('#payment-form').submit();
			}
		} else {
			$j('#payment-form').submit();
		}
	});
	
	$j('#payment-form').on('submit',function(){
		cart.processing_payment_msg();
	});
});
function set_same_billing_details() {
	var toggle_type = 'empty';
	if($j('#same-as-billing-address').is(':checked')){
		toggle_type = 'populate';
	}
	cart.loading();
	$j.ajax({
	type: "POST",
	url: "<?=base_url();?>order/ajax/toggle_delivery_address_fields",
	data: {toggle_type:toggle_type},
	success: function(html) {
			cart.remove_loading();
			$j('#delivery-details-form-wrap').html(html);
	  	}
	});
}
</script>
