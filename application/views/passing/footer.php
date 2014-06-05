<div id="footer-wrapper">
	<div class="white-line">
        <div class="container">
            <div class="wrap">
                <div class="row">
                	<div class="col-xs-4">
                    	<div class="login-member">
                        	<form id="footer-login-form">
                        	<span class="footer-title">Login - </span><span class="footer-subtitle">Member Account</span>
                            <p class="p-description">Login to your member account to download <br /> your purchased resource.</p>
                            <input name="username" type="text" class="input-txt footer-login-input" placeholder="User Name" />
                            <input name="password" type="password" class="input-txt footer-login-input" placeholder="Password" />
                            <div class="left-side">
                            	<a class="blue-link support-text-detail" href="#">Forgot Password</a><br />
                            	<a class="blue-link support-text-detail" href="<?=base_url();?>customer/sign_in">Don't have an account?</a>
                            </div>
                            <div class="right-side">
                            	<button id="footer-login-btn" type="button" class="btn btn-primary right10"><i class="fa fa-unlock-alt right5"></i> LOGIN</button>
                            </div>
                            </form>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                    	<div class="login-member">
                        	<span class="footer-title">Support - </span><span class="footer-subtitle">Need Help</span>
                            <p class="p-description">Contact Passing Lane support staff for assistance via phone or email.</p>
                            <table width="95%">
                            	<tr>
                                	<td width="15%" valign="top"><i class="fa fa-phone blue"></i></td>
                                    <td width="30%" valign="top"><span class="support-text">Call</span></td>
                                    <td width="40%"><a href="#" class="blue-link support-text-detail">1300 64 98 63</a></td>
                                </tr>
                                <tr>
                                	<td valign="top"><i class="fa fa-print blue"></i></td>
                                    <td valign="top"><span class="support-text">Fax</span></td>
                                    <td><a href="#" class="blue-link support-text-detail">1300 64 98 64</a></td>
                                </tr>
                                <tr>
                                	<td valign="top"><i class="fa fa-envelope-o blue"></i></td>
                                    <td valign="top"><span class="support-text">Email</span></td>
                                    <td><a href="#" class="blue-link support-text-detail">CLICK HERE</a></td>
                                </tr>
                                <tr>
                                	<td valign="top"><i class="fa fa-info-circle blue"></i></td>
                                    <td valign="top"><span class="support-text">Terms</span></td>
                                    <td><a href="#" class="blue-link support-text-detail">CLICK HERE</a></td>
                                </tr>
                                <tr>
                                	<td valign="top"><i class="fa fa-home blue"></i> </td>
                                    <td valign="top"><span class="support-text">Address</span></td>
                                    <td><a href="#" class="blue-link support-text-detail">PO Box 975, COWES VIC 3922 AUSTRALIA</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-4">
                    	<div class="join-column">
                        	<span class="footer-title">Join - </span><span class="footer-subtitle">Our Mailing List</span>
                            <p class="p-description">Keep up to date with with resource updates and special member only discounts.</p>
                            <input id="subscriber-email" type="text" class="input-txt" placeholder="Your Email Address" required/><br />                                                      
                            <div class="right-side">
                            	<button id="subscriber-btn" type="button" class="btn btn-primary right10"><i class="fa fa-envelope-o right5"></i> JOIN</button>
                            </div>
                             <div id="subscription-msg" class="alert subscription-msg-alert"></div>
                        </div>
                    </div>
                </div>
         	</div>
        </div>
    </div>
    <div class="container jump-container">
    	<div class="wrap">
            <div class="row">
                <div class="col-xs-12">
                    
                    <span class="footer-title">Link - </span><span class="footer-subtitle">Jump</span><br />
                    <ul class="footer-jump">
                        <li><a href="#" class="blue-link">HOME</a></li>
                        <li><a href="#" class="blue-link">ABOUT</a></li>
                        <li><a href="#" class="blue-link">RESOURCES</a></li>
                        <li><a href="#" class="blue-link">TRAINING VIDEOS</a></li>
                        <li><a href="#" class="blue-link">CONTACT</a></li>
                    </ul>
                    
                    <ul class="footer-jump">
                        <li><a href="#" class="blue-link">MY CART</a></li>
                        <li><a href="#" class="blue-link">MY ACCOUNT</a></li>
                        <li><a href="#" class="blue-link">SIGN UP</a></li>
                        <li><a href="#" class="blue-link">TERMS & CONDITIONS</a></li>
                        <li><a href="#" class="blue-link">PRIVACY POLICY</a></li>
                    </ul>
                    
                    <ul class="footer-jump">
                        <li><a href="#" class="blue-link">HOSPITALITY</a></li>
                        <li><a href="#" class="blue-link">BUSINESS</a></li>
                        <li><a href="#" class="blue-link">AGRICULTURE</a></li>
                        <li><a href="#" class="blue-link">RETAIL</a></li>
                        <li><a href="#" class="blue-link">TRANSPORT & LOGISTICS</a></li>
                    </ul>
                    
                    <ul class="footer-jump">
                        <li><a href="#" class="blue-link">EVENTS</a></li>
                        <li><a href="#" class="blue-link">TOURISM</a></li>
                        <li><a href="#" class="blue-link">SPORT & RECREATIONAL</a></li>
                        <li><a href="#" class="blue-link">INFORMATION TECHNOLOGY</a></li>
                        <li><a href="#" class="blue-link">CONSTRUCTION</a></li>
                    </ul>
                    
                    <ul class="footer-jump">
                        <li><a href="#" class="blue-link">SCREEN & MEDIA</a></li>
                        <li><a href="#" class="blue-link">METAL & ENGINEERING</a></li>
                        <li><a href="#" class="blue-link">HORTICULTURE</a></li>
                        <li><a href="#" class="blue-link">COMMUNITY SERVICES</a></li>
                        <li><a href="#" class="blue-link">WORK STUDIES (NSW & QLD)</a></li>
                    </ul>
                </div>
            </div>
        </div>
     </div>
</div>

<script>
$j(function(){
	$j('#footer-login-btn').click(function(){
		footer_login();
	});
	
	$j('#subscriber-btn').on('click',function(){
		subscribe_to_newsletter();
	});
});

function subscribe_to_newsletter()
{
	$j('#subscription-msg').addClass('alert-warning').html('<i class="fa fa-spinner fa-spin"></i>');
	$j.ajax({
	type: "POST",
	dataType: "JSON",
	url: "<?=base_url();?>customer/ajax/add_subscriber",
	data: {email:$j('#subscriber-email').val()},
	success: function(data) {
			$j('#subscription-msg').removeClass('alert-warning');
			if(data['status']){
				$j('#subscriber-email').val('');
				$j('#subscription-msg').addClass('alert-success').html(data['msg']);	
			}else{
				$j('#subscription-msg').addClass('alert-danger').html(data['msg']);	
			}
			setTimeout(function(){
				$j('#subscription-msg').removeClass('alert-success').removeClass('alert-danger').html('');
			},3000);
	  	}
	});		
}

function footer_login()
{
	$j.ajax({
	type: "POST",
	url: "<?=base_url();?>customer/ajax/login",
	data: $j('#footer-login-form').serialize(),
	success: function(html) {
		if(html == 'failed'){
			$j('.footer-login-input').effect('shake', {distance:12},600 );
		}else if(html == 'success'){
			window.location.href = "<?=base_url();?>customer/profile";	
		}
	  }
	});	
}
</script>
