<div class="row row-bottom-margin">
	<div class="col-md-12">
		<div class="title-page">MANAGE FEATURE PRODUCTS</div>
		<div class="sub-title">
			You can add feature product by selecting a product from the select field below. <br />
            Once you have selected a product that you would like to appear as a feature product, click Add to save it as a feature product. 
		</div>
		

        <div class="grey-box">
        	<div class="title-page">ADD FEATURE PRODUCTS</div>
        </div>	

        <form id="add-feature-product-form">
            <div class="form-search-gap"></div>
            <div class="form-search-label">Product List</div>
            <div class="form-search-input">
                <select class="custom-select2" name="product_id">
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
            </div> 
        	<div class="form-search-gap"></div>
            <div class="form-search-label">&nbsp;</div>
            <div class="form-search-input">
                <button id="set-feature-product" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add</button>
            </div> 

         </form>
     </div>
     <div class="col-md-12 remove-gutter push message-wrap">
        <div class="alert alert-success hide push full-width" id="msg-success"><i class="fa fa-check"></i> &nbsp; <span id="msg-success-span"></span></div>
        <div class="alert alert-danger hide push full-width" id="msg-error"><i class="fa fa-times"></i> &nbsp; <span  id="msg-error-span"></span></div>
     </div>
     
     <div id="existing-feature-products" class="col-md-12 push">
     	<?=modules::run('adminproduct/feature_products_list');?>
     </div>

</div>
<script>
$j(function(){
	//init select 2
	$j('.custom-select2').select2();
	
	//set product as feature product
	$j('#set-feature-product').on('click',function(){
		set_feature_product();
	});
});

function set_feature_product()
{
	$j.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/product/ajax/set_feature_product",
		data: $j('#add-feature-product-form').serialize(),
		dataType:'json',
		success: function(data) {
			if(data['status']){
				$j('#msg-success-span').html(data['msg']);
				$j('#msg-success').removeClass('hide');
				setTimeout(function(){
					$j('#msg-success').addClass('hide');
					$j('#msg-success-span').html('');
				}, 2000);
				load_existing_feature_product();
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

function load_existing_feature_product()
{
	$j.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/product/ajax/load_existing_feature_products",
		success: function(html) {
			$('#existing-feature-products').html(html);
		}
	});			
}
</script>