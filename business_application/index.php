<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div class="inputHolder">
		<h1>Welcome to the Tactical Defense Classes Management System!</h1>
		<form action="core/handleForms.php" method="POST">
			<p>
				<label for="firstName">Username</label> 
				<input type="text" name="username">
			</p>
			<p>
				<label for="firstName">First Name</label> 
				<input type="text" name="firstName">
			</p>
			<p>
				<label for="firstName">Last Name</label> 
				<input type="text" name="lastName">
			</p>
			<p>
				<label for="firstName">Date of Birth</label> 
				<input type="date" name="dateOfBirth">
			</p>
			<p>
				<label for="firstName">Specialization</label> 
				<input type="text" name="specialization">
				<input type="submit" name="insertInstructorBtn">
			</p>
		</form>
	</div>
	<?php $getAllInstructor = getAllInstructor($pdo); ?>
	<?php foreach ($getAllInstructor as $row) { ?>
	<div class="container">
		<h3>Username: <?php echo $row['username']; ?></h3>
		<h3>First Name: <?php echo $row['first_name']; ?></h3>
		<h3>Last Name: <?php echo $row['last_name']; ?></h3>
		<h3>Date Of Birth: <?php echo $row['date_of_birth']; ?></h3>
		<h3>Specialization: <?php echo $row['specialization']; ?></h3>
		<h3>Date Added: <?php echo $row['date_added']; ?></h3>


		<div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="viewclasses.php?instructor_id=<?php echo $row['instructor_id']; ?>">View Class</a>
			<a href="editInstructor.php?instructor_id=<?php echo $row['instructor_id']; ?>">Edit</a>
			<a href="deleteInstructor.php?instructor_id=<?php echo $row['instructor_id']; ?>">Delete</a>
		</div>


	</div> 
	<?php } ?>
</body>
</html>