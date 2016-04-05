<?php

// Include DB connection script
require_once("db.php");
require_once("log.php");
require_once("DOM_functions.php");
require_once("auth.php");

//logger($_REQUEST);


// Overrie regular order pages with review / submit options
switch(@$_REQUEST['mode'])
{
	case 'review'	: review(); exit();
	case 'submit'	: submit(); exit();
	default			: showCategory(); exit();
}


function showCategory() // {{{
{
	// getCategory in db.php
	$category = getCategory(@$_REQUEST['category']);
	if(empty($category)) $category = 'appetizers';
	



	// function to run a query (from db.php)
	$items = runQ("SELECT p.*, pc.*, p.name AS product_name, pc.name AS category FROM products p 
				INNER JOIN product_categories pc ON pc.category_id = p.category_id
				WHERE LOWER(pc.name) = LOWER('$category') ");


	$groups = runQ("SELECT name FROM product_categories");
	
	include('page_header.php');		// Global HTML, CSS etc
	include("order_header.php");	// Order HTML, CSS, JS
	
	

	echo "	<div id='orderGroups' class='blackList'>
			<ul>";


	foreach($groups AS $g)
	{
		$cat = getCategoryURL(@$g['name']);
	
		echo "<li><a href='/order/$cat/'>$g[name]</a></li>\n";
	}
	
	echo "		</ul>
			</div>";
	


	$title = "";
	if(empty($items) || empty($items[0]['category'])) $title = "Invalid Category: $category";
	else $title = $items[0]['category'];



	echo "<div id='orderMenu'>\n";
	echo "<h1>$title</h1>\n";

	// iterate over array to print data

	echo "<table id='selection_table'><tr>";


	$i = 0;
	foreach($items AS $item)
	{
		if($i % 2 == 0) echo "</tr>\n<tr>";
		$i++;
	
		echo "<td><div class='itemBlock' data-product_id=$item[product_id]>
			  		<h3>$item[product_name]</h3>
				  	<p class='description'>$item[description]</p>
					<div class='itemBlock_footer'>
						<input type='image' src='/images/AddToOrder_Button.jpg' class='addItem' />
						<div class='price'>$$item[price]</div>
					</div>
				</div></td>";
	}
	
	echo "</tr></table>";
	

	echo "</div>";
	echo file_get_contents('order_footer.php');
	echo file_get_contents('page_footer.php');
} // }}}

function review() // {{{
{
	if(!isLoggedIn())
	{
		// echo basic HTML & js functions
		include('page_header.php');
		include('page_footer.php');

		$js = "location.href = '/login'";
		alert("Please sign in to place an order.", $js);	// DOM_functions.php
		exit();												// displays dialog box which runs given JS code on "OK" click
	}

	include('page_header.php');
	include('order_header.php');
	include('order_review.php');
	include('page_footer.php');
} // }}}

function submit() // {{{
{
	showCategory();

	if(!isset($_COOKIE['order']) ) 
	{
		alert("Order is empty!");
		exit();
	}

	if(!isLoggedIn())
    {
        // echo basic HTML & js functions
        include('page_header.php');
        include('page_footer.php');

        $js = "location.href = '/login'";
        alert("Please sign in to place an order.", $js);
        exit();
    }

	$user = getUser();
	$user_id = intval(@$user['num']);


	$order_items = json_decode(@$_COOKIE['order'], true);

	$requested = date('Y-m-d H:i:s', strtotime(substr(@$_COOKIE['ordertime'], 0, 21)));

	logger(print_r($_COOKIE, true));
	logger("Requested time: $requested");

	//$requested = date('Y-m-d H:i:s'); // for now

	$q = "INSERT INTO orders(user_id, requested) VALUES($user_id, '$requested')";
	if(($r = runQ($q)) === FALSE) 
	{
		alert("Unable to add order!");
		exit();
	}
	$r = runQ("SELECT order_id FROM orders ORDER BY submitted DESC LIMIT 1");
	$order_id = $r[0]['order_id'];


	foreach($order_items AS $item)
	{
		$product = intval($item['product_id']);
		$quantity = intval($item['quantity']);
		$notes = mysql_escape_string(@$item['notes']);
		$q = "INSERT INTO order_items(order_id, product_id, quantity, notes)
				VALUES ($order_id, $product, $quantity, '$notes' )";
		if(($r = runQ($q)) === FALSE)
	    {
			alert("Unable to add order!");
			exit();
		}

	}
	setcookie('order', '');						// clear cart
	clearCookie('order', 'path=/');

	setcookie('ordertime', '');
	clearCookie('ordertime', 'path=/');

	alert("Thank-you for your order. 
			Your order number is $order_id");

} // }}}


?>
