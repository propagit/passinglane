<div class="container">
	<div class="content-wrap">
        <div class="inner-content top-padding">           
            <div class="col-md-12 remove-gutters push">
            	<div class="col-md-7 push remove-gutters">
                     <a class="back-link"><i class="fa fa-angle-left"></i>Keep Shopping</a>
                	<h1>FORGOT PASSWORD</h1>
					<p class="short-desc">Enter the email address you used to sign up at Passing Lane Website and we will send you your new password.</p>
                </div>
            </div>
            
            <div class="col-md-12 push remove-left-gutter">
            	<div class="custom-form-wrap grey-bg push full-width">
                	<form id="forgot-password-form">
                        <div class="form-group">
                            <label for="login_email" class="col-sm-3 control-label">Your Email Address</label>
                            <div class="col-sm-5">
                                <input type="email" class="form-control login-input" id="forgot-password-email" name="forgot_password_email" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-5 col-sm-offset-3">
                                <a class="forgot-password" href="<?=base_url();?>customer/sign_in"><i class="fa fa-arrow-circle-left"></i> BACK TO LOGIN PAGE</a> <button id="reset-password-btn" type="button" class="btn btn-primary pull"><i class="fa fa-unlock-alt"></i> RESET</button>
                            </div>
                        </div>
                	</form>
                </div>
            </div> 
            
            <div class="col-md-12 push remove-left-gutter">                
                <div id="reset-password-msg" class="alert"></div>
            </div>             
        </div>
    </div>
</div>
<script>

$j(function(){
	$j('#reset-password-btn').on('click',function(){
		reset_password();
	});
});

function reset_password()
{
	$j('#reset-password-msg').addClass('alert-warning').html('<i class="fa fa-spinner fa-spin"></i>');
	$j.ajax({
	type: "POST",
	dataType: "JSON",
	url: "<?=base_url();?>customer/ajax/reset_password",
	data: {email:$j('#forgot-password-email').val()},
	success: function(data) {
			$j('#reset-password-msg').removeClass('alert-warning');
			if(data['status']){
				$j('#forgot-password-email').val('');
				$j('#reset-password-msg').addClass('alert-success').html(data['msg']);	
			}else{
				$j('#reset-password-msg').addClass('alert-danger').html(data['msg']);	
			}
			setTimeout(function(){
				$j('#reset-password-msg').removeClass('alert-success').removeClass('alert-danger').html('');
			},3000); 
	  	}
	});		
}
</script>