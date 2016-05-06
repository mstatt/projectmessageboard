<?php
// we must never forget to start the session
session_start();
require 'database/dbSettings.php';
require 'library/functions.php';
chkLogin();

//Get the values from the submission form
$UniqueID = $_REQUEST["G"];
$emailAddress = $_REQUEST["A"];
$password   = $_REQUEST["B"];
$UserFname   = $_REQUEST["C"];
$UserLname = $_REQUEST["D"];
$UserMobile  = $_REQUEST["E"];
$UserOffice   = $_REQUEST["F"];


//--------------------------------------------SQL for user update
$sql = "UPDATE `tbl_Users`
SET `str_Fname` ='".$UserFname."',`str_Lname` ='".$UserLname."',`str_Email` ='".$emailAddress."',
`strMobilePhone` = '".$UserMobile."',`strOfficePhone` ='".$UserOffice."' WHERE `UUIDUSER` = '".$UniqueID."';";



$sql2 = "UPDATE `tbl_Auth`
SET `str_Username` ='".$emailAddress."',`str_pass` ='".$password."' WHERE `UUIDUSER` = '".$UniqueID."';";


dbOpen();

	$result = mysql_query($sql) or die('Query failed. ' . mysql_error());

	$result2 = mysql_query($sql2) or die('Query failed. ' . mysql_error());

	if ($result == TRUE && $result2 == TRUE) {
	echo "User updated successfully.";
	}
	else{
	echo "User edit unsuccessful.";
	}



	    dbClose();
?>