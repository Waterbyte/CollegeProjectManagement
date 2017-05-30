<?php

include_once "../Utilities/CommonFunctions.php";
include_once "../Utilities/Connection.php";
$project_title=sqlClean($_POST['project_title']);
$project_title=nl2br(htmlentities($project_title, ENT_QUOTES, 'UTF-8'));
$project_objective=sqlClean($_POST['project_objective']);
$project_objective=nl2br(htmlentities($project_objective, ENT_QUOTES, 'UTF-8'));
$project_requirements=sqlClean($_POST['project_requirements']);
$project_requirements=nl2br(htmlentities($project_requirements, ENT_QUOTES, 'UTF-8'));
$project_background=sqlClean($_POST['project_background']);
$project_background=nl2br(htmlentities($project_background, ENT_QUOTES, 'UTF-8'));
$project_type =$_POST['project_type'];
$project_supervisor =$_POST['user_id'];
$project_id=$_POST['project_id'];
$con=OpenCon();

$sql="UPDATE `project` SET `project_title` = '".$project_title."', `project_objective` = '".$project_objective."', `project_requirements` = '".$project_requirements."', `project_background` = '".$project_background."', `project_type` = '".$project_type."' , `project_supervisor`='".$project_supervisor."' WHERE `project`.`project_id`='".$project_id."'";



if($con->query($sql))
{
header("location:StudentPersonalInfo.php");
}
else
{
echo mysqli_error($con);
}

CloseCon($con);

?>
