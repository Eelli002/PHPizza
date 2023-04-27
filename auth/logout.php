<!-- This script will be log the user out and will
reset the $_SESSION variables -->
<?php
    session_start();

    if (isset($_SESSION['loggedin'])) {
        $_SESSION['loggedin'] = false;
        $_SESSION['user'] = '';
    }
?>