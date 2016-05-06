<?php
// we must never forget to start the session
session_start();
require 'database/dbSettings.php';
require 'library/functions.php';
chkLogin();


?>


<!DOCTYPE html>
<html>
<head>
<title><?php echo $_SESSION["AppName"]; ?></title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="js/utilities.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<script>
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
$(document).ready(function(){

//------------------------------------------------------------------------------
//---------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//----------------Function to refresh the message board when
//----------------a new message has been posted--------------------
/*
   var j = jQuery.noConflict();
   //-----Timer set to 60 seconds
	j(document).ready(function()
	{
		j(".refresh").everyTime(60000,function(i){
			j.ajax({
			  url: "refresh.php",
			  cache: false,
			  success: function(html){
			  //-----Use of prepend to keep the latest message on top
				j(".refresh").prepend(html);
			  }
			})
		})
	});
   newMessageAlert();
   */
//--------------------------------------------------------------------------------
//-----*****************************--Ajax Methods-----****************************----------------
//----------------------------------------------------------------------------
$('body').on('click','.mgrUserEdit',function(){

    var X = this.id;

    $.ajax({type: 'POST',url: 'manageuseredit.php',data: "B="+ X,
       success: function(data){$("#ControlManageUsersList").html(data);},
       error: function(xhr, type, exception) {$("#ControlManageUsersList").html("ajax error response type "+xhr +" - "+ type+" - "+ exception);}
});

 });
//--------------------------------------------------------------------------------
    function fnLoadManageUsers(){

     $.ajax({type: 'POST',url: 'loadmanageusers.php',data: '',
       success: function(data){$("#ControlManageUsersList").html(data); },
       error: function(xhr, type, exception) {
        $("#ControlManageUsersList").html("ajax error response type "+xhr +" - "+ type+" - "+ exception);
       }
});}
//--------------------------------------------------------------------------------
//-----*****************************--End Ajax Methods-----****************************----------------
//--------------------------------------------------------------------------------
$('body').on('click','#btnMgrEditUserConfirmClose',function(){
     $("#ControlManageUsersList").html("Loading user data...............");
     fnLoadManageUsers();
         $("#ControlManageUsers").show();
 });
//--------------------------------------------------------------------------------
//-----------Function to add checklist items to the message textarea
    $(".taglist input").bind("click", function(){
         $("#txtStaff").text('');
         $(".taglist :checked").each(function(){
         $("#txtStaff").append( $(this).val() + " : ");
         });
    });
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
function LogOut(){
window.location = "login.php"
}
//--------------------------------------------------------------------------------
//--------------------------Launch Control Console----------------------
    $("#btnLogOut").click(function(){
	    LogOut();
    });
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
$(document).ready(function(){
    $("#selectall").change(function(){
      $(".checkbox1").prop('checked', $(this).prop("checked"));
               $(".taglist :checked").each(function(){
	           $("#txtStaff").append( $(this).val() + " : ");
         });
      });
});
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
$("#btnAttachFile").click(function() {
	hideControlDivs();
    $('input[type=file]').trigger('click');
});

//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//-----------Function to add message to the Board
    $("#btnPost").click(function(){
    	hideControlDivs();
         $("#newmessageindicator").hide();

         if( !$(txtMessage).val() || !$("#txtStaff").text() || !$("input[name='msgType']:checked").val()) {
		  $("#newmessageindicator").show();
		  $("#newmessageindicator").css('background-color', 'red');
		  $("#newmessageindicator").css('color', '#FFFFFF');
		  $("#newmessageindicator").text('Please Enter values for Steps #1-#3');
		  $("#newmessageindicator").fadeOut( 6000 );
        } else  {

		  $("#messageboard").prepend(PostMessage());
           newMessageAlert();
        }
    });
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
if(/chrom(e|ium)/.test(navigator.userAgent.toLowerCase())){
 }
else{
alert("Please use Google Chrome Browser to access this site.");
}
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
$("#btnSearch").click(function(){
	if($("#inptSearchTerm").val() == ""){
      cancelSearch();
   }else
   {
   cancelSearch();
   var searchtextval = $("#inptSearchTerm").val();
   $(".msgpost").highlight(searchtextval,"highlight");
   }
});
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
jQuery.fn.highlight = function (str, className) {
    var regex = new RegExp(str, "gi");
    return this.each(function () {
        $(this).contents().filter(function() {
            return this.nodeType == 3 && regex.test(this.nodeValue);
        }).replaceWith(function() {
            return (this.nodeValue || "").replace(regex, function(match) {
                return "<span class=\"" + className + "\">" + match + "</span>";
            });
        });
    });
};
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
$("#inptSearchTerm").keypress(function(event){
    if(event.keyCode == 13){
        event.preventDefault();
        $("#btnSearch").click();
    }
});
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
function cancelSearch(){
	$("span").removeClass("highlight");
	$("span").contents().unwrap();
	$(".msgpost").find('span').remove();
}

//--------------------------------------------------------------------------------
//--------------------------Launch Control Console----------------------
    $("#btnMyAccount").click(function(){
	    hideControlDivs();
      $("#inpteditusername").val('');
      $("#impteditpassword").val('');
      $("#inpteditUserMobileNum").val('');
      $("#inpteditUserOfficeNum").val('');
      var b = $("#userid").val();
      fnLoadMyUserdata(b);
		$("#MyaccountUserUpdate").show();
    });
//--------------------------------------------------------------------------------

$('body').on('click','#btnUpdateUserConfirm',function(){

   fnUpdateUser();

 });
//--------------------------------------------------------------------------------
 $(function() {
         function fnCancelUserEditClear(){
       $("#inpteditusername").val('');
$("#impteditpassword").val('');
$("#inptedituserfname").val('');
$("#inptedituserLname").val('');
$("#inpteditUserMobileNum").val('');
$("#inpteditUserOfficeNum").val('');
$("#btnUpdateUserConfirmClose").trigger('click');
         }
           fnCancelUser_EditClear = fnCancelUserEditClear;
});
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
    $('body').on('click','.close',function(){
      $(this).parents().eq(1).hide('slow');
    });

//--------------------------------------------------------------------------------
$('body').on('click','#btnUpdateUserConfirmClose',function(){
$("#MyaccountUserUpdate").hide('slow');
});
//--------------------------------------------------------------------------------

//--------------------------Launch Control Console----------------------
    $("#btnProjectControls").click(function(){
      hideControlDivs();
    $("#ManageControlProject").show();
    });
//--------------------------------------------------------------------------------
    $("#btnIssues").click(function(){
         $("#ControlProjectIssue").show();
    });
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
    $("#btnResolutions").click(function(){
         $("#ControlProjectIssueResolution").show();
    });
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
    $("#btnUserProjectResolutions").click(function(){
	hideControlDivs();
         $("#ControlProjectIssueResolution").show();
    });
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
    $("#btnCriticalTasks").click(function(){
         $("#ControlCriticalTasks").show();
    });
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
 function hideControlDivs() {
	$("#ManageControlProject").hide();
	$("#ControlProjectIssue").hide();
	$("#ControlProjectIssueResolution").hide();
	$("#ControlCriticalTasks").hide();
	$("#ControlGenerateReports").hide();
	$("#ControlManageTasks").hide();
	$("#ControlManageGroups").hide();
	$("#ControlManageUsers").hide();
	$("#ControlProjectFileDisplay").hide();
	$("#ControlManageTasksUser").hide();
  $("#MyaccountUserUpdate").hide();

}
//--------------------------------------------------------------------------------

//--------------------------------------------------------------------------------
//--------------------------Launch User Manage Console----------------------
    $("#btnmngUsers").click(function(){
    	hideControlDivs();
		 $("#ManageControlProject").show();
     $("#ControlManageUsersList").html("Loading user data...............");
     fnLoadManageUsers();
         $("#ControlManageUsers").show();
    });
//--------------------------------------------------------------------------------
//--------------------------Launch Manage Group Console----------------------
    $("#btnmngGroups").click(function(){
    	hideControlDivs();
		 $("#ManageControlProject").show();
         $("#ControlManageGroups").show();

    });
//--------------------------------------------------------------------------------
//--------------------------Launch Manage Task Console----------------------
    $("#btnmngTasks").click(function(){
    	hideControlDivs();
		 $("#ManageControlProject").show();
         $("#ControlManageTasks").show();

    });
//--------------------------------------------------------------------------------
//--------------------------Launch Report Generator Console----------------------
    $("#btnReportCurrentState").click(function(){
    	hideControlDivs();
		 $("#ManageControlProject").show();
         $("#ControlGenerateReports").show();

    });
//--------------------------------------------------------------------------------
//--------------------------Launch Manage File Console----------------------
    $("#btnProjectFileList").click(function(){
    	hideControlDivs();
		 $("#ManageControlProject").show();
         $("#ControlProjectFileDisplay").show();

    });
//--------------------------------------------------------------------------------
//-------------------Launch Toggle New User fields visibility--------------------
$("#btnAddNewUser").click(function(){
		 $("#btnAddNewUser").hide();
         $("#NewUserAdd").show();
         $("#Addresult").text('');
		     $("#ControlManageUsersList").hide();
          $("#ControlManageUsers").animate({height:'300px',width:'500px'}, 100);
          document.getElementById("imptpassword").value = generatePassword();
});
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//-------------------Launch Toggle New Fields fields visibility--------------------
$("#btnAddNewUserConfirm").click(function(){
//----------*******************************************
//------------------Call Ajax to update db here
//----------*******************************************
fnAddNewProjectUser();

fnCancelUserEntry();
});
//--------------------------------------------------------------------------------
//-------------------Launch Cancel User Entry div--------------------
$("#btnAddNewUserConfirmClose").click(function(){
fnCancelUser_Entry();
});
//--------------------------------------------------------------------------------
//--------------------------New User Entry Cancellation----------------------------------
 $(function() {
         function fnCancelUserEntry(){
       $("#inptusername").val('');
$("#imptpassword").val('');
$("#inptUserFname").val('');
$("#inptUserLname").val('');
$("#inptUserMobileNum").val('');
$("#inptUserOfficeNum").val('');
$("#inptAccessLvl").val('');
$("#NewUserAdd").hide();
$("#btnAddNewUser").show();
$("#ControlManageUsersList").show();
$("#ControlManageUsers").animate({height:'350px'}, 100);

         }
           fnCancelUser_Entry = fnCancelUserEntry;
});
//--------------------------------------------------------------------------------
//-------------------Launch Toggle New Group fields visibility--------------------
$("#btnAddNewGroup").click(function(){
		 $("#btnAddNewGroup").hide();
         $("#NewGroupAdd").show();
		 $("#ControlManageGroupsList").hide();
        $("#ControlManageGroups").animate({height:'200px'}, 100);
});
//--------------------------------------------------------------------------------
//-------------------Launch Toggle New Fields Group visibility--------------------
$("#btnAddNewGroupConfirmClose").click(function(){
fnCancelGroupEntry();
});
//--------------------------------------------------------------------------------
//-------------------Add new group and close out--------------------
$("#btnAddNewGroupConfirm").click(function(){
//----------*******************************************
//------------------Call Ajax to update db here
//----------*******************************************
fnCancelGroupEntry();
});
//--------------------------------------------------------------------------------
//--------------------------New Group Entry Cancellation----------------------------------
function fnCancelGroupEntry(){
$("#inptGroupName").val('');
$("#NewGroupAdd").hide();
$("#btnAddNewGroup").show();
$("#ControlManageGroupsList").show();
$("#ControlManageGroups").animate({height:'300px'}, 100);

}
//--------------------------------------------------------------------------------
//-------------------Launch Toggle New Task visibility--------------------
$("#btnAddNewTask").click(function(){
		 $("#btnAddNewTask").hide();
         $("#NewTaskAdd").show();
		 $("#ControlManageTasksList").hide();
		 $("#ControlManageTasks").animate({height:'300px',width:'380px'}, 100);
});
//--------------------------------------------------------------------------------
//-------------------Launch Toggle New Task fields visibility--------------------
$("#btnAddNewTaskConfirm").click(function(){
//----------*******************************************
//------------------Call Ajax to update db here
//----------*******************************************
fnCancelTaskEntry()();
});
//--------------------------------------------------------------------------------
//-------------------Launch Cancel Task Entry div--------------------
$("#btnAddNewTaskConfirmClose").click(function(){
fnCancelTaskEntry()();
});
//--------------------------------------------------------------------------------
//-------------------Launch Toggle New Task fields visibility--------------------
function fnCancelTaskEntry(){
$("#inptTaskName").val('');
$("#txtTaskDescription").val('');
$("#drpboard").get(0).selectedIndex = 0;
$("#NewTaskAdd").hide();
$("#btnAddNewTask").show();
$("#ControlManageTasksList").show();
$("#ControlManageTasks").animate({height:'420px',width:'980px'}, 100);
}
//--------------------------------------------------------------------------------
//----------------------------------Standard User Project Control Funtions------------------------------//
//--------------------------Launch User Task Console----------------------
    $("#btnUserProjectTasks").click(function(){
    	hideControlDivs();
         $("#ControlManageTasksUser").show();
    });
//--------------------------------------------------------------------------------
//--------------------------Launch User Task Console----------------------
    $("#btnLUserProjectIssues").click(function(){
    	hideControlDivs();
         $("#ControlProjectIssue").show();
    });
//--------------------------------------------------------------------------------

//----------------------------------End Standard User Project Control Funtions//////////////------------//
//--------------------------------Close button function
$(".close").click(function(){
$(this).parents().eq(1).hide('slow');
 });
//-----------------------------End of close button class function
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
 function newMessageAlert() {
		  $("#newmessageindicator").show();
		  $("#newmessageindicator").css('background-color', 'yellow');
		  $("#newmessageindicator").css('color', '#000000');
		  $("#newmessageindicator").text('New Message');
		  $("#btnClear").trigger('click');
		  $("#newmessageindicator").fadeOut( 6000 );
    }
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//-----------Function to add message to the Board
    $("#btnClear").click(function(){
     fnClearMessageFields();
    });
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
function fnClearMessageFields(){
        $("#txtStaff").text('');
        $("#txtMessage").val('');
		$("[name=msgType]").removeAttr("checked");
		$("[name=selectall]").removeAttr("checked");
		$("[name=staff]").removeAttr("checked");
}
//--------------------------------------------------------------------------------
//---------------------------------------------------Post message function
 function PostMessage() {

hideControlDivs();

var msgID = guidGenerator();
var msgAuthor = $("#currentUser").text();
var msgDelegates = $("#txtStaff").val();
var msgType = jQuery( 'input[name=msgType]:checked' ).val();
var msgHtml = $("#txtMessage").val()
		    .replace(/</g, '&lt;')
		    .replace(/>/g,'&gt;')
            .replace(/\n/g, '<br/>');
var now = new Date();
var msgDateTime = dateFormat(now, "mm/dd/yyyy HH:MM:ss ");

//-----Ajax Call to load into db here--------

//-------------------This functionality below will be removed upon db connection
//-------------------The div refresh will control updating the Message div and
//-------------------The Message formatter will control the formatting of the messages.
  var msgPost = "<div class=msgpost id=" + msgID + " >";
      msgPost += "<div id=close><button type=button class=btnRepost>Repost</button></div>";
      msgPost += "<u><b>Author:</b></u> &nbsp;" + msgAuthor + "<br/>" ;
      msgPost += "<u><b>Delegation:</b></u> " + msgDelegates + "<hr>";
      msgPost += "<u><b>Message Type:</b></u> " + msgType;
	    msgPost += "<hr><u><b>Message:</b></u><p> " + msgHtml + "<hr></p>";
      msgPost +=  "<button type=button class=btnnewthread >+ Thread</button>";
	    msgPost +=  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + msgDateTime;
	    msgPost += "</div>";


	return msgPost;
   }
//--------------------------------------------------------------------------------
$('body').on('click','.btnnewthread',function(){
$("#newthreadmessageid").html($(this).parent().attr("id"));
 $("#inptmsgNewThread").val('');
$("#dvNewThread").show();
$("[id$=inptmsgNewThread]").focus();
});
//--------------------------------------------------------------------------------
$('body').on('click','.btndvNewThread',function(){

var now = new Date();
var msgDateTime = dateFormat(now, "mm/dd/yyyy HH:MM:ss ");
 var dvtoappend = $("#newthreadmessageid").text();
 var x = $("#inptmsgNewThread").val(); //posted thread
 var a = $("#currentUser").text();  //current user
 var msgthread = "<hr><u>" + a + "</u> threaded : </u><br/>" + x + "<br/><br/>" + msgDateTime;
$("#" + dvtoappend).append(msgthread);
 $("#inptmsgNewThread").val('');
$("#dvNewThread").hide();

});

//--------------------------------------------------------------------------------
$('body').on('click','.btnRepost',function(){

 //var divtext = $(this).parent().attr("id").text();
 var divtext = $(this).parent().parent().html();
divtext =  divtext.replace(/<hr ?\/?>/g, "\n")
var newline = divtext.replace(/<br ?\/?>/g, "\n")
var cleanString = newline.replace(/(<([^>]+)>)/ig,"");
$("#txtMessage").val("Reposted Message by:" + "\n" + $("#currentUser").text() + ":\n\n" + cleanString);
$("#messageboard").prepend(PostMessage());
newMessageAlert();

});
//--------------------------------------------------------------------------------
$("#inptmsgNewThread").keypress(function(event){
    if(event.keyCode == 13){
        event.preventDefault();
        $(".btndvNewThread").click();
    }
});
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
});
</script>


</head>
<body onload="startTime()">
<img class="background" src="<?php echo $_SESSION["BGimage"]; ?>">
<div id="divMainContent">
<table width="90%">
<tr>
<td align="center" colspan="2"><font style="float : left; font-size: 350%;" font-family: Georgia, Serif;><?php echo $_SESSION["AppName"]; ?></font>
<div id="dvSearchDiv">
<input type="text" name="inptSearchTerm" id="inptSearchTerm" value="Search Term" onfocus="this.value='';">
<button type="button" id="btnSearch">Search</button>
</div>
</tr>
</tr>
<tr>
<td colspan="2">
<div id="User"><div id="currentUser" class="dvUsername"><?php echo $_SESSION["UserFname"]." ".$_SESSION["UserLname"]; ?></div>
<button type="button" id="btnMyAccount">My Account</button>
</div>
<input type="hidden" id="userid" value=<?php echo $_SESSION["UserID"]; ?>>
<input type="hidden" id="hdnthread" value="">


<button type="button" id="btnProjectControls">Project Controls</button>&nbsp;&nbsp;&nbsp;
<button type="button" id="btnUserProjectTasks">Project Tasks</button>&nbsp;&nbsp;&nbsp;
<button type="button" id="btnLUserProjectIssues">Project Issues</button>&nbsp;&nbsp;&nbsp;
<button type="button" id="btnUserProjectResolutions">Issue Resolutions</button>&nbsp;&nbsp;&nbsp;
<button type="button" id="btnLogOut">Logout</button>&nbsp;&nbsp;&nbsp;
<button type="button" id="btnHelp">Help</button>&nbsp;&nbsp;&nbsp;

<div id="close"><div id="divClock"></div></div>
</td>
</tr>

<tr>
<td>

  <div id="divMessageContentWrap">
<!--   <u><b><div id="divChapterContentTitleText">Message Feed:</div></b></u> -->
  <br/><div id=newmessageindicator></div>
<div id="messageboard" class="refresh"></div>

</td>
<td>
  <div id="Personelllist">
<u><b>#1) Select Project Resources</u></b><br/>
Select All:<input type="checkbox" id="selectall" name="selectall" value="selectall">
<div class="taglist">
<fieldset>
      <section id="1">
      <article>
        <details>
          <summary>{GroupName} ex:Steering Committee</summary>
           {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
		   {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
		   {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
          </details>
		  <details>
		  <summary>{GroupName} ex:Project Leadership</summary>
           {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
		   {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
		   {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
          </details>
		  <details>
          <summary>{GroupName} ex:Systems Analysts</summary>
           {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
		   {MemberName}<input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
          </details>
		  <details>
          <summary>{GroupName} ex:Developers</summary>
           {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
		   {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName} " /><br/>
		   {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
          </details>
		  <details>
          <summary>{GroupName} ex:Database Administrators</summary>
           {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
		   {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
          </details>
		  <details>
          <summary>{GroupName} ex:Network/Hardware Resources</summary>
           {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
		   {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
          </details>

		  <details>
          <summary>{GroupName} ex:Quality Assurance</summary>
           {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
		   {MemberName} <input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
          </details>
		  <details>
          <summary>{GroupName} ex:Business Unit Resources</summary>
           {MemberName}<input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
          </details>
		  <details>
          <summary>{GroupName} ex:Auxillary Resources</summary>
           {MemberName}<input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
		   {MemberName}<input type="checkbox" class="checkbox1" name="staff" value="{MemberName}" /><br/>
        </details>
      </article>
	  </fieldset>
</div>

</div>
<!-- /////////////////////////////////// Below id the control for the Message Select///////////////////////////////////////////////////////////// -->



<div id="newMessage">
<fieldset class="radiogroup">
<legend>#2) Select Message Type</legend>
  <ul class="radio">
    <li><input type="radio" name="msgType" id="notice" value="Question/Comment/Observation" /><label for="notice">Question/Comment/Observation</label></li>
	<li><input type="radio" name="msgType" id="risk" value="Project Risk" /><label for="risk">Project Risk</label></li>
    <li><input type="radio" name="msgType" id="Issue" value="Project Issue" /><label for="Issue">Project Issue</label></li>
    <li><input type="radio" name="msgType" id="resolution" value="Issue Resolution" /><label for="resolution">Issue Resolution</label></li>
  </ul>
</fieldset>
<!-- /////////////////////////////////// Below id the hidden reciepient list textarea///////////////////////////////////////////////////////////// -->
<textarea id="txtStaff" rows="1" cols="45">
</textarea>

<!-- /////////////////////////////////// Below id the textarea for Entering a message ///////////////////////////////////////////////////////////// -->

<u><b>#3) Enter Message:</u></b>
<textarea id="txtMessage" rows="4" cols="55" ondrop="drop(event)" ondragover="allowDrop(event)">
</textarea>

<!-- /////////////////////////////////// Below id are the message control buttons ///////////////////////////////////////////////////////////// -->
<button type="button" id="btnPost">Post Message</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="button" id="btnAttachFile">Attach File</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="button" id="btnClear">Clear/Cancel Post</button><input type="file" />
</div>
</td>
</tr>
</table>


<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->

<div id="ManageControlProject" class="controls">
<div id="Add">Project Control Console</div><div id="close"><button id="btnManageControlProjectClose" class="close">Cancel/Close</button></div><br/><hr>
<table class="tblForm">
 <tr>
   <th>Resources:<br/></th>
   <th>Processes:<br/></th>
   <th>Artifacts:<br/></th>
 </tr>
<tr>
<td><button type="button" id="btnmngUsers" class="ControlButton">Manage Users</button></td>
<td><button type="button" id="btnIssues" class="ControlButton">Project Issues</button></td>
<td><button type="button" id="btnProjectFileList" class="ControlButton">Project File List</button></td>
</tr>

<tr>

<td><button type="button" id="btnmngGroups" class="ControlButton">Manage Groups</button></td>
<td><button type="button" id="btnmngTasks" class="ControlButton">Manage Tasks</button></td>
<td><button type="button" id="btnReportCurrentState" class="ControlButton">Current State Report</button></td>
</tr>

<tr>
<td></td>
<td><button type="button" id="btnResolutions" class="ControlButton">Issue Resolutions</button></td>
<td></td>
</tr>

</table>


</div>

<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->
<div id="ControlProjectIssue" class="controls">
<div id="Add">Project Issues</div><div id="close"><button id="btnControlProjectIssueClose" class="close">Cancel/Close</button></div><br/><hr>
<div id="ControlProjectIssueList">

</div>
</div>
<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->
<div id="ControlProjectIssueResolution" class="controls">
<div id="Add">Project Issue Resolutions</div><div id="close"><button id="btnControlProjectIssueResolutionClose" class="close">Cancel/Close</button></div><br/><hr>
 <div id="ControlProjectIssueResolutionList" style="overflow-x:hidden;">

</div>
</div>
<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->

<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->
<div id="ControlManageUsers" class="controls">
<div id="Add">User Management</div><div id="close">
<button id="btnAddNewUser" >Add New User</button>&nbsp;&nbsp;&nbsp;&nbsp;
<button id="btnControlManageUsersClose" class="close">Cancel/Close</button></div><br/>
<div id="Addresult"></div>
<hr>

<div id="NewUserAdd">
<table class="tblForm">
<tr>
<td>Email address:</td><td><input type="text" name="inptusername" id="inptusername" onblur="checkEmail(this.value)">(*is the Username*)</td>
</tr>
<tr>
<td>First Name:</td><td><input type="text" name="inptUserFname" id="inptUserFname"></td>
</tr>
<tr>
<td>Last Name:</td><td><input type="text" name="inptUserLname" id="inptUserLname"></td>
</tr>
<tr>
<td>Password:</td><td><input type="password" name="imptpassword" id="imptpassword" disabled> *system generated</td>
</tr>
<tr>
<td>User Mobile#:</td><td><input type="text" name="inptUserMobileNum" id="inptUserMobileNum" maxlength="14" placeholder="(XXX) XXX-XXXX"  onblur="checkPhone(this.value)"/></td>
</tr>
<tr>
<td>User Office#:</td><td><input type="text" name="inptUserOfficeNum" id="inptUserOfficeNum" maxlength="14" placeholder="(XXX) XXX-XXXX"  onblur="checkPhone(this.value)"/></td>
</tr>
<tr>
<td>User Access Level:</td><td><input type="number" name="inptAccessLvl" id="inptAccessLvl">(Range1-10)</td>
</tr>
</table>

<button id="btnAddNewUserConfirm">Add User</button>&nbsp;&nbsp;
<button id="btnAddNewUserConfirmClose">Cancel/Close</button>
</div>
<div id="ControlManageUsersList">

</div>
</div>
<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->
<div id="ControlManageGroups" class="controls">
<div id="Add">Group Management</div>
<button id="btnAddNewGroup" >Add New Group</button>&nbsp;&nbsp;&nbsp;&nbsp;
<div id="close"><button id="btnControlManageGroupsClose" class="close">Cancel/Close</button></div><br/><hr>

<div id="NewGroupAdd">
<table class="tblForm">
<tr>
<td>Group Name:</td><td><input type="text" name="inptGroupName" id="inptGroupName"></td>
</tr>
</table>

<button id="btnAddNewGroupConfirm">Add Group</button>&nbsp;&nbsp;
<button id="btnAddNewGroupConfirmClose">Cancel/Close</button>
</div>
<div id="ControlManageGroupsList">

</div>
</div>
<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->
<div id="ControlManageTasks" class="controls">
<div id="Add">(Kanban) Project Critical Tasks</div>

<div id="close"><button id="btnAddNewTask" >Add New Task</button>&nbsp;&nbsp;&nbsp;&nbsp;
<button id="btnControlManageTasksClose" class="close">Cancel/Close</button></div>

<br/><hr>

<div id="NewTaskAdd" >
<table class="tblFormAdd">
<tr>
<td valign="top" colspan="3">Task Name:<br/><input type="text" name="inptTaskName" id="inptTaskName"></td>
<tr><td valign="top" colspan="3">Task Description:<br/><textarea id="txtTaskDescription" rows="4" cols="45"></textarea></td>
<tr><td valign="top" colspan="3">Assign To Board:<br/><select id="drpboard">
  <option value="To Do">To Do</option>
  <option value="In-Process">In-Process</option>
  <option value="Completed">Completed</option>
</select></td>
</tr>
<tr>
<td colspan="3">
<button id="btnAddNewTaskConfirm">Add Task</button>&nbsp;&nbsp;
<button id="btnAddNewTaskConfirmClose">Cancel/Close</button>
</td>
<td></td>
<td></td>
</tr>
</table>


</div>
<div id="ControlManageTasksList">
<table>
<tr><td>To Do Column</td><td>In-Process Column</td><td>Completed Column</td></tr>
<tr>
<td><div id="divToDoColumn" class="KanbanColumnDiv">
<ol>
<li>Fix Search RegEx to check for complete word.</li>
<li>Finish user functionality</li>
<li>Finish group functionality</li>
<li>Finish message functionality</li>
<li>Finish task functionality</li>
<li>Add Task Due Dates</li>
<li>Add Task Priority ranking</li>
<li>Finish File Functionality</li>
<li></li>
<li></li>
</ol>

</div>
</td>
<td><div id="divIn-ProcessColumn" class="KanbanColumnDiv"></div></td>
<td><div id="divToDoColumn" class="KanbanColumnDiv"></div></td>
</tr>
</table>

</div>
</div>
<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->
<div id="ControlGenerateReports" class="controls">
<div id="Add">Report Generator List</div><div id="close"><button id="btnControlGenerateReportsClose" class="close">Cancel/Close</button></div><br/><hr>
<div id="ControlGenerateReportsList">

</div>
</div>
<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->
<div id="ControlProjectFileDisplay" class="controls">
<div id="Add">Project File Listing:</div><div id="close"><button id="btnProjectFileDisplayClose" class="close">Cancel/Close</button></div><br/><hr>
<div id="ControlProjectFileDisplayList">

</div>
</div>
<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->
<div id="ControlManageTasksUser" class="controls">
<div id="Add">(Kanban) Project Critical Tasks</div>
<div id="close"><button id="btnControlManageTasksUserClose" class="close">Cancel/Close</button></div>
<br/><hr>

<div id="ControlManageTasksListUser">
<table>
<tr><td>To Do Column</td><td>In-Process Column</td><td>Completed Column</td></tr>
<tr>
<td><div id="divToDoColumnUser" class="KanbanColumnDiv"></div></td>
<td><div id="divIn-ProcessColumnUser" class="KanbanColumnDiv"></div></td>
<td><div id="divToDoColumnUser" class="KanbanColumnDiv"></div></td>
</tr>
</table>

</div>
</div>
<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->


<div id="MyaccountUserUpdate" class="controls">

</div>


<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->
<div id="dvNewThread"  class="controls">
<div id="Add">New Message Thread</div><div id="close"><button id="btndvNewThread" class="close">Cancel/Close</button></div><br/><hr>
<div id="newthreadmessageid"></div>
<input type="text" name="inptmsgNewThread" id="inptmsgNewThread" /><br/>
<button class="btndvNewThread" >POST</button>

</div>
<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->
<!--/////////////////////////////// Control Div's  ///////////////////////////////////////////////////////////////-->



</div>
</body>
</html>