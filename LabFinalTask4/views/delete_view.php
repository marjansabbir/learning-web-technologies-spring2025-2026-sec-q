<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; }
        .navbar {
            background: #2c2c2c; color: white;
            padding: 15px 30px; display: flex; justify-content: space-between;
        }
        .navbar a { color: #ffcc00; text-decoration: none; }
        .content { max-width: 650px; margin: 30px auto; padding: 0 15px; }
        h2 { color: #e53935; margin-bottom: 20px; }
        table {
            width: 100%; border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px; overflow: hidden;
        }
        th { background: #e53935; color: white; padding: 12px 15px; text-align: left; }
        td { padding: 12px 15px; border-bottom: 1px solid #eee; }
        tr:last-child td { border-bottom: none; }
        tr:hover { background: #fafafa; }
        a.del-btn {
            background: #e53935; color: white;
            padding: 5px 12px; border-radius: 5px;
            text-decoration: none; font-size: 13px;
        }
        a.del-btn:hover { background: #b71c1c; }
        .msg-success { color: green; margin-bottom: 15px; font-size: 14px; }
        .msg-error   { color: red;   margin-bottom: 15px; font-size: 14px; }
        .no-data {
            text-align: center; padding: 40px;
            color: #999; background: white; border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <span>🗑️ Delete Records</span>
    <a href="index.php?page=home">🏠 Back to Home</a>
</div>

<div class="content">
    <h2>🗑️ Delete a Record</h2>

    <?php if ($message !== ""): ?>
        <?php
            list($type, $text) = explode(":", $message, 2);
            $css = ($type === "success") ? "msg-success" : "msg-error";
        ?>
        <p class="<?= $css ?>"><?= htmlspecialchars($text) ?></p>
    <?php endif; ?>

    <?php if (count($records) === 0): ?>
        <div class="no-data">
            <p>No records to delete.</p>
            <p style="margin-top:10px;"><a href="index.php?page=create">➕ Add some records first</a></p>
        </div>
    <?php else: ?>
        <table>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Grade</th>
                <th>Action</th>
            </tr>
            <?php $num = 1; foreach ($records as $rec): ?>
            <tr>
                <td><?= $num++ ?></td>
                <td><?= htmlspecialchars($rec['name']) ?></td>
                <td><?= htmlspecialchars($rec['course']) ?></td>
                <td><?= htmlspecialchars($rec['grade']) ?></td>
                <td>
                    <a href="index.php?page=delete&id=<?= $rec['id'] ?>"
                       class="del-btn"
                       onclick="return confirm('Delete <?= htmlspecialchars($rec['name']) ?>? This cannot be undone.')">
                        🗑️ Delete
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
