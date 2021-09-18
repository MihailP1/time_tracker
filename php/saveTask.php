<?php

require_once 'db.php';


$taskData = json_decode(array_keys($_POST)[0]);
print_r($taskData->taskName);
print_r($taskData->userName);
$userName = $taskData->userName;
$taskName = $taskData->taskName;
$taskTime = $taskData->time;
$userId = mysqli_query( $db, "SELECT id FROM users WHERE user_name = '$userName'");
$userId = mysqli_fetch_assoc($userId);
$userId = $userId['id'];

$taskNameExists = mysqli_query( $db, "SELECT task FROM saved_tasks WHERE id = '$userId' AND task = '$taskName'");
$taskNameExists = mysqli_num_rows($taskNameExists);


if ($userId > 0){
    if($taskNameExists > 0){
        $prevTime = mysqli_query( $db, "SELECT time FROM saved_tasks WHERE id = '$userId' AND task = '$taskName'");
        $prevTime = mysqli_fetch_assoc($prevTime);
        $prevTime = $prevTime['time'];
        $taskTime += $prevTime;

        mysqli_query($db, "UPDATE `saved_tasks` SET time = '$taskTime' WHERE id = '$userId' AND task = '$taskName'");
    } else {
        mysqli_query($db, "INSERT INTO `saved_tasks` (`id`, `task`, `time`) VALUES ('" . $userId . "','" . $taskName . "','" . $taskTime . "')");
    }
        
}
