<?php include 'inc/header.php'; ?>
<div class="main">
	<h1>Online Exam System - User Registration</h1>
	
	<div class="segment">
		
			<form action="" method="post" width="100%">
				
				<div class="col-sm-12 clearfix">
					<label>
						<span>Name</span> 
						<input type="text" name="name" id="name" placeholder="Enter User Name">
					</label>
					
					
					<label>
						<span>Branch</span> 
						<div class="select">
							<select name="branch" id="branch" class="form-control">
								<option value="SelectBranch">Select Branch</option>
								<option value="Computer">Computer</option>
								<option value="IT">IT</option>
								<option value="ENTC">ENTC</option>
								<option value="Electrical">Electrical</option>
								<option value="Mechanical">Mechanical</option>
								<option value="Civil">Civil</option>
							</select>
						</div>
					</label>
					
					<label><span>Enrollment</span> <input name="username" type="text" id="username"placeholder="Enter Roll No"></label>
					
					<label><span>Password</span> <input type="password" name="password" id="password"placeholder="Enter Password"></label>
					
					<label><span>E-mail</span> <input name="email" type="email" id="email" placeholder="Enter Email"></label>
				</div>
				<div class="text-center col-sm-12">
					<input type="submit" id="regsubmit" value="Signup" class="btn btn-pink">
				</div>
				
			</form>
	</div>
	
	
</div>


<span id="state"></span>
<div class="clearfix col-md-12 text-center">
	
	<p><br>Already Have Registered ? <a href="index.php">Login</a> Here</p>
</div>
<?php include 'inc/footer.php'; ?>