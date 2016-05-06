//------------------------------------------------------------------------------------------------------------------------------------
function checkEmail(str)
{
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!re.test(str))
    	    var id = $(event.target).attr('id');
            document.getElementById(id).value = "";
            $("#newmessageindicator").show();
		    $("#newmessageindicator").css('background-color', 'red');
		    $("#newmessageindicator").css('color', '#FFFFFF');
		    $("#newmessageindicator").text('Enter a valid email address.');
             $("#newmessageindicator").fadeOut( 6000 );
          
}
//------------------------------------------------------------------------------------------------------------------------------------
function checkPhone(str)
{
    var re = /^\(?[0-9]{3}(\-|\)) ?[0-9]{3}-[0-9]{4}$/;
    if(!re.test(str))
    	    var id = $(event.target).attr('id');
            document.getElementById(id).value = "";
            $("#newmessageindicator").show();
		    $("#newmessageindicator").css('background-color', 'red');
		    $("#newmessageindicator").css('color', '#FFFFFF');
		    $("#newmessageindicator").text('Enter a valid phone number.');
             $("#newmessageindicator").fadeOut( 6000 );
        
}
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
function guidGenerator() {
    var S4 = function() {
       return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}
//------------------------------------------------------------------------------------------------------------------------------------
function fnAddNewProjectUser() {
           var A = guidGenerator();
	       var B = document.getElementById("inptusername").value;
	       var C = document.getElementById("inptUserFname").value;
	       var D = document.getElementById("inptUserLname").value;
	       var E = document.getElementById("imptpassword").value;
	       var F = document.getElementById("inptUserMobileNum").value;
	       var G = document.getElementById("inptUserMobileNum").value;
	       var H = document.getElementById("inptAccessLvl").value;

           //alert(A + "\n" + B + "\n" + C + "\n" + D + "\n" + E + "\n" + F + "\n" + G); 
         
        // fnCancelUser_Entry(); 
       if (B=="" || C=="" || D=="" || F=="" || G=="")
         {
         document.getElementById("Addresult").innerHTML="Required field missing.";
         return;
         }
       if (window.XMLHttpRequest)
         {// code for IE7+, Firefox, Chrome, Opera, Safari
         xmlhttp=new XMLHttpRequest();
         }
       else
         {// code for IE6, IE5
         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
         }
       xmlhttp.onreadystatechange=function()
         {
         if (xmlhttp.readyState==4 && xmlhttp.status==200)
           {
           	document.getElementById("Addresult").innerHTML=xmlhttp.responseText;
           //fnCancelUser_Entry();
           }
         }
         xmlhttp.open("GET","addprojectuser.php?A="+A+"&B="+B+"&C="+C+"&D="+D+"&E="+E+"&F="+F+"&G="+G+"&H="+H,false);
         xmlhttp.send();

         fnCancelUser_Entry(); //== call jquery function - just Reference is globally defined not function itself

}
//------------------------------------------------------------------------------------------------------------------------------------
function fnUpdateUser(){
	
     	var A = document.getElementById("inpteditusername").value;
        var B = document.getElementById("impteditpassword").value;
        var C = document.getElementById("inptedituserfname").value;
        var D = document.getElementById("inptedituserLname").value;
        var E = document.getElementById("inpteditUserMobileNum").value;
        var F = document.getElementById("inpteditUserOfficeNum").value;
        var G = document.getElementById("userid").value;
        
       if (A=="")
         {
         document.getElementById("Editresult").innerHTML="";
         return;
         }
       if (window.XMLHttpRequest)
         {// code for IE7+, Firefox, Chrome, Opera, Safari
         xmlhttp=new XMLHttpRequest();
         }
       else
         {// code for IE6, IE5
         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
         }
       xmlhttp.onreadystatechange=function()
         {
         if (xmlhttp.readyState==4 && xmlhttp.status==200)
           {
           	document.getElementById("Editresult").innerHTML=xmlhttp.responseText;
           //fnCancelUser_Entry();
           }
         }
         xmlhttp.open("GET","updateprojectuser.php?A="+A+"&B="+B+"&C="+C+"&D="+D+"&E="+E+"&F="+F+"&G="+G,false);
         xmlhttp.send();
         document.getElementById("currentUser").innerHTML= C + " " + D;

         fnCancelUser_EditClear(); //== call jquery function - just Reference is globally defined not function itself

}
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
function UUID() {
    var nbr, randStr = "";
    do {
        randStr += (nbr = Math.random()).toString(16).substr(2);
    } while (randStr.length < 30);
    return [
        randStr.substr(0, 8), "-",
        randStr.substr(8, 4), "-4",
        randStr.substr(12, 3), "-",
        ((nbr*4|0)+8).toString(16), // [89ab]
        randStr.substr(15, 3), "-",
        randStr.substr(18, 12)
        ].join("");
}
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
function generatePassword() {
    var length = 10,
        charset = "!@#$%&*abcdefghijklnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
return retVal;
}
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------Javascript Clock Function-----------------------------------------------------------
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('divClock').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------Javascript Date format Function-------------------------------------

var dateFormat = function () {
	var	token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
		timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
		timezoneClip = /[^-+\dA-Z]/g,
		pad = function (val, len) {
			val = String(val);
			len = len || 2;
			while (val.length < len) val = "0" + val;
			return val;
		};

	// Regexes and supporting functions are cached through closure
	return function (date, mask, utc) {
		var dF = dateFormat;

		// You can't provide utc if you skip other args (use the "UTC:" mask prefix)
		if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
			mask = date;
			date = undefined;
		}

		// Passing date through Date applies Date.parse, if necessary
		date = date ? new Date(date) : new Date;
		if (isNaN(date)) throw SyntaxError("invalid date");

		mask = String(dF.masks[mask] || mask || dF.masks["default"]);

		// Allow setting the utc argument via the mask
		if (mask.slice(0, 4) == "UTC:") {
			mask = mask.slice(4);
			utc = true;
		}

		var	_ = utc ? "getUTC" : "get",
			d = date[_ + "Date"](),
			D = date[_ + "Day"](),
			m = date[_ + "Month"](),
			y = date[_ + "FullYear"](),
			H = date[_ + "Hours"](),
			M = date[_ + "Minutes"](),
			s = date[_ + "Seconds"](),
			L = date[_ + "Milliseconds"](),
			o = utc ? 0 : date.getTimezoneOffset(),
			flags = {
				d:    d,
				dd:   pad(d),
				ddd:  dF.i18n.dayNames[D],
				dddd: dF.i18n.dayNames[D + 7],
				m:    m + 1,
				mm:   pad(m + 1),
				mmm:  dF.i18n.monthNames[m],
				mmmm: dF.i18n.monthNames[m + 12],
				yy:   String(y).slice(2),
				yyyy: y,
				h:    H % 12 || 12,
				hh:   pad(H % 12 || 12),
				H:    H,
				HH:   pad(H),
				M:    M,
				MM:   pad(M),
				s:    s,
				ss:   pad(s),
				l:    pad(L, 3),
				L:    pad(L > 99 ? Math.round(L / 10) : L),
				t:    H < 12 ? "a"  : "p",
				tt:   H < 12 ? "am" : "pm",
				T:    H < 12 ? "A"  : "P",
				TT:   H < 12 ? "AM" : "PM",
				Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
				o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
				S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
			};

		return mask.replace(token, function ($0) {
			return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
		});
	};
}();

// Some common format strings
dateFormat.masks = {
	"default":      "ddd mmm dd yyyy HH:MM:ss",
	shortDate:      "m/d/yy",
	mediumDate:     "mmm d, yyyy",
	longDate:       "mmmm d, yyyy",
	fullDate:       "dddd, mmmm d, yyyy",
	shortTime:      "h:MM TT",
	mediumTime:     "h:MM:ss TT",
	longTime:       "h:MM:ss TT Z",
	isoDate:        "yyyy-mm-dd",
	isoTime:        "HH:MM:ss",
	isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
	isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings
dateFormat.i18n = {
	dayNames: [
		"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
		"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
	],
	monthNames: [
		"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
		"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
	]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
	return dateFormat(this, mask, utc);
};
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
  //-----------Load Users in Manage Div------------------------------------------------------------------------------
    function fnLoadManageUsers(){

     $.ajax({type: 'POST',url: 'loadmanageusers.php',data: '',
       success: function(data){$("#ControlManageUsersList").html(data); },
       error: function(xhr, type, exception) {
       	$("#ControlManageUsersList").html("ajax error response type "+xhr +" - "+ type+" - "+ exception);
       }
});}
//--------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
  //-----------Load My User account Div------------------------------------------------------------------------------
    function fnLoadMyUserdata(b){
     $.ajax({type: 'POST',url: 'myaccount.php',data: "b="+ b,
       success: function(data){$("#MyaccountUserUpdate").html(data);},
       error: function(xhr, type, exception) {$("#MyaccountUserUpdate").html("ajax error response type "+xhr +" - "+ type+" - "+ exception);}
});}
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------
