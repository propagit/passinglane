<?php if(count($products)){ ?>
<p><strong>Existing Cross Sale Products</strong></p>
<div class="table-responsive modal-table-wrap">
    <table class="table table-bordered table-hover table-middle table-expanded modal-table">
        <thead>
            <tr class="list-tr">
                <th class="left" width="100">Name</th>
                <th class="center" width="100">Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($products as $product){
        ?>
             <tr id="product-tr-<?=$product->id;?>" class="list-tr">
                <td class="left"><?=$product->title.' '.$product->subtitle;?></td>
                <td class="center" width="100"><a class="delete-cross-sale" data-cross-sale-product-id="<?=$product->id;?>"><i class="fa fa-times blue-icon pointer"></i></a></td>
            </tr>
        <?		
            }
        ?>
        </tbody>
    </table>
</div>
<?php } ?>
<script>
$j(function(){
	$j('.delete-cross-sale').on('click',function(){
		var product_id = $j(this).attr('data-cross-sale-product-id');
		var main_product_id = <?=$main_product_id;?>;
		$j.ajax({
			type: "POST",
			url: "<?=base_url();?>admin/product/ajax/delete_cross_sale",
			data: {main_product_id:main_product_id,product_id:product_id},
			success: function(html) {
				if(html == 'success'){
					$j('#product-tr-'+product_id).remove();
				}else{
					alert('Something went wrong! Please try again!')	
				}
			}
		});	
	});
});
</script>