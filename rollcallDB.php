<?php
// connect to database
$connection = mysqli_connect('localhost', 'rollcall_admin', 'admin123', 'rollcall');

// check connection
if (!$connection){
    echo "Connection error: " . mysqli_connect_error();
}

$sql = 'SELECT email, password FROM users';
$result = mysqli_query($connection, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
//mysqli_free_result($result);
//mysqli_close($connection);
//print_r($users);
?>