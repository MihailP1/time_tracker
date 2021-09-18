<?php 

require_once 'db.php';

$regData = json_decode(array_keys($_POST)[0]);
print_r($regData);
$id = mysqli_query( $db, "SELECT MAX(id) AS max FROM users");
$id = mysqli_fetch_assoc($id);
$id = $id['max'] + 1;
print_r($id);

$user_name = $regData->username;
$email = $regData->email;
$password = $regData->psw;
$password = hash('md5', $password);
$userNameExists = mysqli_query( $db, "SELECT user_name FROM users WHERE user_name = '$user_name'");
$userNameExists = mysqli_num_rows($userNameExists);
$emailExists = mysqli_query( $db, "SELECT email FROM users WHERE email = '$email'");
$emailExists = mysqli_num_rows($emailExists);
if($userNameExists==0 && $emailExists==0){
    mysqli_query($db, "INSERT INTO `users` (`id`, `user_name`, `email`, `password`) VALUES ('" . $id . "','" . $user_name . "','" . $email . "','" . $password . "')");
}
