<?php
// connect to database
$connection = mysqli_connect('localhost', 'rollcall_admin', 'admin123', 'rollcall');

// check connection
if (!$connection){
    echo "Connection error: " . mysqli_connect_error();
}

//$sql_users = 'SELECT email, password FROM users';
//$result = mysqli_query($connection, $sql);
//$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
//mysqli_free_result($result);
//mysqli_close($connection);
//print_r($users);



function get_user($email){
    global $connection;
    $sql = "SELECT * FROM users WHERE email = '$email'";
    return (mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC)[0]);
}

function get_course($id){
    global $connection;
    $sql = "SELECT * FROM courses WHERE id = '$id'";
    return (mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC)[0]);
}

?>