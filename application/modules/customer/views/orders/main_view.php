<div class="container">
	<div class="content-wrap">
        <div class="inner-content top-padding">
            <div class="col-md-12 remove-gutters customer-purchase-head-wrap push">
                <div class="col-md-9 remove-gutters">
                	<?=modules::run('pages/keep_shopping');?>
                    <h1>VIEW YOUR ORDERS</h1>
                    <p class="short-desc">
                        Your pruchased products are available for download for 3 years from the date of purchase. <br />
                        The registration date of the product is displayed in the below table.
                    </p>
                </div>
                <div class="col-md-3 remove-left-gutter right-btn-wrap">
                	<a href="<?=base_url();?>customer/profile"><div class="btn btn-primary btn-lg pull "><i class="fa fa-user"></i> MY PROFILE</div></a>
                </div>
            </div>
            
             <div id="purchased-items" class="col-md-12 push remove-left-gutter top-padding bottom-padding">

             </div>
            
        </div>
    </div>
</div>
<form id="customer-purchase-items">
	<input type="hidden" id="sort-by" name="sort_by" value="product_name" />
    <input type="hidden" id="sort-order" name="sort_order" value="ASC" />
</form>
<script>

$j(function(){
	get_purchase_items();
	
	//sort result
	$j(document).on('click','.sort-list',function(){
		var cur_obj = $j(this);
		var cur_sort_order = $j('#sort-order').val();
		$j('#sort-by').val(cur_obj.attr('sort-by'));
		$j('#sort-order').val(cur_sort_order == 'DESC' ? 'ASC' : 'DESC');
		get_purchase_items();
	});
});


function get_purchase_items()
{
	help.loading();
	$j.ajax({
		type: "POST",
		url: "<?=base_url();?>customer/ajax/get_customer_order",
		data:$j('#customer-purchase-items').serialize(),
		success: function(html) {
				help.remove_loading();
				$j('#purchased-items').html(html);
		  	}
	});	
}
</script>