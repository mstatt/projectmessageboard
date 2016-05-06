<?php

require 'database/dbSettings.php';
require 'library/functions.php';
chkLogin();

$sql = "Select * from tbl_Users";

dbOpen();
$result = mysql_query($sql) or die('Query failed. ' . mysql_error());
		if (mysql_num_rows($result) >0) {
          echo "<table width=100%>";
    while($row = mysql_fetch_row($result))
        {

         echo "<tr><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td>";
         echo "<td><button id=".$row[0]." class=mgrUserEdit >Edit User</button></td></tr>";

        }
    echo "</table>";
    dbClose();
       	}
       	else{
       	echo "No users currently assigned.";
       	}


?>
