<?php include 'navbar.php'; include 'db.php'; ?>
<?php
if (isset($_POST['register'])) {
    $u = $_POST['username'];
    $e = $_POST['email'];
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users (username, email, password)
                  VALUES ('$u','$e','$p')");

    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>

<div class="page-center">
    <div class="card">
        <h2>Create Account</h2>

        <form method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">

            <button class="btn" name="register">Register</button>
        </form>
    </div>
</div>

</body>
</html>
