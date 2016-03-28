<?php

// Include DB connection script
require_once("db.php");
require_once("log.php");

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
	
	echo file_get_contents('page_header.html');		// Global HTML, CSS etc
	echo file_get_contents("order_header.html");	// Order HTML, CSS, JS
	
	

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
	
		echo "<td><div class='itemBlock'>
			  		<h3>$item[product_name]</h3>
				  	<p class='description'>$item[description]</p>
					<div class='itemBlock_footer'>
						<div class='addItem ui-button'>Add to Order</div>
						<div class='price'>$$item[price]</div>
					</div>
				</div></td>";
	}
	
	echo "</tr></table>";
	

	echo "</div>";
	echo file_get_contents('order_footer.html');
	echo file_get_contents('page_footer.html');
} // }}}

function review() // {{{
{
	echo file_get_contents('page_header.html');
	echo file_get_contents('order_header.html');
	echo file_get_contents('order_review.html');
	echo file_get_contents('page_footer.html');
} // }}}

function submit() // {{{
{
	if(!isset($_COOKIE['order']) ) 
	{
		alert("Order is empty!");
		exit();
	}
	$order_items = json_decode(@$_COOKIE['order']);
//	$order_meta  = json_decode(@$_COOKIE['order_meta']); // for another milestone

	$user_id = 0; // for now
//	$requested = date('Y-m-d H:i:s', strtotime($order_meta['timestamp']));
	$requested = date('Y-m-d H:i:s'); // for now

	runQ("BEGIN");

	$q = "INSERT INTO orders(user_id, requested) VALUES($user_id, '$requested')";
	if($r = runQ($q) == FALSE) 
	{
		alert("Unable to add order!");
		runQ("ROLLBACK");
		exit();
	}
	$r = runQ("SELECT order_id FROM orders ORDER BY submitted DESC LIMIT 1");
	$order_id = $r[0]['order_id'];


	foreach($order_items AS $item)
	{
		$product = intval($item['itemID']);
		$quantity = intval($item['quantity']);
		$notes = mysql_escape_string(@$item['notes']);
		$q = "INSERT INTO order_items(order_id, product_id, quantity, notes)
				VALUES ($order_id, $product, $quantity, '$notes' )";
		if($r = runQ($q) == FALSE)
	    {
			alert("Unable to add order!");
			runQ("ROLLBACK");
			exit();
		}

	}

	runQ("COMMIT");


} // }}}



function alert($msg) // {{{
{
	echo "	<script>
				alertDialog('$msg');
			</script>";
} // }}}




?>
