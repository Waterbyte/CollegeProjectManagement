<?php
      echo '<link rel="stylesheet" href="../Utilities/styles2.css">';
      include '../Utilities/Connection.php';
      session_start();
       if(!($_SESSION['user_type']=='STUDENT'))
      {
        header("location: ../Welcome.php");
      }
      $user_id=$_SESSION['user_id'];

      $con=OpenCon();
      $sql="SELECT * FROM projuser where user_id='".$user_id."'";
      if($result=$con->query($sql))
      {


    $row=$result->fetch_assoc();



     echo '
    <form action="StudentPersonalInfoProcessor.php" method="post">

    <div id="container">
    <div id="first">Name:</div>
    <input id="second" type="text" name="user_name" maxlength=40 value="'.$row["user_name"].'"/>
    </div>
    <div id="container">
    <div id="first">Phone Number:</div>
    <input id="second" type="number" max="9999999999" name="phone_number" value="'.$row["phone_number"].'"/>
    </div>

    <div id="container">
    <div id="first">Email:</div>
    <input id="second" type="email" name="email" maxlength=50 value="'.$row["email"].'"/>
    </div>

    <div id="container">
    <div id="first">Address:</div>
    <input id="second" type="text" name="user_address" maxlength=70 value="'.$row["user_address"].'"/>
    </div>

    <div id="container">
    <div id="first">Password:</div>
    <input id="second" type="password" name="password" onmousedown="this.type=\'text\'"
    onmouseup="this.type=\'password\'" maxlength=70 required/>
    </div>

    <input id="button" type="submit" name="update" value="Update" />
    <input type="hidden" name="selected_user_id" value="'.$user_id.'">
</form>';

      }
       else
       {
           echo "Error in DATABASE Connection";
       }
?>
