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
	<h1>Are you sure you want to delete this user?</h1>
	<?php $getInstructorByID = getInstructorByID($pdo, $_GET['instructor_id']); ?>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Username: <?php echo $getInstructorByID['username']; ?></h2>
		<h2>FirstName: <?php echo $getInstructorByID['first_name']; ?></h2>
		<h2>LastName: <?php echo $getInstructorByID['last_name']; ?></h2>
		<h2>Date Of Birth: <?php echo $getInstructorByID['date_of_birth']; ?></h2>
		<h2>Specialization: <?php echo $getInstructorByID['specialization']; ?></h2>
		<h2>Date Added: <?php echo $getInstructorByID['date_added']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?instructor_id=<?php echo $_GET['instructor_id']; ?>" method="POST">
				<input type="submit" name="deleteInstructorBtn" value="Delete">
			</form>			
		</div>	

	</div>
</body>
</html>