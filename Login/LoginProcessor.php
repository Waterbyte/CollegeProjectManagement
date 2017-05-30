<?php
session_start();
include_once "Authorisation.php";
include_once "../Utilities/Connection.php";
include_once "../Utilities/CommonFunctions.php";
include_once "../Logs/Logging.php";
$user_id=$_POST['user_id'];
$password=$_POST['password'];

$user_id=sqlClean($user_id);
$password=sqlClean($password);

if(Authorise($user_id,$password))
{
UserType($user_id);
LogCreator($user_id);
}
else
{
    $Message="Please Enter Correct Credentials";
	header("location: ../Welcome.php?Message=" . urlencode($Message));
}





function UserType($user_id)
{
     $con=OpenCon();
 $sql="SELECT `user_type`,`last_login` FROM projuser WHERE user_id='".$user_id."'";
 $result = $con->query($sql);
 $row = $result->fetch_assoc();
 $user_type=$row['user_type'];
 $last_login=$row['last_login'];

    $_SESSION['user_id']=$user_id;
    $_SESSION['user_type']=$user_type;
    $_SESSION['last_login']=$last_login;

    $sqlupdatelogin="UPDATE projuser set last_login=curdate() WHERE user_id='".$user_id."'";
    $con->query($sqlupdatelogin);

    if($user_type=='ADMINISTRATOR')
    {
     header("location: ../Administration/AdministratorHome.php");
    }
    else if($user_type=='FACULTY'||$user_type=='HOD')
    {
        header("location: ../Faculty/FacultyHome.php");
    }
    else if($user_type=='STUDENT')
    {
        header("location: ../Student/StudentHome.php");
    }

 CloseCon($con);
}


?>
