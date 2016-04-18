<h1 id="loginHeader">Please Log In</h1>

<div class="container">
  <button id="login" class="button" onclick="fbLogin()"></button>
	<script>
		// display yhe correct words on the button
		if(localStorage.getItem("login") === "true"){
			document.getElementById("login").innerHTML = "Log Out";
			document.getElementById("loginHeader").innerHTML = "Log Out:";
		}
		else {
			document.getElementById("login").innerHTML = "Log In With Facebook";
			document.getElementById("loginHeader").innerHTML = "Log In:";
		}
	</script>
</div>