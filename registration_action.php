<?php
session_start();
$_SESSION["location_state"] = 'signup';
$errors = [];
$success = [];

// validation for name
if (isset($_POST['name']) && strlen($_POST['name']) == 0) {
    $errors[] = 'Please enter name.';
}

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
    $name = "";
    $email = "";
    
    // check if there is an error while trying to connect
    if($db === false){
        die("ERROR: Could not connect to server. ");
    }
    
    // if connection didn't fail, check if there is a user with given name and email
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // defining name and email query's for validation
    $sql_n = "SELECT * FROM users WHERE name='$name'";
    $sql_e = "SELECT * FROM users WHERE email='$email'";
    $res_n = mysqli_query($db, $sql_n);
    $res_e = mysqli_query($db, $sql_e);
    
    // validation for name and email
    // if name already exists
    if (mysqli_num_rows($res_n) > 0) {
        
        // if name and email already exist
        if (mysqli_num_rows($res_e) > 0){
            $errors[] = 'Name and email already taken.';

        // if only name exists
        } else {
            $errors[] = 'Name already taken.';
        }
    
    // if email already exists
    } else if (mysqli_num_rows($res_e) > 0){
        $errors[] = 'Email already taken.';	

    // if there is no such user registered, then add data to db
    } else {
        $query = "INSERT INTO users (name, email, password) 
                VALUES ('$name', '$email', '".sha1($password)."')";
        $results = mysqli_query($db, $query);
        $success[] = 'Registration was successful.';
    }
}

// checking validation outcomes for errors and success, and redirecting to index.php
if (count($errors) > 0) {
    $_SESSION['flash']['errors'] = $errors;
    header('Location: index.php');
} else if (count($success) > 0) {
    $_SESSION['flash']['success'] = $success;
    // $_SESSION["location_state"] = 'login';
    header('Location: index.php');
} 
