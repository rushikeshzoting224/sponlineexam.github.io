<?php
	include 'inc/header.php';
	include_once ('lib/Database.php');
	//unset($_SESSION['timeSession']);
	if(!isset($_SESSION['timeSession'])){
		$tm = $_GET['exmTime'];
		if($tm <= 5)
		$finTime = $tm * 60;
		else
		$finTime = $tm;
		
		$_SESSION['timeSession'] = date('H:i:s',strtotime("+".$finTime." minutes"));
	}
	
	if (isset($_GET['q'])) {
		$number = (int) $_GET['q'];
		}else{
		header("Location:exam.php");
	}
	
	$total = $exm->getTotalRows($_GET['examID']);
	$question = $exm->getQuesByNumber($number,$_GET['examID']);
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$process = $pro->processData($_POST);
	}
	
	
?>

<div class="main">
	<h1>Question <?php echo $question['quesNo']; ?> of <?php echo $total; ?></h1>
	<div class="test">
		<form method="post" action="">
			<table> 
				<tr>
					<td colspan="2">
						<h3>Que <?php echo $question['quesNo']; ?>: <?php echo $question['ques']; ?></h3>
					</td>
				</tr>
				<?php 
					$answer = $exm->getAnswer($number,$_GET['examID']);
					if ($answer) {
						while ($result = $answer->fetch_assoc()) {
						?>
						<tr>
							<td>
								<input type="radio" name="ans" value="<?php echo $result['id']; ?>" id="<?php echo $result['id']; ?>" /><label for="<?php echo $result['id']; ?>"><?php echo $result['ans']; ?></label>
							</td>
						</tr>
					<?php }} ?>
					<tr>
						<td>
						    <br>
							<input class="btn btn-danger" type="submit" name="submit" value="Next Question" style="padding:6px 10px;"/>
							<?php
								if(isset($_GET['q'])){
									if($_GET['q'] > 1){
										echo '<a onclick="window.history.back()" class="btn btn-success" Question" style="padding:6px 10px;margin:0;color:#fff;"/>Back</a>';
									}
								}
								
								echo '<div class="clearfix sub-btn" id="chnge">';
								
								for($i = 1; $i <= $total; $i++){
									echo '<li><a href="test.php?examID='.$_GET['examID'].'&q='.$i.'" class="btn btn-success btn-number">'.$i.'</a></li>';
								}
								
								echo '</div>';
							?>
							<input type="hidden" name="number" value="<?php echo $number; ?>" />
							<input type="hidden" name="examID" value="<?php echo $_GET['examID']; ?>" />
							<input type="hidden" name="userID" value="<?php echo $_SESSION['userid']; ?>" />
						</td>
					</tr>
			</table>
		</form>
	</div>
</div>


<script src="allkey.js"></script>

<script>
	var dt = new Date();
	dt = dt.toString();
	dt = dt.split(" ");
	
	let tStr = dt[1]+" "+dt[2]+", "+dt[3]+" "+ <?php echo json_encode($_SESSION['timeSession']); ?>;
	// Set the date we're counting down to
	var countDownDate = new Date(tStr).getTime();
	// Update the count down every 1 second
	var x = setInterval(function() {
		// Get today's date and time
		var now = new Date().getTime();
		// Find the distance between now and the count down date
		var distance = countDownDate - now;
		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		// Output the result in an element with id="demo"
		// document.getElementById("demo").innerHTML = days + "d " + hours + "h "
		document.getElementById("demo").innerHTML = hours + "h "
		+ minutes + "m " + seconds + "s ";
		// If the count down is over, write some text 
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("demo").innerHTML = "Your Result Will Show Now Thank You !!!";
			window.location.href = 'http://localhost/exam/final.php?examID='+ <?php echo json_encode($_GET['examID']); ?>;
		}
	}, 1000);
</script>

<?php include 'inc/footer.php'; ?>