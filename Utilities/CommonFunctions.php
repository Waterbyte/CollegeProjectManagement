<?php
function UserName($user_id,$con)
 {
    $sql="SELECT user_name FROM projuser WHERE user_id='".$user_id."'";
 $result = $con->query($sql);
 $row=$result->fetch_assoc();
 $user_name=$row["user_name"];
 return $user_name;
 }

function sqlClean($input)
{
include_once "Connection.php";
$con=OpenCon();
$output=mysqli_real_escape_string($con,$input);
CloseCon($con);
return $output;
}

?>
