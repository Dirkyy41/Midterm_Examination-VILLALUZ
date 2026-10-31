<?php require_once 'core/auth.php'; requireLogin(); ?>
<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Activity Log</title>
	<link rel="stylesheet" href="indexstyles.css">
</head>
<body>
	<div class="topbar">
		<a href="index.php">Home</a>
		<a href="logs.php">Activity Log</a>
		<span class="user">You are logged in as <?php echo e($_SESSION['username']); ?></span>
		<a href="logout.php">Logout</a>
	</div>
	<h1>Activity Log</h1>
	<table>
		<tr><th>#</th><th>User</th><th>Action</th><th>Table</th><th>Record ID</th><th>Description</th><th>Date</th></tr>
		<?php foreach (getAllLogs($pdo) as $log) { ?>
		<tr>
			<td><?php echo $log['log_id']; ?></td>
			<td><?php echo e($log['username'] ?? 'Unknown'); ?></td>
			<td><?php echo e($log['action']); ?></td>
			<td><?php echo e($log['table_name']); ?></td>
			<td><?php echo e($log['record_id']); ?></td>
			<td><?php echo e($log['description']); ?></td>
			<td><?php echo e($log['date_logged']); ?></td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>
