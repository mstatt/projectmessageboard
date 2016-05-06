<?php
// we must never forget to start the session
session_start();
require 'database/dbSettings.php';
require 'library/functions.php';

if (isset($_REQUEST['txtUserId']) && isset($_REQUEST['txtPassword'])) {
	dbOpen();

	$userId   = $_REQUEST['txtUserId'];
	$password = $_REQUEST['txtPassword'];


	// check if the user id and password combination exist in database
	$sql = "SELECT UUIDUSER,str_Username
	        FROM tbl_Auth
			WHERE str_Username = '$userId' AND str_pass = '$password' and int_Status != 0";

	$result = mysql_query($sql) or die('Query failed. ' . mysql_error());

	if (mysql_num_rows($result) == 1) {
		// the user id and password match,
		// set the session

		      while($row = mysql_fetch_row($result))
		 		{
				$_SESSION["UserID"] = $row[0];
				$_SESSION["UserName"] = $row[1];
				}

	dbClose();
	dbOpen();

		// assign user variables here:
			$sql1 = "SELECT str_Fname,int_User_Level,str_Lname
			        FROM tbl_Users
					WHERE UUIDUSER = '".$_SESSION['UserID']."'";

	$result1 = mysql_query($sql1) or die('Query failed. ' . mysql_error());
		while($row = mysql_fetch_row($result1))
		 		{
					$_SESSION["UserFname"] = $row[0];
					$_SESSION["UserLevel"] = $row[1];
					$_SESSION["UserLname"] = $row[2];
				}






		$_SESSION['db_is_logged_in'] = true;

		// after login we move to the main page
		//Code here:
        header( 'Location: main.php' ) ;
		exit;
	} else {
		$errorMessage = 'Sorry, wrong user id / password';
	}

	dbClose();
}
?>

<html>
<head>
<script src="js/functions.js"></script>
<script src="js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<META http-equiv="Content-type" content="text/html; charset=iso-8859-1">
<title><?php echo $_SESSION["AppName"]; ?></title>
</head>
<body>
<img class="background" src="<?php echo $_SESSION["BGimage"]; ?>">
<center>
<h1> <?php echo $_SESSION["AppName"]; ?> </h1>
</center>
<form action="login.php" method="post" name="Login" id="Login">
<div id="divlogin">
<table>
<tr><td align=center>
<h3>Log-In to <?php echo $_SESSION["AppName"]; ?></h3>
</td></tr>
<tr><td align="center">
Username: <input type="text" name="txtUserId" title="User Id" id="txtUserId" />
</td></tr>
<tr><td align="center">
Password: <input type="password" name="txtPassword" title="Password" id="txtPassword" />
</td></tr>
<tr><td align="center">
<button type="reset" id"Reset">Reset</button>
<button type="submit" id="Login">Login</button></br>
<input type="button" value="Forgot Password" onClick="window.location='forgot.php'">
</form>
</td></tr>
  <td colspan="2" align="center">
<?php echo $errorMessage ?>
<br/>


   <font color="#000000">
  Copyright &copy;
  		        <script type="text/javascript">

  					var currentTime = new Date()
  					var year = currentTime.getFullYear()
  					document.write(year)

  	            </script>
<?php echo $_SESSION["AppName"]; ?> | Michael J. Stattelman | All Rights Reserved.
</font>
</div>
   </td>
  </tr>
</table>

</div>



</body>
<html>