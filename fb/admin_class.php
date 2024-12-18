<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
        // Establish the database connection
        $this->conn = new mysqli("localhost", "root", "", "kaagapay");

        // Check if the connection is successful
        if ($this->conn->connect_error) {
            // If there's an error, display a message and stop execution
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
	public function __destruct() {
        // Only try to close the connection if it's successfully initialized
        if ($this->conn) {
            $this->conn->close();
        }
    }

	function login() {
		// Check if form is submitted
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$email = $_POST['email'];
			$password = $_POST['password'];
	
			// Sanitize inputs to avoid SQL injection
			$email = $this->conn->real_escape_string($email);
			$password = $this->conn->real_escape_string($password);
	
			// Query to get the user by email
			$query = "SELECT * FROM users WHERE email = ?";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$result = $stmt->get_result();
	
			// Check if the user exists
			if ($result->num_rows > 0) {
				$user = $result->fetch_assoc();
	
				// Check if user is verified
				if ($user['verified'] == 1) {
					// Verify the password
					if (password_verify($password, $user['password'])) {
						// Password matches and user is verified, log the user in
						$_SESSION['user_id'] = $user['id'];
						$_SESSION['user_email'] = $user['email'];
	
						return "Login successful!";
					} else {
						return "Incorrect password.";
					}
				} else {
					return "Your account is not verified yet.";
				}
			} else {
				return "No account found with that email.";
			}	
		}
	}

	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function login2(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users where email = '".$email."' and password = '".md5($password)."'  and type= 2 ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}
	function save_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!empty($cpass) && !empty($password)){
					$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	public function signup() {
		if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'])) {
			$firstname = $this->conn->real_escape_string($_POST['firstname']);
			$lastname = $this->conn->real_escape_string($_POST['lastname']);
			$email = $this->conn->real_escape_string($_POST['email']);
			$password = $_POST['password']; 
			$gender = isset($_POST['gender']) ? $_POST['gender'] : 'Not specified'; 
			$birthday = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day']; 
	
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return "Invalid email format.";
			}
	
			$query = "SELECT * FROM users WHERE email = ?";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result->num_rows > 0) {
				return "Email already exists.";
			}
	
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	
			// Handle document upload
			$document = '';
			if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
				$document = $this->uploadDocument($_FILES['document']);
				if (is_string($document)) {
					return $document; 
				}
			}
	
			// Insert user data
			$query = "INSERT INTO users (firstname, lastname, email, password, gender, dob, document, verified) 
					  VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param("sssssss", $firstname, $lastname, $email, $hashedPassword, $gender, $birthday, $document);
			if ($stmt->execute()) {
				return "Registration successful! Please check your email for verification.";
			} else {
				return "Error executing query: " . $stmt->error;
			}
		} else {
			return "Please fill in all the required fields.";
		}
	}
	
	
	// File Upload Logic (optional)
	private function uploadDocument($file) {
		$allowedExtensions = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
		$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
	
		if (!in_array(strtolower($extension), $allowedExtensions)) {
			return "Invalid document format. Please upload a PDF, DOC, DOCX, JPG, JPEG, or PNG document.";
		}
	
		$targetDir = "../img/ID/";
		$fileName = time() . "_" . basename($file['name']);
		$targetFile = $targetDir . $fileName;
	
		// Ensure the target directory exists and is writable
	
		if (move_uploaded_file($file['tmp_name'], $targetFile)) {
			return $fileName;  // Document was uploaded successfully
		} else {
			return "Error uploading document.";
		}
		
		var_dump($file);  // This will show the details of the uploaded file

	}
	

    // Optional: Send verification email (logic can be customized)
    private function sendVerificationEmail($email) {
        $verificationLink = "https://yourwebsite.com/verify.php?email=" . urlencode($email);
        // Send an email with the verification link (use a mailing library like PHPMailer or mail())
    }

	function update_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function save_post(){
		extract($_POST);
		$data = "";

		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','img','imgName')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
					$data .= ", user_id='{$_SESSION['login_id']}' ";


		if(empty($id)){
			$save = $this->db->query("INSERT INTO posts set $data");
			if($save && isset($img)){
				$id= $this->db->insert_id;
				mkdir('assets/uploads/'.$id);
				for($i = 0 ; $i< count($img);$i++){
					list($type, $img[$i]) = explode(';', $img[$i]);
					list(, $img[$i])      = explode(',', $img[$i]);
					$img[$i] = str_replace(' ', '+', $img[$i]);
					$img[$i] = base64_decode($img[$i]);
					$fname = strtotime(date('Y-m-d H:i'))."_".$imgName[$i];
					$upload = file_put_contents('assets/uploads/'.$id.'/'.$fname,$img[$i]);
					$data = " file_path = '".$fname."' ";
				}
			}
		}else{
			$save = $this->db->query("UPDATE posts set $data where id = $id");
			if($save){
				if(is_dir('assets/uploads/'.$id)){
					$gal = scandir('assets/uploads/'.$id);
					unset($gal[0]);
					unset($gal[1]);
					foreach($gal as $k=>$v){
						unlink('assets/uploads/'.$id.'/'.$v);
					}
					rmdir('assets/uploads/'.$id);
				}
				if(isset($img)){
					mkdir('assets/uploads/'.$id);
					for($i = 0 ; $i< count($img);$i++){
						list($type, $img[$i]) = explode(';', $img[$i]);
						list(, $img[$i])      = explode(',', $img[$i]);
						$img[$i] = str_replace(' ', '+', $img[$i]);
						$img[$i] = base64_decode($img[$i]);
						$fname = strtotime(date('Y-m-d H:i'))."_".$imgName[$i];
						$upload = file_put_contents('assets/uploads/'.$id.'/'.$fname,$img[$i]);
						$data = " file_path = '".$fname."' ";
					}
				}
			}
		}
		if($save){
			return 1;
		}
	}
	function delete_post(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM posts where id = $id");
		if($delete){
			if(is_dir('assets/uploads/'.$id)){
				$gal = scandir('assets/uploads/'.$id);
				unset($gal[0]);
				unset($gal[1]);
				foreach($gal as $k=>$v){
					unlink('assets/uploads/'.$id.'/'.$v);
				}
				rmdir('assets/uploads/'.$id);
			}
			return 1;
		}
	}
	function like(){
		extract($_POST);
		$data = " user_id = {$_SESSION['login_id']} ";
		$data .= ", post_id = $post_id ";
		$chk = $this->db->query("SELECT * FROM likes where user_id = {$_SESSION['login_id']} and post_id = $post_id ")->num_rows;
		if($chk > 0){
			$delete = $this->db->query("DELETE FROM likes where user_id = {$_SESSION['login_id']} and post_id = $post_id ");
			if($delete){
				return 0;
				exit;
			}
		}
		$save = $this->db->query("INSERT INTO likes set $data ");
		if($save){
			return 1;
		}
	}
	function save_comment(){
		extract($_POST);
		$data = " user_id = {$_SESSION['login_id']} ";
		$data .= ", post_id = $post_id ";
		$data .= ", comment = '$comment' ";
		$save = $this->db->query("INSERT INTO comments set $data ");
		if($save){
			$id= $this->db->insert_id;
			$d['status'] = 1;
			$qry = $this->db->query("SELECT c.*,concat(u.firstname,' ',u.lastname) as name,u.profile_pic FROM comments c inner join users u on u.id = c.user_id where c.id = $id ")->fetch_array();
			foreach($qry as $k => $v){
				if(!is_numeric($k)){
					if($k == "comment"){
						$v = str_replace("\n","<br/>",$v);
					}
					if($k == 'date_created'){
						$k = 'timestamp';
						$v = date("M d,Y h:i A",strtotime($v));
					}
					$d['data'][$k] = $v;
				}
			}
			return json_encode($d);
		}
	}
	function update_cover(){
		
		if(isset($_FILES['cover']) && $_FILES['cover']['tmp_name'] != ''){
			$fnamec = strtotime(date('y-m-d H:i')).'_'.$_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'],'assets/uploads/'. $fnamec);
			$data = " cover_pic = '$fnamec' ";

		}
		if(isset($data)){
			$save = $this->db->query("UPDATE users set $data where id = {$_SESSION['login_id']}");
			if($save){
				if(isset($_FILES['cover']) &&$_FILES['cover']['tmp_name'] != '')
						$_SESSION['login_cover_pic'] = $fnamec;
				return 1;
			}
		}
	}
	function update_profile(){
		
		if(isset($_FILES['pp']) && $_FILES['pp']['tmp_name'] != ''){
			$fnamep = strtotime(date('y-m-d H:i')).'_'.$_FILES['pp']['name'];
			$move = move_uploaded_file($_FILES['pp']['tmp_name'],'assets/uploads/'. $fnamep);
			$data = " profile_pic = '$fnamep' ";

		}
		if(isset($data)){
			$save = $this->db->query("UPDATE users set $data where id = {$_SESSION['login_id']}");
			if($save){
				if(isset($_FILES['pp']) &&$_FILES['pp']['tmp_name'] != '')
						$_SESSION['login_profile_pic'] = $fnamep;
				return 1;
			}
		}
	}
}