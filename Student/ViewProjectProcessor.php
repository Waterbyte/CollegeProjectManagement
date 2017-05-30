<!DOCTYPE html>
<html>
<style>
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}
textarea{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}


div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    }
    p {
        width: 98%;
        word-break:normal;
        text-align: left;
        background: wheat;
        padding:10px;
        border: 1px solid dodgerblue;
        border-radius: 4px;
        font-family:verdana;
        font-weight: 400;
    }
    h2{
        text-align: left;
    }

</style>
<body>

<?php
include_once "../Utilities/Connection.php";
$con=openCon();

if(!empty($_POST))
{
    foreach($_POST as $key => $value)
{
   if(substr($key,0,4) == "View")
   {
      $project_id = substr($key,4);
      $sql="SELECT * FROM project where project_id='".$project_id."'";
      if($result=$con->query($sql))
      {
       displayProject($result,$con);
      }
       else
       {
           echo "Error in DATABASE Connection";
       }

   }


    else if(substr($key,0,4) == "Edit")
     {
      $project_id = substr($key,4);
      $sql="SELECT * FROM project where project_id='".$project_id."'";
      if($result=$con->query($sql))
      {
       EditProjectForm($project_id,$result,$con);
      }
       else
       {
           echo "Error in DATABASE Connection";
       }

     }


    else if(substr($key,0,6) == "Delete")
    {
      $project_id = substr($key,6);

          $sqldelete="Select project_file_path from project where project_id='".$project_id."'";
          $resultpath=$con->query($sqldelete);
          $rowpath=$resultpath->fetch_assoc();
          echo $rowpath["project_file_path"];

          if (is_file($rowpath["project_file_path"])){
           unlink($rowpath["project_file_path"]);
          }

      $sql="DELETE FROM project where project_id='".$project_id."'";

        if($result=$con->query($sql))
      {
        header("location:StudentPersonalInfo.php");
      }
    }


    else if(substr($key,0,6)=="Upload")
    {
        $project_id=substr($key,6);
        displayUploadForm($project_id);
    }

}
}

function displayProject($result,$con)
{
    $row=$result->fetch_assoc();

    echo '
    <div style="background:#e8e8e8; border-radius:0px;">
    <label style="font-weight:bold;">Project Id:</label><label>'.$row["project_id"].'</label>
    <br>
    <label style="font-weight:bold;">Project By:</label><label>'.UserName($row["user_id"],$con).'</label>
    <br>
    <label style="font-weight:bold;">Supervisor:</label><label>'.UserName($row["project_supervisor"],$con).'</label>
    '.DownloadButtonDisplay($row["project_status"],$row).'
    </div>
    <div>
    <h2>Project Title</h2>
    <p>'.$row["project_title"].'</p>
    <h2>Project Objective</h2>
    <p>'.$row["project_objective"].'</p>
    <h2>Project Requirements</h2>
    <p>'.$row["project_requirements"].'</p>
    <h2>Project Background</h2>
    <p>'.$row["project_background"].'</p>
    </div>';
}
    function DownloadButtonDisplay($project_status,$row)
    {
        if($project_status>2)
        {
    return '
    <form  action="DownloadProjectFile.php" method="post">
    <input style="position:absolute; right:10px; width:20%;padding:5px; margin-bottom:10px; "
    type="submit" name="DownloadButton" value="Download">
    <input type="hidden" name="project_file_path" value="'.$row["project_file_path"].'">
    </form>';
        }
    }


    function UserName($user_id,$con)
{
    $sql="SELECT user_name FROM projuser WHERE user_id='".$user_id."'";
 $result = $con->query($sql);
$row=$result->fetch_assoc();
$user_name=$row["user_name"];
return $user_name;
}



function EditProjectForm($project_id,$result,$con)
{
    $row=$result->fetch_assoc();
    echo '

  <form action="EditProjectFormProcessor.php" method="post">
    <div>
    <label >Project Title</label>
    <input type="text"  name="project_title" value="'.$row["project_title"].'" maxlength=150 required>
    <label >Project Requirements</label>
        <textarea name="project_requirements" maxlength=1000 required>'.strip_tags($row["project_requirements"]).'</textarea>
    <label >Project Objectives</label>
        <textarea name="project_objective" maxlength=2000 required>'.strip_tags($row["project_objective"]).'</textarea>
       <label >Project Background</label>
        <textarea name="project_background" maxlength=5000 required>'.strip_tags($row["project_background"]).'</textarea>
        <label>HI</label>
     <label  >Project Supervisor</label>';

      session_start();
      if(!($_SESSION['user_type']=='STUDENT'))
      {
        header("location: ../Welcome.php");
      }
      $user_id=$_SESSION["user_id"];

      $sqldepartment="Select user_department from projuser where user_id='".$user_id."'";
      $resultdepartment=$con->query($sqldepartment);
      $rowdepartment=$resultdepartment->fetch_assoc();
      $user_department=$rowdepartment['user_department'];

      $sql ="SELECT `user_id`,  `user_name` FROM `projuser` WHERE user_type='FACULTY'||user_type='HOD' AND user_department='".$user_department."'";

      $result=$con->query($sql);


    echo  '<select name=\'user_id\' id=\'type\'>';
      while($row2=$result->fetch_assoc())
      {
              echo '<option value=\''.$row2[user_id].'\'>'.$row2["user_name"].'</option>';
      }
      echo '</select>';

       echo  '<label for=\'type\'>Project Type</label>';
      $sql1 ="select `project_type`,`project_criteria_name` from projecttypemap";

       $result1=$con->query($sql1);
       echo '<select name=\'project_type\' id=\'type\'>';
      while($row1=$result1->fetch_assoc())
       {
              echo '<option value=\''.$row1[project_type].'\'>'.$row1["project_criteria_name"].'</option>';
      }
      echo '</select>



     <input type="submit" value="Update">
     <input type="hidden" name="project_id" value="'.$project_id.'">
      </form>
      </div>';
}
    function displayUploadForm($project_id)
    {
        echo'
    <form action="ProjectFileUpload.php" method="post" enctype="multipart/form-data">
    <label for="file">File:</label>
    <input type="file" name="file" id="file" />
    <br />
    <input type="submit" name="submit" value="Submit" />
    <input type="hidden" name="project_id" value="'.$project_id.'">
    </form>';
    }



CloseCon($con);
?>





    </body>
    </html>
