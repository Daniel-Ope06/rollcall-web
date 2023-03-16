<?php
// connect to database
$connection = mysqli_connect('localhost', 'rollcall_admin', 'admin123', 'rollcall');

// check connection
if (!$connection){
    echo "Connection error: " . mysqli_connect_error();
}

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

/*
function enroll_in_course($new_id, $email){
    global $connection;

    $user_data = get_user($email);
    $course_list = json_decode($user_data["courses_enrolled"], true);

    $new_id = mysqli_real_escape_string($connection, $new_id);
    $new_id = mysqli_real_escape_string($connection, $email);

    array_push($course_list["list"], $new_id);
    $updated_courses = json_encode($course_list);

    $sql = "UPDATE user SET courses_enrolled = '$updated_courses' WHERE email = '$email'";
    mysqli_query($connection, $sql);
}
*/
?>