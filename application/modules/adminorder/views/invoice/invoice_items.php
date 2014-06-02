<?php if(isset($order_items) && $order_items){?>
<br /><p><span class="title-page">Purchase Items</span> (PRICES DISPLAYED $AUD)</p>
<table class="tbl-order-items">
    <thead>
    	<tr>
        	<th><span class="title-page">Product Name</span></th>
            <th><span class="title-page">Qty</span></th>
            <th width="170"><span class="title-page">Price</span></th>
            <th width="150"><span class="title-page">Subtotal</span></th>
        </tr>
    </thead>
    <tbody>
		<?php foreach($order_items as $item){?>
        <tr>
            <td><?=strtoupper($item->product_name . ' ' . $item->product_subtitle);?></td>
            <td><?=$item->quantity;?></td>
            <td width="170">$<?=money_format('%i',$item->price);?></td>
            <td width="150">$<?=money_format('%i',($item->price * $item->quantity));?></td>
        </tr>  
        <?php } ?>
	</tbody>
</table>
<?php } ?>