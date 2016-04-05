
// order.js - javascript funtions and event handlers for the order pages - Brayden Traas

// March 08

var taxpct = 0.05;		// 0.05 -> multiplier.
var minMinutes = 15;	// 15   -> minimum time to order completion
var maxDays = 30;		// 30   -> max days for advance orders

$(document).ready(function()  // {{{
{
	var now = new Date();
	var minTime = new Date(now.getTime() + minMinutes*60000);
	var maxTime = new Date(now.getTime() + maxDays*86400000);

	$('.addItem').click(function() { addToOrder($(this)); });
	$('input.order_datetime').first().datepicker(
	{
		minDate: minTime,
		maxDate: maxTime,
	});
	$('input.order_datetime').last().timepicker(
	{ 
		timeOnlyTitle: "Pickup time ("+minMinutes+" min+)",
		currentText: "ASAP",
		timeFormat: 'h:mm tt',
		minDate: minTime,

	});
	
	$('input[value="Clear"]').click(function() 
	{
		$('.order_datetime').val('');
		$('.lineitem').remove();
		calculateTotal();
	});

	$('#submit1').click(function()
	{
		submit1();
	});


	/* Updates minimum date / time each minutes */
	setInterval(setMinDateTime, 60*1000);


	$('#orderItems .total').next().find('td').first().attr('colspan',3);
	$('#orderItems .total').next().next().find('td').first().attr('colspan', 3);
	$('#orderItems .total td').attr('colspan',4);


	$('input').change(function() 
	{
		calculateTotal();
	});

	setOrder(); // populate order from cookie

}); // }}}


function addToOrder(item) // {{{
{
	var name  = item.parent().parent().find('h3').text();
	var price = item.parent().parent().find('.price').text().replace(/$/, '');

	var id = item.parent().parent().data('product_id');
	//var unique = name.replace(/[^a-zA-Z]/g, '');

	// alert("name: " + name + " price: "+price);
	

	if($('#orderItems .product_'+id).length > 0) // if already in order
	{
		var qty = parseInt($('#orderItems .product_'+id+' .quantity').text())+1;
		var priceCalc = (parseFloat(price.replace(/[$]/g, ''))*qty).toFixed(2);
		$('#orderItems .product_'+id+' .quantity').text(qty);
		//$('#orderItems .item_'+unique+' .price').text("$"+priceCalc);
	}
	else
	{
		var html = "<tr data-product_id='"+id+"' class='lineitem product_"+id+"'>";
		html	+=		"<td><div class='ui-state-default btn-small' onClick='modifyItem(this, 1);'><span class='ui-icon ui-icon-plusthick'></span></div>"
		html	+= 			"<div class='ui-state-default btn-small' onClick='modifyItem(this, -1);'><span class='ui-icon ui-icon-minusthick'></span></div>";
		html	+=		"</td>";
		html	+=		"<td class='name'>"+name+"</td>";
		html	+=		"<td class='quantity'>1</td>";
		html	+=		"<td class='price'>"+price+"</td>";
		html	+= "</tr>";

		//alert(html);
		$('#orderItems .total').before(html);


	}

	calculateTotal();

} // }}}

function modifyItem(elem, increment) // {{{
{
	//console.log('modifying item');
	var oldQty = parseInt($(elem).closest('.lineitem').find('.quantity').text());
	$(elem).closest('.lineitem').find('.quantity').text(oldQty + increment);

	if(parseInt($(elem).closest('.lineitem').find('.quantity').text()) <= 0)
	{
		$(elem).closest('.lineitem').remove();
	}
	calculateTotal();

} // }}}

function setMinDateTime() // {{{
{
	var now = new Date();
    var minTime = new Date(now.getTime() + minMinutes*60000);
    var maxTime = new Date(now.getTime() + maxDays*86400000);

	$('input.order_datetime').first().datepicker( 'option', 'minDate', minTime );
	$('input.order_datetime').first().datepicker( 'option', 'maxDate', maxTime );
	$('input.order_datetime').last().timepicker( 'option', 'minDate', minTime );

	var date = new Date($('.order_datetime.hasDatepicker').first().val() + " " + convertTo24Hour($('.order_datetime.hasDatepicker').last().val()));
    if(date.getTime() < minTime.getTime() || date.getTime() > maxTime.getTime())
    {
		$('input.order_datetime').last().timepicker('setTime', minTime + 60*1000);
	}


} // }}}

function getOrder() // {{{ Get JSON order 
{
	var now = new Date();
    var minTime = new Date(now.getTime() + minMinutes*60000);
    var maxTime = new Date(now.getTime() + maxDays*86400000);

    var items = [];
    $('#orderItems .lineitem').each(function()
    {
        if(parseInt($(this).find('.quantity').text()) <= 0)
        {
            alertDialog('Error: Invalid quantity for:'+$(this).find('.name').text());
            return false;
        }
        items.push(
        {
            product_id: $(this).data('product_id'),
            name:       $(this).find('.name').text(),
            quantity:   parseInt($(this).find('.quantity').text()),
            price:      parseFloat($(this).find('.price').text().replace(/[$]/g, '')),
        });
    });


	return items;
	
} // }}}
function setOrder() // {{{ Set JSON order from cookie
{
	var orderCookie = getCookie("order");
	var ordertime   = getCookie("ordertime");

	// console.log("cookie: "+orderCookie);

	if(orderCookie == "") return;
	
	var result = JSON.parse(orderCookie);
	result.forEach(function(obj) 
	{
		var id = obj.product_id;
		obj.name;
		obj.quantity;
		obj.price;		
		
		if(empty(obj.name) || empty(obj.quantity)) return;


		//var unique = obj.name.replace(/[^a-zA-Z]/g, '');

		var html = "<tr data-product_id='"+id+"' class='lineitem product_"+id+"'>";
        html    +=      "<td><div class='ui-state-default btn-small' onClick='modifyItem(this, 1);'><span class='ui-icon ui-icon-plusthick'></span></div>"
        html    +=          "<div class='ui-state-default btn-small' onClick='modifyItem(this, -1);'><span class='ui-icon ui-icon-minusthick'></span></div>";
        html    +=      "</td>";
        html    +=      "<td class='name'>"+obj.name+"</td>";
        html    +=      "<td class='quantity'>"+obj.quantity+"</td>";
        html    +=      "<td class='price'>$"+obj.price.toFixed(2)+"</td>";
        html    += "</tr>";

        //alert(html);
        $('#orderItems .total').before(html);


	});
	
	calculateTotal();
	if(ordertime == "") return;
	
	ordertime = new Date(ordertime);

	var month = ordertime.getMonth()+1;
	if(month < 10) month = "0"+month;
	var date = month + "/" +ordertime.getDate() + "/" + ordertime.getFullYear();

	$('input.order_datetime').first().datepicker('setDate', date);
	$('input.order_datetime').last().timepicker('setTime', ordertime);


} // }}}

function validate()// {{{
{

	var items = getOrder();

    var now = new Date();
    var minTime = new Date(now.getTime() + minMinutes*60000);
    var maxTime = new Date(now.getTime() + maxDays*86400000);


    if(items.length <= 0)
    {
        alertDialog("Error: No items selected!");
        return false;
    }

    if(empty($('.order_datetime').first().val()) || empty($('.order_datetime').last().val()))
    {
        confirmDialog("Error: Date / Time not specified!\nSet ASAP (in "+minMinutes+" minutes)?",
        {
            title: "No Date / Time",
        }, function()
        {
            $('input.order_datetime').first().datepicker('setDate', new Date(minTime + 60*1000));
            $('input.order_datetime').last().timepicker('setTime', minTime + 60*1000);
             validate(); // run again
        });
        return false;
    }

    var date = new Date($('.order_datetime.hasDatepicker').first().val() + " " + convertTo24Hour($('.order_datetime.hasDatepicker').last().val()));
    if(date.getTime() < minTime.getTime() || date.getTime() > maxTime.getTime())
    {
        if(date.getTime() < minTime.getTime() && date.getTime() > (minTime.getTime() - 5*60*1000 ))
        {
            $('input.order_datetime').last().timepicker('setTime', minTime + 60*1000)
        }
        else
        {
            alertDialog("Error: Invalid date/time!");
            return false;
        }
    }

	return true;

} // }}}
function submit1() // {{{ Validate data in cookies / table, then proceed
{

	if(validate() == true) 
	{
		location.href = '/order/review';
		return true;
	}
	else
	{
		return false;
	}


} //  }}}
function submit2() // {{{	// Values are already saved in a cookie.
{
	if(validate() == true)
	{
		location.href = '/order/submit';
		return true;
	}

	return false;

} // }}}

function calculateTotal() // {{{ AND save a cookie
{
	var sum = 0;
	var tax = 0;
	$(".lineitem").each(function() 
	{
		var priceVal = parseFloat($(this).find('.price').text().replace(/[$]/g,''));
		var qty		 = parseInt($(this).find('.quantity').text());
		sum += priceVal * qty;
	});
	
	tax = calculateTax(sum, taxpct);
	sum = (parseFloat(sum) + parseFloat(tax)).toFixed(2);
	

	$('#orderTotals .totals').first().find('.price').text("$"+tax);
	$('#orderTotals .totals').last().find('.price').text("$"+sum);


	var ordertime = new Date($('.order_datetime.hasDatepicker').first().val() + " " + convertTo24Hour($('.order_datetime.hasDatepicker').last().val())); 

	if(empty($('.order_datetime.hasDatepicker').last().val()) || empty($('.order_datetime.hasDatepicker').first().val())) ordertime = "Invalid Date";

	document.cookie="order="+JSON.stringify(getOrder())+";path=/";
	if(ordertime!='Invalid Date') 
	{
		//alert(ordertime);
		document.cookie="ordertime="+ordertime+";path=/";
		//alert('set cookie: '+ordertime);
	}

} // }}}
function calculateTax(total, pct) // {{{
{
	return (total * pct).toFixed(2);

} // }}}


