<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="nav">
    <div class="nav-inner">
        <div class="nav-brand">NatureSpot</div>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="explore.php">Explore</a>

            <?php if(isset($_SESSION['user'])): ?>
                <a href="add.php">Add Spot</a>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php" class="logout-btn">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="script.js"></script>
