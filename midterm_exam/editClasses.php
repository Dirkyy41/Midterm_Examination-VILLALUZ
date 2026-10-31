<?php require_once 'core/auth.php'; requireLogin(); ?>
<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Class</title>
	<link rel="stylesheet" href="indexstyles.css">
</head>
<body>
	<div class="topbar">
		<a href="index.php">Home</a>
		<a href="logs.php">Activity Log</a>
		<span class="user">You are logged in as <?php echo e($_SESSION['username']); ?></span>
		<a href="logout.php">Logout</a>
	</div>
	<a class="back" href="viewclasses.php?instructor_id=<?php echo (int)$_GET['instructor_id']; ?>">&larr; Back to classes</a>
	<?php $c = getClassByID($pdo, $_GET['class_id']); ?>
	<div class="inputHolder">
		<h1>Edit the Class!</h1>
		<form action="core/handleForms.php?class_id=<?php echo (int)$_GET['class_id']; ?>&instructor_id=<?php echo (int)$_GET['instructor_id']; ?>" method="POST">
			<p>
				<label>Class Name</label> 
				<input type="text" name="className" value="<?php echo e($c['class_name']); ?>" required>
			</p>
			<p>
				<label>Class Type</label> 
				<input type="text" name="classType" value="<?php echo e($c['class_type']); ?>" required>
				<input type="submit" name="editClassBtn" value="Save Changes">
			</p>
		</form>
	</div>
</body>
</html>
