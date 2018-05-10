<?php
session_start();
$_SESSION["location_state"] = 'login';
$errors = [];
$success = [];

// validation for email
if (isset($_POST['email']) && strlen($_POST['email']) == 0) {
    $errors[] = 'Please enter email.';
}

// validation for password
if (isset($_POST['password']) && strlen($_POST['password']) < 8) {
    $errors[] = 'Password must be atleast 8 symbols long.';

// if no errors in input fealds, then check if user exists in db
} else {
    $db = mysqli_connect('localhost', 'root', '', 'rcs_web_server');
    $email = "";
    $passwod = "";

    // check if there is an error while trying to connect
    if($db === false){
        die("ERROR: Could not connect to server. ");
    }

    // if connection didn't fail, check if there is a user with given email and password
    $email = $_POST['email'];
    $password = $_POST['password'];

    // defining email and password query's for validation
    $sql_e = "SELECT * FROM users WHERE email='$email'";
    $sql_p = "SELECT * FROM users WHERE password='".sha1($password)."'";
    $res_e = mysqli_query($db, $sql_e);
    $res_p = mysqli_query($db, $sql_p);

    // validation for email and password
    // if email is correct
    if (mysqli_num_rows($res_e) > 0){

        // if email and passord is correct
        if (mysqli_num_rows($res_p) > 0){
            $success[] = 'You have logged in.';
        
        // if email is correct, but password is not
        } else {
            $errors[] = 'Password was incorrect.';
        }

    // if email is incorrect
    } else {
        $errors[] = 'Login was incorrect.';
    }
}

// checking validation outcomes for errors and success, and redirecting to index.php
if (count($errors) > 0) {
    $_SESSION['flash']['errors'] = $errors;
    header('Location: index.php');
} else if (count($success) > 0) {
    $_SESSION['flash']['success'] = $success;
    header('Location: index.php');
} 
