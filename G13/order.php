<?php

// Include DB connection script
require_once("db.php");

// function to run a query (from db.php)
$items = runQ("SELECT * FROM products");



// iterate over array to print data

echo "<table>";

foreach($items AS $item)
{
	echo "<tr>";

	foreach($item AS $attr)
	{
		echo "<td>$attr</td>";
	}
	echo "</tr>";

}

echo "</table>";


$q = "INSERT INTO products(name, description, price) VALUES('test', 'test 2', 9999)";

if(runQ($q) === FALSE) 	echo "Could not add product";
else 					echo "Product added successfully";


?>
