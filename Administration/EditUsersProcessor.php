<?php
session_start();
    if(!($_SESSION['user_type']=='ADMINISTRATOR'))
    {
        header("location: ../Welcome.php");
    }
include_once "../Utilities/Connection.php";
include_once "../Utilities/CommonFunctions.php";

$user_id=sqlClean($_POST['user_id']);
$user_id=nl2br(htmlentities($user_id, ENT_QUOTES, 'UTF-8'));

$user_roll_number=sqlClean($_POST['user_roll_number']);
$user_roll_number=nl2br(htmlentities($user_roll_number, ENT_QUOTES, 'UTF-8'));

$user_name=sqlClean($_POST['user_name']);
$user_name=nl2br(htmlentities($user_name, ENT_QUOTES, 'UTF-8'));

$phone_number=sqlClean($_POST['phone_number'].""); //To make it a string.
$phone_number=nl2br(htmlentities($phone_number, ENT_QUOTES, 'UTF-8'));

$email=sqlClean($_POST['email']);
$email=nl2br(htmlentities($email, ENT_QUOTES, 'UTF-8'));

$user_address=sqlClean($_POST['user_address']);
$user_address=nl2br(htmlentities($user_address, ENT_QUOTES, 'UTF-8'));

$user_department=$_POST['user_department'];
$user_type=$_POST['user_type'];
$selected_user_id=$_POST['selected_user_id'];
$user_year=$_POST['user_year'];

$con=OpenCon();

$sql="UPDATE `projuser` SET `user_id` = '".$user_id."', `user_roll_number` = '".$user_roll_number."', `user_name` = '".$user_name."', `phone_number` = '".$phone_number."', `email` = '".$email."',`user_year`='".$user_year."', `user_address` = '".$user_address."', `user_department` = '".$user_department."', `user_type` = '".$user_type."' WHERE `projuser`.`user_id` = '".$selected_user_id."'";


if($con->query($sql))
{
header("location:CurrentUsers.php");
}
else
{
echo mysqli_error($con);
}

CloseCon($con);

?>
