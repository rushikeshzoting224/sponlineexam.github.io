<?php
	if(!isset($_GET['examID']) || $_GET['examID'] == 0){
		header("location:exam.php?error=Please select exam first");
		exit;
	}
	include 'inc/header.php';
	Session::checkSession();
	if($_GET['examID']){
		if($exm->isExamDoneAlready($_SESSION['userid'],$_GET['examID'])){
			header("location:final.php?examID=$_GET[examID]");
			exit;
		}
	}
	$question = $exm->getQuestion($_GET['examID']);
	$total = $exm->getTotalRows($_GET['examID']);
	
	$getData = $exm->commonGetData("tbl_exam","id='$_GET[examID]'");
	$result = $getData->fetch_assoc()
?>
<div class="main">
	<h1>Welcome to Online Exam</h1>
	<div class="starttest">
		<h2>Test your knowledge</h2>
		<p>This is multiple choice quiz to test your knowledge</p>
		<ul>
			<li><strong>Number of Questions:</strong> <?php echo $result['moOfQue']; ?></li>
			<li><strong>Question Type:</strong> Multiple Choice</li>
			<li><strong>Exam Time:</strong> <?php echo $result['examTime'] <= 5 ? $result['examTime'].' Hours' : $result['examTime'].' Minutes' ; ?></li>
		</ul>
		<a href="#" onclick="startTest()">Start Test</a>
	</div>
</div>

<script>
	function startTest(){
		window.history.back();
		window.open('test.php?exmTime=<?php echo $result['examTime']; ?>&session=start&examID=<?php echo $_GET['examID'] ?>&q=<?php echo $question['quesNo']; ?>','newwindow','fullscreen,width=max-width,height=auto,toolbar=no,scrollbars=no,resizable=no');
	}
</script>
<?php include 'inc/footer.php'; ?>