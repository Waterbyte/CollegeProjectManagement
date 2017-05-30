<?php
session_start();
include "../Utilities/Connection.php";
$con=OpenCon();

if(isset($_POST['update'])) {

  $user_id=$_POST['user_id'];
  if($_POST['pass_id']===$_POST['pass2_id']) {
      echo $_POST['otp'];
      echo $_SESSION['otp'];
       if($_POST['otp']===$_SESSION['otp'])
       {
        $sql="UPDATE `projuser` SET  `password`='".$pass_id."' WHERE `projuser`.`user_id` = '".$user_id."'";
        if($con->query($sql))
        {
            $Message="Password Updated";
	        header("location: ../Welcome.php?Message=" . urlencode($Message));
        }
           else
           {
              echo "Database Problem. Please try again.";
           }

       }
       else
       {
          echo "Wrong OTP";
       }

  }
  else
   {
    echo "Wrong Confirm Password Entered";
   }
}

?>
