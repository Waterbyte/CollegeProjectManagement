<DOCTYPE html>
<html>
<head>
<title>Project List</title>
<link rel="stylesheet" href="../Utilities/TableStyle.css">
</head>
<body>

<?php
include_once "../Utilities/Connection.php";
$con=openCon();
session_start();
    $user_id=$_SESSION['user_id'];


$sql="SELECT user_department FROM projuser WHERE user_id='".$user_id."' ";
$result = $con->query($sql);
$row=$result->fetch_assoc();
$user_department=$row["user_department"];


 $sql2="SELECT * FROM project WHERE project_department='".$user_department."' and project_status=1 or project_status=2 or project_status=8 and project_supervisor='".$user_id."'";
 $result2=$con->query($sql2);

 if ($result2->num_rows > 0)
{
	    echo "
    <form action=\"ProjectStatusProcessor.php\"  method=\"post\">
    <table><tr>
    <th>Project ID</th>
    <th>User ID </th>
    <th>Student Name</th>
    <th>Project Title</th>
    <th>Project Type</th>
    <th>Project Allocation</th>
    <th>Project Status</th>
    <th>Project Status Date</th>
    <th>Project Supervisor</th>
    <th>View</th>
    <th>Allow</th>
    <th>Reject</th>
    </tr>";

        while($row2 = $result2->fetch_assoc())
		{
         echo "<tr>
        <td>".$row2["project_id"]."</td>
        <td>".$row2["user_id"]."</td>
        <td>".UserName($row2["user_id"],$con)."</td>
        <td>".$row2["project_title"]."</td>
        <td>".ProjTypeDesc($row2["project_type"],$con)."</td>
        <td>".$row2["project_allocation"]."</td>
        <td>".ProjStatus($row2["project_status"],$con)."</td>
        <td>".$row2["project_statusdate"]."</td>
        <td>".UserName($row2["project_supervisor"],$con)."</td>
        <td> <input name=\"View$row2[project_id]\" type=\"submit\" value=\"View\" /></td>
        <td>".StatusCheck($row2["project_status"],$row2)."</td>
        <td>".StatusCheckReject($row2["project_status"],$row2)."</td>
        </tr>";
		}
echo "</table>
    </form>
    ";
 }
function ProjTypeDesc($project_type,$con)
{
 $sql="SELECT project_criteria_name FROM projecttypemap WHERE project_type='".$project_type."'";
 $result = $con->query($sql);
$row=$result->fetch_assoc();
$project_criteria_name=$row["project_criteria_name"];
return $project_criteria_name;
}

function UserName($user_id,$con)
{
    $sql="SELECT user_name FROM projuser WHERE user_id='".$user_id."'";
 $result = $con->query($sql);
$row=$result->fetch_assoc();
$user_name=$row["user_name"];
return $user_name;
}



function StatusCheck($project_status,$row2)
{
    if ($project_status==1)

    {
       return "<input name=\"Edit$row2[project_id]\" type=\"submit\" value=\"Allow\"  >";
    }
    else if($project_status==2)
    {
        return "Allowed";
    }
}
    function StatusCheckReject($project_status,$row2)
{
    if($project_status==1)
    {
        return "<input name=\"Rjct$row2[project_id]\" type=\"submit\" value=\"Reject\"  >";
    }
    else if($project_status==8)
    {
        return "Rejected by Supervisor";
    }
}
function ProjStatus($project_status,$con)
    {
        $sql="Select  project_status from projectstatusmap where project_status_type='".$project_status."'";
        $result=$con->query($sql);
        $row=$result->fetch_assoc();
        return $row['project_status'];
    }
CloseCon($con);
?>
</body>
</html>


