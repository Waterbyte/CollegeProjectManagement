<DOCTYPE html>
<html>
<head>
<title>Current Users</title>
<link rel="stylesheet" type="text/css" href="../Utilities/styles.css">
</head>
<body>

<?php
include_once "../Utilities/Connection.php";
$con=openCon();

session_start();
    $user_id=$_SESSION['user_id'];


$sql="SELECT * FROM projuser WHERE user_id='".$user_id."'";
$result = $con->query($sql);


if ($result->num_rows > 0)
{
        $row = $result->fetch_assoc();

   echo '

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
    <div id="second" style=" overflow-y: scroll;">'.$row["user_address"].'</div>
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
    <a id="button" href="PersonalInfoUpdater.php" target="iframe_a">Update</a>
';


}
CloseCon($con);

?>




</body>
</html>
