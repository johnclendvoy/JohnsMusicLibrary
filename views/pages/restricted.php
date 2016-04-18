<h1>You must be logged in to use that feature.</h1>

<div class="container">
  <button id="login" class="button" onclick="fbLogin()"></button>
	<script>
		// display yhe correct words on the button
		if(localStorage.getItem("login") === "true"){
			document.getElementById("login").innerHTML = "Log Out";
		}
		else {
			document.getElementById("login").innerHTML = "Log In With Facebook";
		}
	</script>
</div>