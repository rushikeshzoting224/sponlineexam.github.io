<?php 
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../lib/Database.php');
  include_once ($filepath.'/../helpers/Format.php');
  class Exam{
    private $db;
    private $fm;
    function __construct()
    {
      $this->db = new Database();
      $this->fm = new Format();
    }
    public function addQuestions($data){
      $quesNo = mysqli_real_escape_string($this->db->link,$data['quesNo']);
      $ques = mysqli_real_escape_string($this->db->link,$data['ques']);
      $ans = array();
      $examID = $data['examID'];
      
      $query = "SELECT * FROM tbl_ques WHERE examID ='$examID' AND quesNo='$quesNo'";
      $getData = $this->db->select($query);
      if (!empty($getData) && $getData->num_rows > 0){
        $minMax = "SELECT MIN(quesNo) AS minQuesNo, MAX(quesNo) AS maxQuesNo FROM tbl_ques WHERE examID ='$examID'";
        $getData = $this->db->select($minMax);
        $dataArr = $getData->fetch_assoc();
        if($dataArr['minQuesNo']!=1){
          $quesNo = $dataArr['minQuesNo'] - 1;
          }else{
          $quesNo = $dataArr['maxQuesNo'] + 1;
        }
      }
      
      $ans[1] = $data['ans1'];
      $ans[2] = $data['ans2'];
      $ans[3] = $data['ans3'];
      $ans[4] = $data['ans4'];
      $rightAns = $data['rightAns'];
      $query = "INSERT INTO tbl_ques(examID,quesNo,ques) VALUES('$examID','$quesNo','$ques')";
      $inserted_row = $this->db->insert($query);
      if ($inserted_row) {
        foreach ($ans as $key => $ansName) {
          if ($ansName != '') {
            if ($rightAns == $key) {
              $rquery = "INSERT INTO tbl_ans(examID,quesNo,rightAns,ans) VALUES('$examID','$quesNo','1','$ansName')";
              }else{
              $rquery = "INSERT INTO tbl_ans(examID,quesNo,rightAns,ans) VALUES('$examID','$quesNo','0','$ansName')";
            }
            $insertrow = $this->db->insert($rquery);
            if ($insertrow) {
              continue;
              }else{
              die('Error....');
            }
          }
        }
        $msg = "<div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button><span class='success'>Question Added Successfully...</span></div>";
        return $msg;
      }
    }
    
    public function addExam($data){
      $examType = mysqli_real_escape_string($this->db->link,$data['examType']);
      $branch = mysqli_real_escape_string($this->db->link,$data['department']);
      $examName = mysqli_real_escape_string($this->db->link,$data['examName']);
      $moOfQue = mysqli_real_escape_string($this->db->link,$data['moOfQue']);
      $examTime = mysqli_real_escape_string($this->db->link,$data['examTime']);
      $dateAdded= date("Y-m-d");
      $query = "INSERT INTO tbl_exam(examType,department,examName,moOfQue,examTime,dateAdded) VALUES('$examType','$branch','$examName','$moOfQue','$examTime','$dateAdded')";
      $inserted_row = $this->db->insert($query);
      if ($inserted_row) {
        $msg = "<div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button><span class='success'>Exam Added Successfully...</span></div>";
        return $msg;
      }
    }
    
    public function getQueByOrder($examID){
      $query = "SELECT * FROM  tbl_ques WHERE examID=$examID ORDER BY quesNo ASC";
      $result = $this->db->select($query);
      return $result;
    }
    public function delQuestion($examID,$quesNo){
      $tables = array("tbl_ques","tbl_ans");
      foreach ($tables as $table) {
        $delquery = "DELETE FROM $table WHERE examID='$examID' AND quesNo ='$quesNo'";
        $deldata = $this->db->delete($delquery);
      }
      if ($deldata) {
        $msg = "<div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button><span class='success'>Data Deleted Successfully...</span></div>";
        return $msg;
        }else{
        $msg = "<div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button><span class='error'>Data Not Deleted !</span></div>";
        return $msg;
      }
    }
    public function getTotalRows($examID){
      $query = "SELECT * FROM tbl_ques WHERE examID='$examID'";
      $getResult = $this->db->select($query);
      $total = $getResult->num_rows;
      return $total;
    }
    
    public function getQuestion(){
      $query = "SELECT * FROM tbl_ques ORDER BY quesNo ASC";
      $getData = $this->db->select($query);
      $result = $getData->fetch_assoc();
      return $result;
    }
    public function getQuesByNumber($number,$examID){
      $query = "SELECT * FROM tbl_ques WHERE quesNo ='$number' AND examID='$examID'";
      $getData = $this->db->select($query);
      $result = $getData->fetch_assoc();
      return $result;
    }
    public function getAnswer($number,$examID){
      $query = "SELECT * FROM tbl_ans WHERE quesNo ='$number' AND examID='$examID'";
      $getData = $this->db->select($query);
      return $getData;
    }
    
    
    ////////////////// CUSTOM CLASSES //////////////////////
    public function commonAdd($data){
      $examName = mysqli_real_escape_string($this->db->link,$data['examName']);
      $moOfQue = mysqli_real_escape_string($this->db->link,$data['moOfQue']);
      $examTime = mysqli_real_escape_string($this->db->link,$data['examTime']);
      $dateAdded= date("Y-m-d");
      $query = "INSERT INTO tbl_exam(examName,moOfQue,examTime,dateAdded) VALUES('$examName','$moOfQue','$examTime','$dateAdded')";
      $inserted_row = $this->db->insert($query);
      if ($inserted_row) {
        $msg = "<div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button><span class='success'>Exam Added Successfully...</span></div>";
        return $msg;
      }
    }
    
    public function commonDelete($table,$id){
      $delquery = "DELETE FROM $table WHERE id=$id";
      if($this->db->delete($delquery)){
        return true;
      }
    }
    
    public function commonGetData($table,$where="1",$orderBy=""){
      $query = "SELECT * FROM $table WHERE $where $orderBy";
      $getResult = $this->db->select($query);
      return $getResult;
    }
    
    public function commonActivation($table,$val,$where="1"){
      $val = $val == 1 ? 0 : 1;
      $query = "UPDATE $table SET status=$val WHERE $where";
      $getResult = $this->db->update($query);
      return $getResult;
    }
    
    public function isExamDoneAlready($userID,$examID){
      $flag = false;
      $sel = "SELECT id FROM tbl_comp_exam WHERE userID='$userID' AND examID='$examID'";
      $getResult = $this->db->select($sel);
      if (!empty($getResult) && $getResult->num_rows > 0){
        $flag = true;
      }
      return $flag;
    }
    
    public function commonUpdate($table,$data,$condition){
      $qry = "UPDATE $table SET $data WHERE $condition";
      if($this->db->update($qry)){
        return true;
        }else{
        return false;
      }
    }
    
  }
?>