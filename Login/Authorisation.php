<?php
include_once "../Utilities/Connection.php";

function Authorise($user_id,$password)
{
 $password=hash("sha256", $password);
 $con=OpenCon();
 $sql="SELECT password FROM projuser WHERE user_id='".$user_id."'";
 if($result = $con->query($sql))
 {
 $row = $result->fetch_assoc();

            if($password==$row['password'])
            {
               return true;
            }
            else
            {
              return false;
            }

 }

    CloseCon($con);

}





?>




