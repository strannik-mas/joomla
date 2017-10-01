
function ipLising(optionsValue){
if(optionsValue.value != undefined)
{
	if(optionsValue.value == "0"){
		document.getElementById("BipLisingIpbox").style.display = "";
		document.getElementById("BipLisingAddbox").style.display = "";
		document.getElementById("WipLisingAddbox").style.display = "none";
		document.getElementById("WipLisingIpbox").style.display = "none";
	} else {
		document.getElementById("WipLisingAddbox").style.display = "";
		document.getElementById("WipLisingIpbox").style.display = "";
		document.getElementById("BipLisingIpbox").style.display = "none";
		document.getElementById("BipLisingAddbox").style.display = "none";
	}
	}
}

Joomla.submitbutton = function(pressbutton){
	var submitForm = document.adminForm;
	
	if(pressbutton=="help"){
		submitForm.task.value=pressbutton;
		submitForm.submit();
	}	
	if(pressbutton=="save"){
		
		submitForm.task.value='saveIp';
		submitForm.submit();
	}	


	submitForm.task.value=pressbutton;
	submitForm.submit();
}

function checkEMail(email){
	var reg = /^[A-Z0-9\._%-]+@[A-Z0-9\.-]+\.[A-Z]{2,4}(?:[,;][A-Z0-9\._%-]+@[A-Z0-9\.-]+\.[A-Z]{2,4})*$/i;
	if(reg.test(email) == false) {
		return false;
	} else {
		return true;
	}
}

function verifyIP (IPvalue) {
	errorString = "";
	theName = "IPaddress";

	var ipPattern = "/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/";
	var ipArray = IPvalue.match(ipPattern);
	
	if (IPvalue == "0.0.0.0")
		return false;
	else if (IPvalue == "255.255.255.255")
		return false;
	if (ipArray == null)
		return false;
	else {
		for (i = 0; i <= 4; i++) {
			thisSegment = ipArray[i];
			if (thisSegment > 255) {
					return false;
				i = 4;
			}
			if ((i == 0) && (thisSegment > 255)) {
					return false;
				i = 4;
		    }
		}
	}
	extensionLength = 3;
	if (errorString == "")
		return true;
	else
		return false;
}
 
 function addIpB(placeholder, iplist)
{	
	var part1 = document.getElementById(placeholder + '1').value != '*' ? parseInt(document.getElementById(placeholder + '1').value) : '*';
	var part2 = document.getElementById(placeholder + '2').value != '*' ? parseInt(document.getElementById(placeholder + '2').value) : '*';
	var part3 = document.getElementById(placeholder + '3').value != '*' ? parseInt(document.getElementById(placeholder + '3').value) : '*';
	var part4 = document.getElementById(placeholder + '4').value != '*' ? parseInt(document.getElementById(placeholder + '4').value) : '*';
	
	if ((part1 != '*' && (isNaN(part1) || part1 < 0 || part1 > 255)) || (part2 != '*' && (isNaN(part2) || part2 < 0 || part2 > 255)) || (part3 != '*' && (isNaN(part3) ||part3 < 0 || part3 > 255)) || (part4 != '*' && (isNaN(part4) ||part4 < 0 || part4 > 255)))
	{
		alert('Please insert a correct IP address.');
		return false;
	}
	
	var ip = part1 + '.' + part2 + '.' + part3 + '.' + part4;
	
	if (ip == '*.*.*.*')
	{
		alert("It's not safe to add a mask that contains all IP addresses (*.*.*.*)");
		return false;
	}

		if (document.getElementById(iplist).value.length > 0)
			document.getElementById(iplist).value += "\n" + ip;
		else
		document.getElementById(iplist).value = ip;
		document.getElementById(placeholder + '1').value = '';
		document.getElementById(placeholder + '2').value = '';
		document.getElementById(placeholder + '3').value = '';
		document.getElementById(placeholder + '4').value = '';
		return true;
}

 function addIpW(placeholder, iplist)
{	
	var part1 = document.getElementById(placeholder + '1').value != '*' ? parseInt(document.getElementById(placeholder + '1').value) : '*';
	var part2 = document.getElementById(placeholder + '2').value != '*' ? parseInt(document.getElementById(placeholder + '2').value) : '*';
	var part3 = document.getElementById(placeholder + '3').value != '*' ? parseInt(document.getElementById(placeholder + '3').value) : '*';
	var part4 = document.getElementById(placeholder + '4').value != '*' ? parseInt(document.getElementById(placeholder + '4').value) : '*';
	
	if ((part1 != '*' && (isNaN(part1) || part1 < 0 || part1 > 255)) || (part2 != '*' && (isNaN(part2) || part2 < 0 || part2 > 255)) || (isNaN(part3) || part3 != '*' && (part3 < 0 || part3 > 255)) || (isNaN(part4) || part4 != '*' && (part4 < 0 || part4 > 255)))
	{
		alert('Please insert a correct IP address.');
		return false;
	}
	
	var ip = part1 + '.' + part2 + '.' + part3 + '.' + part4;
	
	if (ip == '*.*.*.*')
	{
		alert("It's not safe to add a mask that contains all IP addresses (*.*.*.*)");
		return false;
	}

		if (document.getElementById(iplist).value.length > 0)
			document.getElementById(iplist).value += "\n" + ip;
		else
		document.getElementById(iplist).value = ip;
		document.getElementById(placeholder + '1').value = '';
		document.getElementById(placeholder + '2').value = '';
		document.getElementById(placeholder + '3').value = '';
		document.getElementById(placeholder + '4').value = '';
		return true;
}

//*/
function isNumeric(val)
{
	val.value=val.value.replace(/[^0-9*]/g, '');
	if (val.value.indexOf('*') != '-1')
		val.value = '*';
}