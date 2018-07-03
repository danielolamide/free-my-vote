function openNav(){
	document.getElementById("side-menu").style.width ="200px";
	document.getElementById("wrapper").style.marginLeft ="200px";
}
function closeNav(){
	document.getElementById("side-menu").style.width= "0";
	document.getElementById("wrapper").style.marginLeft="0";
}
function dropFunction(){
	document.getElementById("myDropButton").classList.toggle("show");
}
window.onclick = function(event){
	if(!event.target.matches('.dropbtn')){
		var dropdowns = document.getElementsByClassName("drop-content");
		var i ;
		for(i=0; i<dropdowns.length; i++){
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains("show")) {
				openDropdown.classList.remove("show");
			}
		}
	}
}

