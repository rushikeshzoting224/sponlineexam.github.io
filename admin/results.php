<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Exam.php');
	$exm = new Exam();
	if(isset($_GET['examID'])){
		$exmQ = $exm->commonGetData("tbl_exam","id=$_GET[examID]");
		$exmDataArr = $exmQ->fetch_assoc();
	}
?>
<div class="main">
	<h1><?php echo isset($_GET['examID']) ? '<strong>'.$exmDataArr['examName'].'</strong> Results' : 'All Exam Results'; ?></h1>
	<div class="quelist">
		<table class="tblone table-bordered table" id="dataTable">
			<thead>
				<tr>
					<th width="10%">No</th>
					<?php if(!isset($_GET['examID'])){ echo '<th width="20%">Exam</th>';}  ?>
					<th width="20%">User ID</th>
					<th width="20%">User Name</th>
					<th width="15%">Date</th>
					<th width="20%">Email Id</th>
					<th width="10%">Score</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if(isset($_GET['examID'])){
						$getData = $exm->commonGetData("tbl_comp_exam","examID=$_GET[examID]");
					}
					else{
						$getData = $exm->commonGetData("tbl_comp_exam");
					}
					if (!empty($getData) && mysqli_num_rows($getData) > 0){
						$i = 0;
						while ($result = $getData->fetch_assoc()) {
							$subQry = $exm->commonGetData("tbl_user","userid=$result[userID]");
							$subData = $subQry->fetch_assoc();
							$exmQry = $exm->commonGetData("tbl_exam","id=$result[examID]");
							$exmData = $exmQry->fetch_assoc();
							$i++;
						?>
						<tr>
							<td class="text-center"><?php echo $i; ?></td>
							<?php if(!isset($_GET['examID'])){ echo '<td class="text-center">'.$exmData['examName'].'</td>';}  ?>
							<td class="text-center"><?php echo $subData['username']; ?></td>
							<td class="text-center"><?php echo $subData['name']; ?></td>
							<td class="text-center"><?php echo $result['dateAdded']; ?></td>
							<td class="text-center"><?php echo $subData['email']; ?></td>
							<td class="text-center"><?php echo $result['givenAns']; ?></td>
						</tr>
						<?php  }
						}else{
						echo '<tr><td style="text-align:center; color:red" colspan="6">No data found.</td></tr>';
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php include 'inc/footer.php'; ?>