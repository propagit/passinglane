<div class="container">
	<div class="content-wrap">
        <div class="inner-content top-padding">
            <div class="col-md-12 remove-gutters customer-purchase-head-wrap push">               
                <div class="col-md-9 remove-gutters">
                	<a class="back-link"><i class="fa fa-angle-left"></i>Keep Shopping</a>
                    <h1>YOUR PROFILE</h1>
                    <p class="short-desc">You can update your profile details from here</p>
                </div>
                <div class="col-md-3 remove-left-gutter right-btn-wrap">
                	<a href="<?=base_url();?>customer/orders"><div class="btn btn-primary btn-lg pull "><i class="fa fa-paperclip"></i> MY ORDERS</div></a>
                </div>
            </div>
            
             <div class="col-md-12 push remove-left-gutter">
             	<?php if($this->session->flashdata('profile_created')){?>
                <div class="alert alert-success" id="msg-success-profile-created"><i class="fa fa-check"></i> &nbsp; Your profile was successfully created</div>
                <?php } ?>
            	<div class="custom-form-wrap grey-bg push">
                	<?=modules::run('customer/customer_profile_update_form');?>
                </div>
            </div>
            
        </div>
    </div>
</div>