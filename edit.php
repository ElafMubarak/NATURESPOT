<?php
include 'db.php';
include 'navbar.php';

$id = $_GET['id'];


$res = $conn->query("SELECT * FROM spots WHERE id=$id");
$spot = $res->fetch_assoc();


if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];

    // الصورة
    if ($_FILES['image']['name']) {
        $img = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$img");
    } else {
        $img = $spot['image']; 
    }

    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];

  
    $conn->query("
        UPDATE spots 
        SET site_name='$name', description='$desc', image='$img',
            latitude='$lat', longitude='$lng'
        WHERE id=$id
    ");

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>

<div class="page-center">
    <div class="card" style="max-width:600px;">

        <h2>Edit Spot</h2>

        <form method="POST" enctype="multipart/form-data">

            <input type="text" name="name" value="<?= $spot['site_name'] ?>" placeholder="Spot name">
            
            <textarea name="description"><?= $spot['description'] ?></textarea>

            <p>Current Image:</p>
            <img src="uploads/<?= $spot['image'] ?>" width="120" style="border-radius:10px;margin-bottom:10px;">

            <input type="file" name="image">

            <input type="text" name="latitude" value="<?= $spot['latitude'] ?>" placeholder="Latitude">
            <input type="text" name="longitude" value="<?= $spot['longitude'] ?>" placeholder="Longitude">

            <button class="btn" name="update">Save</button>
        </form>

    </div>
</div>

</body>
</html>