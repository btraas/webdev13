<?php
// Use in the "Post-Receive URLs" section of your GitHub repo.

if (@$_REQUEST['pass'] == getenv("GITHUB_PASS")) {
    echo nl2br(shell_exec( 'cd /var/www/webdev13/ && sudo git reset --hard HEAD && sudo git pull && sudo chown www-data -R /var/www/webdev13 && sudo chgrp www-data -R /var/www/webdev13' ));
    exit();
}

// else display info

echo "<h1>Last 2 commits:</h1><br /><br />";
echo nl2br(shell_exec( 'cd /var/www/webdev13/ && sudo git log -p -2' ));

?>

