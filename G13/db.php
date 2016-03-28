<?php

require_once("log.php");

function runQ($query, $printerror=false) // {{{
{
	
	$link = new mysqli( "localhost",    // Server (localhost = this server)
                        "webdev13",     // Username
                        "c1536withBen", // Password
                        "webdev13"      // Database name
) or die("Could not connect: " . $link->connect_error());


	$result = $link->query($query);


	if($result === FALSE) 
	{
		logger("Failed Query: $query: ".$link->error);
		if($printerror) echo $link->error;
		return FALSE;
	}
	$arr = array();
	
	while($row = $result->fetch_assoc())
	{
		$arr[] = $row;
	}

	$link->close();
	return $arr;

} // }}}


function getCategory($input) // {{{
{
	return str_replace('_', ' ', preg_replace("/[^a-zA-Z_\-~]/", "", $input));
} // }}}

function getCategoryURL($input) // {{{
{
	return strtolower(urlencode(str_replace(' ', '_', $input)));
} // }}}


?>
