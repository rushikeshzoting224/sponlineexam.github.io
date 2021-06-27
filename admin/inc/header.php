<?php 
	
    include_once ("../lib/Session.php");
    Session::checkAdminSession();
    include_once ("../lib/Database.php");
    include_once ("../helpers/Format.php");
	$db  = new Database();
	$fm  = new Format();
	
?>


<?php
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: pre-check=0, post-check=0, max-age=0"); 
	header("Pragma: no-cache"); 
	header("Expires: Mon, 6 Dec 1977 00:00:00 GMT"); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
?>
<!doctype html>
<html>
	<head>
		<title>Admin</title>
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
		<link rel="stylesheet" href="css/admin.css">
		<link rel="stylesheet" href="../css/custom.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	</head>
	<body>
		<div class="phpcoding">
			<section class="headeroption"></section>
			
			<section class="maincontent"> 	  	
				
				<center>
					<h3 class="text-center">
						<img src="../img/logo.png" width="100" height="90" border="0" alt="" class="pull-left"/>
						&nbsp; &nbsp; &nbsp;Sandip Foundation's Sandip Polytechnic&nbsp; &nbsp; &nbsp; 
						<img src="../img/logo2.png" width="100" height="50" border="0" alt="" class="pull-right"/>
					</h3><hr>
				</center>
				<div class="menu">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="users.php">Manage User</a></li>
						<li><a href="addexam.php">Add New Exam</a></li>
						<li><a href="examlist.php">Exams List</a></li>
						<li><a href="login.php?action=logout">Logout</a></li>
					</ul>
				</div>
						