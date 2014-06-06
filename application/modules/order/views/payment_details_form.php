<div class="form-group"><span class="col-sm-10 mandatory-label">* Denotes required field</span></div>
<? if ($customer['is_trading']) { ?>
<div class="form-group">
    <label for="payment-type" class="col-sm-4 remove-right-gutter control-label">Payment Type *</label>
    <div class="col-sm-8">
        <select class="form-control custom-select" id="payment-type" name="payment_type" data="required">
            <option value="cc">Credit Card</option>
            <option value="trading">30 Day Trading Account</option>
        </select>
    </div>
</div>
<? } else { ?>
<input type="hidden" name="payment_type" value="cc" />
<? } ?>
<div id="wp_cc_details">
	<div class="form-group">
	    <label for="ccname" class="col-sm-4 remove-right-gutter control-label">Card Name</label>
	    <div class="col-sm-8">
	        <input type="text" class="form-control" id="ccname" name="ccname" placeholder="" data="required">
	    </div>
	</div>
	<div class="form-group">
	    <label for="ccnumber" class="col-sm-4 remove-right-gutter control-label">Card Number *</label>
	    <div class="col-sm-8">
	        <input type="text" class="form-control" id="ccnumber" name="ccnumber" placeholder="" data="required" onkeypress="return cart.check_numeric(this, event,'n');">
	    </div>
	</div>
	<div class="form-group">
	    <label for="expiry" class="col-sm-4 remove-right-gutter control-label">Expiry *</label>
	    <div class="col-sm-8 remove-gutters">
	        <div class="col-sm-6">
	            <select class="form-control custom-select col-sm-3" id="expiry-month" name="expiry_month" data="required">
	            <? for($i = 1; $i <=12;$i++){ ?>
	                <option value="<?=$i;?>"><?=($i < 10 ? '0'.$i : $i);?></option>
	            <?php } ?>
	            </select>
	        </div>
	        <div class="col-sm-6">
	            <select class="form-control custom-select col-sm-3" id="expiry-year" name="expiry_year" data="required">
	            <? for($i = date('y'); $i <= (date('y') + 10);$i++){ ?>
	                <option value="<?=$i;?>">20<?=$i;?></option>
	            <?php } ?>
	            </select>
	        </div>
	    </div>
	</div>
	<div class="form-group">
	    <label for="address2" class="col-sm-4 remove-right-gutter control-label">CVV* </label>
	    <div class="col-sm-8 remove-gutters">
	        <div class="col-sm-6">
	            <input type="text" class="form-control" id="cvv" name="cvv" placeholder="" onkeypress="return cart.check_numeric(this, event,'n');" data="required">
	        </div>
	        <div class="col-sm-6 remove-gutters blue-text form-info-label"><i class="fa fa-question-circle"></i> WHAT'S THIS </div>
	    </div>
	</div>
</div>
<div class="form-group">
    <div class="col-sm-8 col-sm-offset-4 remove-gutters">
        <div class="col-sm-6" style="height: 83px;">
            <img id="wp_eway_logo" style="width:100%;" src="<?=base_url();?>assets/frontend-assets/passing/dummy/eway-secure.png" />
        </div>
        <div class="col-sm-6 confirm-payment-btn-wrap">
            <button id="process-payment" type="button" class="btn btn-primary btn-lg"><i class="fa fa-arrow-circle-right"></i> PAY NOW</button>
        </div>
    </div>
</div>

<script>
$j(function(){
	check_payment_type();
	$j('#payment-type').change(function(){
		check_payment_type();
	})
})
function check_payment_type() {
	var type = $j('#payment-type').val();
	if (type == "trading") {
		$j('#wp_cc_details').hide();
		$j('#wp_eway_logo').hide();
	} else {
		$j('#wp_cc_details').show();
		$j('#wp_eway_logo').show();
	}
}
</script>
