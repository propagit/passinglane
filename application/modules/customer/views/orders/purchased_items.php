<table class="table table-striped cart-table">
	<thead>
    	<tr>
        	<th class="left" colspan="2">PRODUCT <i class="fa <?=($sort_by == 'product_name' ? 'fa-sort-alpha-'.$sort_order : 'fa-sort-alpha-asc');?> blue-text sort-list pointer" sort-by="product_name"></i></th>
            <th class="center">REG START <i class="fa <?=($sort_by == 'created' ? 'fa-sort-numeric-'.$sort_order : 'fa-sort-numeric-asc');?> blue-text sort-list pointer" sort-by="created"></i></th>
            <th class="center">REG FINISH <i class="fa <?=($sort_by == 'reg_expiry' ? 'fa-sort-numeric-'.$sort_order : 'fa-sort-numeric-asc');?> blue-text sort-list pointer" sort-by="reg_expiry"></i></th>
            <th class="center">DOWNLOAD</th>
        </tr>
    </thead>
    
    <tbody>
    <?php if(isset($orders) && $orders) { ?>
   	<?php foreach($orders as $order){ ?>
    	<tr data-toggle="collapse" data-target="#toggle-row-<?=$order->order_item_id;?>" class="accordion-toggle">
        	<td width="100" class="left col-sm-1"><div class="cart-product-img-wrap push"><?=modules::run('product/load_product_hero_thumb_image',$order->product_id);?></div></td>
            <td class="left col-sm-6"><?=$order->product_name . ' ' . $order->product_subtitle; ?></td>
            <td class="center remove-line-height col-sm-2"><?=date('d-m-Y',strtotime($order->created));?></td>
            <td class="center col-sm-2"><?=date('d-m-Y',strtotime($order->reg_expiry));?></td>
            <td class="center col-sm-1"><i class="fa fa-download fa-2x pointer download-product"></i></td>
        </tr>
        <tr>
        	<td colspan="5" class="no-padding no-border-top">
            	 <div class="accordian-body collapse" id="toggle-row-<?=$order->order_item_id;?>">
				<?php
                    $product_files = modules::run('product/get_product_files',$order->product_id);
                    if(count($product_files) > 0){
                        foreach($product_files as $product_file){
                ?>
                        <a target="_blank" class="customer-download" href="<?=base_url();?>customer/download/<?=$order->order_item_id;?>/<?=$product_file['file_id'];?>"><?=$product_file['file_name'];?></a>
                <?php
                        }
                    }
                ?>
                </div>
            </td>
        </tr>
    <?php } ?>
    <?php } ?>
    </tbody>
</table>