<?php
	$conn = mysqli_connect("localhost","root","","exam");
	
	if(isset($_POST["submit"]))
	{
		$filename=$_FILES["file"]["tmp_name"];
		if($_FILES["file"]["size"] > 0)
		{
			$file = fopen($filename, "r");
			while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
			{	
				//print_r($emapData);
				$qry = "SELECT * FROM tbl_user WHERE username='$emapData[2]' AND email='$emapData[4]'";
				$res = mysqli_query($conn,$qry);
				$count = mysqli_num_rows($res);
				
				// Here if conditon is true query run or else error message
				if($count<1){
					$sql = "INSERT INTO tbl_user(name, branch, username, password, email) values ('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]')";
					//print_r($sql);
					//exit();
					mysqli_query($conn,$sql);
				}
				else{
					echo " ";
				}
			}
			fclose($file);
			
			echo "<link href='https://fonts.googleapis.com/css?family=Pacifico|Open+Sans:400,300,700' rel='stylesheet' type='text/css'>";
			echo "<link href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'  rel='stylesheet'  type='text/css'>";
			echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js\"></script>";
			echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js\"></script>";
			echo "<script>
			window.onload = function() {
			swal(\"Thank You!\", \"Student Registraion Was Successfuly!\", \"success\")
			};
			setTimeout(\"location.href = 'index.php';\",3000);
			</script>";
			
		}
		else
		echo 'Invalid File:Please Upload CSV File';
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Export Student Record</title>
		<style>
			body {
			width: 80%;
			margin:auto;
			}
			
			.outer-container {
			background: #F0F0F0;
			border: #e0dfdf 1px solid;
			padding: 40px 20px;
			border-radius: 2px;
			}
			
			.btn-submit {
			background: #333;
			border: #1d1d1d 1px solid;
			border-radius: 2px;
			color: #f0f0f0;
			cursor: pointer;
			padding: 5px 20px;
			font-size: 0.9em;
			}
			
			.tutorial-table {
			margin-top: 40px;
			font-size: 0.8em;
			border-collapse: collapse;
			width: 100%;
			}
			
			.tutorial-table th {
			background: #f0f0f0;
			border-bottom: 1px solid #dddddd;
			padding: 8px;
			text-align: left;
			}
			
			.tutorial-table td {
			background: #FFF;
			border-bottom: 1px solid #dddddd;
			padding: 8px;
			text-align: left;
			}
			
			#response {
			padding: 10px;
			margin-top: 10px;
			border-radius: 2px;
			display: none;
			}
			
			.success {
			background: #c7efd9;
			border: #bbe2cd 1px solid;
			}
			
			.error {
			background: #fbcfcf;
			border: #f3c6c7 1px solid;
			}
			
			div#response.display-block {
			display: block;
			}
		</style>
	</head>
	
	<body>
		<h2>Import Excel File into Student Database</h2>
		
		<div class="outer-container">
			<form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
				<div>
					<label>Choose Excel File</label> <input type="file"
					name="file" id="file" accept=".csv">
					<button type="submit" id="submit" name="submit" class="btn-submit">Import</button>
					
				</div>
				
			</form>
			
		</div>
		<div id="response"
		class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
		
		
	</body>
</html>		