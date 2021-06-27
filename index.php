<?php include 'inc/header.php'; ?>
<?php
	Session::checkLogin();
?>
<div class="main">
	<h1>Online Exam - Student Login</h1>
	<!--<div class="segment">
		<img src="img/test.png"/>
	</div>-->
	<center>
	<div class="logins">
		<form action="" method="post">
			
			<div class="col-md-12">
				<label>
					<i class="fa fa-user"></i> <input name="email" type="text" id="email" placeholder="Enter Email">
				</label>
		
				<label>
					<i class="fa fa-lock"></i> <input name="password" type="password" id="password" placeholder="Enter Password">
				</label>
			</div>
			<div class="col-md-12 text-center">
				
				<input type="submit" id="loginsubmit" value="Login" class="btn btn-lg btn-pink">	
			</div>
		</form>
		<p><br>Don't Have Account <a href="register.php">Register Now</a></p>
		<span class="empty" style="display: none;">Field must not be empty !</span>
		<span class="error" style="display: none;">Email or Password not matched !</span>
		<span class="disable" style="display: none;">User Id disabled !</span>
		
	</div>
	</center>
</div>
<div class="clearfix col-md-12 text-center">
	
	
</div>
<?php include 'inc/footer.php'; ?>