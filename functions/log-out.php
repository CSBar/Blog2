<?php
switch ( session_status() ) {
    case PHP_SESSION_ACTIVE:
        session_destroy();
        break;
}
header("Location: ../login.php");
exit;
