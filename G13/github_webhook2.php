<?php

// Git auto-pull script called by github. Provided by gist.github.com/cowboy/619858


$BASH_PATH = "C:/cygwin64/bin/";
$SH_PATH = "/cygdrive/d/webdev13/G13/";

$_POST['payload'] = 'hi';

if( $_POST['payload'] ) {

	echo shell_exec( $BASH_PATH."bash ".$SH_PATH."pull.sh" );

}


?>
