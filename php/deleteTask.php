<?php

require_once 'db.php';

$taskData = json_decode(array_keys($_POST)[0]);


$userName = $taskData->userName;
$taskName = $taskData->taskName;

$userId = mysqli_query( $db, "SELECT id FROM users WHERE user_name = '$userName'");
$userId = mysqli_fetch_assoc($userId);
$userId = $userId['id'];

mysqli_query($db, "DELETE FROM`saved_tasks` WHERE id = '$userId' AND task = '$taskName'");