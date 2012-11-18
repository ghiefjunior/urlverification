<!Doctype html>
<html>
<head>
<title>Validate URL</title>
<style type="text/css">
fieldset{
	width: 460px;
	height: 80px;
	-moz-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
	-webkit-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
	box-shadow:inset 0px 1px 0px 0px #bbdaf7;
	background-color:#79bbff;
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	border-radius:10px;
	border:1px solid #84bbf3;
	color:#ffffff;
	font-family:Verdana;
	font-size:15px;
	font-weight:bold;
	text-decoration:none;
	text-shadow:1px 1px 0px #528ecc;
	margin: 0 auto;
}

#main{
	position:relative;
	top: 0;
	width: 485px;
	margin: 0 auto;
	border: 0px solid #999;
}

#errorDiv{
	font: bold 12px Verdana, Geneva, sans-serif;
	position:relative;
	top: 5px;
	color: #C00;
	width: 460px;
	text-align:center;
	text-shadow:1px 1px white, -1px -1px #444
}
.inputurl{
	width: 224px;
	height: 34px;
	padding: 2px;
	text-shadow: 0px 1px 0px #ffffff;
	outline: none;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#bcbcbe', endColorstr='#ffffff');
	background: -webkit-gradient(linear, left top, left bottom, from(#bcbcbe), to(#ffffff));
	background: -moz-linear-gradient(top,  #bcbcbe,  #ffffff);
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 5px;
	border: 1px solid #717171;
	-webkit-box-shadow: 1px 1px 0px #efefef;
	-moz-box-shadow: 1px 1px 0px #efefef;
	box-shadow:  1px 1px 0px #efefef;
}

.button {
	-moz-box-shadow:inset 0px 1px 0px 0px #a4e271;
	-webkit-box-shadow:inset 0px 1px 0px 0px #a4e271;
	box-shadow:inset 0px 1px 0px 0px #a4e271;
	background-color:#89c403;
	-moz-border-radius:20px;
	-webkit-border-radius:20px;
	border-radius:20px;
	border:1px solid #FFFFFF;
	display:inline-block;
	color:#ffffff;
	font-family:Verdana;
	font-size:15px;
	font-weight:bold;
	padding:10px 24px;
	text-decoration:none;
	text-shadow:1px 1px 0px #528009;
}.button:hover {
	background-color:#77a809;
}.button:active {
	position:relative;
	top:1px;
}
</style>
</head>
<body onLoad="document.myForm.urls.focus();">
<script language="javascript" type="text/javascript">
<!-- 
//Browser Support Code
function validate(url) {
	// generate pattern for regex
	//var pattern = /(^|\s)((https?:\/\/)?[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/gi;
	var pattern = /^(?:(ftp|http|https):\/\/)?(?:[\w-]+\.)+[a-z]{3,6}$/;
	// check if the pattern match the URL
	if (pattern.test(url)) {
		//alert("Url is valid");
		return true;
	} 
	//alert("Url is not valid!");
	return false;
}
function ajaxFunction(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Get the URL value from the form
	var url = document.getElementById('url').value;
	
	// validate the URL
	if (validate(url)==true){
		url = url.replace(/^(?:(ftp|http|https):\/\/)/,"");
		url = url.replace(/^(?:(www.))/,"");
		// Create query url
		var queryString = "?url=" + url;

		//alert(url);
		// check for dot com only
		var ext = url.split(".");
		var countarray = ext.length;
		if (countarray>1){
			for (i=0;i<countarray;i++){
				if (ext[i]=="com"){
					//alert("1:" + ext[i]);
					var divresults = 'successDiv';
				}else{
					//alert("2:" + ext[i]);
					var divresults = 'errorDiv';
				}
			}
		}else{
			var divresults = 'errorDiv';
		}
	}else{
		var queryString = "?url=" + url;
		var divresults = 'errorDiv';
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById(divresults);
			if (divresults=='successDiv'){
				//d.removeChild(divIdName);
				//var newdiv = document.createElement('div');
				//newdiv.setAttribute('id',divIdName);
				//d.appendChild(newdiv);
				// overstacking method for the results
				document.myForm.urls.value = '';
				document.getElementById('errorDiv').innerHTML = '&nbsp;';
				ajaxDisplay.innerHTML =  ajaxRequest.responseText + "<br />" + ajaxDisplay.innerHTML;
				document.myForm.urls.focus();
			}else{
				// overwrite the result on error
				document.myForm.urls.value = '';
				ajaxDisplay.innerHTML =  "Not a valid URL \"" + ajaxRequest.responseText + "\"!";
				document.myForm.urls.focus();
			}
		}
	}
	ajaxRequest.open("GET", "results.php" + queryString, true);
	ajaxRequest.send(null); 
}
//-->
</script>

<fieldset>
	<label>&nbsp;</label>
	<form name='myForm' onSubmit="ajaxFunction(); return false;">
		Enter a URL: <input type='text' name='urls' id='url' class='inputurl' />&nbsp;<input type='button' onclick='ajaxFunction()' value=' SEND ' class='button' />
	</form>
	<div id='errorDiv'>&nbsp;</div>
</fieldset>
<div id="main">
	<div id='successDiv'>&nbsp;</div>
</div>

</body>
</html>