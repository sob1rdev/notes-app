<?php

declare(strict_types=1);
use PDO;
class Notes {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = DB::connect();
    }
    public function addNotes(int $id): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (text) VALUES (:text)");
        $stmt->bindParam(':note', $note);
    }

    public function getNotes(int $id): array{
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteNotes(int $id):bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateNotes(int $id, string $text): bool
    {
        require 'DB.php';

        $sql = "UPDATE tasks SET text = :text WHERE id = :id";


        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':text', $text, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

}