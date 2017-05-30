<DOCTYPE html>
<html>
<head>
<title>Current Users</title>
<link rel="stylesheet" href="../Utilities/TableStyle.css">
</head>
<body>

<?php
     session_start();
    if(!($_SESSION['user_type']=='STUDENT'))
    {
        header("location: ../Welcome.php");
    }
include_once "../Utilities/Connection.php";
$con=openCon();
$sql="SELECT * FROM project";
$result = $con->query($sql);


if ($result->num_rows > 0) {

    echo " <form action=\"ViewProjectProcessor.php\" method=\"post\">
    <table><tr>
    <th>Project ID</th>
    <th>Student Name</th>
     <th>Project Type</th>
    <th>Project title</th>
    <th>Project Allocation</th>
    <th>Project Supervisor</th>
    <th>Project Status</th>
    <th>Status Date</th>
    <th>View</th>
    </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["project_id"]."</td>
        <td>".UserIdDis($row["user_id"],$con)."</td>
        <td>".ProjTypeDis($row["project_type"],$con)."</td>
        <td>".$row["project_title"]."</td>
        <td>".$row["project_allocation"]."</td>
        <td>".ProjSuper($row["project_supervisor"],$con)."</td>
        <td>".ProjStatus($row["project_status"],$con)."</td>
        <td>".$row["project_statusdate"]."</td>
        <td> <input name=\"View$row[project_id]\" type=\"submit\" value=\"View\" /></td>
        </tr>";
    }
    echo "</table>
    </form>";
}

    function ProjTypeDis($project_type,$con)
    {
        $sql="Select project_criteria_name from projecttypemap where project_type='".$project_type."'";
        $result=$con->query($sql);
        $row=$result->fetch_assoc();
        return $row['project_criteria_name'];
    }
    function UserIdDis($user_id,$con)
    {
        $sql="Select  user_name from projuser where user_id='".$user_id."'";
        $result=$con->query($sql);
        $row=$result->fetch_assoc();
        return $row['user_name'];
    }
    function ProjSuper($project_supervisor,$con)
    {
        $sql="Select  user_name from projuser where user_id='".$project_supervisor."'";
        $result=$con->query($sql);
        $row=$result->fetch_assoc();
        return $row['user_name'];
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
