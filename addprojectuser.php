<?php
// we must never forget to start the session
session_start();
require 'database/dbSettings.php';
require 'library/functions.php';
chkLogin();

//Get the values from the submission form
$UniqueID = $_REQUEST["A"];
$emailAddress   = $_REQUEST["B"];
$password   = $_REQUEST["E"];
$UserFname   = $_REQUEST["C"];
$UserLname = $_REQUEST["D"];
$UserMobile  = $_REQUEST["F"];
$UserOffice   = $_REQUEST["G"];
$UserLevel   = $_REQUEST["H"];

//--------------------------------------------SQL for user insert

$AddUserSQL = " INSERT INTO `tbl_Users` 
(`UUIDUSER`, `str_Fname`, `str_Lname`, `str_Email`, `int_User_Level`, `strMobilePhone`, `strOfficePhone`) 
VALUES('".$UniqueID."','".$UserFname."','".$UserLname."','".$emailAddress."',".$UserLevel.",'".$UserMobile."','".$UserOffice."');";


$AddUserSQL2 = " INSERT INTO `tbl_Auth` (`UUIDUSER`, `str_Username`, `str_pass`, `int_Status`) 
VALUES  ('".$UniqueID."','".$emailAddress."','".$password."', 1);";


//----------------------------------------------------------

dbOpen();
	$result = mysql_query($AddUserSQL) or die('Query failed. ' . mysql_error());
	$result2 = mysql_query($AddUserSQL2) or die('Query failed. ' . mysql_error());
	if ($result == TRUE && $result2 == TRUE) {
	echo "User added successfully.";
	}
	else{
	echo "User add unsuccessful.";
	}
	    dbClose();
?>
