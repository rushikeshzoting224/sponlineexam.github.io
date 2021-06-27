<?php include 'inc/header.php'; ?>
<?php
Session::checkSession();
$total = $exm->getTotalRows($_GET['examID']);
?>
<div class="main">
	<h1>All Question & Ans:<?php echo $total; ?></h1>
	<div class="viewans">
		<table id="DivIdToPrint"> 
			<?php 
			$getQues = $exm->getQueByOrder($_GET['examID']);
			if ($getQues) {
				$iCounter = 1;
				while ($question = $getQues->fetch_assoc()) {
					?>
					<tr>
						<td colspan="2">
							<h3><br>Que <?php echo $iCounter; ?>: <?php echo $question['ques']; ?></h3>
						</td>
					</tr>
					<?php 
					$number = $question['quesNo'];
					$answer = $exm->getAnswer($number,$_GET['examID']);
					if ($answer) {
						while ($result = $answer->fetch_assoc()) {
							?>
							<tr>
								<td>
									Ans -> 
									<?php 
									if ($result['rightAns'] == '1') {
										echo "<span style='color:#ff0000'>".$result['ans']."</span>"; 
									}else{
										echo $result['ans']; 
									}
									?>
									<br>
								</td>
							</tr>
						<?php }
					}
					$iCounter ++; 
				}
			} 
			?>
		</table>
		<br>
		<div class="row text-center col-12">
			<a href="exam.php" class="btn btn-primary" width="50%">GO BACK</a>&nbsp;&nbsp;
			<a href="#print" class="btn btn-info" width"50%" onclick='printDiv();'>Print Answer list</a>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
<script>
	function printDiv() 
	{
		var divToPrint=document.getElementById('DivIdToPrint');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();
		setTimeout(function(){newWin.close();},10);
	}
</script>