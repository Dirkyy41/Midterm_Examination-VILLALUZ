<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertInstructorBtn'])) {

	$query = insertInstructor($pdo, $_POST['username'], $_POST['firstName'], 
		$_POST['lastName'], $_POST['dateOfBirth'], $_POST['specialization']);

	if ($query) {
		header("Location: ../index.php");
	}else {
		echo "Insertion failed";
	}

}

if (isset($_POST['editInstructorBtn'])) {
	$query = updateInstructor($pdo, $_POST['firstName'], $_POST['lastName'], 
		$_POST['dateOfBirth'], $_POST['specialization'], $_GET['instructor_id']);

	if ($query) {
		header("Location: ../index.php");
	}else {
		echo "Edit failed";;
	}

}

if (isset($_POST['deleteInstructorBtn'])) {
	$query = deleteInstructor($pdo, $_GET['instructor_id']);

	if ($query) {
		header("Location: ../index.php");
	}else {
		echo "Deletion failed";
	}
}

if (isset($_POST['insertNewClassBtn'])) {
	$query = insertClass($pdo, $_POST['className'], $_POST['classType'], $_GET['instructor_id']);

	if ($query) {
		header("Location: ../viewclasses.php?instructor_id=" .$_GET['instructor_id']);
	}
	else {
		echo "Insertion failed";
	}
}

if (isset($_POST['editClassBtn'])) {
	$query = updateClass($pdo, $_POST['className'], $_POST['classType'], $_GET['class_id']);

	if ($query) {
		header("Location: ../viewclasses.php?instructor_id=" .$_GET['instructor_id']);
	}
	else {
		echo "Update failed";
	}

}

if (isset($_POST['deleteClassBtn'])) {
	$query = deleteClass($pdo, $_GET['class_id']);

	if ($query) {
		header("Location: ../viewclasses.php?instructor_id=" .$_GET['instructor_id']);
	}
	else {
		echo "Deletion failed";
	}
}

?>