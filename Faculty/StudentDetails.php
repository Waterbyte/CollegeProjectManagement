<DOCTYPE html>
<html>
<head>
<title>Student Details</title>
<link rel="stylesheet" type="text/css" href="../Utilities/TableStyle.css">
</head>
<body>

<?php
include_once "../Utilities/Connection.php";
$con=openCon();

session_start();
    $user_id=$_SESSION['user_id'];


$sql="SELECT user_department FROM projuser WHERE user_id='".$user_id."'";
$result = $con->query($sql);
$row1=$result->fetch_assoc();
$user_department=$row1["user_department"];
$sql2="SELECT * FROM projuser WHERE user_department='".$user_department."' AND user_type='STUDENT' ";
$result2=$con->query($sql2);



if ($result2->num_rows > 0)
{
    echo "<table>
    <tr>
    <th>Student ID</th>
    <th>Student Name </th>
    <th>Roll Number</th>
    <th>Branch</th>
    <th>Phone Number</th>
    <th>Email</th>
    <th>Address</th>
    </tr>";
        while($row2 = $result2->fetch_assoc())
		{
   echo "<tr>
        <td>".$row2["user_id"]."</td>
        <td>".$row2["user_name"]."</td>
        <td>".$row2["user_roll_number"]."</td>
        <td>".$row2["user_department"]."</td>
        <td>".$row2["phone_number"]."</td>
        <td>".$row2["email"]."</td>
        <td>".$row2["user_address"]."</td>
        </tr>";
	    }
echo "</table>";
}

mysqli_close($con);

?>




</body>
</html>
