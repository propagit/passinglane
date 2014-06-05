<table class="table table-striped cart-table">
	<thead>
    	<tr>
        	<th class="left" colspan="2">PRODUCT</th>
            <th class="center col-md-2">QTY</th>
            <th class="center col-md-2">COST</th>
            <th class="right col-md-1">REMOVE</th>
        </tr>
    </thead>

    <tbody>
    	<?php if(isset($cart_items) && $cart_items){ ?>
        <?php foreach($cart_items as $item){ ?>
    	<tr id="cart-item-row-<?=$item['rowid'];?>">
        	<td class="left col-md-1"><div class="cart-product-img-wrap push"><?=modules::run('product/load_product_hero_thumb_image',$item['id']);?></div></td>
            <td class="left col-md-6"><?=$item['name'].' '.$item['subtitle'];?></td>
            <td class="center remove-line-height"><input class="form-group cart-qty" value="<?=$item['qty'];?>" data-rowid="<?=$item['rowid'];?>" <?=(!$quantity_box_enabled ? 'readonly="readonly"' : '');?>  onkeypress="return cart.check_numeric(this, event,'n');"></td>
            <td class="center f20">$<?=$item['price'];?></td>
            <td class="right"><i class="fa fa-minus-circle f20 red-text pointer remove-cart-item" data-rowid="<?=$item['rowid'];?>"></i></td>
        </tr>
        <?php } ?>
        <tr>
        	<td class="no-padding" colspan="5"><div id="cart-checkout-options">&nbsp;</div></td>
        </tr>
        <tr>
        	<?php echo modules::run('cart/cart_total_table_row', $this->uri->segment(2));
            ?>
        </tr>
        <tr>
        	<td colspan="5" class="border-solid"></td>
        </tr>
        <?php } else {?>
        <tr>
        	<td colspan="5">Your Cart is empty</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<script>
$j(function(){

	//remove cart item
	$j('.remove-cart-item').on('click',function(){
		var row_id = $j(this).attr('data-rowid');
		cart.remove_item(row_id);
	});
});
</script>


