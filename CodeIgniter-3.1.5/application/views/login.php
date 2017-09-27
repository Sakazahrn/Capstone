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
<div class = "login-container">
	<h2 class = "text-center">Login</h3>
	
	<hr/>
	
	<form id =  "login-form" method = "post" action = "Login/Auth">
		<input type = "email" id = "email" name = "email" placeholder = "Email" required = "required"/>
		<br>
		<input type = "password" id = "password" name = "password" placeholder = "Password" required = "required" />
		<br>
		<input type = "submit" id = "submit" value = "Login" required = "required"></submit>
		
		<div id = "register">
			<span id = "register-span">Not registered? <a href = "<?=base_URL();?>index.php/Register">Create an account</a></span>
		</div>
		
		<div id = "forgot">
			<a href = "<?=base_URL();?>index.php/Forgot">Forgot Password</a>
		</div>
		
		<div id = "error">
		<?php 
		if (isset($_SESSION['error'])) 
		{ 
			echo $_SESSION['error'];
		} 
		unset($_SESSION['error']);
		?>
		</div>
		
		<div id = "success">
		<?php 
		if (isset($_SESSION['msg'])) 
		{ 
			echo $_SESSION['msg']; 
		} 
		unset($_SESSION['msg']);
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