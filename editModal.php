<?php
include './db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['edittitle'];
    $description = $_POST['desc'];

    $sql = 'UPDATE notes SET title = :title, description = :description WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'title' => $title,
        'description' => $description,
        'id' => $id
    ]);

    header('Location: index.php');
    exit();
}
?>
