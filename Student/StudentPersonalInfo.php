<DOCTYPE html>
<html>
<head>
<title>Current Users</title>

<link rel="stylesheet" type="text/css" href="../Utilities/styles.css">
<link rel="stylesheet" type="text/css" href="../Utilities/TableStyle.css">
</head>
<body>

<?php

    session_start();
    if(!($_SESSION['user_type']=='STUDENT'))
    {
        header("location: ../Welcome.php");
    }
    $user_id=$_SESSION['user_id'];


include_once "../Utilities/Connection.php";
$con=openCon();
$sql="SELECT * FROM projuser WHERE user_id='".$user_id."'";

if($result = $con->query($sql))
{
$row = $result->fetch_assoc();
    echo'
        <div id="container">
    <div id="first">User Id:</div>
    <div id="second">'.$row["user_id"].'</div>
    </div>
    <div id="container">
    <div id="first">Name:</div>
    <div id="second">'.$row["user_name"].'</div>
    </div>
    <div id="container" >
    <div id="first">Department:</div>
    <div id="second">'.$row["user_department"].'</div>
    </div>
    <div id="container" >
    <div id="first">Address:</div>
    <div id="second" style=" overflow: auto;">'.$row["user_address"].'</div>
    </div>
    </div>
    <div id="container" >
    <div id="first">Phone Number:</div>
    <div id="second">'.$row["phone_number"].'</div>
    </div>
    </div>
    <div id="container" >
    <div id="first">Email:</div>
    <div id="second">'.$row["email"].'</div>
    </div>
    <div id="container" >
    <div id="first">Last Login:</div>
    <div id="second">'.$_SESSION["last_login"].'</div>
    </div>
    <a id="button" href="StudentPersonalInfoUpdate.php" target="iframe_a">Update</a>
    ';
}
else
{
    echo "Database Error. Please Login Again.";
}




$sql1="SELECT * FROM project where user_id='".$user_id."'";
$result1 = $con->query($sql1);


if ($result1->num_rows > 0) {

    echo '<div
    style="
    margin-top:10px;
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    ">
    <h2 style="color:dodgerblue;">MY PROJECTS</h2>';
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
    <th>Edit</th>
    <th>Delete</th>
    <th>Upload</th>
    </tr>";

    while($row1 = $result1->fetch_assoc()) {
        echo "<tr>
        <td>".$row1["project_id"]."</td>
        <td>".UserIdDis($row1["user_id"],$con)."</td>
        <td>".ProjTypeDis($row1["project_type"],$con)."</td>
        <td>".$row1["project_title"]."</td>
        <td>".$row1["project_allocation"]."</td>
        <td>".ProjSuper($row1["project_supervisor"],$con)."</td>
        <td>".ProjStatus($row1["project_status"],$con)."</td>
        <td>".$row1["project_statusdate"]."</td>
        <td> <input name=\"View$row1[project_id]\" type=\"submit\" value=\"View\" /></td>
        <td> <input name=\"Edit$row1[project_id]\" type=\"submit\" value=\"Edit\" /></td>
        <td> <input name=\"Delete$row1[project_id]\" type=\"submit\" value=\"Delete\" /></td>
        <td>".UploadCheck($row1)."</td>
        </tr>";
    }
    echo "</table>
    </form></div>";
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
    function UploadCheck($row1)
    {
     if($row1["project_status"]==2)
    {
       return " <input name=\"Upload$row1[project_id]\" type=\"submit\" value=\"Upload\" />";
    }else
    {
        return "-";
    }
    }

CloseCon($con);

?>
</body>
</html>
