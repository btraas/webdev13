
// order.js - javascript funtions and event handlers for the order pages - Brayden Traas

var taxpct = 1.05; // 1.05 -> multiplier. total + tax = total * multiplier.

$(document).ready(function() 
{
	$('.addItem').click(function() { addToOrder($(this)); });
	$('input.order_datetime').datepicker();
});


function addToOrder(item) // {{{
{
	var name  = item.parent().parent().find('h3').text();
	var price = item.parent().parent().find('.price').text().replace(/$/, '');

	// alert("name: " + name + " price: "+price);
	
	$('#orderItems .total').before("<tr class='lineitem'><td>"+name+"</td><td class='price'>"+price+"</td></tr>");

	calculateTotal();

} // }}}

function calculateTotal() // {{{
{
	var sum = 0;

	$(".lineitem").each(function() 
	{
		sum += parseFloat($(this).find('.price').text().replace(/[$]/g,''));
	});
	sum = sum.toFixed(2);
	//alert("Total (before tax): "+sum);	
	$('#orderItems .total').next().find('.price').text("$"+sum);

	sum = calculateTax(sum, taxpct);
	//alert("Total (after tax): "+sum);
	$('#orderItems .total').next().next().find('.price').text("$"+sum);


} // }}}

function calculateTax(total, pct) // {{{
{
	return (total * pct).toFixed(2);

} // }}}
