<?php
session_start();
if (!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit; 
}

include 'db.php';
include 'navbar.php';

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];

   
    $category = $_POST['category']; // park / cafe / restaurant


    $img = '';
    if (!empty($_FILES['image']['name'])) {
        $img = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $img);
    }

    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];
    $uid = $_SESSION['user']['id'];

   
    $conn->query("INSERT INTO spots (site_name, description, image, latitude, longitude, category, user_id)
                  VALUES ('$name', '$desc', '$img', '$lat', '$lng', '$category', '$uid')");

    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="page-center">
    <div class="card" style="max-width:600px;">
        <h2>Add New Spot</h2>

        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Spot name">

            <textarea name="description" placeholder="Description"></textarea>

            <input type="file" name="image">

           
            <select name="category" class="filter-box" style="width:100%; margin-top:5px; margin-bottom:14px;">
                <option value="park">Park</option>
                <option value="cafe">Cafe</option>
                <option value="restaurant">Restaurant</option>
            </select>

            <input type="text" name="latitude" placeholder="Latitude">
            <input type="text" name="longitude" placeholder="Longitude">

            <button class="btn" name="add">Add Spot</button>
        </form>
    </div>
</div>

</body>
</html>