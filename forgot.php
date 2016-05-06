<?php

// like i said, we must never forget to start the session
session_start();
require 'library/functions.php';
require 'database/dbSettings.php';

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<script src="js/functions.js"></script>
<script src="js/jquery.js"></script>
<title><?php echo $_SESSION["AppName"]; ?></title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/functions.js"></script>
<script type="text/javascript">
$(document).ready(function(){

<!-- /////////////---------------------Begin next Function----------------------///////////////////////// -->

<!-- /////////////---------------------End Next Function----------------------///////////////////////// -->

});
</script>
<script language="javascript" src="js/isValidEmail.js"></script>
<script language="javascript">
  function validate() {
    if (! isValidEmail(document.forms[0].email.value)) {
        alert("Please enter a valid email address");
        return false;
    }
            document.forms[0].submit();;
  }
</script>
</head>
<body>
<img class="background" src="img/1.jpg">
<center>
<h1> <?php echo $_SESSION["AppName"]; ?> </h1>

</center>


<div id="divlogin">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
		<div align="center">
	...:::Enter your e-mail address below!:::...
	    </div>
	</td>
  </tr>
  <tr>
    <td valign="middle" align="center">
<form name="theForm" method=post action=forgot.php?action=email>
<input type=text name="email" id="email" size="30"></td>
  </tr>
  <tr>
<td align ="center">
<input type="button" value="Back to log in" onClick="window.location='login.php'">
<input type="button" value="Send my password" onclick="validate();"></br></br>
<div align="center">
   <font color="#000000">
  Copyright &copy;
  		        <script type="text/javascript">

  					var currentTime = new Date()
  					var year = currentTime.getFullYear()
  					document.write(year)

  	            </script>
<?php echo $_SESSION["AppName"]; ?> | All Rights Reserved.
</font><br/><br/>
<?php

dbOpen();

if($_REQUEST['action'] == 'email')
{
$_Email = $_REQUEST['email'];

$sqlfor = ReturnForgotSQL($_REQUEST['email']);

$result = mysql_query($sqlfor) or die(mysql_error());
$row = mysql_fetch_array( $result );
if ($row['str_pass']=="" || $row['str_Username']==""){
echo "<font color=\"#ff0000\"><br/><b>Your email is not registered with this application</b><br/>";
echo "<b>If you have questions contact the administrator!</b></font>";
}

else{
// The message
$xHeaders = "From: TechSupport@".$_SESSION["domainURL"];
$message = "\n\nYour Username is : ".$row['str_Username'] . "\n Your password is : ".$row['str_pass'] . "\n\n
Please go to ".$_SESSION["siteURL"]."in order to login in.\n\n
This is an auto response, please do not reply to this email address.
\n Thanks,  Technical Support.";
// Send
mail($_Email, 'Forgot Username or password', $message,$xHeaders);
echo "<br/>";
echo "<font color=\"#00ff00\"><br/><b>An email has been sent to $_Email</b>  ,";
echo "<b>Check your email for the information!</b></font>";
}
       	    dbClose();
}

?>





</div>
</td>
</tr>
</table>
</form>



		</div>


</body>
</html>

