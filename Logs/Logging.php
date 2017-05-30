<?php
function LogCreator($user_id)
{
$ip=$_SERVER["REMOTE_ADDR"];
$date=date("D d M,Y h:i a");
$file=fopen("../Logs/Logs.txt","a");

$output="User Id : ".$user_id."  connected with ip : ".$ip." on this date:".$date."\n";

fwrite($file,$output);
}
?>





