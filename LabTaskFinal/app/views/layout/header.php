<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - ' : '' ?>Shop Management System</title>
</head>
<body>

<h2>Shop Management System</h2>

<?php if (isset($_SESSION['admin_username'])): ?>
    <p>
        Logged in as: <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong> |
        <a href="index.php?controller=employee&action=index">Dashboard</a> |
        <a href="index.php?controller=employee&action=create">Add Employee</a> |
        <a href="index.php?controller=employee&action=search">Search</a> |
        <a href="index.php?controller=auth&action=logout">Logout</a>
    </p>
<?php endif; ?>

<hr>
