<div class="container">
	<div class="content-wrap">
        <div class="inner-content top-padding">
            <div class="col-md-12 remove-gutters customer-purchase-head-wrap push">
                <div class="col-md-9 remove-gutters">
                	<a class="back-link"><i class="fa fa-angle-left"></i>Keep Shopping</a>
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
            
             <div class="col-md-12 push remove-left-gutter top-padding bottom-padding">
             	<?php echo modules::run('customer/purchased_items'); ?>
            </div>
            
        </div>
    </div>
</div>