
<DOCTYPE html>
<html>
    <head>
      <title>John's Music Library</title>
      <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

		<script>
	
	// setup for facebook login
	window.fbAsyncInit = function() {
    FB.init({
      appId      : '257544151249706',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

	function fbLogin(){
		// already logged in, should log out
		if (localStorage.getItem("login") === "true"){
			localStorage.setItem("login", "false");
			document.getElementById("login").innerHTML = "Log In with Facebook";
			document.getElementById("loginButton").innerHTML = "Log In";
			document.getElementById("loginHeader").innerHTML = "Log In:";
		}
		
		//not logged in, try to log in
		else {
    		FB.getLoginStatus(function(response) {
      		if (response.status === 'connected') {
				localStorage.setItem("login", "true");
				document.getElementById("login").innerHTML = "Log Out";
				document.getElementById("loginButton").innerHTML = "Log Out";
				document.getElementById("loginHeader").innerHTML = "Log Out:";
			}
      		else {
        		FB.login();
			}
    		});	
		}
	}
	
	</script>
		
      <link href='https://fonts.googleapis.com/css?family=Viga' rel='stylesheet' type='text/css'>
      <link href="style.css" media="all" rel="stylesheet" type="text/css">
		
    </head>
    
<body>
		  
	<header>
     	<div>
            <button class="button" >This is behind the nav bar</button>
        </div>
          
        </br>
          
   		<div id="navBar">
          	<button id="titleButton" class="borderlessButton" onclick="location.href='./index.php'">John's Music Library</button>
     
          	<button class="button" 
				  onclick="location.href='?controller=artists&action=see'">Browse Artists</button>
	   
          	<button class="button" 
				  onclick="location.href='?controller=artists&action=add'">Add Artist</button>
	   
          	<button class="button" 
				  onclick="location.href='?controller=artists&action=update'">Edit Artist</button>
	   
          	<button class="button" 
				  onclick="location.href='?controller=artists&action=delete'">Delete Artist</button>
     
          	<button id="loginButton" class="borderlessbutton" onclick="location.href='?controller=pages&action=login'"></button>
	   		<script>
			// put the correct word in the login button
			if(localStorage.getItem("login") === "true"){
				document.getElementById("loginButton").innerHTML = "Log Out";
			}
			else {
				document.getElementById("loginButton").innerHTML = "Log In";
			}	
			</script>
        </div>
       
	</header>
        
	<?php require_once('routes.php'); ?>
</body>
<html>


