<?php
	date_default_timezone_set("Asia/Calcutta");
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	Session::init();
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});
	$db = new Database();
	$fm = new Format();
	$usr = new User();
	$exm = new Exam();
	$pro = new Process();
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: pre-check=0, post-check=0, max-age=0"); 
	header("Pragma: no-cache"); 
	header("Expires: Mon, 6 Dec 1977 00:00:00 GMT"); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
?>
<!doctype html>
<html>
	<head>
		<title>Online Exam System</title>
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
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="js/jquery.js"></script>
		<script src="js/main.js"></script>
	</head>
	<body>
		
		<?php 
			if (isset($_GET['action']) && $_GET['action'] == 'logout') {
				Session::destroy();
				header("Location:index.php");
				exit();
			}
		?>
		<div class="phpcoding">
			<section class="maincontent">
				
				<div class="logo">
					<img src="img/logo.png" width="80" height="80" border="0" alt=""  class="pull-left"/>
						
					<img src="img/logo2.png" width="100" height="50" border="0" alt="" class="pull-right" style="margin-top:10px;"/>
				</div>
				<hr>
				<div class="menu">
					<ul>
						<?php
							$login = Session::get("login");
							if ($login == true) {
								if(!isset($_GET['examID']) && !isset($_GET['q'])){
								?>
								<li><a href="profile.php">Profile</a></li>
								<li><a href="exam.php">Exam</a></li>
							<?php } ?>
							<li><a href="?action=logout">Logout</a></li>
							<?php } else { ?>
							<li><a href="admin">Admin</a></li>
							<li><a href="register.php">Register</a></li>
							<li><a href="index.php">Login</a></li>
						<?php } ?>
					</ul>
					<?php
						$login = Session::get("login");
						if ($login == true) {?>
						<span style="float: right;color: #888;">
							Welcome <strong><?php echo Session::get('name') ; ?></strong>
							</span>
						<p id="demo"></p>
					<?php } ?>
				</div>
						