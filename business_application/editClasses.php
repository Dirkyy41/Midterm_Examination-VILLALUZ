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
	<a href="viewclasses.php?instructor_id=<?php echo $_GET['instructor_id']; ?>">
	View The Classes</a>
	<h1>Edit the Class!</h1>
	<?php $getClassByID = getClassByID($pdo, $_GET['class_id']); ?>
	<form action="core/handleForms.php?class_id=<?php echo $_GET['class_id']; ?>
	&instructor_id=<?php echo $_GET['instructor_id']; ?>" method="POST">
		<p>
			<label for="firstName">Class Name</label> 
			<input type="text" name="className" 
			value="<?php echo $getClassByID['class_name']; ?>">
		</p>
		<p>
			<label for="firstName">Class Type</label> 
			<input type="text" name="classType" 
			value="<?php echo $getClassByID['class_type']; ?>">
			<input type="submit" name="editClassBtn">
		</p>
	</form>
</body>
</html>