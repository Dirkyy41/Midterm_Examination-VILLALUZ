<?php require_once 'core/auth.php'; requireLogin(); ?>
<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Instructor</title>
	<link rel="stylesheet" href="indexstyles.css">
</head>
<body>
	<div class="topbar">
		<a href="index.php">Home</a>
		<a href="logs.php">Activity Log</a>
		<span class="user">You are logged in as <?php echo e($_SESSION['username']); ?></span>
		<a href="logout.php">Logout</a>
	</div>
	<?php $i = getInstructorByID($pdo, $_GET['instructor_id']); ?>
	<div class="inputHolder">
		<h1>Edit the instructor!</h1>
		<form action="core/handleForms.php?instructor_id=<?php echo (int)$_GET['instructor_id']; ?>" method="POST">
			<p>
				<label>First Name</label> 
				<input type="text" name="firstName" value="<?php echo e($i['first_name']); ?>" required>
			</p>
			<p>
				<label>Last Name</label> 
				<input type="text" name="lastName" value="<?php echo e($i['last_name']); ?>" required>
			</p>
			<p>
				<label>Date of Birth</label> 
				<input type="date" name="dateOfBirth" value="<?php echo e($i['date_of_birth']); ?>" required>
			</p>
			<p>
				<label>Specialization</label> 
				<input type="text" name="specialization" value="<?php echo e($i['specialization']); ?>" required>
				<input type="submit" name="editInstructorBtn" value="Save Changes">
			</p>
		</form>
	</div>
</body>
</html>
