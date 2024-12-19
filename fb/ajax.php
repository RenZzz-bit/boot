<?php
ob_start();
date_default_timezone_set("Asia/Manila");

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if ($action == 'login') {
    $login = $crud->login();
    if ($login !== null) {
        echo $login;  // Return the response code (1, 2, 3, or 4)
    } else {
        echo 5;  // Optional: For unknown errors, you could return another error code
    }
}

if ($action == 'login2') {
	$login = $crud->login2();
	if ($login)
		echo $login;
}
if ($action == 'logout') {
	$logout = $crud->logout();
	if ($logout)
		echo $logout;
}
if ($action == 'logout2') {
	$logout = $crud->logout2();
	if ($logout)
		echo $logout;
}
if ($action == 'signup') {
	// Get form data
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$gender = $_POST['gender'];
	$month = $_POST['month'];
	$day = $_POST['day'];
	$year = $_POST['year'];

	// Handle file upload
	$document = $_FILES['document']['name'];
	$document_tmp = $_FILES['document']['tmp_name'];
	$document_error = $_FILES['document']['error'];
	$document_size = $_FILES['document']['size'];
	$document_folder = "../img/documents";
	$document_path = $document_folder . '/' . basename($document);

	// Check for file upload errors
	if ($document_error !== UPLOAD_ERR_OK) {
		echo "Error uploading document. Error code: $document_error";
		exit;
	}

	// Optional: Check file size (e.g., max 2MB)
	if ($document_size > 2 * 1024 * 1024) {
		echo "File is too large. Maximum size is 2MB.";
		exit;
	}

	// Optional: Check file type (e.g., only allow PDF, JPG, PNG)
	$allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
	$document_type = mime_content_type($document_tmp);

	if (!in_array($document_type, $allowed_types)) {
		echo "Invalid file type. Only JPG, PNG, and PDF are allowed.";
		exit;
	}

	// Move the uploaded file to the server
	if (move_uploaded_file($document_tmp, $document_path)) {
		$response = $crud->signup($firstname, $lastname, $email, $password, $gender, $month, $day, $year, $document_path);
		echo $response;
	} else {
		// Error uploading file
		echo "Error uploading document.";
	}
}


if ($action == 'save_user') {
	$save = $crud->save_user();
	if ($save)
		echo $save;
}
if ($action == 'update_user') {
	$save = $crud->update_user();
	if ($save)
		echo $save;
}
if ($action == 'delete_user') {
	$save = $crud->delete_user();
	if ($save)
		echo $save;
}
if ($action == 'save_post') {
	$save = $crud->save_post();
	if ($save)
		echo $save;
}
if ($action == 'delete_post') {
	$delete = $crud->delete_post();
	if ($delete)
		echo $delete;
}
if ($action == 'like') {
	$save = $crud->like();
	if ($save)
		echo $save;
}
if ($action == 'save_comment') {
	$save = $crud->save_comment();
	if ($save)
		echo $save;
}
if ($action == 'update_cover') {
	$save = $crud->update_cover();
	if ($save)
		echo $save;
}
if ($action == 'update_profile') {
	$save = $crud->update_profile();
	if ($save)
		echo $save;
}
ob_end_flush();
