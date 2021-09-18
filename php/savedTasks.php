<?php
require_once 'db.php';

$userName = json_decode(array_keys($_POST)[0]);



$userId = mysqli_query( $db, "SELECT id FROM users WHERE user_name = '$userName'");
$userId = mysqli_fetch_assoc($userId);
$userId = $userId['id'];

$savedTasks = mysqli_query($db, "SELECT task, time FROM saved_tasks WHERE id = '$userId'");
$savedTasksExist = mysqli_num_rows($savedTasks);
$savedTasks = json_encode(mysqli_fetch_all($savedTasks));

if($savedTasksExist > 0){
    print_r($savedTasks);
} else {
    print_r(0);
}