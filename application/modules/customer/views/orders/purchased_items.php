<table class="table table-striped cart-table">
	<thead>
    	<tr>
        	<th class="left" colspan="2">PRODUCT <i class="fa fa-sort-alpha-asc blue-text sort-list"></i></th>
            <th class="center">REG START <i class="fa fa-sort-numeric-asc blue-text sort-list"></i></th>
            <th class="center">REG FINISH <i class="fa fa-sort-numeric-asc blue-text sort-list"></i></th>
            <th class="center">DOWNLOAD</th>
        </tr>
    </thead>
    
    <tbody>
    <?php if(isset($orders) && $orders) { ?>
   	<?php foreach($orders as $order){ ?>
    	<tr id="cart-item-row-1">
        	<td width="100" class="left col-sm-1"><div class="cart-product-img-wrap push"><?=modules::run('product/load_product_hero_thumb_image',$order->product_id);?></div></td>
            <td class="left col-sm-6"><?=$order->product_name . ' ' . $order->product_subtitle; ?></td>
            <td class="center remove-line-height col-sm-2"><?=date('d-m-Y',strtotime($order->created));?></td>
            <td class="center col-sm-2"><?=date('d-m-Y',strtotime($order->reg_expiry));?></td>
            <td class="center col-sm-1"><a href="<?=base_url();?>customer/download/<?=$order->order_item_id;?>"><i class="fa fa-download fa-2x pointer download-product"></i></a></td>
        </tr>
    
    <?php } ?>
    <?php } ?>
    </tbody>
</table>
