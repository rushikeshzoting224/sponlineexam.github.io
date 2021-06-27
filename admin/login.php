<?php 
    
    $filepath = realpath(dirname(__FILE__));
	
	include_once("../lib/Session.php");
	Session::checkAdminLogin();
	
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: pre-check=0, post-check=0, max-age=0"); 
	header("Pragma: no-cache"); 
	header("Expires: Mon, 6 Dec 1977 00:00:00 GMT"); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

	include_once ($filepath.'/../classes/Admin.php');
	$ad = new Admin();
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$adminData = $ad->getAdminData($_POST);
	}
	
?>
<?php 
	if (isset($_GET['action']) && $_GET['action'] == 'logout') {
		Session::destroy();
		header("Location:login.php");
		exit();
	}
?>
<!doctype html>
<html>
	<head>
		<title>Login</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="no-cache">
		<meta http-equiv="Expires" content="-1">
		<meta http-equiv="Cache-Control" content="no-cache">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		
		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="css/login.css">
		<link rel="stylesheet" href="../css/custom.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class="phpcoding">
			
			
			<section class="maincontent">
				
				<div class="main">
					
					<div class="logo">
						<img src="../img/logo.png" width="80" height="80" border="0" alt=""  class="pull-left"/>
						<img src="../img/logo2.png" width="100" height="50" border="0" alt="" class="pull-right" style="margin-top:10px;"/>
					</div>
					
					<div class="adminlogin">
						<form action="" method="post">
							<br>
							<br>
							<br>
							<br>
							<h1>Admin Login</h1>
							<div class="col-md-12">
								<label>
									<i class="fa fa-user"></i> <input type="text" name="adminUser"/>
								</label>
								<br>
								<label>
									<i class="fa fa-lock"></i> <input type="password" name="adminPass"/>
								</label>
							</div>
							<div class="col-md-12">
								<br>
								<a href="../" class="btn btn-info"><i class="fa fa-arrow-left"> </i> Go Back</a>
								
								<input type="submit" name="login" value="Login" class="btn btn-pink"/>
								
							</div>
							<div>		
								<?php 
									if (isset($adminData)) {
										echo $adminData;
									}
								?>
							</div>
						</form>
					</div>
				</div>
				
			</section>
			
		</div>
		<script src="../click.js"></script>
		
	</body>
</html>