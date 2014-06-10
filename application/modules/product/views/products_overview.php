<div class="container">
	<div class="content-wrap">
        <div class="inner-content">
            <div class="col-md-6 remove-gutters resource-info">
                <? if ($product->product_type == 'video') { ?>
                <a class="back-link uppercase" href="<?=base_url();?>page/Video"><i class="fa fa-angle-left"></i> Back To Video</a>
                <? } else { ?>
                <a class="back-link uppercase" href="<?=base_url();?>page/Resources"><i class="fa fa-angle-left"></i> Back To Resources</a>
                <? } ?>

                <h1><?=$product->title;?></h1>
                <h2><?=$product->subtitle;?></h2>
                <p class="short-desc"><?=$product->short_desc;?></p>
                <h3>DESCRIPTION</h3>
                <p><?=nl2br($product->long_desc);?></p>

             	<?=modules::run('product/load_product_modules',$product->modules);?>

              <ul>
              	 <?php if($product->product_brochure != ''){ ?>
				 <li><a target="_blank" href="<?=base_url();?>uploads/products/<?=md5('mbb'.$product->id);?>/doc/<?=$product->product_brochure;?>"><i class="fa fa-download"></i> DOWNLOAD INFORMATION SHEET</a></li>
                 <?php } ?>
                 <li><a href="#"><i class="fa fa-envelope"></i> TELL A FRIEND</a></li>
              </ul>

            </div>
            <div class="col-md-6 remove-gutters">
                <div class="resource-img-wrap">
                	<?=modules::run('product/load_product_hero_image',$product->id);?>
                </div>

                <div class="purchase-wrap">
                    <button class="btn btn-primary btn-lg add-to-cart" data-product-id="<?=$product->id?>"><i class="fa fa-plus"></i> ADD TO CART</button>
                    <a href="<?=base_url();?>cart/checkout"><div class="btn btn-primary-inverse btn-lg"><i class="fa fa-shopping-cart"></i> CHECKOUT</div></a>
                    <?php

						$price = $product->sale_price > 0 ? $product->sale_price : $product->price;
						$price_arr = explode('.',$price);
					?>
                    <span class="price">$<?=$price_arr[0];?><sub>.<?=$price_arr[1];?></sub></span>
                    <? if ($price != $product->price) { ?>
                    <span class="ori_price">$<?=money_format('%i', $product->price);?></span>
                    <? } ?>
                </div>
            </div>

            <?php if(modules::run('product/has_cross_sale',$product->id)){ ?>
            <div class="col-md-12 page-breaker">
            	<h3 class="stitched grey-bg">Supporting Resources</h3>

                <div class="supporting-resource-wrap">
                	<?=modules::run('product/load_supporting_resource',$product->id);?>
                </div>

            </div>
            <?php } ?>

            <div class="col-md-12 page-breaker">
            	<h3 class="stitched">You May Also Like</h3>

                <div class="supporting-resource-wrap">
                	 <?=modules::run('product/load_similar_products');?>
                </div>
            </div>

            <div class="col-md-12 page-breaker"><hr class="single-stitched" /></div>
        </div>
    </div>
</div>
<script>
$j(function(){
	$j('.add-to-cart').on('click',function(){
		var product_id = $j(this).attr('data-product-id');
		var quantity = 1;
		cart.add(product_id,quantity);
	});

});//ready

</script>
