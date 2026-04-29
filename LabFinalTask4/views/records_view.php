<!DOCTYPE html>
<html>
<head>
    <title>View Records</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; }
        .navbar {
            background: #2c2c2c; color: white;
            padding: 15px 30px; display: flex; justify-content: space-between;
        }
        .navbar a { color: #ffcc00; text-decoration: none; }
        .content { max-width: 750px; margin: 30px auto; padding: 0 15px; }
        h2 { color: #333; margin-bottom: 20px; }
        table {
            width: 100%; border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px; overflow: hidden;
        }
        th { background: #1a73e8; color: white; padding: 12px 15px; text-align: left; }
        td { padding: 12px 15px; border-bottom: 1px solid #eee; }
        tr:last-child td { border-bottom: none; }
        tr:hover { background: #f9f9f9; }
        .action-link { color: #1a73e8; text-decoration: none; margin-right: 8px; }
        .del-link    { color: #e53935; text-decoration: none; }
        .no-data { text-align: center; padding: 40px; color: #999; background: white; border-radius: 8px; }
    </style>
</head>
<body>

<div class="navbar">
    <span>📋 All Records</span>
    <a href="index.php?page=home">🏠 Back to Home</a>
</div>

<div class="content">
    <h2>📋 Student Records</h2>

    <?php if (count($records) === 0): ?>
        <div class="no-data">
            <p>No records found yet.</p>
            <?php if ($user['role'] === 'admin'): ?>
                <p style="margin-top:10px;"><a href="index.php?page=create">➕ Add the first record</a></p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <table>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Grade</th>
                <?php if ($user['role'] === 'admin'): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
            <?php $num = 1; foreach ($records as $rec): ?>
            <tr>
                <td><?= $num++ ?></td>
                <td><?= htmlspecialchars($rec['name']) ?></td>
                <td><?= htmlspecialchars($rec['course']) ?></td>
                <td><?= htmlspecialchars($rec['grade']) ?></td>
                <?php if ($user['role'] === 'admin'): ?>
                <td>
                    <a href="index.php?page=update&id=<?= $rec['id'] ?>" class="action-link">✏️ Edit</a>
                    <a href="index.php?page=delete&id=<?= $rec['id'] ?>"
                       class="del-link"
                       onclick="return confirm('Are you sure you want to delete this record?')">
                        🗑️ Delete
                    </a>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
