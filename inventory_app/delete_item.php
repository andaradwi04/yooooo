<?php
include 'db.php';

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM items WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
