<?php
//Settings and functions for the database
function dbOpen()
{
// db properties
$dbhost = '';
$dbuser = '';
$dbpass = '';
$dbname = '';

$conn = mysql_connect ($dbhost, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ($dbname);
}

function dbClose()
{
mysql_close($conn);
}







?>