<?php
// connect to database
$connection = mysqli_connect('localhost', 'rollcall_admin', 'admin123', 'rollcall');

// check connection
if (!$connection){
    echo "Connection error: " . mysqli_connect_error();
}

?>