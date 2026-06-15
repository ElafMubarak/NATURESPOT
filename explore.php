<?php include 'navbar.php'; include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Explore</title>
    <link rel="stylesheet" href="style.css?v=5">
</head>
<body>

<div class="filter-container">
    <form method="GET">
        <select name="filter" class="filter-box">
            <option value="">All Spots</option>
            <option value="park">Parks</option>
            <option value="cafe">Cafes</option>
            <option value="restaurant">Restaurants</option>
        </select>

        <select name="sort" class="sort-box">
            <option value="new">Newest</option>
            <option value="old">Oldest</option>
            <option value="az">A → Z</option>
            <option value="za">Z → A</option>
        </select>

        <button class="search-btn" style="margin-left:10px;">Apply</button>
    </form>
</div>

<div class="grid">
<?php
$filter = $_GET['filter'] ?? "";
$sort   = $_GET['sort'] ?? "";

$query = "SELECT * FROM spots WHERE 1 ";

if ($filter) {
    $query .= " AND category = '$filter' ";
}

if ($sort == "new") {
    $query .= " ORDER BY id DESC ";
} elseif ($sort == "old") {
    $query .= " ORDER BY id ASC ";
} elseif ($sort == "az") {
    $query .= " ORDER BY site_name ASC ";
} elseif ($sort == "za") {
    $query .= " ORDER BY site_name DESC ";
}

$res = $conn->query($query);

while ($row = $res->fetch_assoc()):
?>
    <div class="card-item">
        <img src="uploads/<?= $row['image'] ?>">
        
        <div class="card-body">
            <h3><?= $row['site_name'] ?></h3>
            <p><?= $row['description'] ?></p>

            <?php if(!empty($row['latitude']) && !empty($row['longitude'])): ?>
                <a href="https://www.google.com/maps?q=<?= $row['latitude'] ?>,<?= $row['longitude'] ?>" 
                   target="_blank" 
                   style="display:inline-block; margin-top:10px; color:#5F6F52; font-weight:bold; text-decoration:none;">
                   📍 View on Map
                </a>
            <?php endif; ?>
            </div>
    </div>
<?php endwhile; ?>
</div>

</body>
</html>