<DOCTYPE html>
<html>
     <?php
    session_start();
    if(!($_SESSION['user_type']=='STUDENT'))
    {
        header("location: ../Welcome.php");
    }
    ?>

<head>
<title>STUDENT</title>
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

<a href="">Students Details</a>
<a href="Listofproject.php"  target="iframe_a">View List of Projects</a>
<a href="Listoffaculty.php" target="iframe_a">View List of Faculty</a>
<a href="AddProject.php"  target="iframe_a">Add Project</a>
<a href="../Utilities/LogOut.php">Log Out</a>
</nav>

<section>

<iframe src="StudentPersonalInfo.php" width="100%" height="100%" name="iframe_a">
</iframe>

</section>

<footer>
www.thdcihet.com
</footer>

</body>


 </html>
