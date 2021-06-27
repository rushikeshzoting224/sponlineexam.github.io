<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Exam.php');
	$exm = new Exam();
?>
<?php 
	if (isset($_GET['delque'])) {
		$quesno = (int)$_GET['delque'];
		$delQue = $exm->delQuestion($_GET['examID'],$quesno);
	}
	$examData = $exm->commonGetData("tbl_exam","id=$_GET[examID]");
	$examData = $examData->fetch_assoc();
?>
<div class="main">
	<h1><?php echo $examData['examName']; ?></h1>
	<?php 
		if (isset($delQue)) {
			echo $delQue;
		}
	?>
	<div class="quelist">
		<table class="tblone table-bordered table"  id="dataTable">
			<thead>
				<tr>
					<th width="10%">No</th>
					<th width="70%">Questions</th>
					<th width="20%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$getData = $exm->getQueByOrder($_GET['examID']);
					if ($getData) {
						$i = 0;
						while ($result = $getData->fetch_assoc()) {
							$i++;
						?>
						<tr>
							<td class="text-center"><?php echo $i; ?></td>
							<td><?php echo $result['ques']; ?></td>
							<td class="text-center">
								<a onclick="return confirm('Are You Sure to Remove')" href="?examID=<?php echo $_GET['examID'] ?>&delque=<?php echo $result['quesNo'];?>">Remove</a>
							</td>
						</tr>
					<?php  }} ?>
			</table>
		</tbody>
	</div>
</div>
<?php include 'inc/footer.php'; ?>