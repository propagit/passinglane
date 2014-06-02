<div class="container">
	<div class="content-wrap">
        <div class="inner-content top-padding">           
            <div class="col-md-12 remove-gutters push">
            	<div class="col-md-7 push remove-gutters">
                     <a class="back-link"><i class="fa fa-angle-left"></i>Keep Shopping</a>
                	<h1>PAYMENT SUCCESSFUL</h1>
					<p class="short-desc">
                    Your order was successfully processed. We will redirect to your download page shortly. If the page does not redirect automatically <a href="<?=base_url();?>customer/orders">click here</a>
                    </p>
                    <div style="min-height:400px"></div>
                </div>
            </div>

            
        </div>
    </div>
</div>
<script>
$j(function(){
	setTimeout(function(){
		window.location.href = "<?=base_url();?>customer/orders";
	},3000);
	
});
</script>