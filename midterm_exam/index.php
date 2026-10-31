<?php require_once 'core/auth.php'; requireLogin(); ?>
<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tactical Defense Classes</title>
	<link rel="stylesheet" href="indexstyles.css">
</head>
<body>
	<div class="topbar">
		<a href="index.php">Home</a>
		<a href="logs.php">Activity Log</a>
		<span class="user">You are logged in as <?php echo e($_SESSION['username']); ?></span>
		<a href="logout.php">Logout</a>
	</div>
	<div class="inputHolder">
		<h1>Welcome to the Tactical Defense Classes Management System!</h1>
		<p>Hello, <?php echo e($_SESSION['full_name']); ?>!</p>
		<form action="core/handleForms.php" method="POST">
			<p>
				<label>Username</label> 
				<input type="text" name="username" required>
			</p>
			<p>
				<label>First Name</label> 
				<input type="text" name="firstName" required>
			</p>
			<p>
				<label>Last Name</label> 
				<input type="text" name="lastName" required>
			</p>
			<p>
				<label>Date of Birth</label> 
				<input type="date" name="dateOfBirth" required>
			</p>
			<p>
				<label>Specialization</label> 
				<input type="text" name="specialization" required>
				<input type="submit" name="insertInstructorBtn" value="Add Instructor">
			</p>
		</form>
	</div>
	<?php $getAllInstructor = getAllInstructor($pdo); ?>
	<?php foreach ($getAllInstructor as $row) { ?>
	<div class="container">
		<h3>Username: <?php echo e($row['username']); ?></h3>
		<h3>First Name: <?php echo e($row['first_name']); ?></h3>
		<h3>Last Name: <?php echo e($row['last_name']); ?></h3>
		<h3>Date Of Birth: <?php echo e($row['date_of_birth']); ?></h3>
		<h3>Specialization: <?php echo e($row['specialization']); ?></h3>
		<h3>Date Added: <?php echo e($row['date_added']); ?></h3>
		<p class="meta">
			Added by: <b><?php echo e($row['added_by_name'] ?? 'Unknown'); ?></b> |
			Last updated by: <b><?php echo e($row['updated_by_name'] ?? 'Unknown'); ?></b> |
			Last updated: <b><?php echo e($row['last_updated']); ?></b>
		</p>

		<div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="viewclasses.php?instructor_id=<?php echo $row['instructor_id']; ?>">View Class</a>
			<a href="editInstructor.php?instructor_id=<?php echo $row['instructor_id']; ?>">Edit</a>
			<a href="deleteInstructor.php?instructor_id=<?php echo $row['instructor_id']; ?>">Delete</a>
		</div>
		<div style="clear: both;"></div>
	</div> 
	<?php } ?>
</body>
</html>
