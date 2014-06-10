<div class="tax-wrap">
	<table class="table invoice-table">
    	<tbody>
        	<!--row 1-->
        	<tr>
            	<td><span class="invoice-header">Tax Invoice</span></td>
                <td class="width-0">&nbsp;</td>
            	<td>
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
        	<tr><td colspan="3">&nbsp;</td></tr>
            <!--row 2-->
            <tr>
            	<td>
                	<?=modules::run('adminorder/invoice_company_details');?>
                </td>
                <td class="width-0">&nbsp;</td>
                <td>
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

            <tr>
            	<td colspan="3">
                	<?=modules::run('adminorder/invoice_items',$order_id);?>
                </td>
            </tr>
            <tr class="invoice-summary">
            	<td colspan="2"><span class="title-page">Discount <?=($order->coupon_code ? '(' . $order->coupon_code . ')' : '');?></span></td>
                <td>
                	<div class="td100">
                		<span class="title-page">$<?=money_format('%i',$order->discount);?></span>
                	</div>
                </td>
            </tr>
            <tr class="invoice-summary">
                <td colspan="2"><span class="title-page">Shipping Cost</span></td>
                <td>
                    <div class="td100">
                        <span class="title-page">$<?=money_format('%i',$order->shipping_cost);?></span>
                    </div>
                </td>
            </tr>
            <tr class="invoice-summary">
            	<td colspan="2" class="top-border bottom-border"><span class="invoice-header">Total</span></td>
                <td class="top-border bottom-border">
                	<div class="td100">
                		<span class="invoice-header">$<?=money_format('%i',$order->total);?></span>
                	</div>
                </td>
            </tr>
            <tr class="invoice-summary">
            	<td colspan="2"><span class="title-page">GST</span></td>
                <td>
                	<div class="td100">
                		<span class="title-page">$<?=money_format('%i',$order->tax);?></span>
                	</div>
                </td>
            </tr>
            <tr><td colspan="3">&nbsp;</td></tr>
            <tr><td colspan="3">&nbsp;</td></tr>
			<tr class="invoice-summary">
            	<td colspan="2"><span class="title-page">Payment Status</span></td>
                <td>
                	<div class="td100">
                		<span class="title-page"><?=$order->order_status;?></span>
                	</div>
                </td>
            </tr>
            <? if ($order->order_status == "not paid") { ?>
            <tr class="invoice-summary">
            	<td colspan="2"><span class="title-page">Payment Due</span></td>
                <td>
                	<div class="td100">
                		<span class="title-page"><?=date('Y-m-d',strtotime($order->created) + 259200);?></span>
                	</div>
                </td>
            </tr>
            <? } else if ($order->order_status == "paid") { ?>
            <tr class="invoice-summary">
            	<td colspan="2"><span class="title-page">Paid On</span></td>
                <td>
                	<div class="td100">
                		<span class="title-page"><?=date('Y-m-d',strtotime($order->paid_on));?></span>
                	</div>
                </td>
            </tr>
            <? } else if ($order->order_status == "success") { ?>
            <tr class="invoice-summary">
            	<td colspan="2"><span class="title-page">Paid On</span></td>
                <td>
                	<div class="td100">
                		<span class="title-page"><?=date('Y-m-d',strtotime($order->created));?></span>
                	</div>
                </td>
            </tr>
            <? } ?>
            <tr><td colspan="3">&nbsp;</td></tr>
            <tr><td colspan="3">&nbsp;</td></tr>
        	<tr>
            	<td colspan="3" class="bottom-border"><span class="title-page">How To Pay</span></td>
            </tr>
            <tr><td colspan="3">&nbsp;</td></tr>
            <!--how to pay row-->
            <tr>
            	<td><span class="title-page">Direct Deposit</span></td>
                <td class="width-0">&nbsp;</td>
                <td><span class="title-page">Credit Card</span></td>
            </tr>
            <tr>
            	<td>
                	<table class="tbl-how-to-pay" width="100%">
                    	<tr>
                        	<td><span class="title-page">Passing Lane Pty Ltd.</span></td>
                        </tr>
                        <tr>
                            <td><span class="title-page">Commonwealth Bank</span></td>
                        </tr>
                        <tr>
                        	<td><span class="title-page">BSB 014 245</span></td>
                        </tr>
                        <tr>
                        	<td><span class="title-page">Account Number 205 022 334</span></td>
                        </tr>
                    </table>
                </td>
                <td class="width-0">&nbsp;</td>
                <td>
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
</div>
