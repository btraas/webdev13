<?php

// Git auto-pull script called by github. Provided by gist.github.com/cowboy/619858


$GIT_PATH = "C:/cygwin64/bin/";

$_POST['payload'] = 'hi';

$msg = "";
$msg2 = "";

if( $_POST['payload'] ) {
	

	copy('sync_in_progress.html', 'index.html');
	$msg  .= shell_exec( $GIT_PATH.'git fetch origin master' );
	$msg2 .= shell_exec( $GIT_PATH.'git reset --hard HEAD & '.$GIT_PATH.'git merge -s recursive -X theirs origin/master' );

	if($msg2 == 'Already up-to-date.') 
	{
		echo "$msg\n$msg2\nTrying again...\n";
		sleep(2);
		$msg  .= shell_exec( $GIT_PATH.'git fetch origin master' );
		$msg2 .= shell_exec( $GIT_PATH.'git reset --hard HEAD & '.$GIT_PATH.'git merge -s recursive -X theirs origin/master' );

	}
}

echo "$msg\n$msg2";

?>
