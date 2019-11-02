
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
	MsgCount();
});
$("#settings").click(function() {
	var selectedpage = $(this).attr('name');
	$(".list-group-item").removeClass("active");
	loadContent(selectedpage);
	MsgCount();
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
	    url: 'backend/work.php',
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
	 }
	});
}

// cheking if user logged in
function LoggedIn() {
	var check = false;
	$.ajax({
	    type: 'POST',
	    url: 'backend/work.php',
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
	    url: 'backend/work.php',
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
	    url: 'backend/work.php',
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
	    url: 'backend/work.php',
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