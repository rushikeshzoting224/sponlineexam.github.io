<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
	
	class User{
		private $db;
		private $fm;
		function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		
		public function userRegistration($name,$branch,$username,$password,$email){
			
			$name = $this->fm->validation($name);
			$branch = $this->fm->validation($branch);
			$username = $this->fm->validation($username);
			$password = $this->fm->validation($password);
			$email = $this->fm->validation($email);
			
			
			if ($name == "" || $branch == 'SelectBranch' || $username == "" || $password == "" || $email == "") {
				echo "<span class='error'>Fields Must Not be Empty !</span>";
				exit();
				}elseif (filter_var($email,FILTER_VALIDATE_EMAIL) === false) {
				echo "<span class='error'>Invalid Email Address !</span>";
				exit();
				}else{
				$chkquery = "SELECT * FROM tbl_user WHERE email = '$email'";
				$chkresult = $this->db->select($chkquery);
				if ($chkresult != false) {
					echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='error'>Email Address Already Eixst !</span></div>";
					exit();
					}else{
					
					//$password = mysqli_real_escape_string($this->db->link,md5($password));
					
					$query = "INSERT INTO tbl_user(name, branch, username, password, email) VALUES('$name','$branch','$username','$password','$email')";
					$inserted_row = $this->db->insert($query);
					if ($inserted_row) {
						echo "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='success'>Registration Successfully !</span></div>";
						exit();
						}else{
						echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='error'>Error.. Not Registered !</span></div>";
						exit();
					}
				}
			}
			
		}
		
		public function userLogin($email,$password){
			$email = $this->fm->validation($email);
			$password = $this->fm->validation($password);
			$email = mysqli_real_escape_string($this->db->link, $email);
			
			
			if ($email == "" || $password == "") {
				echo "empty";
				exit();
				}else{
				//$password = mysqli_real_escape_string($this->db->link,md5($password));
				$query = "SELECT * FROM tbl_user WHERE email='$email' AND password='$password'";
				$result = $this->db->select($query);
				if ($result != false) {
					$value = $result->fetch_assoc();
					if ($value['status'] == '1') {
						echo "disable";
						exit();
						}else{
						
						Session::init();
						Session::set("login", true);
						Session::set("userid", $value['userid']);
						Session::set("username", $value['username']);
						Session::set("name", $value['name']);
						
					}
					}else{
					echo "error";
					exit();
				}
			}
			
		}
		
		public function getUserData($userid){
			$query = "SELECT * FROM tbl_user WHERE userid=$userid";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function updateUserData($userid, $data){
			
			$name = $this->fm->validation($data['name']);
			$branch = $this->fm->validation($data['branch']);
			$username = $this->fm->validation($data['username']);
			$email = $this->fm->validation($data['email']);
			
			$name = mysqli_real_escape_string($this->db->link,$name);
			$username = mysqli_real_escape_string($this->db->link,$username);
			$email = mysqli_real_escape_string($this->db->link,$email);
			
			$query = "UPDATE tbl_user 
			SET
			name = '$name',
			branch = '$branch',
			username = '$username',
			email = '$email'
			WHERE userid = '$userid'";
			$updated_row = $this->db->update($query);
			if ($updated_row) {
				$msg = "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='success'>User Data Updated !  </span></div>";
				return $msg;
                }else{
				$msg = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='error'>User Data Not Updated !  </span></div>";
				return $msg;
			} 
		}
		
		public function getAllUser(){
			$query = "SELECT * FROM tbl_user WHERE userid = userid";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function disableUser($userid){
			$query = "UPDATE tbl_user 
			SET
			status = '1'
			WHERE userid = '$userid'";
			$updated_row = $this->db->update($query);
			if ($updated_row) {
				$msg = "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='success'>User Disable !  </span></div>";
				return $msg;
                }else{
				$msg = "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='error'>User Not Disable !  </span></div>";
				return $msg;
			} 
		}
		
		public function enableUser($userid){
			
			$query = "UPDATE tbl_user 
			SET
			status = '0'
			WHERE userid = '$userid'";
			$updated_row = $this->db->update($query);
			if ($updated_row) {
				$msg = "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='success'>User Active !  </span></div>";
				return $msg;
                }else{
				$msg = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='error'>User Not Active !  </span></div>";
				return $msg;
			} 
			
		}
		
		public function deleteUser($userid){
			$query = "DELETE FROM tbl_user WHERE userid = '$userid'";
			$deldata = $this->db->delete($query);
			if ($deldata) {
				$msg = "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='success'>User Removed !  </span></div>";
				return $msg;
                }else{
				$msg = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><span class='error'>Error... User Not Removed  !  </span></div>";
				return $msg;
			} 
		}
	}
	
	
?>