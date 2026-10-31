<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';
require_once 'auth.php';

if (isset($_POST['loginBtn'])) {
	if (loginUser($pdo, trim($_POST['username']), $_POST['password'])) {
		header("Location: ../index.php");
	} else {
		header("Location: ../login.php?error=1");
	}
	exit;
}

if (isset($_POST['registerBtn'])) {
	$data = [
		'username'       => trim($_POST['username']),
		'password'       => $_POST['password'],
		'first_name'     => trim($_POST['firstName']),
		'last_name'      => trim($_POST['lastName']),
		'email'          => trim($_POST['email']),
		'contact_number' => trim($_POST['contactNumber']),
		'address'        => trim($_POST['address']),
		'age'            => trim($_POST['age']),
		'date_of_birth'  => $_POST['dateOfBirth'],
		'gender'         => $_POST['gender'],
	];

	$error = null;
	if ($data['username'] === '' || $data['password'] === '' || $data['first_name'] === ''
		|| $data['last_name'] === '' || $data['email'] === '') {
		$error = "Please fill in all required fields.";
	} elseif ($data['password'] !== $_POST['confirmPassword']) {
		$error = "Passwords do not match.";
	} elseif (strlen($data['password']) < 6) {
		$error = "Password must be at least 6 characters.";
	} elseif (getUserByUsername($pdo, $data['username'])) {
		$error = "Username already taken.";
	} elseif (getUserByEmail($pdo, $data['email'])) {
		$error = "Email already registered.";
	} elseif (!registerUser($pdo, $data)) {
		$error = "Registration failed.";
	}

	if ($error) {
		header("Location: ../register.php?error=" . urlencode($error));
	} else {
		header("Location: ../login.php?registered=1");
	}
	exit;
}

requireLogin();
$userId = currentUserId();

if (isset($_POST['insertInstructorBtn'])) {
	$query = insertInstructor($pdo, $_POST['username'], $_POST['firstName'], 
		$_POST['lastName'], $_POST['dateOfBirth'], $_POST['specialization'], $userId);

	if ($query) {
		header("Location: ../index.php");
	} else {
		echo "Insertion failed";
	}
}

if (isset($_POST['editInstructorBtn'])) {
	$query = updateInstructor($pdo, $_POST['firstName'], $_POST['lastName'], 
		$_POST['dateOfBirth'], $_POST['specialization'], $_GET['instructor_id'], $userId);

	if ($query) {
		header("Location: ../index.php");
	} else {
		echo "Edit failed";
	}
}

if (isset($_POST['deleteInstructorBtn'])) {
	$query = deleteInstructor($pdo, $_GET['instructor_id'], $userId);

	if ($query) {
		header("Location: ../index.php");
	} else {
		echo "Deletion failed";
	}
}

if (isset($_POST['insertNewClassBtn'])) {
	$query = insertClass($pdo, $_POST['className'], $_POST['classType'], $_GET['instructor_id'], $userId);

	if ($query) {
		header("Location: ../viewclasses.php?instructor_id=" . $_GET['instructor_id']);
	} else {
		echo "Insertion failed";
	}
}

if (isset($_POST['editClassBtn'])) {
	$query = updateClass($pdo, $_POST['className'], $_POST['classType'], $_GET['class_id'], $userId);

	if ($query) {
		header("Location: ../viewclasses.php?instructor_id=" . $_GET['instructor_id']);
	} else {
		echo "Update failed";
	}
}

if (isset($_POST['deleteClassBtn'])) {
	$query = deleteClass($pdo, $_GET['class_id'], $userId);

	if ($query) {
		header("Location: ../viewclasses.php?instructor_id=" . $_GET['instructor_id']);
	} else {
		echo "Deletion failed";
	}
}

?>
