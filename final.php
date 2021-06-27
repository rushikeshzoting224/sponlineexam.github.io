<?php include 'inc/header.php'; ?>
<?php
	Session::checkSession();
	unset($_SESSION['timeSession']);
?>

<div class="main">
	<h1>You are done!</h1>
	
	<div class="starttest">
		<p>Congrats! 
			<?php
				if(isset($_SESSION['score']))
				echo 'You have just competed the test.';
				else
				echo 'You already attended this exam.';
			?>
		</p>
		
		<p>Final Score Will Be Sent To Mail !!!!
			
			<?php 
				if (isset($_SESSION['score'])) {
					unset($_SESSION['score']);
				}
				if(isset($_GET['examID'])){
					$usrData = $exm->commonGetData("tbl_user","userid=$_SESSION[userid]");
					$uarResesData = $usrData->fetch_assoc();
					
					$data = $exm->commonGetData("tbl_comp_exam","userID=$_SESSION[userid] AND examID=$_GET[examID]");
					$resData = $data->fetch_assoc();
					
					// To Show Score Remove Comment From Below Echo line
					//echo $resData['givenAns'];

					if($resData['isMailed'] == 0){
						$from = 'info@padhiyarithub.com';
						$mailto = $uarResesData['email'];
						$subject = "Exam Result";
						
						$message_body = '<html>
						<head>
						<title>Exam Result</title>
						</head>
						<body>
						<p>This email contains your exam result</p>
						<table border=1>
						<caption>
						<p>Your Exam Result</p>
						</caption>
						<thead>
						<tr>
						<th scope="col">Name</th>
						<th scope="col">Score</th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<td>Attempted Qutions</td>
						<td>'.$resData['noQuesDone'].'</td>
						</tr>
						<tr>
						<td>Total Score</td>
						<td>'.$resData['givenAns'].'</td>
						</tr>
						
						</tbody>
						</table>
						</body>
						</html>';
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1'. "\r\n";
						$headers .= 'To:'.$mailto."\r\n";
						$headers .= 'From:'.$from."\r\n";
						$headers .= 'Cc:'.$from."\r\n";
						$headers .= 'Bcc:'.$from."\r\n";
						
						/* if(mail($mailto, $subject, $message_body,$headers)){
							echo '<br> >> Email with your score is sent to your email, Thank you.';
							$exm->commonUpdate("tbl_comp_exam","isMailed=1","userID=$_SESSION[userid] AND examID=$_GET[examID]");
							}else{
							echo 'Mail Error';
						} */
					}
					
				}
			?>
			
		</p>
		
		<a href="viewans.php?examID=<?php echo $_GET['examID'] ?>">View Ans</a>
		<a href="exam.php">Go Back</a>
	</div>
	
</div>

<script src="allkey.js"></script>

<?php include 'inc/footer.php'; ?>