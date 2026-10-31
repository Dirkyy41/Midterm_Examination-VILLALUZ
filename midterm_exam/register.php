<?php require_once 'core/auth.php'; ?>
<?php if (isLoggedIn()) { header("Location: index.php"); exit; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link rel="stylesheet" href="indexstyles.css">
</head>
<body>
	<div class="inputHolder">
		<h1>Create an Account</h1>
		<?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo e($_GET['error']); ?></p>
		<?php } ?>
		<form action="core/handleForms.php" method="POST">
			<p><label>Username *</label><input type="text" name="username" required></p>
			<p><label>First Name *</label><input type="text" name="firstName" required></p>
			<p><label>Last Name *</label><input type="text" name="lastName" required></p>
			<p><label>Email *</label><input type="email" name="email" required></p>
			<p><label>Contact Number</label><input type="text" name="contactNumber"></p>
			<p><label>Address</label><input type="text" name="address"></p>
			<p><label>Age</label><input type="number" name="age" min="1" max="120"></p>
			<p><label>Date of Birth</label><input type="date" name="dateOfBirth"></p>
			<p><label>Gender</label>
				<select name="gender">
					<option value="">Prefer not to say</option>
					<option>Male</option>
					<option>Female</option>
					<option>Other</option>
				</select>
			</p>
			<p><label>Password * (min 6 characters)</label><input type="password" name="password" required></p>
			<p>
				<label>Confirm Password *</label>
				<input type="password" name="confirmPassword" required>
				<input type="submit" name="registerBtn" value="Register">
			</p>
		</form>
		<p><a href="login.php">Already have an account? Login</a></p>
	</div>
</body>
</html>
