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
<div class = "forgot-container">
	<h2 class = "text-center">Forgot Password</h3>
	
	<hr/>
	
	<form id =  "forgot-form" method = "POST" action = "Forgot/getPassword">
		<input type = "email" id = "email" name = "email" placeholder = "Email" required = "required"/>
		<br>
		<select name = "security_questions" required = "required">
			<option value = "book">What Is your favorite book?</option>
			<option value = "hero">Who was your childhood hero?</option>
			<option value = "nickname">What was your childhood nickname?</option>
			<option value = "vacation">Where is your favorite place to vacation?</option>
			<option value = "school">What was the name of your elementary / primary school?</option>
			<option value = "growup">When you were young, what did you want to be when you grew up?</option>
		</select>
		<br>
		<input type = "text" id = "security_answer" name = "security_answer" placeholder = "Security Answer" required = "required" />
		<br>
		<input type = "submit" id = "submit" value = "Reset Password"></submit>
		
		<div id = "register">
			<span id = "register-span">Not registered? <a href = "<?=base_URL();?>index.php/Register">Create an account</a></span>
		</div>
		
		<div id = "back">
			<a href = "<?=base_URL();?>index.php/Login">Back</a>
		</div>
		
		<div id = "forgotPass">
		
		<?php 
		if (isset($_SESSION['password'])) 
		{ 
		?>
		Success! Your password is '<?php echo $_SESSION['password'] ?>'
		<?php } 
		unset($_SESSION['password']);
		?>
		</div>
		
		<div id = "errorPass">
		<?php
		if (isset($_SESSION['incorrect']))
		{
			echo $_SESSION['incorrect'];
		}
		unset($_SESSION['incorrect']);
		?>
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
</body>
</html>