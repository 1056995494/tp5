function phoneactive(){
	var phone=document.getElementById('phone').value;
	var phoneactive=document.getElementById('phoneactive');
	console.log(phone);
	if(user1.x==0){
	var pat= /^1[34578]\d{9}$/;
	if(!pat.test(phone)){
		alert('请输入正确的手机号码');
		return;
	}
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}else{
		xmlhttp=new ActiveXObject('microsoft.XMLHTTP');
	}
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			result=JSON.parse(xmlhttp.responseText);
			if(result.result==0){
				alert('发送成功，请注意查收');
			}
		}
	}
	xmlhttp.open('GET','phoneactive?phone='+phone,true);
	xmlhttp.send();
	}else{
		return;
	}
}
