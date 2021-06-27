<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Exam.php');
	$exm = new Exam();
	if(isset($_SESSION['addQusExeed'])){
		echo '<script type="text/javascript">alert("You completed the no of question that can be added to this exam")</script>';
		unset($_SESSION['addQusExeed']);
	}
?>
<?php 
	
	if (isset($_GET['dis'])) {
		$dblid = (int)$_GET['dis'];
		$dblUser = $usr->disableUser($dblid);
	}
	
	if (isset($_GET['status'])) {
		$id = $_GET['id'];
		$val = $_GET['val'];
		$eblUser = $exm->commonActivation("tbl_exam",$val,"id=$id");
	}
	
	if (isset($_GET['del'])) {
		$ebllid = $_GET['id'];
		$eblUser = $exm->commonDelete("tbl_exam","$ebllid");
		if($eblUser){
			$msg = "Record Deleted";
		}
	}
	
	
?>

<div class="main">
	<h1>Admin Panel - Exam List</h1>
	
	<?php 
		if (isset($delExam)) {
			echo $delQue;
		}
	?>
	
	<div class="quelist table-responsive">
		<table class="tblone table-bordered table"  id="dataTable">
			<thead>
				<tr>
					<th>No</th>
					<th>Exam Type</th>
					<th>Department</th>
					<th>Exam Name</th>
					<th>Date</th>
					<th>Action</th>
					<th>Status</th>
					<th>Result</th>
				</tr>
				</thead>
				<tbody>
				<?php 
					if(isset($msg)){
						echo $msg;
					}
					$getData = $exm->commonGetData("tbl_exam");
					if ($getData) {
						$i = 0;
						while ($result = $getData->fetch_assoc()) {
							$i++;
							
						?>
						<tr>
							<td class="text-center"><?php echo $i; ?></td>
							<td><?php echo $result['examType']; ?></td>
							<td><?php echo $result['department']; ?></td>
							<td><?php echo $result['examName']; ?></td>
							<td><?php echo $result['dateAdded']; ?></td>
							<td class="text-center">
							<a href="quesadd.php?examID=<?php echo $result['id'];?>" class="btn btn-warning"><i class="fa fa-edit" style="color:#fff;"></i></a>
							<a href="queslist.php?examID=<?php echo $result['id'];?>" class="btn btn-info"><i class="fa fa-eye" style="color:#fff;"></i></a>
							<a href="examlist.php?del=true&id='<?php echo $result['id'] ?>'"  onclick="return confirm('Are You Sure to Remove')" class="btn btn-danger"><i class="fa fa-trash" style="color:#fff;"></i></a>
						</td>
						<td class="status text-center"><a href="examlist.php?status=true&id=<?php echo $result['id'] ?>&val=<?php echo $result['status'] ?>" class="btn <?php echo $result['status'] == 0 ? "btn-info" : "btn-danger ";?>" style="color:#fff;"><?php echo $result['status'] == 0 ? "Activate" : "Deactivate ";?></a></td>
						<td class="status text-center"><a href="results.php?examID=<?php echo $result['id'];?>" class="btn btn-success" style="color:#fff;">Check</a></td>
					</tr>
					
				<?php  }} ?>
			</tbody>
		</table>
		
	</div>
	
	
</div>
<?php include 'inc/footer.php'; ?>