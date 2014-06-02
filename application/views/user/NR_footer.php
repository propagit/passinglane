<script>
function validate()
{
	var username = jQuery('#username').val();
	var password = jQuery('#password').val();
	
	jQuery.ajax({
		url: '<?=base_url()?>client/ajax/validate/',
		type: 'POST',
		data: ({username:username,password:password}),
		dataType: "html",
		success: function(html) {
	
			if(html=='ok')
			{
				window.location='<?=base_url()?>client';
			}else
			{
				jQuery('#any_message').html("Sorry, your username and password are not correct");
		jQuery('#anyModal').modal('show');
			}
		}
	});
}
</script>

<!-- begin footer-->
<div class="container">
	<div class="wrap" id="footer-wrap">
    	<div class="row">
            <div class="col-xs-12 footer-links-row">
                <div class="col-xs-4 footer-box">
                  <h3>login to your account</h3>
                  <span>Check your website stats and manage your email</span>
                  <form name="footer_login" id="footer_login" action="<?=base_url()?>client/validate" method="post">
                  <input type="text" class="login-txt-box" id="username" name="username" data="required" err-msg="User Name is mandatory" placeholder="User Name"/> 
                  <input type="password" class="login-txt-box" id="password" name="password" data="required" err-msg="Password is mandatory" placeholder="Password"/> 
                  <button type="button" class="button login-btn" onclick="validate();"><i class="fa fa-angle-double-right"></i> LOGIN</button>
                  </form>
                </div>
                <div class="col-xs-8 footer-box">
                  <h3>quick jump menu</h3>
                  <ul class="quick-links quick-links-first-set">
                  	<li>site links</li>
                    <li><a href="#">home</a></li>
                    <li><a href="#">company</a></li>
                    <li><a href="#">our products</a></li>
                    <li><a href="#">our services</a></li>
                    <li><a href="#">case studies</a></li>
                    <li><a href="#">news media</a></li>
                    <li><a href="#">contact us</a></li>
                  </ul>
                  <ul class="quick-links">
                  	<li>our services</li>
                    <li><a href="#">site survey</a></li>
                    <li><a href="#">network engineering</a></li>
                    <li><a href="#">network install</a></li>
                    <li><a href="#">network maintenance</a></li>
                    <li><a href="#">link monitoring</a></li>
                  </ul>
                  <ul class="quick-links">
                  	<li>our products</li>
                    <li><a href="#">wireless microwave network</a></li>
                    <li><a href="#">licensed wireless microwave</a></li>
                    <li><a href="#">laser communications</a></li>
                    <li><a href="#">unlicensed bridge routers</a></li>
                    <li><a href="#">ultra fast network solutions</a></li>
                  </ul>   
                </div>
            </div>
            <div class="col-xs-12 float-left"><hr class="footer-hr" /></div>
            <div class="col-xs-12 footer-links-row">
                <div class="col-xs-4 footer-box">
                  <h3>wave 1 offices</h3>
                  <ul class="footer-locations-link">
                  	<li>VIC</li>
                    <li>19 Laser Drive</li>
                    <li>rowville vic 3178</li>
                  </ul>
                  <ul class="footer-locations-link">
                  	<li>NSW</li>
                    <li>Unit 5, 13 - 15 Wollongong Road</li>
                    <li>Arncliffe NSW 2205</li>
                  </ul>
                  <ul class="footer-locations-link">
                  	<li>QLD</li>
                    <li>Unit 13, 547 Kessels Road</li>
                  </ul> 
                </div>
                <div class="col-xs-4 footer-box">
                  <h3>support - contact us</h3> 
                  <span class="contact-us-span">Talk to a Wave 1 sales or support technician via calling the phone numbers below.</span>
                    <dl>
                        <dt>VIC</dt>
                        <dd><i class="fa fa-phone"></i> +61 (03) 9212 7200</dd>
                        <dt>&nbsp;</dt>
                        <dd><i class="fa fa-envelope-o"></i><span class="head">EMAIL</span> - <a href="mailto:<?=vic_support_email;?>">click here</a></dd>
                    </dl>
                    <dl>
                        <dt>NSW</dt>
                        <dd><i class="fa fa-phone"></i> +61 (02) 9556 1500</dd>
                        <dt>&nbsp;</dt>
                        <dd><i class="fa fa-envelope-o"></i><span class="head">EMAIL</span> - <a href="mailto:<?=nsw_support_email;?>">click here</a></dd>
                    </dl>
                    <dl>
                        <dt>QLD</dt>
                        <dd><i class="fa fa-phone"></i> +61 (07) 3343 0555</dd>
                        <dt>&nbsp;</dt>
                        <dd><i class="fa fa-envelope-o"></i><span class="head">EMAIL</span> - <a href="mailto:<?=qld_support_email;?>">click here</a></dd>
                    </dl>
                </div>
                <div class="col-xs-4 footer-box">
                 <?php if(0) {?>
                 <h3>socialise</h3> 
                 <span>Can't Get Enought Wave 1 Then Get More</span>
                 <div class="social-links">
                     <a href="<?=fb_url;?>"><i class="fa fa-facebook-square"></i></a>
                     <a href="<?=twitter_url;?>"><i class="fa fa-twitter-square"></i></a>
                     <a href="<?=linkedin_url;?>"><i class="fa fa-linkedin-square"></i></a>
                 </div>
                 <?php } ?>
                 <span class="copy">&copy; Copyright Wave1 PTY LTD</span>
                 <span class="copy">ABN 74 006 395 026</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end footer-->

<div id="anyModal" class="modal  fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
      <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Message</h3>
</div>
<div class="modal-body">
    <p id="any_message"></p>
</div>
<div class="modal-footer">
<button class="button login-btn" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
</div>
</div>
</div>
