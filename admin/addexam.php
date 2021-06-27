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
		$addQue = $exm->addExam($_POST);
	}
?>
<div class="main">
	<h1>Admin Panel - Add Exam</h1>
	<?php 
		if (isset($addQue)) {
			echo $addQue;
		}
	?>
	<div class="adminpanel">
		<form action="" method="post">
			<table>
				<tr>
					<td>Exam Type</td>
					<td>:</td>
					<td>
						<select name="examType" id="select" class="form-control">
							<option value="0">Select Exam Type</option>
							<option value="Unit Test I">Unit Test I</option>
							<option value="Term Test I">Term Test I</option>
							<option value="Unit Test II">Unit Test II</option>
							<option value="Term Test II">Term Test II</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Department</td>
					<td>:</td>
					<td>
						<select name="department" id="select" class="form-control">
							<option value="0">Select Department</option>
							<option value="Computer">Computer</option>
							<option value="IT">IT</option>
							<option value="ENTC">ENTC</option>
							<option value="Electrical">Electrical</option>
							<option value="Mechanical">Mechanical</option>
							<option value="Civil">Civil</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Exam Name</td>
					<td>:</td>
					<td><input type="text"  name="examName" placeholder="Enter Exam Name..." class="form-control" required></td>
				</tr>
				<tr>
					<td>No. of Question</td>
					<td>:</td>
					<td><input type="text"  name="moOfQue" placeholder="Enter No. of Question..." class="form-control" required></td>
				</tr>
				<tr>
					<td>Exam Time</td>
					<td>:</td>
					<td><input type="text" name="examTime" placeholder="Enter Time in Number Ex.(1) 1=1 Hr" class="form-control" required></td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<input type="submit" value="Add New Exam" class="btn btn-success">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php include 'inc/footer.php'; ?>