<!DOCTYPE html>
<html>
<head>
	<meta name="google-signin-client_id" content="186518999735-847nsioj8rqjqokuttdpv8aou7elesol.apps.googleusercontent.com">
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script type="text/javascript">
		function onSignIn(googleUser) {
			alert("Khupach");
		  	var profile = googleUser.getBasicProfile();
		  	console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
		  	console.log('Name: ' + profile.getName());
		  	console.log('Image URL: ' + profile.getImageUrl());
	  		console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.	
}
</script>

	<title></title>
</head>
<body>


<div class="g-signin2" data-onsuccess="onSignIn"></div>


</body>
</html>