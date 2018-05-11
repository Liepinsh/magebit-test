<?php
session_start();

if(!isset($_SESSION["location_state"])) {
    $_SESSION["location_state"] = 'login';
}

//content
require_once 'components/index.php';
