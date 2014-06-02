<div id="cross-sale-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
         <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h3 id="myModalLabel" class="title-page">Add Cross Sale Products</h3>
            </div>
            <div class="modal-body">
                <div class="col-md-12 remove-gutter push">
                    <p>
                    Selected Product: <strong>[<?=$main_product['title'].' '.$main_product['subtitle'];?>]</strong>
                    </p>
                    <div class="col-md-10 remove-gutter">
                        <form id="add-cross-sale-form">
                        <select class="custom-select2" name="cross_sale_product_id">
                            <option value="">Select One</option>
                            <?php
                                if(count($products) > 0){
                                    foreach($products as $product){
                            ?>
                                    <option value="<?=$product['id'];?>"><?=$product['title'] .' ['. $product['subtitle'] .']';?></option>
                            <?php	
                                    }
                                }
                            ?>
                        </select>
                        <input type="hidden" id="main-product-id" name="main_product_id" value="<?=$main_product_id?>" />
                        </form>
                    </div>
                    <div class="col-md-2 remove-right-gutter">
                        <button id="add-cross-sale" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add</button>
                    </div>
                </div>
                <div class="col-md-12 remove-gutter push message-wrap">
                    <div class="alert alert-success hide push full-width" id="msg-success"><i class="fa fa-check"></i> &nbsp; <span id="msg-success-span"></span></div>
                    <div class="alert alert-danger hide push full-width" id="msg-error"><i class="fa fa-times"></i> &nbsp; <span  id="msg-error-span"></span></div>
                </div>
                <div id="product-existing-cross-sales" class="col-md-12 remove-gutter push"></div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
       </div>
    </div>
</div>
<script>
$j(function(){
	//init select2
	$j('.custom-select2').select2();
	
	//load existing cross sale
	load_product_existing_cross_sales();
	
	//add cross sale
	$j('#add-cross-sale').on('click',function(){
		add_cross_sale();
	});
});

function load_product_existing_cross_sales()
{
	$j.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/product/ajax/load_existing_cross_sales",
		data: {main_product_id:$('#main-product-id').val()},
		success: function(html) {
			$('#product-existing-cross-sales').html(html);
		}
	});			
}

function add_cross_sale()
{
	$j.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/product/ajax/add_cross_sale",
		data: $j('#add-cross-sale-form').serialize(),
		dataType:'json',
		success: function(data) {
			if(data['status']){
				$j('#msg-success-span').html(data['msg']);
				$j('#msg-success').removeClass('hide');
				setTimeout(function(){
					$j('#msg-success').addClass('hide');
					$j('#msg-success-span').html('');
				}, 2000);
				load_product_existing_cross_sales();
			}else{
				$j('#msg-error-span').html(data['msg']);
				$j('#msg-error').removeClass('hide');
				setTimeout(function(){
					$j('#msg-error').addClass('hide');
					$j('#msg-error-span').html('');
				}, 2000);
			}
			
		}
	});		
		
}
</script>
