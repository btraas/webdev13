<?php

function logger($input)
{
	$msg = date("Y-m-d H:i:s")." ";

	if(is_array($input)) $msg .= print_r($input, true);
	else $msg .= $input;

	$msg .= "\n";

	file_put_contents("/tmp/g13-rc.log", $msg, FILE_APPEND);
 
}

?>
