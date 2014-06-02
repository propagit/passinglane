<div class="grey-box">
    <div class="title-page">Search Orders</div>
</div>
<div style="clear: both"></div>

<div class="subtitle-page">Search Orders</div>
<form id="search-order-form" class="form-horizontal custom-form" role="form">
      <div class="form-group">
            <label for="keyword" class="col-sm-2 control-label">Keyword</label>
            <div class="col-sm-3">
              <input type="text" class="form-control search-frm-input" id="keyword" name="keyword" placeholder="Customer Name, Email or order id">
            </div>
       </div>
      
       <div class="form-group">
            <label for="keyword" class="col-sm-2 control-label">Order Status</label>
            <div class="col-sm-3">
              <select class="custom-select search-frm-input" name="order_status" id="order_status">
                <option value="0">Any Status</option>
                <option value="success">Success</option>
                <option value="failed">Failed</option>
                <option value="paid">Paid</option>
                <option value="not paid">Not Paid</option>
             </select>
            </div>
       </div>
       
       <div class="form-group">
            <label for="keyword" class="col-sm-2 control-label">Date From</label>
            <div class="col-sm-2">
                <div class="input-group">
                    <input type="text" class="form-control date-picker" id="date-from" name="date_from">
                    <span class="input-group-btn btn-group-cal" data-trigger="date-from">
                       <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
            <label for="keyword" class="control-label col-sm-50">Date To</label>
            <div class="col-sm-2">
                <div class="input-group">
                    <input type="text" class="form-control date-picker" id="date-to" name="date_to">
                    <span class="input-group-btn btn-group-cal" data-trigger="date-to">
                       <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
        </div>
     
      
     
      
       <div class="form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-3">
              <button id="search-order-btn" type="button" class="btn btn-info"><i class="fa fa-search"></i> Search Orders</button>
            </div>
       </div>
       <input type="hidden" id="sort-by" name="sort_by" value="created" />
       <input type="hidden" id="sort-order" name="sort_order" value="DESC" />
       <input type="hidden" name="current_page"  id="current-page" value="1"  />
</form>
<div id="search-results">

</div>
<script>
$j(function(){
	//init selectpicker
	$j('.custom-select').selectpicker();
	
	//init datepicker
	$j('.date-picker').datepicker({});
	
	//init search
	search_order();
	
	//init search on search button click
	$j('#search-order-btn').on('click',function(){
		search_order();
	});
	
	//init datepicker on calendar icon click
	//work around as the default demo to put use the wrapper class 'input-group' did not work
	$j('.btn-group-cal').on('click',function(){
		var trigger = $j(this).attr('data-trigger');
		$j('#'+trigger).trigger('focus');
	});
	
	//sort result
	$j(document).on('click','.sort-results',function(){
		var cur_obj = $j(this);
		var cur_sort_order = $j('#sort-order').val();
		$j('#sort-by').val(cur_obj.attr('sort-by'));
		$j('#sort-order').val(cur_sort_order == 'DESC' ? 'ASC' : 'DESC');
		
		search_order();
	});
	
	//go to page
	$j(document).on('click','.pagination li',function(e){
		e.preventDefault();
		scroll_to_form = false;
		var clicked_page = $(this).attr('data-page-no');
		$j('#current-page').val(clicked_page);
		search_order();
	});
	
	//call confirm delete modal
	$(document).on('click','.delete-order',function(){
		var title = 'Delete Order';
		var message ='You are about to delete an Order Permanently. To proceed click <strong>Yes</strong>';
		var order_id = $(this).attr('data-order-id');
		help.confirm_delete(title,message,function(confirmed){
			 if(confirmed){
				delete_order(order_id);
			 }
		});
	});
	
});

function search_order()
{
	$j.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/order/ajax/search_order",
		data:$j('#search-order-form').serialize(),
		success: function(html) {
				$j('#search-results').html(html);
		  	}
	});		
}

function delete_order(order_id)
{
	$j.ajax({
		type:"POST",
		url:"<?=base_url();?>admin/order/ajax/delete_order",
		data:{order_id:order_id},
		dataType:'JSON',
		success:function(data){
			if(data['status']){
				search_order();	
			}else{
				help.message_modal('Operation Failed',data['msg']);	
			}
		}
		
	});	
}


</script>