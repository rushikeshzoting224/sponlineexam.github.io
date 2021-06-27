<?php
	include 'inc/header.php';
	Session::checkSession();
	$userid = Session::get("userid");
	$getDepartment = $usr->getUserData($userid);
	
	$dep = $getDepartment->fetch_assoc();
	$department = $dep['branch'];
	$csqli = new mysqli('localhost','root','','exam');
	$qry = "SELECT * FROM tbl_exam WHERE department='$department'";
	$getData = $csqli->query($qry);							
?>
<div class="main">
	<center><strong><?php echo $department; ?></strong></center>
	<h1>Welcome to Online Exam - Start Now</h1>
	<?php
		if(isset($_GET['error'])){
			echo '<span style="color:red">'.$_GET['error'].'</span>';
		}
	?>
	<div class="row">
		<div class="col-sm-6">
			<div class="segment" style="margin-right:30px;">
				<img src="img/online_exam.png"/>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="segment">
				<h2>Start Exam</h2>
				<ul>
					<form action="starttest.php">
						<div class="select" style="width:100%;">
							<select name="examID" id="examID">
								<option value="0">Choose an Exam</option>
								<?php
									while ($result = $getData->fetch_assoc()) {
										echo '<option value="'.$result['id'].'">'.$result['examName'].'</option>';
									}
								?>
							</select>
						</div>
						<br>
						<li><button class="btn btn-success">Start Now...</button></li>
					</form>
				</ul>
			</div>
		</div>
		
	</div>
	
	
</div>
<?php include 'inc/footer.php'; ?>