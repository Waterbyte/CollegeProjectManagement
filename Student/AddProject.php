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
    textarea{
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

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    }

</style>
<body>

<div>
  <form action="ProjectUploader.php" method="post">

    <label >Project Title</label>
    <input type="text"  name="project_title" maxlength=150 required>
    <label >Project Requirements</label>
      <textarea name="project_requirements" maxlength=1000 required></textarea>
    <label >Project Objectives</label>
      <textarea name="project_objective" maxlength=2000 required></textarea>
       <label >Project Background</label>
      <textarea  name="project_background" maxlength=5000 required></textarea>
     <label for="type" >Project Supervisor</label>
    <?php
      include_once "../Utilities/Connection.php";
      $con=openCon();
      session_start();
      if(!($_SESSION['user_type']=='STUDENT'))
      {
        header("location: ../Welcome.php");
      }
      $user_id=$_SESSION['user_id'];

      $sqldepartment="Select user_department from projuser where user_id='".$user_id."'";
      $resultdepartment=$con->query($sqldepartment);
      $rowdepartment=$resultdepartment->fetch_assoc();
      $user_department=$rowdepartment['user_department'];

      $sql ="SELECT `user_id`,  `user_name` FROM `projuser` WHERE user_type='FACULTY'||user_type='HOD' AND user_department='".$user_department."'";

      $result=$con->query($sql);

      echo"<select name='user_id' id='type'>";
      while($row=$result->fetch_assoc())
      {
              echo "<option value='$row[user_id]'>".$row['user_name']."</option>";
      }
      echo "</select>";
       echo  "<label for='type'>Project Type</label>";
      $sql1 ="select `project_type`,`project_criteria_name` from projecttypemap";

       $result1=$con->query($sql1);
       echo"<select name='project_type' id='type'>";
      while($row1=$result1->fetch_assoc())
       {
              echo "<option value='$row1[project_type]'>".$row1['project_criteria_name']."</option>";
      }
      echo "</select>";








      CloseCon($con);


    ?>


    <input type="submit" value="Submit">
  </form>
</div>

</body>


</html>
