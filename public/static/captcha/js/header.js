function test(){
	console.log(1);
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}else{
		xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	}
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			console.log(xmlhttp.responseText);
			console.log(2);
		}
	}
	xmlhttp.open('POST','https://www.st1207.com/test.php',true);
	xmlhttp.setRequestHeader("Contend-type","application/x-www-form-urlencoded");
	xmlhttp.send('da头鱼啊');
}