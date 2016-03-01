<?php

// Git auto-pull script called by github. Provided by gist.github.com/cowboy/619858


$GIT_PATH = "C:\\cygwin64\\bin\\";

if( $_POST['payload'] ) {


	copy('index.html', 'index.html.bak');
	copy('sync_in_progress.html', 'index.html');
	shell_exec( $GIT_PATH.' git fetch origin master' );
	shell_exec( $GIT_PATH.' git merge -s recursive -X theirs origin/master' );

}

?>
