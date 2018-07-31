function test(a,b,c,d){
	t=document.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
	for(var i=0;i<t.length;i++){
		t[i].style.backgroundColor=(t[i].sectionRowIndex%2==0)?a:b;
		t[i].onclick=function(){
			if(this.x!=1){
				this.x=1;
				this.style.backgroundColor=c;
			}else{
				this.x=0;
				this.style.backgroundColor=(this.sectionRowIndex%2==0)?a:b;
			}
		}
		t[i].onmouseover=function(){
			if(this.x!=1){
				this.style.backgroundColor=d;
			}
		}
		t[i].onmouseout=function(){
			if(this.x!=1){
				this.style.backgroundColor=(this.sectionRowIndex%2==0)?a:b;
			}
		}
		console.log(t[i].x);
	}
}
function deletet(){
	if(!confirm('确认删除选中的项目吗？')){
		return;
	}
	var list=[];
	for(var i=0;i<t.length;i++){
		
		if(t[i].x==1){
			list.push(t[i].getElementsByTagName('td')[0].innerHTML);
		
	}
	}
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}else{
		xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	}
	xmlhttp.open("POST","http://localhost/api/v1.decoration/deletet",true);
	xmlhttp.setRequestHeader('Content-type',"application/json");
	xmlhttp.send(JSON.stringify(list));
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200)
		{
			//console.log(xmlhttp.responseText);
			window.location.reload();
			
		}
		
	}
}