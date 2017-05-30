<DOCTYPE html>
<html>

    <?php
    session_start();
    if(!($_SESSION['user_type']=='FACULTY'|| $_SESSION['user_type']=='HOD' ))
    {
        header("location: ../Welcome.php");
    }
    ?>



<head>
<title>Faculty</title>
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

<a href="PersonalInfo.php" target="iframe_a">Personal Info</a>
<a href="StudentDetails.php"  target="iframe_a">Student Details</a>
<a href="ProjectListInitiated.php"  target="iframe_a">Project List Initiated</a>
<a href="CompletedProjectList.php"  target="iframe_a">Completed Project List</a>
<?php

     if(($_SESSION['user_type']=='HOD'))
    {

        echo '<a href="HODApproval.php" target="iframe_a">Project Incharge</a>';
    }


?>
<a href="../Utilities/LogOut.php">Log Out</a>
</nav>
<section>
<iframe src="PersonalInfo.php" width="100%" height="100%" name="iframe_a">
</iframe>


</section>

<footer>
www.thdcihet.com
</footer>

</body>


 </html>
