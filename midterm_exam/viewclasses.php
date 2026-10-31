<?php require_once 'core/auth.php'; requireLogin(); ?>
<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Classes</title>
	<link rel="stylesheet" href="indexstyles.css">
</head>
<body>
	<div class="topbar">
		<a href="index.php">Home</a>
		<a href="logs.php">Activity Log</a>
		<span class="user">You are logged in as <?php echo e($_SESSION['username']); ?></span>
		<a href="logout.php">Logout</a>
	</div>
	<?php $instructor = getInstructorByID($pdo, $_GET['instructor_id']); ?>
	<h1>Instructor: <?php echo e($instructor['username']); ?></h1>
	<div class="inputHolder">
		<h2>Add New Class</h2>
		<form action="core/handleForms.php?instructor_id=<?php echo (int)$_GET['instructor_id']; ?>" method="POST">
			<p>
				<label>Class Name</label> 
				<input type="text" name="className" required>
			</p>
			<p>
				<label>Class Type</label> 
				<input type="text" name="classType" required>
				<input type="submit" name="insertNewClassBtn" value="Add Class">
			</p>
		</form>
	</div>

	<table>
	  <tr>
	    <th>Class ID</th>
	    <th>Class Name</th>
	    <th>Class Type</th>
	    <th>Class Instructor</th>
	    <th>Date Added</th>
	    <th>Added By</th>
	    <th>Last Updated By</th>
	    <th>Last Updated</th>
	    <th>Action</th>
	  </tr>
	  <?php $classes = getClassByInstructor($pdo, $_GET['instructor_id']); ?>
	  <?php foreach ($classes as $row) { ?>
	  <tr>
	  	<td><?php echo $row['class_id']; ?></td>
	  	<td><?php echo e($row['class_name']); ?></td>
	  	<td><?php echo e($row['class_type']); ?></td>
	  	<td><?php echo e($row['class_instructor']); ?></td>
	  	<td><?php echo e($row['date_added']); ?></td>
	  	<td><?php echo e($row['added_by_name'] ?? 'Unknown'); ?></td>
	  	<td><?php echo e($row['updated_by_name'] ?? 'Unknown'); ?></td>
	  	<td><?php echo e($row['last_updated']); ?></td>
	  	<td>
	  		<a href="editClasses.php?class_id=<?php echo $row['class_id']; ?>&instructor_id=<?php echo (int)$_GET['instructor_id']; ?>">Edit</a>
	  		<a href="deleteClasses.php?class_id=<?php echo $row['class_id']; ?>&instructor_id=<?php echo (int)$_GET['instructor_id']; ?>">Delete</a>
	  	</td>
	  </tr>
	  <?php } ?>
	</table>
</body>
</html>
