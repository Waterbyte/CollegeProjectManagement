<?php

function sendMail($otp,$email)
{
$to=$email;
$subject="Forget Password";
$body ="Your OTP is: ".$otp;
$headers="From: thdcihetpms@gmail.com";

if(mail($to,$subject,$body,$headers))
{
   return true;
}
else
{
   return false;
}
}
?>
