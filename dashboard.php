<?php
session_start();
if (!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit; 
}

include 'navbar.php';
include 'db.php';

$uid = $_SESSION['user']['id'];
$res = $conn->query("SELECT * FROM spots WHERE user_id=$uid");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<div class="header-row">
    <h2>Your Spots</h2>
    <a href="add.php" class="btn-add">+ Add</a>
</div>


<div class="container" style="width:90%;max-width:1100px;margin:auto;margin-top:20px;">
<table>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Category</th> <th>Location (Lat/Long)</th> <th>Actions</th>
        </tr>

        <?php while($row = $res->fetch_assoc()): ?>
        <tr>
            <td><?= $row['site_name'] ?></td>
            
            <td>
                <img src="uploads/<?= $row['image'] ?>" width="100" style="border-radius:8px;">
            </td>

            <td><?= $row['category'] ?></td>

            <td>
                <?= $row['latitude'] ?><br>
                <?= $row['longitude'] ?>
            </td>

            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                &nbsp;|&nbsp;
                <a href="delete.php?id=<?= $row['id'] ?>" class="confirm">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>
</div>

</body>
</html>