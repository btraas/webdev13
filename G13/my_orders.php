<?php

// Include DB connection script
require_once("db.php");
require_once("log.php");
require_once("DOM_functions.php");
require_once("auth.php");

//logger($_REQUEST);


$u = array();
if(!isLoggedIn() && !empty($u = getUser()))
{
	// echo basic HTML & js functions
	include('page_header.php');
	include('page_footer.php');

	$js = "location.href = '/login'";
	alert("Please sign in to view previous orders.", $js);	// DOM_functions.php
	exit();												// displays dialog box which runs given JS code on "OK" click
}

include('page_header.php');

$q = "SELECT *, DATE_FORMAT(submitted, '%W, %b %e %Y') AS sub_date WHERE user_id = ".$u['num'];
if(($r = runQ($q)) === FALSE || empty($r))
{
	$js = "location.href = '/order'";
	alert("No previous orders found! Click OK to create a new order.");
	include('page_footer.php');
	exit();
}


echo "<h1>Previous Orders</h1>\n";

foreach($r AS $order)
{
	echo "<input class='ui-button' onClick=\"location.href = '/my_orders/$order[order_id]'\" value='Order #$order[order_id] - $order[sub_date]'/><br />";
}


include('page_footer.php');

} // }}}



?>
