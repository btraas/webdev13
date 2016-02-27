
// order.js - javascript funtions and event handlers for the order pages - Brayden Traas

var taxpct = 1.05;		// 1.05 -> multiplier. total + tax = total * multiplier.
var minMinutes = 15;	// 15   -> minimum time to order completion
var maxDays = 30;		// 30   -> max days for advance orders


$(document).ready(function() 
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

	$('#orderItems .total').next().find('td').first().attr('colspan',3);
	$('#orderItems .total').next().next().find('td').first().attr('colspan', 3);
	$('#orderItems .total td').attr('colspan',4);
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
		//$('#orderItems .item_'+unique+' .price').text("$"+priceCalc);
	}
	else
	{
		var html = "<tr class='lineitem item_"+unique+"'>";
		html	+=		"<td><p class='ui-state-default btn-small' onClick='modifyItem(this, 1);'><span class='ui-icon ui-icon-plusthick' /></p><p class='ui-state-default btn-small' onClick='modifyItem(this, -1);'><span class='ui-icon ui-icon-minusthick' /></p></td>";
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

function submit1() // {{{ Validate data in cookies / table, then proceed
{
	var now = new Date();
	var minTime = new Date(now.getTime() + minMinutes*60000);
    var maxTime = new Date(now.getTime() + maxDays*86400000);

	if(empty($('.order_datetime').first().val()) || empty($('.order_datetime').last().val()))
	{
		alert("Error: Date / Time not specified!");
		return false;
	}

	var date = new Date($('.order_datetime.hasDatepicker').first().val() + " " + convertTo24Hour($('.order_datetime.hasDatepicker').last().val()));
    if(date.getTime() < minTime.getTime() - 60000 || date.getTime() > maxTime.getTime())
    {
        alert("Error: Invalid date!");
        return false;
    }


	var items = [];
	$('#orderItems .lineitem').each(function() 
	{
		if(parseInt($(this).find('.quantity').text()) <= 0) 
		{
			alert('Error: Invalid quantity for:'+$(this).find('.name').text());
			return false;
		}
		items.push(
		{
			itemID:		0, 
			name:		$(this).find('.name').text(), 
			quantity:	parseInt($(this).find('.quantity').text()), 
			price:		parseFloat($(this).find('.price').text().replace(/[$]/g, '')),
		});
	});

	if(items.length <= 0)
	{
		alert("Erorr: No items selected!");
		return false;
	}

	alert('Data to pass: date:'+date+" items: "+JSON.stringify(items));
	return true;


} //  }}}


function calculateTotal() // {{{
{
	var sum = 0;

	$(".lineitem").each(function() 
	{
		var priceVal = parseFloat($(this).find('.price').text().replace(/[$]/g,''));
		var qty		 = parseInt($(this).find('.quantity').text());
		sum += priceVal * qty;
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


function convertTo24Hour(time) {
    var hours = parseInt(time.substr(0, 2));
    if(time.indexOf('am') != -1 && hours == 12) {
        time = time.replace('12', '0');
    }
    if(time.indexOf('pm')  != -1 && hours < 12) {
        time = time.replace(hours, (hours + 12));
    }
    return time.replace(/(\sam|\spm)/, '');
}

function empty(mixed_var) { // {{{
  //  discuss at: http://phpjs.org/functions/empty/
  // original by: Philippe Baumann
  //    input by: Onno Marsman
  //    input by: LH
  //    input by: Stoyan Kyosev (http://www.svest.org/)
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Onno Marsman
  // improved by: Francesco
  // improved by: Marc Jansen
  // improved by: Rafal Kukawski
  //   example 1: empty(null);
  //   returns 1: true
  //   example 2: empty(undefined);
  //   returns 2: true
  //   example 3: empty([]);
  //   returns 3: true
  //   example 4: empty({});
  //   returns 4: true
  //   example 5: empty({'aFunc' : function () { alert('humpty'); } });
  //   returns 5: false

  var undef, key, i, len;
  var emptyValues = [undef, null, false, 0, '', '0'];

  for (i = 0, len = emptyValues.length; i < len; i++) {
    if (mixed_var === emptyValues[i]) {
      return true;
    }
  }

  if (typeof mixed_var === 'object') {
    for (key in mixed_var) {
      // TODO: should we check for own properties only?
      //if (mixed_var.hasOwnProperty(key)) {
      return false;
      //}
    }
    return true;
  }

  return false;
} // }}}

