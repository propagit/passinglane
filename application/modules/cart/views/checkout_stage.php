<?php if(!modules::run('cart/is_cart_empty')){?>
<span class="checkout-stage-head full-width right pull">CHECKOUT STAGE</span>
<ul class="pull">
    <li><div class="circle <?=$checkout_state == checkout_stage_signin ? 'blue-bg': '';?>">1</div></a><span <?=$checkout_state == checkout_stage_signin ? 'class="blue-text"': '';?>>Sign In</span></li>
    <li><a href="<?=base_url();?>cart/checkout"><div class="circle <?=$checkout_state == checkout_stage_review ? 'blue-bg': '';?>">2</div></a><span <?=$checkout_state == checkout_stage_review ? 'class="blue-text"': '';?>>Review</span></li>
    <li><a href="<?=base_url();?>order/payment"><div class="circle <?=$checkout_state == checkout_stage_payment ? 'blue-bg': '';?>">3</div></a><span <?=$checkout_state == checkout_stage_payment ? 'class="blue-text"': '';?>>Pay</span></li>
    <li><div class="circle <?=$checkout_state == checkout_stage_download ? 'blue-bg': '';?>">4</div><span <?=$checkout_state == checkout_stage_download ? 'class="blue-text"': '';?>>Download</span></li>
</ul>
<?php } ?>