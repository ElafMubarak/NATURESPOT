<?php
session_start();
include 'db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM spots WHERE id=$id");
header("Location: dashboard.php");
?>
