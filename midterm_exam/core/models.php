<?php  

function logActivity($pdo, $user_id, $action, $table_name, $record_id, $description) {
	$sql = "INSERT INTO activity_logs (user_id, action, table_name, record_id, description)
			VALUES (?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	return $stmt->execute([$user_id, $action, $table_name, $record_id, $description]);
}

function getAllLogs($pdo) {
	$sql = "SELECT activity_logs.*, users.username
			FROM activity_logs
			LEFT JOIN users ON activity_logs.user_id = users.user_id
			ORDER BY activity_logs.log_id DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll();
}

function insertInstructor($pdo, $username, $first_name, $last_name, $date_of_birth, $specialization, $added_by) {

	$sql = "INSERT INTO instructors (username, first_name, last_name, 
		date_of_birth, specialization, added_by, last_updated_by) VALUES(?,?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username, $first_name, $last_name, $date_of_birth, $specialization, $added_by, $added_by]);

	if ($executeQuery) {
		logActivity($pdo, $added_by, 'INSERT', 'instructors', $pdo->lastInsertId(), "Added instructor $username");
		return true;
	}
}

function updateInstructor($pdo, $first_name, $last_name, $date_of_birth, $specialization, $instructor_id, $updated_by) {

	$sql = "UPDATE instructors
				SET first_name = ?,
					last_name = ?,
					date_of_birth = ?, 
					specialization = ?,
					last_updated_by = ?,
					last_updated = NOW()
				WHERE instructor_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $date_of_birth, $specialization, $updated_by, $instructor_id]);
	
	if ($executeQuery) {
		logActivity($pdo, $updated_by, 'UPDATE', 'instructors', $instructor_id, "Updated instructor $first_name $last_name");
		return true;
	}
}

function deleteInstructor($pdo, $instructor_id, $deleted_by) {
	$instructor = getInstructorByID($pdo, $instructor_id);

	$deleteStmt = $pdo->prepare("DELETE FROM classes WHERE instructor_id = ?");
	$executeDeleteQuery = $deleteStmt->execute([$instructor_id]);

	if ($executeDeleteQuery) {
		$stmt = $pdo->prepare("DELETE FROM instructors WHERE instructor_id = ?");
		$executeQuery = $stmt->execute([$instructor_id]);

		if ($executeQuery) {
			logActivity($pdo, $deleted_by, 'DELETE', 'instructors', $instructor_id,
				"Deleted instructor " . ($instructor['username'] ?? '') . " and all their classes");
			return true;
		}
	}
}

function getAllInstructor($pdo) {
	$sql = "SELECT instructors.*, 
				added.username AS added_by_name,
				updated.username AS updated_by_name
			FROM instructors
			LEFT JOIN users AS added ON instructors.added_by = added.user_id
			LEFT JOIN users AS updated ON instructors.last_updated_by = updated.user_id
			ORDER BY instructors.instructor_id";
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
    return getInstructorByID($pdo, $instructor_id);
}

function getClassByInstructor($pdo, $instructor_id) {
	$sql = "SELECT 
				classes.class_id AS class_id,
				classes.class_name AS class_name,
				classes.class_type AS class_type,
				classes.date_added AS date_added,
				classes.last_updated AS last_updated,
				CONCAT(instructors.first_name,' ',instructors.last_name) AS class_instructor,
				added.username AS added_by_name,
				updated.username AS updated_by_name
			FROM classes
			JOIN instructors ON classes.instructor_id = instructors.instructor_id
			LEFT JOIN users AS added ON classes.added_by = added.user_id
			LEFT JOIN users AS updated ON classes.last_updated_by = updated.user_id
			WHERE classes.instructor_id = ?
			ORDER BY classes.class_id";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$instructor_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function insertClass($pdo, $class_name, $class_type, $instructor_id, $added_by) {
	$sql = "INSERT INTO classes (class_name, class_type, instructor_id, added_by, last_updated_by) VALUES (?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$class_name, $class_type, $instructor_id, $added_by, $added_by]);
	if ($executeQuery) {
		logActivity($pdo, $added_by, 'INSERT', 'classes', $pdo->lastInsertId(), "Added class $class_name");
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
			JOIN instructors ON classes.instructor_id = instructors.instructor_id
			WHERE classes.class_id = ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$class_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateClass($pdo, $class_name, $class_type, $class_id, $updated_by) {
	$sql = "UPDATE classes
			SET class_name = ?,
				class_type = ?,
				last_updated_by = ?,
				last_updated = NOW()
			WHERE class_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$class_name, $class_type, $updated_by, $class_id]);

	if ($executeQuery) {
		logActivity($pdo, $updated_by, 'UPDATE', 'classes', $class_id, "Updated class $class_name");
		return true;
	}
}

function deleteClass($pdo, $class_id, $deleted_by) {
	$class = getClassByID($pdo, $class_id);
	$stmt = $pdo->prepare("DELETE FROM classes WHERE class_id = ?");
	$executeQuery = $stmt->execute([$class_id]);
	if ($executeQuery) {
		logActivity($pdo, $deleted_by, 'DELETE', 'classes', $class_id, "Deleted class " . ($class['class_name'] ?? ''));
		return true;
	}
}

?>
