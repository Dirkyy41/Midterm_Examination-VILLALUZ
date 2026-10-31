<?php  

function insertInstructor($pdo, $username, $first_name, $last_name, 
	$date_of_birth, $specialization) {

	$sql = "INSERT INTO instructors (username, first_name, last_name, 
		date_of_birth, specialization) VALUES(?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username, $first_name, $last_name, 
		$date_of_birth, $specialization]);

	if ($executeQuery) {
		return true;
	}
}

function updateInstructor($pdo, $first_name, $last_name, 
	$date_of_birth, $specialization, $instructor_id) {

	$sql = "UPDATE instructors
				SET first_name = ?,
					last_name = ?,
					date_of_birth = ?, 
					specialization = ?
				WHERE instructor_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, 
		$date_of_birth, $specialization, $instructor_id]);
	
	if ($executeQuery) {
		return true;
	}

}

function deleteInstructor($pdo, $instructor_id) {
	$deleteInstructorClass = "DELETE FROM classes WHERE instructor_id = ?";
	$deleteStmt = $pdo->prepare($deleteInstructorClass);
	$executeDeleteQuery = $deleteStmt->execute([$instructor_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM instructors WHERE instructor_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$instructor_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}

function getAllInstructor($pdo) {
	$sql = "SELECT * FROM instructors";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getInstructorByID($pdo, $instructor_id) {
	$sql = "SELECT * FROM instructors WHERE instructor_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$instructor_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function getAllInfoByInstructorID($pdo, $instructor_id){
    $sql = "SELECT * FROM instructors WHERE instructor_id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$instructor_id]);

    return $stmt->fetch();
}

function getClassByInstructor($pdo, $instructor_id) {
	
	$sql = "SELECT 
				classes.class_id AS class_id,
				classes.class_name AS class_name,
				classes.class_type AS class_type,
				classes.date_added AS date_added,
				CONCAT(instructors.first_name,' ',instructors.last_name) AS class_instructor
			FROM classes
			JOIN instructors ON classes.instructor_id = instructors.instructor_id
			WHERE classes.instructor_id = ? 
			GROUP BY classes.class_name;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$instructor_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function insertClass($pdo, $class_name, $class_type, $instructor_id) {
	$sql = "INSERT INTO classes (class_name, class_type, instructor_id) VALUES (?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$class_name, $class_type, $instructor_id]);
	if ($executeQuery) {
		return true;
	}

}

function getClassByID($pdo, $class_id) {
	$sql = "SELECT 
				classes.class_id AS class_id,
				classes.class_name AS class_name,
				classes.class_type AS class_type,
				classes.date_added AS date_added,
				CONCAT(instructors.first_name,' ',instructors.last_name) AS class_instructor
			FROM classes
			JOIN instructors ON classes.instructor_id = classes.instructor_id
			WHERE classes.class_id  = ? 
			GROUP BY classes.class_name";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$class_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateClass($pdo, $class_name, $class_type, $class_id) {
	$sql = "UPDATE classes
			SET class_name = ?,
				class_type = ?
			WHERE class_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$class_name, $class_type, $class_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteClass($pdo, $class_id) {
	$sql = "DELETE FROM classes WHERE class_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$class_id]);
	if ($executeQuery) {
		return true;
	}
}

?>