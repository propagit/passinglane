<?php if(count($feature_products) > 0){ ?>
<div class="grey-box">
    <div class="title-page">EXISTING FEATURE PRODUCTS</div>
</div>	
<div class="sub-title">
	Drag and drop by holding the <i class="fa fa-move blue-icon "></i> icon to change the order the feature products are displayed and then hit update to save.
</div>
<br />
<div class="table-responsive">
	<form id="feature-products-sort-form">
    <table class="table table-bordered table-hover table-middle table-expanded">
        <thead>
            <tr class="list-tr">
                <th class="left sort-item-name">PRODUCT NAME</th>
                <th class="center sort-item-action">DELETE</th>
            </tr>
        </thead>
        <tbody id="sortable-feature-products">
        <?php
            foreach($feature_products as $product){
        ?>
            <tr id="product-tr-<?=$product->id;?>" class="list-tr sortable">
                <td class="left sort-item-name"><?=$product->title.' '.$product->subtitle;?></td>
                <td class="center sort-item-action" width="100"><a class="remove-feature-product" data-remove-feature-product-id="<?=$product->id;?>"><i class="fa fa-times blue-icon pointer"></i></a></td>
                <input type="hidden" name="product_ids[]" value="<?=$product->id;?>" />
            </tr>
        <?		
            }
        ?>
        </tbody>
    </table>
    </form>
</div>

<div class="grey-box">
    <button class="btn btn-info" id="update-display-order"><i class="fa fa-save"></i> UPDATE</button>
</div>	

<div class="col-md-12 remove-gutter push message-wrap full-width">
    <div class="alert alert-success hide push full-width" id="sort-msg-success"><i class="fa fa-check"></i> &nbsp; <span id="sort-msg-success-span"></span></div>
    <div class="alert alert-danger hide push full-width" id="sort-msg-error"><i class="fa fa-times"></i> &nbsp; <span  id="sort-msg-error-span"></span></div>
</div>
<?php } ?>
<script>
$j(function(){
	//init sort
	$j('#sortable-feature-products').sortable();
	
	//remove feature product
	$j('.remove-feature-product').on('click',function(){
		var product_id = $j(this).attr('data-remove-feature-product-id');
		$j.ajax({
			type: "POST",
			url: "<?=base_url();?>admin/product/ajax/remove_feature_product",
			data: {product_id:product_id},
			success: function(html) {
				if(html == 'success'){
					$j('#product-tr-'+product_id).remove();
				}else{
					alert('Something went wrong! Please try again!')	
				}
			}
		});	
	});
	
	//update display order
	$j('#update-display-order').on('click',function(){
		sort_feature_product_display_order();
	});
	
});//ready

function sort_feature_product_display_order()
{
	$j.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/product/ajax/sort_feature_product_display_order",
		data: $j('#feature-products-sort-form').serialize(),
		dataType:'json',
		success: function(data) {
			if(data['status']){
				$j('#sort-msg-success-span').html(data['msg']);
				$j('#sort-msg-success').removeClass('hide');
				setTimeout(function(){
					$j('#sort-msg-success').addClass('hide');
					$j('#sort-msg-success-span').html('');
				}, 2000);
			}else{
				$j('#sort-msg-error-span').html(data['msg']);
				$j('#sort-msg-error').removeClass('hide');
				setTimeout(function(){
					$j('#sort-msg-error').addClass('hide');
					$j('#sort-msg-error-span').html('');
				}, 2000);
			}
			
		}
	});		
}

</script>
