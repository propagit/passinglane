<html>
<body>

	<table class="table invoice-table" width="100%" style="font-family:Arial, Helvetica, sans-serif;">
    	<tbody>
            <tr>
                <td colspan="3"><img src="<?=base_url();?>assets/frontend-assets/passing/logo.png" /></td>
            </tr>
        	<!--row 1-->
        	<tr>
            	<td width="60%"><span class="invoice-header"><b>Tax Invoice</b></span></td>
                <td>&nbsp;</td>
            	<td width="320" colspan="2">
                	<table>
                    	<tr>
                        	<td><span class="title-page"><b>Invoice Number:</b></span>
                        	<?=$order->order_id;?></td>
                        </tr>
                        <tr>
                        	<td><span class="title-page"><b>Date of Invoice:</b></span>
                        	<?=date('d-m-Y',strtotime($order->created));?></td>
                        </tr>
                        <tr>
                        	<td><span class="title-page"><b>Time of Invoice:</b></span>
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
                	<!--comany info-->
                	<table class="tbl-invoice-company-info">
                        <tr>
                            <td colspan="2" class="tbl-default-padding"><span class="title-page"><b>Passing Lane Pty Ltd</b></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">PO Box 975</td>
                        </tr>
                        <tr>
                            <td colspan="2">COWES VIC 3922</td>
                        </tr>
                        <tr>
                            <td><span class="title-page"><b>Tel:</b></span></td>
                            <td>1300 64 98 63</td>
                        </tr>
                        <tr>
                            <td><span class="title-page"><b>Fax:</b></span></td>
                            <td>1300 64 98 64</td>
                        </tr>
                        <tr>
                            <td><span class="title-page"><b>Email:</b></span></td>
                            <td>info@passinglane.com.au</td>
                        </tr>
                        <tr>
                            <td><span class="title-page"><b>WEB:</b></span></td>
                            <td>www.passinglane.com.au</td>
                        </tr>
                    </table>
                    <!--end company info-->
                </td>
                <td class="width-0">&nbsp;</td>
                <td colspan="2">
                	<table class="tbl-invoice-customer-info">
                    	<tr>
                        	<td colspan="2" class="tbl-default-padding"><span class="title-page"><b>Customer Details</b></span></td>
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
					<br /><p><span class="title-page"><b>Purchase Items</b></span> (PRICES DISPLAYED $AUD)</p>
				</td>
			</tr>
	    	<tr>
	        	<th align="left" width="380"><span class="title-page"><b>Product Name</b></span></th>
	            <th align="center" width="100"><span class="title-page"><b>Qty</b></span></th>
	            <th width="170" align="left"><span class="title-page"><b>Price</b></span></th>
	            <th width="150" align="left"><span class="title-page"><b>Subtotal</b></span></th>
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
            	<td colspan="3"><span class="title-page"><b>Discount <?=($order->coupon_code ? '(' . $order->coupon_code . ')' : '');?></b></span></td>
                <td>
                		<span class="title-page">$<?=money_format('%i',$order->discount);?></span>

                </td>
            </tr>

            <tr class="invoice-summary">
                <td colspan="3"><span class="title-page"><b>Shipping Cost</b></span></td>
                <td>
                    <div class="td100">
                        <span class="title-page">$<?=money_format('%i',$order->shipping_cost);?></span>
                    </div>
                </td>
            </tr>

            <tr class="invoice-summary">
            	<td colspan="3" class="top-border bottom-border"><span class="invoice-header"><b>Total</b></span></td>
                <td class="top-border bottom-border">
                		<span class="invoice-header"><b>$<?=money_format('%i',$order->total);?></b></span>
                </td>
            </tr>
            <tr class="invoice-summary">
            	<td colspan="3"><span class="title-page"><b>GST</b></span></td>
                <td>
                		<span class="title-page"><b>$<?=money_format('%i',$order->tax);?></b></span>
                </td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr><td colspan="4">&nbsp;</td></tr>
			<tr class="invoice-summary">
            	<td colspan="3"><span class="title-page"><b>Payment Status</b></span></td>
                <td>
                		<span class="title-page"><b><?=ucwords($order->order_status);?></b></span>
                </td>
            </tr>
            <? if ($order->order_status == "not paid") { ?>
            <tr class="invoice-summary">
            	<td colspan="3"><span class="title-page"><b>Payment Due</b></span></td>
                <td>
                		<span class="title-page"><b><?=date('Y-m-d',strtotime($order->created) + 259200);?></b></span>
                </td>
            </tr>
            <? } else if ($order->order_status == "paid") { ?>
            <tr class="invoice-summary">
            	<td colspan="3"><span class="title-page"><b>Paid On</b></span></td>
                <td>
                		<span class="title-page"><b><?=date('Y-m-d',strtotime($order->paid_on));?></b></span>
                </td>
            </tr>
            <? } else if ($order->order_status == "success") { ?>
            <tr class="invoice-summary">
            	<td colspan="3"><span class="title-page"><b>Paid On</b></span></td>
                <td>
                		<span class="title-page"><b><?=date('Y-m-d',strtotime($order->created));?></b></span>
                </td>
            </tr>
            <? } ?>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr><td colspan="4">&nbsp;</td></tr>
        	<tr>
            	<td colspan="4" class="bottom-border"><span class="title-page"><b>How To Pay</b></span></td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <!--how to pay row-->
            <tr>
            	<td><span class="title-page"><b>Direct Deposit</b></span></td>
                <td class="width-0">&nbsp;</td>
                <td colspan="2"><span class="title-page"><b>Credit Card</b></span></td>
            </tr>
            <tr>
            	<td>
                	<table class="tbl-how-to-pay">
                    	<tr>
                        	<td><span class="title-page"><b>Passing Lane Pty Ltd.</b></span></td>
                        </tr>
                        <tr>
                            <td><span class="title-page"><b>Commonwealth Bank</b></span></td>
                        </tr>
                        <tr>
                        	<td><span class="title-page"><b>BSB 014 245</b></span></td>
                        </tr>
                        <tr>
                        	<td><span class="title-page"><b>Account Number 205 022 334</b></span></td>
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
