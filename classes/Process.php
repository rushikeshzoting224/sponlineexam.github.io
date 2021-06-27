<?php 
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Session.php');
	//Session::init();
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

class Process{
	private $db;
	private $fm;
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function processData($data){
		$selectedAns    = $this->fm->validation($data['ans']);
		$number         = $this->fm->validation($data['number']);
		$selectedAns    = mysqli_real_escape_string($this->db->link,$selectedAns);
		$number         = mysqli_real_escape_string($this->db->link,$number);
		$next           = $number+1;

		if (!isset($_SESSION['score'])) {
			$_SESSION['score'] = '0';
		}

		$total = $this->getTotal($data['examID']);

		$right = $this->rightAns($number,$data['examID']);
		
		if ($right == $selectedAns) {
			$_SESSION['score']++;
		}
		$sel = "SELECT id FROM tbl_comp_exam WHERE userID='$data[userID]' AND examID='$data[examID]'";
		$getResult = $this->db->select($sel);
		if($getResult->num_rows < 1){
			$date =  date("Y-m-d");
			$qry = "INSERT INTO tbl_comp_exam(userID,examID,noQuesDone,givenAns,dateAdded) VALUES('$data[userID]','$data[examID]','$number','$_SESSION[score]','$date')";
			$insertrow = $this->db->insert($qry);	
		}else{
			$qry = "UPDATE tbl_comp_exam SET noQuesDone='$number',givenAns='$_SESSION[score]' WHERE userID='$data[userID]' AND examID='$data[examID]'";
			$insertrow = $this->db->update($qry);
		}

		if ($number == $total) {
			header("Location:final.php?examID=".$data['examID']);
			exit();
		}else{
			header('Location:test.php?examID='.$data['examID'].'&q='.$next);
			exit();
		}

	}

	private function getTotal($examID){
	$query = "SELECT * FROM tbl_ques WHERE examID='$examID'";
    $getResult = $this->db->select($query);
    $total = $getResult->num_rows;
    return $total;

	}
	private function rightAns($number,$examID){	
	$query = "SELECT * FROM tbl_ans WHERE examID = '$examID' AND quesNo = '$number' AND rightAns = '1'";
    $getdata = $this->db->select($query)->fetch_assoc();
    $result = $getdata['id'];
    return $result;
	}

}


 ?>