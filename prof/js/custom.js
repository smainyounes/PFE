
function ani1(){
	
var animateButton = function(e) {
	document.getElementById("but_ani").classList.add("success");
	e.preventDefault;
	//reset animation
	e.target.classList.remove('animate');
	
	e.target.classList.add('animate');
	
	e.target.classList.add('animate');
	setTimeout(function(){
	  e.target.classList.remove('animate');
	},6000);
  };
  var classname = document.getElementsByClassName("button");

for (var i = 0; i < classname.length; i++) {
  classname[i].addEventListener('click', animateButton, false);
}	
}
function ani2(){
	
	var animateButton = function(e) {
	document.getElementById("but_ani").classList.add("error");
		e.preventDefault;
		//reset animation
		e.target.classList.remove('animate');
		
		e.target.classList.add('animate');
		
		e.target.classList.add('animate');
		setTimeout(function(){
		  e.target.classList.remove('animate');
		},6000);
	  };
	  var classname = document.getElementsByClassName("button");
	
	for (var i = 0; i < classname.length; i++) {
	  classname[i].addEventListener('click', animateButton, false);
	}	
	}

// sidebar toggle

$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});

// load the home page by default
loadContent('acceuil');

// event when navigating the sidebar
$(".list-group-item").click(function() {
	// get selected item
	var selectedpage = $(this).attr('name');
	$(".list-group-item").removeClass("active");
	if(selectedpage != "messagerie"){
		loadContent(selectedpage);
	}
});
$("#settings").click(function() {
	var selectedpage = $(this).attr('name');
	$(".list-group-item").removeClass("active");
	loadContent(selectedpage);
});

// left swip event
$( "#mofid" ).on( "swiperight",function() {
	console.log('test');
});
// first letter uppercase function
function jsUcfirst(string) 
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}
// load the content via ajax
function loadContent(page) {

	// ajax
	$.ajax({
	    type: 'POST',
	    async: false,
	    url: "backend/work.php",
	    data: { Page: page},
	    beforeSend:function(){
	    	// set the loading screen
	    	$("#content-loading").show();

	    	// disable scrolling
	    	$('html, body').css({
	    	    "overflow-y": 'hidden',
	    	    height: '100%'
	    	});

	    },  
	 error: function(){
	 	$("#content-loading").hide();
	 	$('html, body').css({
	 	    "overflow-y": 'auto',
	 	    height: 'auto'
	 	});

	  	alert("error no connection");
	 },     
	 success:function(data)
	 {
	 	// remove the loading screen
	 	$("#content-loading").hide();

	 	// enable scrolling 
	 	$('html, body').css({
	 	    "overflow-y": 'auto',
	 	    height: 'auto'
	 	});

	 	// set the new content
	  	$("#mofid").html(data);

	  	// change the page title
	  	$("title").text("Espace Etudiant | "+jsUcfirst(page));

	  	MsgCount();
	 }
	});
}

function show_hide(x){
	switch (x){
		case 0 :
				document.getElementById('r4').style.display="none";
				document.getElementById('r5').style.display="none";
				document.getElementById('r6').style.display="none";
				document.getElementById('r7').style.display="none";
				document.getElementById('r2').style.display="none";
				document.getElementById('r1').style.display="block";
				document.getElementById('radio5').checked = false;
				document.getElementById('radio11').checked = true;
				document.getElementById('radio7').checked = false;
				document.getElementById('r3').style.display="none";
				document.getElementById('seca').style.display="block";
				document.getElementById('secb').style.display="block";
				document.getElementById('gp1').style.display="block";
				document.getElementById('gp2').style.display="block";
				document.getElementById('gp3').style.display="block";
				document.getElementById('gp4').style.display="block";
				document.getElementById('gp5').style.display="block";
				document.getElementById('gp6').style.display="block";
				break;
		case 1 :
				document.getElementById('r4').style.display="none";
				document.getElementById('r5').style.display="none";
				document.getElementById('r6').style.display="none";
				document.getElementById('r7').style.display="none";
				document.getElementById('r2').style.display="block";
				document.getElementById('radio5').checked = true;
				document.getElementById('radio11').checked = false;
				document.getElementById('radio7').checked = false;
				document.getElementById('r1').style.display="none";
				document.getElementById('r3').style.display="block";
				document.getElementById('seca').style.display="block";
				document.getElementById('secb').style.display="none";
				document.getElementById('gp1').style.display="block";
				document.getElementById('gp2').style.display="block";
				document.getElementById('gp3').style.display="block";
				document.getElementById('gp4').style.display="block";
				document.getElementById('gp5').style.display="none";
				document.getElementById('gp6').style.display="none";
				break;
		case 2 :
				document.getElementById('r4').style.display="block";
				document.getElementById('r5').style.display="block";
				document.getElementById('r6').style.display="block";
				document.getElementById('r7').style.display="block";
				document.getElementById('radio5').checked = false;
				document.getElementById('radio11').checked = false;
				document.getElementById('radio7').checked = true;
				document.getElementById('r2').style.display="none";
				document.getElementById('r1').style.display="none";
				document.getElementById('r3').style.display="none";
				document.getElementById('seca').style.display="block";
				document.getElementById('secb').style.display="none";
				document.getElementById('gp1').style.display="block";
				document.getElementById('gp2').style.display="none";
				document.getElementById('gp3').style.display="none";
				document.getElementById('gp4').style.display="none";
				document.getElementById('gp5').style.display="none";
				document.getElementById('gp6').style.display="none";

				break;
		
	}
	
}
//get annee
function getAnnee(){
	var rates = document.getElementsByName('annee');
	var annee;
	for(var i = 0; i < rates.length; i++){
	  if(rates[i].checked){
		  annee = rates[i].value;
	  }
	}
	return annee;
  }
  
  //get spec
  function getSpec(){
	var rates = document.getElementsByName('spec');
  var spec;
  for(var i = 0; i < rates.length; i++){
	  if(rates[i].checked){
		  spec = rates[i].value;
	  }
  }
  return spec;
  }
  function getModul(){
	return $("#modselect option:selected" ).text();
  }
  
  //get section
  function getSec(){
	var rates = document.getElementsByName('section');
  var section;
  for(var i = 0; i < rates.length; i++){
	  if(rates[i].checked){
		  section = rates[i].value;
	  }
  }
  return section;
  }

  
  
  function Getgrps() {
			  //Create an Array.
			  var grp = new Array();
   
			  //Reference the CheckBoxes and insert the checked CheckBox value in Array.
			  $("#grpform input[type=checkbox]:checked").each(function () {
				  grp.push(this.value);
			  });
   
			  //Display the selected CheckBox values.
			  if (grp.length > 0) {
			      return grp;
			  }else{
			      return null;
			  }
			  
		  };

		  
// cheking if user logged in
function LoggedIn() {
	var check = false;
	$.ajax({
	    type: 'POST',
	    url: "backend/work.php",
	    async: false,
	    data: { test: 1},
	    beforeSend:function(){

	    	// disable scrolling
	    	$('html, body').css({
	    	    "overflow-y": 'hidden',
	    	    height: '100%'
	    	});

	    },  
	 error: function(){
	 	$('html, body').css({
	 	    "overflow-y": 'auto',
	 	    height: 'auto'
	 	});

	  	alert("error no connection");
	  	// redirect to loggin
	  	window.location.replace("../index.html");
	  	alert("redirect");
	 },     
	 success:function(data)
	 {
	 	if(data === "connected"){
	 		check = true;
	 	}else{
	 		// redirect to index page
	 		window.location.replace("../index.html");
	 		check = false;
	 	}
	 }
	});
	return check;
}

function LoadUserInfo() {
	$.ajax({
	    type: 'POST',
	    url: "backend/work.php",
	    data: { Page: 'userinfo'},
	    beforeSend:function(){

	    	// disable scrolling
	    	$('html, body').css({
	    	    "overflow-y": 'hidden',
	    	    height: '100%'
	    	});

	    },  
	 error: function(){
	 	$('html, body').css({
	 	    "overflow-y": 'auto',
	 	    height: 'auto'
	 	});

	  	alert("error no connection");
	 },     
	 success:function(data)
	 {
	 	$('.sidebar-heading').html(data);
	 }
	});
}

function MsgCount() {
	$.ajax({
	    type: 'POST',
	    async: false,
	    url: "backend/work.php",
	    data: { Page: "msgcount"},
	    beforeSend:function(){

	    	// disable scrolling
	    	$('html, body').css({
	    	    "overflow-y": 'hidden',
	    	    height: '100%'
	    	});

	    },  
	 error: function(){
	 	$('html, body').css({
	 	    "overflow-y": 'auto',
	 	    height: 'auto'
	 	});

	  	alert("error no connection");
	 },     
	 success:function(data)
	 {
	 	$('html, body').css({
	 	    "overflow-y": 'auto',
	 	    height: 'auto'
	 	});
	 	$("#count").text(data);
	 }
	});
}

// disconnect
$("#dc").click(function() {
	$.ajax({
	    type: 'POST',
	    async: false,
	    url: "backend/work.php",
	    data: { dc: 1},
	    beforeSend:function(){

	    	// disable scrolling
	    	$('html, body').css({
	    	    "overflow-y": 'hidden',
	    	    height: '100%'
	    	});

	    },  
	 error: function(){
	 	$('html, body').css({
	 	    "overflow-y": 'auto',
	 	    height: 'auto'
	 	});

	  	alert("error no connection");
	 },     
	 success:function(data)
	 {
	 	$('html, body').css({
	 	    "overflow-y": 'auto',
	 	    height: 'auto'
	 	});
	 	if(data === 'done'){
	 		window.location.replace("../index.html");
	 	}
	 }
	});
});

// loading stuff
$(document).ready(function () {
	
	if(LoggedIn()){
		$('#full-loader').hide();
		LoadUserInfo();
		MsgCount();
	}else{
		alert('not loggedin');
		window.location.replace("../index.html");
	}
});