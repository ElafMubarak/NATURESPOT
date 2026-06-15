<?php include 'db.php'; include 'navbar.php'; ?>
<?php
if (isset($_POST['login'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE username='$u'");
    $user = $res->fetch_assoc();

    if ($user && password_verify($p, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
    } else {
        $error = "Invalid login";
    }
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>

<div class="page-center">
    <div class="card">
        <h2>Login</h2>

        <form method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <button class="btn" name="login">Login</button>
        </form>

        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </div>
</div>

</body>
</html>
