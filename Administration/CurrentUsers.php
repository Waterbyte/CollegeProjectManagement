<DOCTYPE html>
<html>
<head>
<title>Current Users</title>
    <link rel="stylesheet" href="../Utilities/TableStyle.css">
</head>
<body>
<?php
    session_start();
    if(!($_SESSION['user_type']=='ADMINISTRATOR'))
    {
        header("location: ../Welcome.php");
    }

include_once "../Utilities/Connection.php";
$con=openCon();
$sql="SELECT * FROM projuser";
$result = $con->query($sql);


if ($result->num_rows > 0) {
    echo "
    <form action=\"CurrentUsersProcessor.php\" method=\"post\">
    <table><tr>
    <th>ID</th>
    <th>Roll Number</th>
    <th>Name</th>
    <th>Phone Number</th>
    <th>Email</th>
    <th>Year</th>
    <th>User Address</th>
    <th>User Department</th>
    <th>User Type</th>
    <th>Change</th>
    <th>Delete</th>
    </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["user_id"]."</td>
        <td>".$row["user_roll_number"]."</td>
        <td>".$row["user_name"]."</td>
        <td>".$row["phone_number"]."</td>
        <td>".$row["email"]."</td>
        <td>".$row["user_year"]."</td>
        <td>".$row["user_address"]."</td>
        <td>".$row["user_department"]."</td>
        <td>".$row["user_type"]."</td>
        <td><input name=\"Edit$row[user_id]\" type=\"submit\" value=\"Edit\" /></td>
        <td><input name=\"Delete$row[user_id]\" type=\"submit\" value=\"Delete\" /></td>
        </tr>";
    }
    echo "</table>
    </form>
    ";
}

CloseCon($con);


?>
</body>
</html>
