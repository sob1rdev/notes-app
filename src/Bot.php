<?php
declare(strict_types=1);

use GuzzleHttp\Client;
use PDO;

class Bot
{
    private const TOKEN = "7247419216:AAFhEMoTi5Two1IHqkn8EKsUZr0Q-7Sqz04";
    private const API = "https://api.telegram.org/bot" . self::TOKEN . "/";
    private Client $http;
    private PDO $pdo;

    public function __construct()
    {
        $this->http = new Client(['base_uri' => self::API]);
        $this->pdo = DB::connect();
    }

    public function handleStartCommand(int $chatId): void
    {
        $this->sendMessage($chatId, 'Xush Kelibsiz Todo Listga');
    }

    public function addHandlerCommand(int $chatId): void
    {
        $keyboard = [
            'inline_keyboard' => [
                [['text' => 'Get Tasks', 'callback_data' => 'get_tasks']]
            ]
        ];
        $replyMarkup = json_encode($keyboard);
        $this->sendMessage($chatId, "taskingizni kiriting:", $replyMarkup);
    }

    public function addTask(string $text, int $chatId): void
    {
        $task = new Task();
        $task->add($text);
        $this->sendMessage($chatId, "Yangi task qoshildi: $text");
    }
    public function handleEditCommand($chatId, $messageText): void
    {

        if (preg_match('/\/edit (\d+) (.+)/', $messageText, $matches)) {
            $taskId = (int)$matches[1];
            $newText = $matches[2];

            $task = new Notes();
            $isUpdated = $task->updateNotes($taskId, $newText);

            if ($isUpdated) {
                $this->sendMessage($chatId, "Eslatma yangilandi: $newText");
            } else {
                $this->sendMessage($chatId, "Eslatma yangilanishi muvaffaqiyatsiz bo'ldi.");
            }
        } else {
            $this->sendMessage($chatId, "Buyruq formatini tekshiring. To'g'ri format: /edit <taskId> <newText>");
        }
    }

    public function getTask(int $chatId): void
    {
        $this->sendTaskList($chatId, "Tasklar:", true);
    }

    public function handleCallbackQuery(array $callbackQuery): void
    {
        $chatId = $callbackQuery['message']['chat']['id'];
        $callbackData = $callbackQuery['data'];

        if ($callbackData === 'get_tasks') {
            $this->getTask($chatId);
        } elseif (strpos($callbackData, 'delete_task_') === 0) {
            $taskId = (int)str_replace('delete_task_', '', $callbackData);
            $this->deleteTask($taskId, $chatId);
            $this->sendTaskList($chatId, "Task $taskId o'chirildi", true);
        }
    }

    private function sendTaskList(int $chatId, string $message, bool $includeCheckboxes): void
    {
        $task = new Notes();
        $tasks = $task->getnotes($chatId);

        $text = 'No tasks available.';
        $keyboard = ['inline_keyboard' => []];

        if (!empty($tasks)) {
            $text = ''; // Clear default message if tasks exist

            foreach ($tasks as $task) {
                if ($includeCheckboxes) {
                    $keyboard['inline_keyboard'][] = [
                        ['text' => "Delete Task {$task['id']}", 'callback_data' => "delete_task_{$task['id']}"]
                    ];
                }
            }
        }

        $replyMarkup = json_encode($keyboard);
        $this->sendMessage($chatId, $message . "\n" . $text, $replyMarkup);
    }

    public function deleteTask(int $taskId, int $chatId): void
    {
        $task = new Notes();
        $task->deleteNotes($taskId);
        $this->sendMessage($chatId, "Task $taskId o'chirildi.");
    }

    public function sendMessage(int $chatId, string $text, ?string $replyMarkup = null): void
    {
        $data = [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'HTML',
        ];
        if ($replyMarkup) {
            $data['reply_markup'] = $replyMarkup;
        }

        try {
            $this->http->post('sendMessage', ['json' => $data]);
        } catch (\Exception $e) {
            error_log("Failed to send message: " . $e->getMessage());
        }
    }
}