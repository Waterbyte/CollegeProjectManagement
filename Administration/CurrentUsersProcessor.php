<?php
session_start();
    if(!($_SESSION['user_type']=='ADMINISTRATOR'))
    {
        header("location: ../Welcome.php");
    }

include_once "../Utilities/Connection.php";
$con=openCon();

if(!empty($_POST))
{
    foreach($_POST as $key => $value)
{
   if(substr($key,0,4) == "Edit")
   {
      $user_id = substr($key,4);
      $sql="SELECT * FROM projuser where user_id='".$user_id."'";
      if($result=$con->query($sql))
      {
       displayForm($user_id,$result);
      }
       else
       {
           echo "Error in DATABASE Connection";
       }

   }
    else if(substr($key,0,6)=="Delete")
    {
        $user_id=substr($key,6);

        $sql="DELETE FROM projuser where user_id='".$user_id."'";
        if($con->query($sql))
        {
            header("location:CurrentUsers.php");
        }
        else
        {
            echo "Error in DATABASE Connection";
        }

    }
}
}

function displayForm($user_id,$result)
{
    $row=$result->fetch_assoc();
    echo '<link rel="stylesheet" href="../Utilities/styles2.css">';
    echo '
    <form action="EditUsersProcessor.php" method="post">

    <div id="container">
    <div id="first">User Id:</div>
    <input id="second" type="text" name="user_id" maxlength=20 required value="'.$row["user_id"].'"/>
    </div>
    <div id="container">
    <div id="first">Roll Number:</div>
    <input id="second" type="text" name="user_roll_number" maxlength=15 placeholder=" OPTIONAL" value="'.$row["user_roll_number"].'"/>
    </div>
    <div id="container">
    <div id="first">User Name:</div>
    <input id="second" type="text" name="user_name" maxlength=40 value="'.$row["user_name"].'"/>
    </div>
    </div>
    <div id="container">
    <div id="first">Year:</div>
    <input id="second" type="number" name="user_year" max="9" value="'.$row["user_year"].'"/>
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
    <div id="first">Department:</div>
      <select id="second" name="user_department">
        <option value="CSE">CSE</option>
        <option value="ME">ME</option>
        <option value="CIVIL">CIVIL</option>
        <option value="EE">EE</option>
        <option value="EE">ECE</option>
      </select>
    </div>

    <div id="container">
    <div id="first">User Type:</div>
      <select id="second" name="user_type">
        <option value="ADMINISTRATOR">ADMINISTRATOR</option>
        <option value="FACULTY">FACULTY</option>
        <option selected="selected" value="STUDENT">STUDENT</option>
        <option value="HOD">HOD</option>
        <option value="DIRECTOR">DIRECTOR</option>
      </select>
    </div>

    <input id="button" type="submit" name="update" value="Update" />
    <input type="hidden" name="selected_user_id" value="'.$user_id.'">
</form>';

}

CloseCon($con);
?>
