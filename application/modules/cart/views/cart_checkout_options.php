<?
$total = $cart_total;
?>
<table class="table cart-checkout-options-table">
	<tr>
    	<td colspan="2">ORDER SUBTOTAL</td>
        <td class="right grey-text">$<?=money_format('%i',$cart_total);?></td>
    </tr>
    <? if ($has_coupon) { ?>
    <tr class="discount-tr">
        <td>COUPON</td>
        <td>
        <?php if($enable_inputs){ ?>
        <span class="cart-options-label push">Enter Discount Coupon Code</span>
        <div class="input-group coupon-input-group pull-left">
          <input type="text" class="form-control no-border-radius" name="coupon">
          <span id="btn-add-coupon" class="input-group-addon custom-addon no-border-radius" style="cursor:pointer;"><i class="fa fa-plus-circle"></i> ADD</span>
        </div>
        <div id="invalid_coupon" class="pull-left red-text" style="margin-left:10px; width:200px;"></div>
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
    <? $total = $total - $total_discount; ?>
    <tr>
        <td>DELIVERY</td>
        <td>
        <?php if($enable_inputs){ ?>
        <input class="update-shipping-info" type="radio" name="shipping_id" value="<?=$shippings[1]['shipping_id'];?>" checked />

        <span class="cart-options-label"><?=$shippings[1]['name'];?> <strong>(<?=$shippings[1]['subtitle'];?>)</strong></span>
        <?=nbs(6);?>
        <input class="update-shipping-info" type="radio" name="shipping_id" value="<?=$shippings[2]['shipping_id'];?>" <?=($current_shipping ? ($current_shipping['id'] == $shippings[2]['shipping_id'] ? 'checked="checked"' : '' ) : '');?>/><span class="cart-options-label"><?=$shippings[2]['name'];?> (<strong>$<?=money_format('%i',$shippings[2]['price'])?></strong> <?=$shippings[2]['subtitle'];?>)</span>
        <?php } ?>
        </td>
        <td class="right grey-text">
           <?php if(isset($current_shipping)){ $shipping_cost = $current_shipping['price']; ?>

           <?php } else { $shipping_cost = 0; } ?>

           $<?=money_format('%i', $shipping_cost);?>
        </td>
    </tr>
    <? $total = $total + $shipping_cost; ?>
	<tr>
    	<td colspan="2">GST</td>
        <td class="right grey-text">$<?=money_format('%i', $total / 10);?></td>
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
                if (html == 'true') {
                    location.reload();
                } else {
                    $j('#invalid_coupon').html('Invalid coupon code');
                }
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
