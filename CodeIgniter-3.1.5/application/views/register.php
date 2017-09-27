<!DOCTYPE HTML>
<html>
<head>
	<!-- Bootstrap -->
	<link href="<?=asset_url();?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="<?=asset_url();?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	
	<!-- Custom styling -->
    <link href="<?=asset_url();?>css/main.css" rel="stylesheet">
</head>
<body>
<div class = "register-container">
	<h2 class = "text-center">Register</h3>
	
	<hr/>
	
	<form id =  "login-form" method = "post" action = "Register/signUp">
		<input type = "text" id = "name" placeholder = "Name" name = "name" required = "required"/>
		<br/>
		<input type = "email" id = "email" placeholder = "Email" name = "email" required = "required" />
		<br/>
		<div id = "taken">
		<?php 
		if (isset($_SESSION['error'])) 
		{ 
			echo $_SESSION['error']; 
		} 
		unset($_SESSION['error']);
		?>
		</div>
		<input type = "password" id = "password" placeholder = "Password" name = "password" required = "true"/>
		<br/>
		<input type = "text" id = "phone" placeholder = "Phone Number" name = "phone"/>
		<br/>
		<select name = "security_questions" required = "required">
			<option value = "book">What is your favorite book?</option>
			<option value = "hero">Who was your childhood hero? </option>
			<option value = "nickname">What was your childhood nickname?</option>
			<option value = "vacation">Where is your favorite place to vacation?</option>
			<option value = "school">What was the name of your elementary / primary school?</option>
			<option value = "growup">When you were young, what did you want to be when you grew up?</option>
		</select>
		<br>
		<input type = "text" id = "security_answer" placeholder = "Security Answer" name = "security_answer" required = "required" />
		<br>
		<input type = "submit" id = "submit" value = "Register"></submit>

		<div id = "back">
			<a href = "<?=base_URL();?>index.php/Login">Back</a>
		</div>
	</form>
</div>

<!-- jQuery -->
<script src="<?=asset_url();?>vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?=asset_url();?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?=asset_url();?>vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?=asset_url();?>vendors/nprogress/nprogress.js"></script>
<!-- Input Mask -->
<script src="<?=asset_url();?>vendors/Inputmask/Inputmask/dist/inputmask/inputmask.js"></script>
	
<script>
var selector = document.getElementById("phone");

var im = new Inputmask("999-999-9999");
im.mask(selector);
</script>
</body>
</html>