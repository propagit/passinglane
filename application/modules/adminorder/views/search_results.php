<div id="top-table">
    <div class="push">
        <div id="top-table-title">Your Orders <span id="total-count"><strong>[Total Records Found - <?=count($total_orders);?>]</strong></span></div>
    </div> 
    <ul class="pagination custom-pagination pull">
        <?=modules::run('helpers/create_pagination',count($total_orders),records_per_page,$current_page)?>
    </ul>        
    <div style="clear: both"></div>
</div>
<div class="table-responsive">
<?php if(count($orders) > 0) { ?>
    <table class="table custom-table">
        <thead>
            <tr>
                <th width="120">Order ID <i class="fa fa-unsorted sort-results" sort-by="order_id"></i></th>
                <th>Customer Name <i class="fa fa-unsorted sort-results" sort-by="delivery_fullname"></i></th>
                <th width="150">Order Date <i class="fa fa-unsorted sort-results" sort-by="created"></i></th>
                <th width="100">Total</th>
                <th width="120">Status <i class="fa fa-unsorted sort-results" sort-by="order_status"></i></th>
                <th width="100" class="center">View</th>
                <th width="100" class="center">Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order){ ?>
            <tr>
                <td><?=$order->order_id;?></td>
                <td><?=$order->delivery_fullname;?></td>
                <td><?=date('d-m-Y',strtotime($order->created));?></td>
                <td>$<?=money_format('%i',$order->total);?></td>
                <td id="order-status-<?=$order->order_id;?>">
                	<?=ucwords($order->order_status);?>
                	<? if ($order->order_status == "not paid") { ?>
                	<span class="mark-paid" data-toggle="tooltip" title="Mark as Paid" style="cursor: pointer" onclick="mark_as_paid(<?=$order->order_id;?>)">
						<i class="fa fa-thumbs-o-down"></i>
					</span>
                	<? } else if ($order->order_status == "paid") { ?>
                	<span class="mark-paid" data-toggle="tooltip" title="Mark as Not Paid" style="cursor: pointer" onclick="mark_as_not_paid(<?=$order->order_id;?>)">
						<i class="fa fa-thumbs-o-up"></i>
					</span>
					<? } ?>
                </td>
                <td class="center"><a href="<?=base_url();?>admin/order/view_order/<?=$order->order_id;?>"><i class="fa fa-search"></i></a></td>
                <td class="center"><i class="fa fa-trash-o delete-order pointer" data-order-id="<?=$order->order_id;?>"></i></td>
            </tr>
        
        
        <?php } ?>    
        </tbody>
    </table>
<?php } ?>
</div>
<?php 
/* * 
	majority of the JS function are written in the 'application/modules/adminorder/views/search_results.php'
	since this page is called through ajax, this is done to reduce the same code being called again and again when performing functions such as sort etc
	
	list of function that gets called on an event assocaited with classes 
		- search_order()
		- delete_order()
*/
?>
<script>

jQuery(function() {
	$j('.mark-paid').tooltip({
		showURL: false
	});
});
function mark_as_paid(order_id) {
	$j.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/order/ajax/update_order_status",
		data: {order_id : order_id, status: 'paid'},
		success: function(html) {
			$j('#order-status-' + order_id).html(html);
			//$j('.mark-paid').tooltip('hide');
		}
	})
}
function mark_as_not_paid(order_id) {
	$j.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/order/ajax/update_order_status",
		data: {order_id : order_id, status: 'not paid'},
		success: function(html) {
			$j('#order-status-' + order_id).html(html);
			//$j('.mark-paid').tooltip('hide');
		}
	})
}

</script>