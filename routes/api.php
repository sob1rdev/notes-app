<?php

declare(strict_types=1);

$router = new Router();
$note   = new Notes();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $router->sendResponse($note->getAll());
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newTask      = $note->add($router->getUpdates()->title, $router->getUpdates()->describtion);
    $responseText = $newTask ? 'New task has been added' : 'Something went wrong';
    $router->sendResponse($responseText);

    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    if ($router->getResourceId()) {
        parse_str(file_get_contents('php://input'), $patchVars); 

        $updateResult = $note->update(
            $router->getResourceId(), 
            $router->getUpdates()->title,
            $router->getUpdates()->describtion
        );

        $responseText = $updateResult ? 'Note has been updated' : 'Failed to update note';
        $router->sendResponse($responseText);
    } else {
        $router->sendResponse('Note ID missing');
    }
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if ($router->getResourceId()) {
        $deleteResult = $note->delete($router->getResourceId());
        $responseText = $deleteResult ? 'Note has been deleted' : 'Failed to delete note';
        $router->sendResponse($responseText);
    } else {
        $router->sendResponse('Note ID missing');
    }
    return;
}