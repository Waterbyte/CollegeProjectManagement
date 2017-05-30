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
$sql="SELECT * FROM projuser WHERE user_type='FACULTY'|| user_type='HOD' ";
$result = $con->query($sql);


if ($result->num_rows > 0) {
    echo "<table ><tr>
    <th>ID</th>
    <th>Teacher Name</th>
    <th>User Department</th>
    <th>Email</th>
    <th>Phone Number</th>
    </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["user_id"]."</td>
        <td>".$row["user_name"]."</td>
        <td>".$row["user_department"]."</td>
        <td>".$row["email"]."</td>
        <td>".$row["phone_number"]."</td>
        </tr>";
    }
    echo "</table>";
}

mysqli_close($con);

?>
</body>
</html>
