<?php
require 'src/DB.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $stmt = $pdo->prepare("INSERT INTO notes (title, description) VALUES (:title, :description)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $desc);
    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Failed to add note.</div>";
    }
}

$stmt = $pdo->query("SELECT * FROM notes");
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>