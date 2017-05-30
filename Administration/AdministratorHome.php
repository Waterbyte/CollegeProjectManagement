<DOCTYPE html>
<html>

    <?php
    session_start();
    if(!($_SESSION['user_type']=='ADMINISTRATOR'))
    {
        header("location: ../Welcome.php");
    }
    ?>
<head>
<title>Administrator</title>
<link rel="stylesheet" href="../Utilities/HomeStyle.css">
</head>
<body>

<header>
<h1><?php
    include_once "../Utilities/CommonFunctions.php";
    include_once "../Utilities/Connection.php";
    $con=OpenCon();
    echo "Hi ".UserName($_SESSION['user_id'],$con);
    CloseCon($con);
    ?></h1>
</header>

<nav>

<a href="CurrentUsers.php" target="iframe_a">View Current Users</a>
<a href="AddUsers.php"  target="iframe_a">Add Users</a>
<a href="../Utilities/LogOut.php">Log Out</a>
</nav>

<section>
<iframe src="CurrentUsers.php" name="iframe_a">
</iframe>

</section>

<footer>
www.thdcihet.com     Designed By: Sagar,Swati,Chirag and Prashant
</footer>
</body>
 </html>
