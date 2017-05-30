<DOCTYPE html>
<html>
    <head>
     <link rel="stylesheet" href="../Utilities/styles2.css">
</head>
        <body>
<?php
            session_start();
    if(!($_SESSION['user_type']=='ADMINISTRATOR'))
    {
        header("location: ../Welcome.php");
    }
?>

    <div>
<form action="AddUsersProcessor.php" method="post">

    <div id="container">
    <div id="first">User Id:</div>
    <input id="second" type="text" name="user_id" maxlength=20 required/>
    </div>
    <div id="container">
    <div id="first">Roll Number:</div>
    <input id="second" type="text" name="user_roll_number" maxlength=15 placeholder=" OPTIONAL"/>
    </div>
    <div id="container">
    <div id="first">User Name:</div>
    <input id="second" type="text" name="user_name" maxlength=40 placeholder=" OPTIONAL"/>
    </div>
    <div id="container">
    <div id="first">Password:</div>
    <input id="second" type="text" name="password"
           onmousedown="this.type='text'" onmouseup="this.type='password'"
           maxlength=20 required/>
    </div>
    <div id="container">
    <div id="first">Year:</div>
    <input id="second" type="number" name="user_year" max="9"/>
    </div>
    <div id="container">
    <div id="first">Phone Number:</div>
    <input id="second" type="number" max="9999999999" name="phone_number" placeholder=" OPTIONAL"/>
    </div>

    <div id="container">
    <div id="first">Email:</div>
    <input id="second" type="email" name="email" maxlength=50 placeholder=" OPTIONAL"/>
    </div>

    <div id="container">
    <div id="first">Address:</div>
    <input id="second" type="text" name="user_address" maxlength=70 placeholder=" OPTIONAL"/>
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

    <input id="button" type="submit" name="submit" value="Submit" />
</form>
</div>
</body>
</html>
