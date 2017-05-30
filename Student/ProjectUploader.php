<?php
session_start();
    $user_id=$_SESSION['user_id'];
include_once "../Utilities/Connection.php";
include_once "../Utilities/CommonFunctions.php";
$con=openCon();
$sql ="SELECT  user_department FROM projuser WHERE user_id='".$user_id."'";
$result=$con->query($sql);
$row=$result->fetch_assoc();
$user_department=$row["user_department"];
$project_title =sqlClean($_POST['project_title']);
$project_title=nl2br(htmlentities($project_title, ENT_QUOTES, 'UTF-8'));
$project_supervisor =$_POST['user_id'];
$project_type =$_POST['project_type'];
$project_requirements =sqlClean($_POST['project_requirements']);
$project_requirements=nl2br(htmlentities($project_requirements, ENT_QUOTES, 'UTF-8'));
$project_objective =sqlClean($_POST['project_objective']);
$project_objective =nl2br(htmlentities($project_objective, ENT_QUOTES, 'UTF-8'));
$project_background =sqlClean($_POST['project_background']);
$project_background=nl2br(htmlentities($project_background, ENT_QUOTES, 'UTF-8'));
$sql1 ="INSERT INTO `project` (`user_id`, `project_title`,`project_objective`,`project_requirements`,`project_background`, `project_department`, `project_type`, `project_file_path`, `project_allocation`, `project_status`, `project_statusdate`, `project_supervisor`) VALUES ('".$user_id."', '".$project_title."','".$project_objective."','".$project_requirements."','".$project_background."', '".$user_department."', '".$project_type."','', '', '1', curdate(), '".$project_supervisor."')";
if(mysqli_query($con,$sql1))
{
   header("location:StudentPersonalInfo.php");
}
else{
       echo "wrong query";
    }
mysqli_close($con);


?>

