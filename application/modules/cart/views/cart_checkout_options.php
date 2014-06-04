<table class="table cart-checkout-options-table">
    <tr>
        <td>DELIVERY</td>
        <td>
        <?php if($enable_inputs){ ?>
       	<input class="update-shipping-info" type="radio" name="shipping_id" value="<?=$shippings[1]['shipping_id'];?>" <?=($current_shipping ? ($current_shipping['id'] == $shippings[1]['shipping_id'] ? 'checked="checked"' : '' ) : '');?>/><span class="cart-options-label"><?=$shippings[1]['name'];?> <strong>(<?=$shippings[1]['subtitle'];?>)</strong></span><?=nbs(6);?>
        <input class="update-shipping-info" type="radio" name="shipping_id" value="<?=$shippings[2]['shipping_id'];?>" <?=($current_shipping ? ($current_shipping['id'] == $shippings[2]['shipping_id'] ? 'checked="checked"' : '' ) : '');?>/><span class="cart-options-label"><?=$shippings[2]['name'];?>t (<strong>$<?=money_format('%i',$shippings[2]['price'])?></strong> <?=$shippings[2]['subtitle'];?>)</span>
        <?php } ?>
        </td>
        <td class="right grey-text">
           <?php if(isset($current_shipping)){ ?>
           $<?=money_format('%i',$current_shipping['price']);?>
           <?php } else { echo '$0.00';} ?>
        </td>
    </tr>
	<tr>
    	<td colspan="2">SUBTOTAL</td>
        <td class="right grey-text">$<?=money_format('%i',$cart_total);?></td>
    </tr>
    <? if ($has_coupon) { ?>
    <tr class="discount-tr">
        <td>COUPON</td>
        <td>
        <?php if($enable_inputs){ ?>
        <span class="cart-options-label push">Enter Discount Coupon Code</span>
        <div class="input-group coupon-input-group">
          <input type="text" class="form-control no-border-radius" name="coupon">
          <span id="btn-add-coupon" class="input-group-addon custom-addon no-border-radius" style="cursor:pointer;"><i class="fa fa-plus-circle"></i> ADD</span>
        </div>
        <?php }else{ echo '&nbsp;'; }?>
        </td>
        <td class="right"></td>
    </tr>
    <? } ?>
    <?
    $total_discount = 0;
    foreach($promotions as $promotion) {
            $discount_value = $promotion['discount_value'];
            $discount_text = '';
            if ($promotion['discount_type'] == 'percentage') {
                $discount_text = '(' . $discount_value .'%)';
                $discount_value = $discount_value * $cart_total / 100;
            }
            $total_discount += $discount_value;
        ?>
    <tr>
        <td colspan="2">
            <?=$promotion['name'];?>
            <? if ($this->session->userdata('coupon')) {
                echo '- Coupon Code: ' . $this->session->userdata('coupon');
            } ?>
             <?=$discount_text;?>
        </td>
        <td class="right red-text f20">
            - $<?=money_format('%i',$discount_value);?>
        </td>
    </tr>
    <? } ?>
	<tr>
    	<td colspan="2">GST</td>
        <td class="right grey-text">$<?=money_format('%i',$cart_total - $total_discount) / 10;?></td>
    </tr>

</table>
<script>
$j(function(){
	$j('.update-shipping-info').on('click',function(){
		update_shipping();
	});
    $j('#btn-add-coupon').click(function(){
        var coupon = $j('input[name="coupon"]').val();
        $j.ajax({
            type: "POST",
            url: "<?=base_url();?>cart/ajax/add_coupon",
            data: {coupon: coupon},
            success: function(html) {
                location.reload();
            }
        })
    })
});

function update_shipping()
{
	var shipping_id = $j('input[name=shipping_id]:checked').val();
	cart.update_shipping(shipping_id);
}

</script>
