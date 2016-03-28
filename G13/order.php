<?php

// Include DB connection script
require_once("db.php");
require_once("log.php");

logger($_REQUEST);

// getCategory in db.php
$category = getCategory(@$_REQUEST['category']);
if(empty($category)) $category = 'appetizers';




// function to run a query (from db.php)
$items = runQ("SELECT p.*, pc.*, p.name AS product_name, pc.name AS category FROM products p 
				INNER JOIN product_categories pc ON pc.category_id = p.category_id
				WHERE LOWER(pc.name) = LOWER('$category') ");


$groups = runQ("SELECT name FROM product_categories");


echo file_get_contents("order_header.html");



echo "	<div id='orderGroups' class='blackList'>
			<ul>";


foreach($groups AS $g)
{
	$category = getCategoryURL(@$g['name']);

	echo "<li><a href='/order/$category/'>$g[name]</a></li>\n";
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



?>
