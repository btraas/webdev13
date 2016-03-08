<?php
// Use in the "Post-Receive URLs" section of your GitHub repo.
if ( $_POST['payload'] ) {
  shell_exec( 'cd /var/www/webdev13/ && sudo git reset --hard HEAD && sudo git pull' );
}
?>

