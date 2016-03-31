<div style='width: 100%;'>
	<div class='receipt'>
		<h1>Review</h1>
		<p>Please review your order before submission.</p>
		<div id='orderDetails' class='nowidthrestriction'><table>
			<tr><td>Pick-up Date:</td><td><input type="text" class='order_datetime'></td></tr>
			<tr><td>Pick-up Time:</td><td><input type="text" class='order_datetime'></td></tr>
		</table></div>
		

		<table id='orderItems'><tbody id='orderTotals'>
			
			<!-- lineitems inserted here -->
			<tr class='total'><td colspan=2></td></tr>
			<tr class='min_height totals'><td>Tax (5%)</td><td class='price'>$0.00</td></tr>
            <tr class='min_height totals'><td>Total</td><td class='price'>$0.00</td></tr>

			</tbody>
		</table>
			<br /><br />
			<input type=button class='ui-button medium' value='Back' onClick="window.history.back();"/>
			<input type=button class='ui-button medium' value='Confirm' onClick='submit2();' />
			<br /><br />
	</div>
</div>
