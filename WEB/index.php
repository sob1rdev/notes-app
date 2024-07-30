<?php
require './notes.php';

$stmt = $pdo->query("SELECT * FROM notes");
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .form {
            border: 2px solid #ced4da;
            padding: 1rem;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Note</h1>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="./editModal.php" id="editForm">
                    <input type="hidden" name="id" id="noteId">
                    <div class="mb-3">
                        <label for="edittitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edittitle" name="edittitle" placeholder="Enter Title...">
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea class="form-control" id="desc" name="desc" placeholder="Enter Description..." rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Update Note</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <form class="form" method="post">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title...">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description</label>
                    <textarea class="form-control" id="desc" name="desc" placeholder="Enter Description..." rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Add Note</button>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h1>Your Notes</h1>
            <?php if (count($notes) > 0): ?>
                <?php foreach ($notes as $note): ?>
                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($note['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($note['description']) ?></p>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="populateEditForm(<?= htmlspecialchars(json_encode($note)) ?>)">Edit</a>
                            <a href="./delete.php?id=<?= htmlspecialchars($note['id']) ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title">Message</h5>
                        <p class="card-text" style="color: red">No Notes are available for reading.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    function populateEditForm(note) {
        document.getElementById('noteId').value = note.id;
        document.getElementById('edittitle').value = note.title;
        document.getElementById('desc').value = note.description;
    }
</script>
</body>
</html>
