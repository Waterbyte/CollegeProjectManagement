<?php

include_once "../Utilities/Connection.php";
include_once "../Utilities/SendMail.php";
$con=openCon();
global $user_id_otp;
session_start();
$user_id=$_POST['user_id'];

$string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$string_shuffled = str_shuffle($string);
$otp = substr($string_shuffled, 1, 6);
$_SESSION['otp']=$otp;

$sql="SELECT email FROM projuser WHERE user_id='".$user_id."'";
$result = $con->query($sql);


if ($result->num_rows > 0)
{
        $row = $result->fetch_assoc();
        $email=$row["email"];
        if($email==null)
        {
            echo "Email Address is not present for this User Id. Please contact the administrator.";
        }
        else
        {
            if(sendMail($otp,$email))
            {
            include_once "NewPassword.php";
            newPass($user_id);
            }
            else
            {
                echo "OTP couldn't be sent";
            }
        }
}
else
{
    echo "This Id doesn't exist.";
}


CloseCon($con);
?>
