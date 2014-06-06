<form id="login-form-customer-page">
    <div class="form-group">
        <label for="login_email" class="col-sm-3 control-label">Your Email Address</label>
        <div class="col-sm-5">
            <input type="email" class="form-control login-input" id="login_email" name="username" placeholder="">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-3 control-label">Your Email Address</label>
        <div class="col-sm-5">
            <input type="password" class="form-control login-input" id="login_password" name="password" placeholder="">
        </div>
    </div>
    <div class="form-group">
    	<!--<div class="alert alert-danger hide" id="msg-failed"><i class="fa fa-check"></i> &nbsp; Invalid login details.</div>-->
        <div class="col-sm-5 col-sm-offset-3">
            <a class="forgot-password" href="<?=base_url();?>customer/forgot_password"><i class="fa fa-question-circle"></i> FORGOT PASSWORD</a> <button id="login-customer" type="button" class="btn btn-primary pull"><i class="fa fa-unlock-alt"></i> LOGIN</button>
        </div>
    </div>
</form>

<script>
$j(function(){
	$j('#login-customer').click(function(){
		login();
	});
});

function login()
{
	$j.ajax({
	type: "POST",
	url: "<?=base_url();?>customer/ajax/login",
	data: $j('#login-form-customer-page').serialize(),
	success: function(html) {
		if(html == 'failed'){
			/* $j('#msg-failed').removeClass('hide');
			setTimeout(function(){
				$j('#msg-failed').addClass('hide');
			}, 4000); */
			$j('.login-input').effect('shake', {distance:12},600 );
		
		}else if(html == 'success'){
			window.location.href = "<?=$redirect_after_login_url;?>";	
		}
	  }
	});	
}
</script>