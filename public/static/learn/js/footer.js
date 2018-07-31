var o=document.getElementById('person').getElementsByTagName('a');
var r=document.getElementById('person');

o[0].onmouseover=function(){
	o[1].style.visibility='visible';
	o[2].style.visibility='visible';
};
r.onmouseout=function(e){
	var e=e||window.event;
	var s=e.toElement||e.relatedTarget;
	console.log(s);
	if(s==o[1]||s==o[2]||s==r){return;}
	o[1].style.visibility='hidden';
	o[2].style.visibility='hidden';
}