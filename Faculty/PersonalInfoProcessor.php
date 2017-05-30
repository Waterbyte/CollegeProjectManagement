<?php
include_once "../Utilities/Connection.php";
include_once "../Utilities/CommonFunctions.php";

$user_name=sqlClean($_POST['user_name']);
$user_name=nl2br(htmlentities($user_name, ENT_QUOTES, 'UTF-8'));

$phone_number=sqlClean($_POST['phone_number'].""); //To make it a string.
$phone_number=nl2br(htmlentities($phone_number, ENT_QUOTES, 'UTF-8'));

$email=sqlClean($_POST['email']);
$email=nl2br(htmlentities($email, ENT_QUOTES, 'UTF-8'));

$user_address=sqlClean($_POST['user_address']);
$user_address=nl2br(htmlentities($user_address, ENT_QUOTES, 'UTF-8'));

$password=$_POST['password'];
$password=hash("sha256", $password);

$selected_user_id=$_POST['selected_user_id'];

$con=OpenCon();

$sql="UPDATE `projuser` SET  `user_name` = '".$user_name."', `phone_number` = '".$phone_number."', `email` = '".$email."', `user_address` = '".$user_address."',`password`='".$password."' WHERE `projuser`.`user_id` = '".$selected_user_id."'";


if($con->query($sql))
{
header("location:PersonalInfo.php");
}
else
{
echo mysqli_error($con);
}

CloseCon($con);

?>
