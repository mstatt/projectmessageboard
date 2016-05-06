<?php

require 'database/dbSettings.php';
require 'library/functions.php';
chkLogin();

$strUID = $_REQUEST['B'];


$sql = "SELECT a.str_Username, str_Fname, str_Lname, int_status
from tbl_Users U
Join tbl_Auth a on a.UUIDUSER = U.UUIDUSER Where a.UUIDUSER = '".$strUID."'";


dbOpen();
$result = mysql_query($sql) or die('Query failed. ' . mysql_error());
		if (mysql_num_rows($result) >0) {

 echo "<table class=mgUedit>";     
    while($row = mysql_fetch_row($result))
        {

echo "<tr><td>Username:       ".$row[0]." </td></tr><tr><td>User:       ".$row[1]."  ".$row[2]."| </td></tr>";

echo "<br/>";

echo "<tr><td>Account Status:   </td><td><select>";
  switch ($row[3]) {
      case 0:
echo "  <option selected=\"yes\"  value=\"0\">Disabled</option><option value=\"1\">Enabled</option>";
          break;
      case 1:
echo "  <option value=\"0\">Disabled</option><option selected=\"yes\"  value=\"1\">Enabled</option>";
          break;
    default:
echo "<option value=\"1\">Please assign a department</option><option value=\"0\">Disabled</option><option value=\"1\">Enabled</option>";
          break;
}

echo "</select></td></tr><tr><td colspan=2><button id=btnMgrEditUserUpdateConfirmClose >Update</button>  <button id=btnMgrEditUserConfirmClose >Cancel/Close</button> </td></tr>";

        }
echo "</table>";
    dbClose();
       	}
       	else{
       	echo "No users currently assigned.";
       	}


?>