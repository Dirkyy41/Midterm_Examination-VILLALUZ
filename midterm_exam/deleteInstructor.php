<?php require_once 'core/auth.php'; requireLogin(); ?>
<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Instructor</title>
	<link rel="stylesheet" href="indexstyles.css">
</head>
<body>
	<div class="topbar">
		<a href="index.php">Home</a>
		<a href="logs.php">Activity Log</a>
		<span class="user">Logged in as <?php echo e($_SESSION['username']); ?></span>
		<a href="logout.php">Logout</a>
	</div>
	<h1>Are you sure you want to delete this instructor? Their classes will be deleted too.</h1>
	<?php $i = getInstructorByID($pdo, $_GET['instructor_id']); ?>
	<div class="container">
		<h3>Username: <?php echo e($i['username']); ?></h3>
		<h3>First Name: <?php echo e($i['first_name']); ?></h3>
		<h3>Last Name: <?php echo e($i['last_name']); ?></h3>
		<h3>Date Of Birth: <?php echo e($i['date_of_birth']); ?></h3>
		<h3>Specialization: <?php echo e($i['specialization']); ?></h3>
		<h3>Date Added: <?php echo e($i['date_added']); ?></h3>
		<form action="core/handleForms.php?instructor_id=<?php echo (int)$_GET['instructor_id']; ?>" method="POST">
			<input type="submit" name="deleteInstructorBtn" value="Delete">
		</form>
	</div>
</body>
</html>
