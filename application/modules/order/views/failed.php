<div class="container">
	<div class="content-wrap">
        <div class="inner-content top-padding">
            <div class="col-md-12 remove-gutters push">
            	<div class="col-md-7 push remove-gutters">
                     <a class="back-link"><i class="fa fa-angle-left"></i>Keep Shopping</a>
                	<h1>PAYMENT FAILED</h1>
					<p class="short-desc">
                    <?=$this->session->userdata('order_error_msg');?>. <a href="<?=base_url();?>order/payment">Try another credit card.</a>
                    </p>

                    <div style="min-height:400px"></div>
                </div>
            </div>


        </div>
    </div>
</div>
