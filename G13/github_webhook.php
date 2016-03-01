<?php

// Git auto-pull script called by github. Provided by gist.github.com/cowboy/619858


$GIT_PATH = "C:/cygwin64/bin/";

$_POST['payload'] = 'hi';

if( $_POST['payload'] ) {
	

	copy('sync_in_progress.html', 'index.html');

	echo shell_exec( $GIT_PATH.'git fetch' );
	echo shell_exec( $GIT_PATH.'git reset --hard HEAD' ); 
	echo shell_exec( $GIT_PATH.'git merge -s recursive -X theirs origin/master' );

}


?>
