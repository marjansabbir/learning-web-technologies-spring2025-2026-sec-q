<?php $pageTitle = 'All Employees'; ?>
<?php require BASE_PATH . '/app/views/layout/header.php'; ?>

<h3>All Employees</h3>

<?php if ($flash): ?>
    <p style="color:<?= $flash['type'] === 'success' ? 'green' : 'red' ?>;">
        <?= htmlspecialchars($flash['message']) ?>
    </p>
<?php endif; ?>

<p><a href="index.php?controller=employee&action=create">+ Add New Employee</a></p>

<?php if (count($employees) === 0): ?>

    <p>No employees found.</p>

<?php else: ?>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Contact No</th>
                <th>Username</th>
                <th>Registered On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $emp): ?>
            <tr>
                <td><?= $emp['id'] ?></td>
                <td><?= htmlspecialchars($emp['name']) ?></td>
                <td><?= htmlspecialchars($emp['contact_no']) ?></td>
                <td><?= htmlspecialchars($emp['username']) ?></td>
                <td><?= $emp['created_at'] ?></td>
                <td>
                    <a href="index.php?controller=employee&action=edit&id=<?= $emp['id'] ?>">Edit</a>
                    |
                    <a href="index.php?controller=employee&action=delete&id=<?= $emp['id'] ?>"
                       onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<?php require BASE_PATH . '/app/views/layout/footer.php'; ?>
