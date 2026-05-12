<?php $pageTitle = 'Login'; ?>
<?php require BASE_PATH . '/app/views/layout/header.php'; ?>

<h3>Admin Login</h3>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="index.php?controller=auth&action=login" onsubmit="return validateLogin()">
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" id="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" id="password"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Login">
            </td>
        </tr>
    </table>
</form>

<p>Don't have an account? <a href="index.php?controller=auth&action=register">Register here</a></p>

<script>
function validateLogin() {
    var username = document.getElementById('username').value.trim();
    var password = document.getElementById('password').value.trim();

    if (username === '') { alert('Username is required.'); return false; }
    if (password === '') { alert('Password is required.'); return false; }
    return true;
}
</script>

<?php require BASE_PATH . '/app/views/layout/footer.php'; ?>
