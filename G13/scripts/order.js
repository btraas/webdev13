
// order.js - javascript funtions and event handlers for the order pages - Brayden Traas

var taxpct = 1.05; // 1.05 -> multiplier. total + tax = total * multiplier.

$(document).ready(function() 
{
	$('.addItem').click(function() { addToOrder($(this)); });
	$('input.order_datetime').first().datepicker();
	$('input.order_datetime').last().timepicker(
	{ 
		timeformat: 'H:i',
		showSecond: false,
        showMillisec: false,
        showMicrosec: false,
        showTimezone: false,

	});
	

	if($('#orderItems .total').next().find('td').length < 3)
	{
		$('#orderItems .total').next().find('td').last().before('<td></td>');
		$('#orderItems .total td').attr('colspan',3);
	}
	if($('#orderItems .total').next().next().find('td').length < 3)
    {
        $('#orderItems .total').next().next().find('td').last().before('<td></td>');
		$('#orderItems .total td').attr('colspan',3);

    }
});


function addToOrder(item) // {{{
{
	var name  = item.parent().parent().find('h3').text();
	var price = item.parent().parent().find('.price').text().replace(/$/, '');

	var unique = name.replace(/\s/g, '');

	// alert("name: " + name + " price: "+price);
	

	if($('#orderItems .item_'+unique).length > 0) // if already in order
	{
		var qty = parseInt($('#orderItems .item_'+unique+' .quantity').text())+1;
		var priceCalc = (parseFloat(price.replace(/[$]/g, ''))*qty).toFixed(2);
		$('#orderItems .item_'+unique+' .quantity').text(qty);
		$('#orderItems .item_'+unique+' .price').text("$"+priceCalc);
	}
	else
	{
		$('#orderItems .total').before("<tr class='lineitem item_"+unique+"'><td>"+name+"</td><td class='quantity'>1</td><td class='price'>"+price+"</td></tr>");
	}

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
