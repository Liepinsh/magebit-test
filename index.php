<?php
session_start();

if(!isset($_SESSION["location_state"])) {
    $_SESSION["location_state"] = 'login';
}


// // header
// require_once 'components/header.php';

//content
require_once 'components/index.php';

// //footer
// require_once 'components/footer.php';