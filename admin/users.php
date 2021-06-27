<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/User.php');
	$usr = new User();
?>
<?php 
	if (isset($_GET['dis'])) {
		$dblid = (int)$_GET['dis'];
		$dblUser = $usr->disableUser($dblid);
	}
	
	if (isset($_GET['ena'])) {
		$ebllid = (int)$_GET['ena'];
		$eblUser = $usr->enableUser($ebllid);
	}
	
	if (isset($_GET['del'])) {
		$delid = (int)$_GET['del'];
		$delUser = $usr->deleteUser($delid);
	}
	
	
?>

<div class="main">
	
	<div style="float:right;">
		<a href="import" target="_blank" class="btn btn-info">Add Users</a>
	</div>
	<h1>Admin Panel - Manage User</h1> <br>
	
	<?php 
		if (isset($dblUser)) {
			echo $dblUser;
		}
		
		if (isset($eblUser)) {
			echo $eblUser;
		}
		
		if (isset($delUser)) {
			echo $delUser;
		}
		
	?>
	
	
	<div class="manageuser">
		<table class="tblone table table-bordered"  id="dataTable">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Branch</th>
					<th>Enrolment</th>
					<th>Email</th>
					<th>Password</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$userData = $usr->getAllUser();
					if ($userData) {
						$i = 0;
						while ($result = $userData->fetch_assoc()) {
							$i++;
							
						?>
						<tr>
							<td class="text-center"><?php 
								if ($result['status'] == '1') {
									echo "<span class='error'>".$i."</span>"; 
									
									}else{
									echo $i;
								}
								
								
							?></td>
							<td><?php echo $result['name'] ; ?></td>
							<td><?php echo $result['branch'] ; ?></td>
							<td><?php echo $result['username'] ; ?></td>
							<td><?php echo $result['email'] ; ?></td>
							<td><?php echo $result['password'] ; ?></td>
							<td class="text-center">
								
								<?php
									if ($result['status'] == '0') { ?>
									<a class="btn btn-danger" style="color:#fff;" onclick="return confirm('Are You Sure to Disable')" href="?dis=<?php echo $result['userid'];?>">Disable</a>
									<?php } else{ ?>
									<a class="btn btn-info" style="color:#fff;" onclick="return confirm('Are You Sure to Enable')" href="?ena=<?php echo $result['userid'];?>">Enable</a>
								<?php }?>
							</td>
							<td  class="text-center">
								<a class="btn btn-danger" style="color:#fff;" onclick="return confirm('Are You Sure to Remove')" href="?del=<?php echo $result['userid'];?>">Remove</a>
							</td>
							
						</tr>
						
					<?php }} ?>
			</tbody>
		</table>
		<br>
	</div>
	
</div>
<?php include 'inc/footer.php'; ?>