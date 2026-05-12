<?php $pageTitle = 'Register'; ?>
<?php require BASE_PATH . '/app/views/layout/header.php'; ?>

<h3>Admin Registration</h3>

<?php if (!empty($success)): ?>
    <p style="color:green;">
        <?= htmlspecialchars($success) ?>
        <a href="index.php?controller=auth&action=login">Login here</a>
    </p>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="index.php?controller=auth&action=register" onsubmit="return validateRegister()">
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
            <td>Confirm Password:</td>
            <td><input type="password" name="confirm_password" id="confirm_password"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Register">
            </td>
        </tr>
    </table>
</form>

<p>Already have an account? <a href="index.php?controller=auth&action=login">Login here</a></p>

<script>
function validateRegister() {
    var username = document.getElementById('username').value.trim();
    var password = document.getElementById('password').value.trim();
    var confirm  = document.getElementById('confirm_password').value.trim();

    if (username === '') { alert('Username is required.');           return false; }
    if (password === '') { alert('Password is required.');           return false; }
    if (confirm  === '') { alert('Please confirm your password.');   return false; }
    if (password !== confirm) { alert('Passwords do not match.');    return false; }
    return true;
}
</script>

<?php require BASE_PATH . '/app/views/layout/footer.php'; ?>
