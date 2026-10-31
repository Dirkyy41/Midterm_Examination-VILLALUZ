<?php require_once 'core/auth.php'; requireLogin(); ?>
<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Class</title>
	<link rel="stylesheet" href="indexstyles.css">
</head>
<body>
	<div class="topbar">
		<a href="index.php">Home</a>
		<a href="logs.php">Activity Log</a>
		<span class="user">Logged in as <?php echo e($_SESSION['username']); ?></span>
		<a href="logout.php">Logout</a>
	</div>
	<h1>Are you sure you want to delete this class?</h1>
	<?php $c = getClassByID($pdo, $_GET['class_id']); ?>
	<div class="container">
		<h3>Class Name: <?php echo e($c['class_name']); ?></h3>
		<h3>Class Type: <?php echo e($c['class_type']); ?></h3>
		<h3>Class Instructor: <?php echo e($c['class_instructor']); ?></h3>
		<h3>Date Added: <?php echo e($c['date_added']); ?></h3>
		<form action="core/handleForms.php?class_id=<?php echo (int)$_GET['class_id']; ?>&instructor_id=<?php echo (int)$_GET['instructor_id']; ?>" method="POST">
			<input type="submit" name="deleteClassBtn" value="Delete">
		</form>
	</div>
</body>
</html>
