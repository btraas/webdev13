<?php

$link = new mysqli(		"localhost", 	// Server (localhost = this server)
						"webdev13", 	// Username
						"c1536withBen",	// Password
						"webdev13"		// Database name
) or die("Could not connect: " . $link->connect_error());

print ("Connected successfully <br \>");

$query = "SELECT * FROM products";
$result = $link->query($query);

while ($row = $result->fetch_assoc()) 	// get each row
{ 
	$name = $row['name']; 		// get this row's 'name' column
	$price= $row['price']; 	// get this row's 'price' column

	echo $name . ", " . $price . "<br>"; 
}


$link->close();
?>
