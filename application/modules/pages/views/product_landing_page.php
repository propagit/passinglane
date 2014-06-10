<div class="container">
    <div class="content-wrap">
        <div class="inner-content">
            <div class="col-md-12 page-breaker">
                <h3 class="stitched grey-bg"><?=$title;?></h3><br />
                <ul>
                <? foreach($products as $product) { ?>
                 <li class="col-md-3" style="margin-bottom: 15px;">
                  <div class="carousel-product-box">
                      <a href="<?=base_url();?>products/<?=$product->id_title;?>">
                      <div class="product-img-box">
                          <?=modules::run('product/load_product_hero_thumb_image',$product->id);?>
                      </div>
                      <span class="product-title"><?=(strlen($product->title .' '. $product->subtitle) > 26 ? substr($product->title .' '.$product->subtitle,0,26).'..' : $product->title .' '.$product->subtitle);?></span>
                      </a>
                      <span class="product-price">$<?=($product->sale_price > 0 ? $product->sale_price : $product->price);?>
                        <? if($product->price > $product->sale_price
                            && $product->sale_price > 0) { ?>
                          <span class="ori_price">
                              $<?=$product->price;?>
                          </span>
                          <? } ?>
                      </span>
                      <button class="btn btn-primary add-to-cart" data-product-id="<?=$product->id?>"><i class="fa fa-plus"></i> ADD</button>
                  </div>
                </li>
                <? } ?>
                </ul><br />
            </div>
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
