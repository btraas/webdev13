<?php
// Use in the "Post-Receive URLs" section of your GitHub repo.

$ip = $_SERVER['REMOTE_ADDR'];

echo gethostbyaddr($ip);

if ( $_REQUEST['payload']) {
    echo nl2br(shell_exec( 'cd /var/www/webdev13/ && sudo git reset --hard HEAD && sudo git pull' ));
    exit();
}

echo "Invalid format!";

?>


