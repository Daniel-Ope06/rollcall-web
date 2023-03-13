<?php
require_once("rollcallDB.php");

$user_data;
$course_list;
$upcoming_courses = array();

if($_POST["submit"] == "sign-in-submit"){
    $user_data = get_user($_POST["email"]);
    $course_list = json_decode($user_data["courses"], true)["list"];

    for($i = 0; $i < count($course_list); $i++){
        $id = $course_list[$i];
        $course = get_course($id);
        $schedule_list = json_decode($course["schedule"], true)["list"];

        $current_day = date('l');
        $current_time = '00:00';//date('H:i');

        for ($j = 0; $j < count($schedule_list); $j++){
            $schedule = $schedule_list[$j];

            $end_time = substr($schedule["time"], strpos($schedule["time"], "-") + 2, 5);

            // time difference in seconds
            $time_diff = strtotime($end_time) - strtotime($current_time);

            if ($schedule["day"] == $current_day && $time_diff>0){
                array_push($upcoming_courses, array("course"=>$course, "time"=>$schedule["time"]));
            }
        }
    }
    //print_r($current_time);
}

//print_r($user_data);
//print_r($course_list);
?>

<head>
    <link rel="stylesheet" type="text/css" href="./views/dashboard.view/dashboard.view.css">
    <title>Dashboard | <?php echo $user_data["username"]; ?></title>
</head>

<body>
    <div class="header-bg"></div>

    <header class="logo">
        <svg class="logo-icon" width="41" height="48" viewBox="0 0 41 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_223_217)">
        <path d="M36.9231 5.53846H33.2308V3.69231C33.2308 2.71305 32.8418 1.77389 32.1493 1.08145C31.4569 0.38901 30.5177 0 29.5385 0H11.0769C10.0977 0 9.15851 0.38901 8.46607 1.08145C7.77363 1.77389 7.38461 2.71305 7.38461 3.69231V5.53846H3.69231C2.71305 5.53846 1.77389 5.92747 1.08145 6.61991C0.38901 7.31236 0 8.25151 0 9.23077V44.3077C0 45.287 0.38901 46.2261 1.08145 46.9185C1.77389 47.611 2.71305 48 3.69231 48H36.9231C37.9023 48 38.8415 47.611 39.5339 46.9185C40.2264 46.2261 40.6154 45.287 40.6154 44.3077V9.23077C40.6154 8.25151 40.2264 7.31236 39.5339 6.61991C38.8415 5.92747 37.9023 5.53846 36.9231 5.53846ZM11.0769 3.69231H29.5385V7.38462V11.0769H11.0769V3.69231ZM36.9231 44.3077H3.69231V9.23077H7.38461V11.0769C7.38461 12.0562 7.77363 12.9953 8.46607 13.6878C9.15851 14.3802 10.0977 14.7692 11.0769 14.7692H29.5385C30.5177 14.7692 31.4569 14.3802 32.1493 13.6878C32.8418 12.9953 33.2308 12.0562 33.2308 11.0769V9.23077H36.9231V44.3077Z" fill="white"/>
        <path d="M11.077 18.4615H7.38473C6.36513 18.4615 5.53857 19.2881 5.53857 20.3077V24C5.53857 25.0196 6.36513 25.8462 7.38473 25.8462H11.077C12.0966 25.8462 12.9232 25.0196 12.9232 24V20.3077C12.9232 19.2881 12.0966 18.4615 11.077 18.4615Z" fill="white"/>
        <path d="M11.077 29.5385H7.38473C6.36513 29.5385 5.53857 30.365 5.53857 31.3846V35.0769C5.53857 36.0965 6.36513 36.9231 7.38473 36.9231H11.077C12.0966 36.9231 12.9232 36.0965 12.9232 35.0769V31.3846C12.9232 30.365 12.0966 29.5385 11.077 29.5385Z" fill="white"/>
        <path d="M33.2306 20.3077H18.4614C17.9718 20.3077 17.5022 20.5022 17.156 20.8484C16.8097 21.1947 16.6152 21.6642 16.6152 22.1539C16.6152 22.6435 16.8097 23.1131 17.156 23.4593C17.5022 23.8055 17.9718 24 18.4614 24H33.2306C33.7202 24 34.1898 23.8055 34.536 23.4593C34.8823 23.1131 35.0768 22.6435 35.0768 22.1539C35.0768 21.6642 34.8823 21.1947 34.536 20.8484C34.1898 20.5022 33.7202 20.3077 33.2306 20.3077Z" fill="white"/>
        <path d="M33.2306 31.3846H18.4614C17.9718 31.3846 17.5022 31.5791 17.156 31.9253C16.8097 32.2716 16.6152 32.7411 16.6152 33.2308C16.6152 33.7204 16.8097 34.19 17.156 34.5362C17.5022 34.8824 17.9718 35.0769 18.4614 35.0769H33.2306C33.7202 35.0769 34.1898 34.8824 34.536 34.5362C34.8823 34.19 35.0768 33.7204 35.0768 33.2308C35.0768 32.7411 34.8823 32.2716 34.536 31.9253C34.1898 31.5791 33.7202 31.3846 33.2306 31.3846Z" fill="white"/>
        </g>
        <defs>
        <clipPath id="clip0_223_217">
        <rect width="40.6154" height="48" fill="white"/>
        </clipPath>
        </defs>
        </svg>
        <h1 class="brand-name">RollCall</h1>
    </header>

    <section class="upcoming-section">
        <h1><?= !empty($upcoming_courses) ? "Upcoming events" : "No upcoming events" ?></h1>

        <div class="card-grid">
            <?php
            $num_courses = min(count($upcoming_courses), 3);
            for ($i = 0; $i < $num_courses; $i++):
                $course = $upcoming_courses[$i]["course"];
            ?>
                <div class="card">
                    <div class="date-time">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_257_89)">
                        <path d="M8 3.5C8 3.22386 7.77614 3 7.5 3C7.22386 3 7 3.22386 7 3.5V9C7 9.17943 7.09614 9.3451 7.25193 9.43412L10.7519 11.4341C10.9917 11.5711 11.2971 11.4878 11.4341 11.2481C11.5711 11.0083 11.4878 10.7029 11.2481 10.5659L8 8.70984V3.5Z" fill="#2E2E2E" fill-opacity="0.7"/>
                        <path d="M8 16C12.4183 16 16 12.4183 16 8C16 3.58172 12.4183 0 8 0C3.58172 0 0 3.58172 0 8C0 12.4183 3.58172 16 8 16ZM15 8C15 11.866 11.866 15 8 15C4.13401 15 1 11.866 1 8C1 4.13401 4.13401 1 8 1C11.866 1 15 4.13401 15 8Z" fill="#2E2E2E" fill-opacity="0.7"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_257_89">
                        <rect width="16" height="16" fill="white"/>
                        </clipPath>
                        </defs>
                        </svg>

                        <h3><?= $upcoming_courses[$i]["time"] ?></h3>
                    </div>

                    <div class="circle"></div>

                    <h2 class="course-name"><?= $course["code"] ?></h2>

                    <p class="course-descriptionn"><?= $course["description"] ?></p>
                </div>
            <?php endfor; ?>
        </div>
    </section>

    <section class="courses-section">
        <h1>Your Courses</h1>
        
        <div class="card-grid">
            <?php
            $num_courses = count($course_list);
            for ($i = 0; $i < $num_courses; $i++):
                $course = get_course($course_list[$i]);
            ?>
                <div class="card">
                    <div class="circle"></div>
                    <h2 class="course-name"><?= $course["code"] ?></h2>
                </div>
            <?php endfor; ?>
        </div>
    </section>

</body>