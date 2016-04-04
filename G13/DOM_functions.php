<?php


function alert($msg, $js="") // {{{
{
	$callback = "";

	$msg = nl2br($msg);
	$msg = trim(preg_replace('/\s+/', ' ', $msg));

	if(!empty($js))
	{
		$callback = ", { buttons : { OK : function() { $js; } } }";
	}

	echo "	<script>
				alertDialog('$msg'$callback);
			</script>";
} // }}}

function clearCookie($cookie, $path="") // {{{
{
	echo "<script>document.cookie='$cookie=;expires=Thu, 01 Jan 1970 00:00:01 GMT;$path';</script>";
} // }}}


?>
