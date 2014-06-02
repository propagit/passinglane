<div class="row row-bottom-margin">
	<div class="col-md-12">
		
        <div class="title-page">View Orders</div>
        <div class="sub-title">
        	The full order details and invoice are displayed below. Email this invoice or download the invoice as a PDF. <br />
            The payment status on this order can be changed on the manage orders page
        </div>
        <div class="box">
        	<button class="btn btn-info" onclick="window.location = '<?=base_url()?>admin/order';"><i class="fa fa-hand-o-left"></i> Back To Orders</button>
            <button class="btn btn-info pull add-lt-margin" onclick="window.location = '<?=base_url()?>admin/order/download/<?=$order_id;?>';"><i class="fa fa-download"></i> Download Invoice</button>
            <button class="btn btn-info pull" onclick="window.location = '<?=base_url()?>admin/order';"><i class="fa fa-envelope"></i> Email Invoice</button>
        </div>
		<div style="clear: both"></div>
		<?=modules::run('adminorder/tax_invoice',$order_id);?>
	</div>
</div>