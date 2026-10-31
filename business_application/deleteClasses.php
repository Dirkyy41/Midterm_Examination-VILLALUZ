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
	<?php $getClassByID = getClassByID($pdo, $_GET['class_id']); ?>
	<h1>Are you sure you want to delete this Class?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Class Name: <?php echo $getClassByID['class_name'] ?></h2>
		<h2>Class Type: <?php echo $getClassByID['class_type'] ?></h2>
		<h2>Class Instructor: <?php echo $getClassByID['class_instructor'] ?></h2>
		<h2>Date Added: <?php echo $getClassByID['date_added'] ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">

			<form action="core/handleForms.php?class_id=<?php echo $_GET['class_id']; ?>&instructor_id=<?php echo $_GET['instructor_id']; ?>" method="POST">
				<input type="submit" name="deleteClassBtn" value="Delete">
			</form>			
			
		</div>	

	</div>
</body>
</html>