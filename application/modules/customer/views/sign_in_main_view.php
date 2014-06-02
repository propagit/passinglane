<div class="container">
	<div class="content-wrap">
        <div class="inner-content top-padding">           
            <div class="col-md-12 remove-gutters push">
            	<div class="col-md-7 push remove-gutters">
                     <a class="back-link"><i class="fa fa-angle-left"></i>Keep Shopping</a>
                	<h1>SIGN IN</h1>
					<p class="short-desc">If you have already registered with Passign Lane, the sign in as below.</p>
                </div>
                <div class="col-md-5 checkout-stages pull">
                    <?php echo modules::run('cart/checkout_stage',checkout_stage_signin);?>
                </div>
            </div>
            
            <div class="col-md-12 push remove-left-gutter">
            	<div class="custom-form-wrap grey-bg push">
                	<?=modules::run('customer/login_form');?>
                </div>
            </div>
            
             <div class="col-md-12 push remove-left-gutter">
             	<h1>CREATE NEW ACCOUNT</h1>
                <p class="short-desc">Create a new member account by filling in the form below</p>
            	<div class="custom-form-wrap grey-bg push no-padding">
                	<?=modules::run('customer/customer_sign_up_form');?>
                </div>
            </div>
            
        </div>
    </div>
</div>