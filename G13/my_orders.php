<?php

// Include DB connection script
require_once("db.php");
require_once("log.php");
require_once("DOM_functions.php");
require_once("auth.php");

//logger($_REQUEST);


$u = array();
if(!isLoggedIn() || empty($u = getUser())) // {{{
{
	// echo basic HTML & js functions
	include('page_header.php');
	include('page_footer.php');

	$js = "location.href = '/login'";
	alert("Please sign in to view previous orders.", $js);	// DOM_functions.php
	exit();												// displays dialog box which runs given JS code on "OK" click
} // }}}

include('page_header.php');
include('order_header.php');


if(!empty(@$_REQUEST['order'])) // show this order
{
	$order_no = intval(@$_REQUEST['order']); // sanitize

	$q = "	SELECT *, product_categories.name AS category, products.name AS name,
			DATE_FORMAT(submitted, '%W, %b %e %Y')	AS sub_date,
			DATE_FORMAT(requested, '%W, %b %e %Y')	AS req_date,
			DATE_FORMAT(submitted, '%l:%i %p')		AS sub_time,
			DATE_FORMAT(requested, '%l:%i %p')      AS req_time
			FROM order_items 
			INNER JOIN orders ON orders.order_id = order_items.order_id
			INNER JOIN products ON products.product_id = order_items.product_id
			INNER JOIN product_categories ON products.category_id = product_categories.category_id
			WHERE order_items.order_id = $order_no
			AND orders.user_id = $u[num]";	// ensure this order is by this user

	if(($r=runQ($q))===FALSE || empty($r))
	{
		$js = "location.href = '/my_orders'";
		alert("Order $order_no not found for $u[fname] $u[lname]!", $js);
		include('page_footer.php');
		exit();
	}


	$ordertotal = 0;
	foreach($r AS $oi)
	{
		$ordertotal += ($oi['quantity']*$oi['price'])
	}

	echo "<div style='text-align: center; width: 100%;'>\n";
	echo "<h1>Order $order_no</h1><br />
	
			<p><b>Submitted: </b>{$r[0]['sub_date']} {$r[0]['sub_time']}</p>
			<p><b>Requested: </b>{$r[0]['req_date']} {$r[0]['req_time']}</p>
			<p><b>Cost (before tax):</b>$ordertotal</p>
	
	
	";

	echo nl2br(print_r($r, true)); // for now of course

	$i = 0;
	foreach($r AS $oi)
	{
		$i++;
		echo "
				<div class='itemBlock myorder_item' style='width: 400px; float: none; '>

             		$i: $oi[category] - $oi[name] x$oi[quantity]

                </div>
                <br />
			";

	}

	echo "</div>\n";
	include('page_footer.php');
	exit();

}

showOrders();
function showOrders() // {{{ // show all orders
{
	Global $u;

	$q = "SELECT *, DATE_FORMAT(submitted, '%W, %b %e %Y') AS sub_date 
			FROM orders
			WHERE user_id = ".$u['num']."
			ORDER BY order_id DESC";
	
	if(($r = runQ($q)) === FALSE || empty($r))
	{
		logger($q);
		logger(print_r($r, true));
	
		$js = "location.href = '/order'";
		alert("No previous orders found! Click OK to create a new order.", $js);
		include('page_footer.php');
		exit();
	}

	echo "<div style='text-align: center; width: 100%;'>\n";
	echo "<h1>Previous Orders for $u[fname] $u[lname]</h1><br />\n";

	foreach($r AS $order)
	{
		echo "	<div	class='itemBlock myorder' 
						onClick=\"location.href = '/my_orders/$order[order_id]'\" 
						style='width: 400px; float: none;'>
	
						Order #$order[order_id] - $order[sub_date]
					
				</div>
				<br />\n\n";
	}

	echo "</div>";
	include('page_footer.php');
	exit();
} // }}}



?>
