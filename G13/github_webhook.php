<?php
// Use in the "Post-Receive URLs" section of your GitHub repo.

if ($_REQUEST['pass'] == getenv("GITHUB_PASS")) {
    echo nl2br(shell_exec( 'cd /var/www/webdev13/ && sudo git reset --hard HEAD && sudo git pull' ));
    exit();
}

// else display info


echo nl2br(shell_exec( 'cd /var/www/webdev13/ && sudo git log -p -2' ));

?>

