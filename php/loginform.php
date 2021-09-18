<?php 

require_once 'db.php';

$loginData = json_decode(array_keys($_POST)[0]);

$email = $loginData->email;
$password = $loginData->psw;
$password = hash('md5', $password);
$userExist = mysqli_query( $db, "SELECT email FROM users WHERE password = '$password' AND email = '$email'");
$userExist = mysqli_num_rows($userExist);
if($userExist){
    $username = mysqli_query( $db, "SELECT user_name FROM users WHERE email = '$email'");
    $username = mysqli_fetch_assoc($username);
    print_r($username['user_name']);
}






