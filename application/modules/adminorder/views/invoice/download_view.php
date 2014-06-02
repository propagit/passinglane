<html>
<head>
</head>
<body>

	<table class="table invoice-table" width="100%">
    	<tbody>
        	<!--row 1-->
        	<tr>
            	<td width="60%"><span class="invoice-header">Tax Invoice</span></td>
                <td>&nbsp;</td>
            	<td width="320" colspan="2">
                	<table>
                    	<tr>
                        	<td><span class="title-page">Invoice Number:</span>
                        	<?=$order->order_id;?></td>
                        </tr>
                        <tr>
                        	<td><span class="title-page">Date of Invoice:</span>
                        	<?=date('d-m-Y',strtotime($order->created));?></td>
                        </tr>
                        <tr>
                        	<td><span class="title-page">Time of Invoice:</span>
                        	<?=date('H:i:s',strtotime($order->created));?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <!--end row 1-->
        	<tr><td colspan="4">&nbsp;</td></tr>
            <!--row 2-->
            <tr>
            	<td>
                	<?=modules::run('adminorder/invoice_company_details');?>
                </td>
                <td class="width-0">&nbsp;</td>
                <td colspan="2">
                	<table class="tbl-invoice-customer-info">
                    	<tr>
                        	<td colspan="2" class="tbl-default-padding"><span class="title-page">Customer Details</span></td>
                        </tr>
                        <tr>
                        	<td colspan="2"><?=strtoupper($order->delivery_fullname);?></td>
                        </tr>
                        <tr>
                        	<td colspan="2"><?=strtoupper($order->address1.' '.$order->address2);?></td>
                        </tr>
                        <tr>
                        	<td colspan="2"><?=strtoupper($order->suburb . ' ' . $order->state_code . ' ' .$order->postcode);?></td>
                        </tr>
                    </table>
                </td>
            
            </tr>
       		<!--end row 2-->
       		<?php if(isset($order_items) && $order_items){?>
	   		<tr>
	   			<td colspan="4">		   		
					<br /><p><span class="title-page">Purchase Items</span> (PRICES DISPLAYED $AUD)</p>
				</td>
			</tr>
	    	<tr>
	        	<th align="left" width="380"><span class="title-page">Product Name</span></th>
	            <th align="center" width="100"><span class="title-page">Qty</span></th>
	            <th width="170" align="left"><span class="title-page">Price</span></th>
	            <th width="150" align="left"><span class="title-page">Subtotal</span></th>
	        </tr>
			<?php foreach($order_items as $item){?>
	        <tr>
	            <td><?=strtoupper($item->product_name . ' ' . $item->product_subtitle);?></td>
	            <td align="center"><?=$item->quantity;?></td>
	            <td width="170" align="left">$<?=money_format('%i',$item->price);?></td>
	            <td width="150" align="left">$<?=money_format('%i',($item->price * $item->quantity));?></td>
	        </tr>  
	        <?php } ?>
			<?php } ?>
					
            <tr class="invoice-summary">
            	<td colspan="3"><span class="title-page">Order Total</span></td>
                <td>
                	<span class="title-page">$<?=money_format('%i',$order->total);?></span>          
                </td>
            </tr>
            <tr class="invoice-summary">
            	<td colspan="3"><span class="title-page">Discount <?=($order->coupon_code ? '(' . $order->coupon_code . ')' : '');?></span></td>
                <td>
                		<span class="title-page">$<?=money_format('%i',$order->discount);?></span>
                
                </td>
            </tr>
            <tr class="invoice-summary">
            	<td colspan="3" class="top-border bottom-border"><span class="invoice-header">Total</span></td>
                <td class="top-border bottom-border">
                		<span class="invoice-header">$<?=money_format('%i',$order->total);?></span>
                </td>
            </tr>
            <tr class="invoice-summary">
            	<td colspan="3"><span class="title-page">Price Includes 10% GST</span></td>
                <td>
                		<span class="title-page">$<?=money_format('%i',$order->tax);?></span>
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr><td colspan="4">&nbsp;</td></tr>
			<tr class="invoice-summary">
            	<td colspan="3"><span class="title-page">Payment Status</span></td>
                <td>
                		<span class="title-page"><?=$order->order_status;?></span>
                </td>
            </tr>
            <? if ($order->order_status == "not paid") { ?>
            <tr class="invoice-summary">
            	<td colspan="3"><span class="title-page">Payment Due</span></td>
                <td>
                		<span class="title-page"><?=date('Y-m-d',strtotime($order->created) + 259200);?></span>
                </td>
            </tr>
            <? } else if ($order->order_status == "paid") { ?>
            <tr class="invoice-summary">
            	<td colspan="3"><span class="title-page">Paid On</span></td>
                <td>
                		<span class="title-page"><?=date('Y-m-d',strtotime($order->paid_on));?></span>
                </td>
            </tr>
            <? } else if ($order->order_status == "success") { ?>
            <tr class="invoice-summary">
            	<td colspan="3"><span class="title-page">Paid On</span></td>
                <td>
                		<span class="title-page"><?=date('Y-m-d',strtotime($order->created));?></span>
                </td>
            </tr>
            <? } ?>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr><td colspan="4">&nbsp;</td></tr>
        	<tr>
            	<td colspan="4" class="bottom-border"><span class="title-page">How To Pay</span></td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <!--how to pay row-->
            <tr>
            	<td><span class="title-page">Direct Deposit</span></td>
                <td class="width-0">&nbsp;</td>
                <td colspan="2"><span class="title-page">Credit Card</span></td>
            </tr>
            <tr>
            	<td>
                	<table class="tbl-how-to-pay">
                    	<tr>
                        	<td><span class="title-page">Account Name:</span></td>
                            <td>Passing Lane Pty Ltd.</td>
                        </tr>
                        <tr>
                        	<td><span class="title-page">BSB:</span></td>
                            <td>014 245</td>
                        </tr>
                        <tr>
                        	<td><span class="title-page">Account:</span></td>
                            <td>205 022 334</td>
                        </tr>
                    </table>
                </td>
                <td class="width-0">&nbsp;</td>
                <td colspan="2">
                	<table>
                    	<tr>
                        	<td>Call 1300 64 98 63 to pay by Credit Card.</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!--end how to pay row-->
        </tbody>	
    </table>
</body>
</html>