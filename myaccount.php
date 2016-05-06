<?php

require 'database/dbSettings.php';
require 'library/functions.php';
chkLogin();

$strUID = $_REQUEST['b'];


$sql = "SELECT a.str_Username, a.str_pass, str_Fname, str_Lname,`strMobilePhone`,`strOfficePhone`
from tbl_Users U
Join tbl_Auth a on a.UUIDUSER = U.UUIDUSER Where a.UUIDUSER = '".$strUID."'";

dbOpen();
$result = mysql_query($sql) or die('Query failed. ' . mysql_error());
		if (mysql_num_rows($result) >0) {
    while($row = mysql_fetch_row($result))
        {
$inpteditusername = $row[0];
$impteditpassword = $row[1];
$inptedituserfname = $row[2];
$inptedituserLname = $row[3];
$inpteditUserMobileNum = $row[4];
$inpteditUserOfficeNum = $row[5];
        }
    
    dbClose();
       	}
       	else{
       	echo "No users currently assigned.";
       	}
?>
<div id="close"><button id="btnMyaccountUsereditClose" class="close">Cancel/Close</button></div>
<h2>User Account Data</h2>
<div id="Editresult"></div>
<hr>
<table class="tblForm">
<tr>
<td>Email address:</td><td><input type="text" onblur="checkEmail(this.value)" name="inpteditusername" id="inpteditusername" value="<?php echo $inpteditusername; ?>"></td>
</tr>
<tr>
<td>Password:</td><td><input type="password" name="impteditpassword" id="impteditpassword" value="<?php echo $impteditpassword; ?>"></td>
</tr>
<tr>
<td>First Name:</td><td><input type="text" name="inptedituserfname" id="inptedituserfname"value="<?php echo $inptedituserfname; ?>"></td>
</tr>
<tr>
<td>Last Name:</td><td><input type="text" name="inptedituserLname" id="inptedituserLname" value="<?php echo $inptedituserLname; ?>"></td>
</tr>
<tr>
<td>User Mobile#:</td><td><input type="text" name="inpteditUserMobileNum" id="inpteditUserMobileNum" maxlength="14" placeholder="(XXX) XXX-XXXX"  value="<?php echo $inpteditUserMobileNum; ?>"/></td>
</tr>
<tr>
<td>User Office#:</td><td><input type="text" name="inpteditUserOfficeNum" id="inpteditUserOfficeNum" maxlength="14" placeholder="(XXX) XXX-XXXX"  value="<?php echo $inpteditUserOfficeNum; ?>"/></td>
</tr>
</table>

<button id="btnUpdateUserConfirm">Update User</button>&nbsp;&nbsp;
<button id="btnUpdateUserConfirmClose">Cancel/Close</button>