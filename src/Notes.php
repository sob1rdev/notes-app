<?php

declare(strict_types=1);
namespace App;

class Notes
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo  = DB::connect();
    }

    public function add(string $title, string $describtion): bool
    {
        $status = false;
        $stmt   = $this->pdo->prepare("INSERT INTO notes (title, describtion) VALUES (:title, :desctibtion)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':describtion', $describtion);
        return $stmt->execute();
    }

    public function getAll(): false|array
    {
        return $this->pdo->query("SELECT * FROM notes")->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(int $id, string $title, string $description): bool
    {
    $stmt = $this->pdo->prepare("UPDATE notes SET title = :title, description = :description WHERE id = :id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM notes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}