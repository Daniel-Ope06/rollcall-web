<?php
require "rollcallDB.php";

$user;
$sql_access = "SELECT * FROM users WHERE email = '$_POST[email]'";


// if sign-up then store data and log in automatically
if($_POST['submit'] == "sign-up-submit"){
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $sql_insert = "INSERT INTO users(email, username, password) VALUES('$email','$username','$password')";

    if(mysqli_query($connection, $sql_insert)){
        $user = mysqli_fetch_all(mysqli_query($connection, $sql_access), MYSQLI_ASSOC)[0];
    } else {
        echo 'query error: '. mysqli_error($connection);
    }
}

// if sign-in
if($_POST['submit'] == "sign-in-submit"){
    if (mysqli_query($connection, $sql_access)){
        $user = mysqli_fetch_all(mysqli_query($connection, $sql_access), MYSQLI_ASSOC)[0];
    } else {
        echo 'query error: '. mysqli_error($connection);
    }
}

print_r($user);
?>