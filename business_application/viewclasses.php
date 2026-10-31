<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="index.php">Return to home</a>
	<?php $getAllInfoByInstructorID = getAllInfoByInstructorID($pdo, $_GET['instructor_id']); ?>
	<h1>Username: <?php echo $getAllInfoByInstructorID['username']; ?></h1>
	<h1>Add New Class</h1>
	<form action="core/handleForms.php?instructor_id=<?php echo $_GET['instructor_id']; ?>" method="POST">
		<p>
			<label for="firstName">Class Name</label> 
			<input type="text" name="className">
		</p>
		<p>
			<label for="firstName">Class Type</label> 
			<input type="text" name="classType">
			<input type="submit" name="insertNewClassBtn">
		</p>
	</form>

	<table style="width:100%; margin-top: 50px;">
	  <tr>
	    <th>Class ID</th>
	    <th>Class Name</th>
	    <th>Class Type</th>
	    <th>Class Instructor</th>
	    <th>Date Added</th>
	    <th>Action</th>
	  </tr>
	  <?php $getClassByInstructor = getClassByInstructor($pdo, $_GET['instructor_id']); ?>
	  <?php foreach ($getClassByInstructor as $row) { ?>
	  <tr>
	  	<td><?php echo $row['class_id']; ?></td>	  	
	  	<td><?php echo $row['class_name']; ?></td>	  	
	  	<td><?php echo $row['class_type']; ?></td>	  	
	  	<td><?php echo $row['class_instructor']; ?></td>	  	
	  	<td><?php echo $row['date_added']; ?></td>
	  	<td>
	  		<a href="editClasses.php?class_id=<?php echo $row['class_id']; ?>&instructor_id=<?php echo $_GET['instructor_id']; ?>">Edit</a>

	  		<a href="deleteClasses.php?class_id=<?php echo $row['class_id']; ?>&instructor_id=<?php echo $_GET['instructor_id']; ?>">Delete</a>
	  	</td>	  	
	  </tr>
	<?php } ?>
	</table>

	
</body>
</html>