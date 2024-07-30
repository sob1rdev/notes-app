<?php
require './db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    $deleteQuery = "DELETE FROM notes WHERE id = :id";
    $stmt = $pdo->prepare($deleteQuery);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $resetAutoIncrement = "ALTER TABLE notes AUTO_INCREMENT = 1";
        $pdo->exec($resetAutoIncrement);

        header('Location: ./index.php');
        exit();
    }
}

