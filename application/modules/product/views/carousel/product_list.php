<?php
/* * 
	each block of <div class="item"> has four list elements
	<ul>
		<li></li>
		..
		..
		<li></li>
	</ul>
	
	the counter checks if four products has been added and then re creates the item block.
	the first item block is marked as active.
*/
	
?>


<div class="carousel slide col-md-12 multi-carousel" id="<?=$carousel_id;?>">
    <div class="carousel-inner">
    
        <div class="item multi-carousel-item active">
            <ul> 
        <?php
            $count = 0;
            if($products){
                foreach($products as $product){
                    if($count < 4){
                        echo modules::run('product/load_product_list_item',$product);
                        $count++;
                    }else{
                        $count = 1;
        ?>
            </ul>
        </div>
        <div class="item multi-carousel-item">
            <ul> 
                <?=modules::run('product/load_product_list_item',$product);?>
        <?php			
                    }
                }
            }
        ?>
            </ul>
        </div>
                                
    </div><!--carousel-inner-->
       
    <a class="left carousel-control" data-slide="prev" href="#<?=$carousel_id;?>"><i class="fa fa-angle-left multi-carousel-control"></i></a>
    <a class="right carousel-control" data-slide="next" href="#<?=$carousel_id;?>"><i class="fa fa-angle-right multi-carousel-control"></i></a>
</div>

<script>
$j(function(){
	$j('#<?=$carousel_id;?>').carousel({
   		pause: true,
    	interval: false
	});
});
 
</script>