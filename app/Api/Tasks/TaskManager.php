<?php

namespace App\Api\Tasks;

use Illuminate\Support\Facades\Http;

class TaskManager
{
    private const API_BASE_URL = 'https://arfkcpx7m7.execute-api.us-east-1.amazonaws.com/dev';

    /**
     * @return Task[]
     */
    public function all(): array
    {
        $response = Http::get(self::API_BASE_URL . '/todos')->json();
        $tasks = array_map(fn($item) => new Task($item), $response);

        usort($tasks, fn($a, $b) => $b->getCreatedAt() <=> $a->getCreatedAt());

        return $tasks;
    }

    public function get(string $id): Task
    {
        $response = Http::get(self::API_BASE_URL . '/todos/' . $id)->json();

        return new Task($response);
    }

    public function add(Task $task): void
    {
        $data = [
            'text' => $task->getText()
        ];
        $response = Http::post(self::API_BASE_URL . '/todos', $data);
        $task
            ->setId($response['id'])
            ->setCreatedAtFromTimestamp($response['createdAt'])
            ->setUpdatedAtFromTimestamp($response['updatedAt']);

    }

    public function update(Task $task): void
    {
        $data = [
            'text'      => $task->getText(),
            'checked'   => $task->getChecked()
        ];
        $response = Http::put(self::API_BASE_URL . '/todos/' . $task->getId(), $data);
        $task->setUpdatedAtFromTimestamp($response['updatedAt']);
    }

    public function delete(Task $task): void
    {
        Http::delete(self::API_BASE_URL . '/todos/' . $task->getId());
    }
}
