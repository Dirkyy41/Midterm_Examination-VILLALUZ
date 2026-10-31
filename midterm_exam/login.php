<?php require_once 'core/auth.php'; ?>
<?php if (isLoggedIn()) { header("Location: index.php"); exit; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="indexstyles.css">
</head>
<body>
	<div class="inputHolder">
		<h1>Tactical Defense Classes Management System</h1>
		<h3>Please login to enter the application</h3>
		<?php if (isset($_GET['error'])) { ?>
			<p class="error">Invalid username or password.</p>
		<?php } ?>
		<?php if (isset($_GET['registered'])) { ?>
			<p class="success">Account created. You can now log in.</p>
		<?php } ?>
		<form action="core/handleForms.php" method="POST">
			<p><label>Username</label><input type="text" name="username" required></p>
			<p>
				<label>Password</label>
				<input type="password" name="password" required>
				<input type="submit" name="loginBtn" value="Login">
			</p>
		</form>
		<p><a href="register.php">Create an account</a></p>
	</div>
</body>
</html>
