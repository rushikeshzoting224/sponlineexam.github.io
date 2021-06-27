<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
include_once ($filepath.'/../classes/Exam.php');
$exm = new Exam();
?>
<style>
.adminpanel{width: 100%;color: #999;margin: 20px auto 0;padding: 30px;border: 1px solid #ddd;}	
</style>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$_POST['examID'] = $_GET['examID'];
	$addQue = $exm->addQuestions($_POST);
}
	//Get Total
$total = $exm->getTotalRows($_GET['examID']);
$examQry = $exm->commonGetData('tbl_exam',"id=$_GET[examID]");
$examData = $examQry->fetch_assoc();


$next = $total+1;
if($next > $examData['moOfQue']){
	header("location:examlist.php");
	$_SESSION['addQusExeed'] = "";
	exit;
}
?>
 
<div class="main">
	<h1>Admin Panel - Add Question</h1>
	<?php 
	if (isset($addQue)) {
		echo $addQue;
	}
	?>
	<div class="adminpanel">
	    <div class="row">
		<div class="exam-info col-6">
			<p><b>Exam </b>: <?php echo $examData['examName']; ?></p>
			<p><b>No. of Question </b>: <?php echo $examData['moOfQue']; ?></p>
			<p><b>Time Period </b>: <?php echo $examData['examTime'] <=5 ? $examData['examTime'].' Hours' : $examData['examTime'].' Minutes'  ?></p>
		</div>
		
		<div class="col-6">
		    <p>Note: Please Do not use following keys while adding any quetions and ans please.<br>
		    Ex.:-(&lt;, &gt;, &lt;!-- --&gt; ,&lt;?php  ?&gt;,&lt;? , ?&gt;)<br>
		    <a href="https://www.whatsmyip.org/html-characters/" target="_blank">Click to See Replacement Entity Code or Number for this symbols.</a>
		    </p> 
		</div>
		</div>
		<hr>
		<br>
		<form action="" method="post">
			<input type="hidden" name="examID" value="<?php echo $_GET['examID']; ?>">
			<table>
				<tr>
					<td>Question No</td>
					<td>:</td>
					<td><input readonly type="number" value="<?php 
					if(isset($next)){
						echo $next;
					}
					?>"  name="quesNo"></td>
				</tr>
				<tr>
					<td>Question</td>
					<td>:</td>
					<td><input type="text"  name="ques" placeholder="Enter Question..." required></td>
				</tr>
				<tr>
					<td>Choice One</td>
					<td>:</td>
					<td><input type="text"  name="ans1" placeholder="Enter Option 1..." required></td>
				</tr>
				<tr>
					<td>Choice Two</td>
					<td>:</td>
					<td><input type="text"  name="ans2" placeholder="Enter Option 2..." required></td>
				</tr>
				<tr>
					<td>Choice Three</td>
					<td>:</td>
					<td><input type="text"  name="ans3" placeholder="Enter Option 3..." required></td>
				</tr>
				<tr>
					<td>Choice Four</td>
					<td>:</td>
					<td><input type="text"  name="ans4" placeholder="Enter Option 4..." required></td>
				</tr>
				<tr>
					<td>Correct No.</td>
					<td>:</td>
					<td><input type="number"  name="rightAns" required min="1" max="4" ></td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<input type="submit" value="Add A Question" class="btn btn-success">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php include 'inc/footer.php'; ?>