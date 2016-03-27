<?php


function runQ($query) // {{{
{
	
	$link = new mysqli(     "localhost",    // Server (localhost = this server)
                        "webdev13",     // Username
                        "c1536withBen", // Password
                        "webdev13"      // Database name
) or die("Could not connect: " . $link->connect_error());


	$result = $link->query($query);


	if($result === FALSE) return FALSE;

	$arr = array();
	
	while($row = $result->fetch_assoc())
	{
		$arr[] = $row;
	}

	$link->close();
	return $arr;

} // }}}



?>
