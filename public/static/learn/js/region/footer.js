var phone=document.getElementById('phone');
var phone1=document.getElementById('phone1');
var x=2;
phone.onkeyup=function(){
	var pat= /^1[34578]\d{9}$/;
	if(!pat.test(phone.value)){
		var x=1;
		phone1.innerHTML="*请输入正确的手机号码";
		phone1.style.color='red';
	}else{
		var x=0;
		phone1.innerHTML="";
	}
}
var user=document.getElementById('user');
var user1=document.getElementById('user1');
user.onblur=function(){
	console.log(this.value);
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}else{
		xmlhttp=new ActiveXObject('microsoft.XMLHTTP');
	}
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			var result=xmlhttp.responseText;
			console.log(result);
			if(result==0){
				user1.innerHTML='此用户可以注册';
				user1.style.color='green';
				user1.x=0;
			}else{
				if(result==1){
				user1.innerHTML='此用户已被注册';
				user1.style.color='red';
				user1.x=1;
			}
			}
		}
	}
	xmlhttp.open('GET','ifname?name='+this.value,true);
	xmlhttp.send();
}
function formsubmit(){
	if(user1.x==1){
		user.focus();
		//user1.innerHTML='此用户已被注册';
		return false;
	}
	return true;
}
