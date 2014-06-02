<?php if(count($feature_products) > 0){ ?>
<?php foreach($feature_products as $product){ ?>
<div class="col-xs-6 remove-gutters">
    <div class="product-box">
        <a href="<?=base_url();?>products/<?=$product->id_title;?>">
        <div class="product-image feature-product-image"><?=modules::run('product/load_product_hero_thumb_image',$product->id);?></div>
        </a>
        <div class="product-text">
            <div class="product-title"><i class="fa <?=$product->product_type == 'video' ? ' fa-video-camera' : 'fa-book';?>"></i> <?=strtoupper($product->product_type);?> - RESOURCES</div>
            <div class="product-subtitle"><?=(strlen($product->title .' '. $product->subtitle) > 35 ? substr($product->title .' '.$product->subtitle,0,35).'..' : $product->title .' '.$product->subtitle);?></div>
            <div class="product-description">
            	<p class="p-description"><?=substr($product->long_desc,0, 140).'...';?></p> 
            </div>
            <button type="button" class="btn btn-primary right10" onclick="javascript:location.href='<?=base_url();?>products/<?=$product->id_title;?>'"><i class="fa fa-info-circle right5"></i> MORE INFO</button>
            <button type="button" class="btn btn-primary add-to-cart" data-product-id="<?=$product->id?>"><i class="fa fa-shopping-cart right5"></i> ADD TO CART</button>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php } ?>
<?php } ?>
<script>
$j(function(){
	$j('.add-to-cart').on('click',function(){
		var product_id = $j(this).attr('data-product-id');
		var quantity = 1;
		cart.add(product_id,quantity);
	});
	
});//ready

</script>