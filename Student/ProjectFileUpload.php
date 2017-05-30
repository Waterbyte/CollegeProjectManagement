<html>
<head><title>File uploaded</title></head>
<body bgcolor="cyan" color="yellow">
<center>
<h3>File uploaded !! <h3>
<hr>
<?php
     session_start();
    if(!($_SESSION['user_type']=='STUDENT'))
    {
        header("location: ../Welcome.php");
    }

    include_once "../Utilities/Connection.php";
    $con=openCon();
    $project_id=$_POST['project_id'];

if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
  $filename=$project_id.$_FILES["file"]["name"];

  $path="C:/xampp/uploads/projectFile/";
  $finalPath=($path . $filename);

  if(move_uploaded_file($_FILES['file']['tmp_name'],$finalPath))
  {
      $sql="UPDATE `project` SET `project_file_path` = '$finalPath', `project_status` = '3',`project_statusdate`=curdate() WHERE `project`.`project_id` ='".$project_id."'";

      if($con->query($sql))
      {
          header("location:StudentPersonalInfo.php");
      }
      else
      {
          echo "Database Error";
      }

  }
   else
   {
      echo "Database Error. Please login again.";
   }

  }

    CloseCon($con);
?>
</center>
</body>
</html>
