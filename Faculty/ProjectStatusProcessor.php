<?php

echo '
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
</style>';


include_once "../Utilities/Connection.php";
if(!empty($_POST))
{
    foreach($_POST as $key => $value)
{
    $con=OpenCon();
   if(substr($key,0,4) == "Edit")
   {
      $project_id = substr($key,4);


session_start();
 $sql="SELECT project_status FROM project where project_id='".$project_id."'";
 $result=$con->query($sql);
 $row=$result->fetch_assoc();
$project_status=$row["project_status"];
    $project_status=$project_status+1;
   $sql1="UPDATE project  SET `project_status`='".$project_status."',`project_statusdate`=curdate() WHERE project_id='".$project_id."'";
   if($result1=$con->query($sql1))
   {
   if($project_status==2)
   {
    $sqlallocate="UPDATE project  SET `project_allocation`=curdate() WHERE project_id='".$project_id."'";
    $con->query($sqlallocate);
	header("location:ProjectListInitiated.php");
   } else if ($project_status==4) {
   	header("location:CompletedProjectList.php");
   }
   else if ($project_status==5) {
   	header("location:HODApproval.php");
   }
   }
   }
    else  if(substr($key,0,4) == "View")
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
    else if(substr($key,0,4)=="Rjct")
    {
        $project_id=substr($key,4);

         $sql="SELECT project_status FROM project where project_id='".$project_id."'";
         $result=$con->query($sql);
         $row=$result->fetch_assoc();
         $project_status=$row["project_status"];
         if($project_status==1)
         {
            $sql="UPDATE project  SET `project_status`='8',`project_statusdate`=curdate() WHERE project_id='".$project_id."'";
        if($result=$con->query($sql))
        {
            header("location:ProjectListInitiated.php");
        }
         }
        else if($project_status==3)
        {
            $sql="UPDATE project  SET `project_status`='8',`project_statusdate`=curdate() WHERE project_id='".$project_id."'";
        if($result=$con->query($sql))
        {
            header("location:CompletedProjectList.php");
        }
        }
        else if($project_status==4)
        {
            $sql="UPDATE project  SET `project_status`='9',`project_statusdate`=curdate() WHERE project_id='".$project_id."'";
        if($result=$con->query($sql))
        {
            header("location:HODApproval.php");
        }
        }





    }
    CloseCon($con);
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
    <form  action="../Student/DownloadProjectFile.php" method="post">
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


?>
