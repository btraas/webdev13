<?php

// Git auto-pull script called by github. Provided by gist.github.com/cowboy/619858


$GIT_PATH = "C:/cygwin64/bin/";

$_POST['payload'] = 'hi';

$msg = "";

if( $_POST['payload'] ) {
	

	copy('sync_in_progress.html', 'index.html');
	$msg .= shell_exec( $GIT_PATH.'git fetch origin master' );
	$msg .= " \n".shell_exec( $GIT_PATH.'git reset --hard HEAD & '.$GIT_PATH.'git merge -s recursive -X theirs origin/master' );
}

echo $msg;

?>
