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

        $tasks = array_map(function ($item) {
            return new Task($item);
        }, $response);

        usort($tasks, function($a, $b) {
            return $b->getCreatedAt() <=> $a->getCreatedAt();
        });

        return array_values($tasks);
    }

    public function get(string $id): Task
    {
        $response = Http::get(self::API_BASE_URL . '/todos/' . $id)->json();
        $task = new Task($response);

        return $task;
    }

    public function add(Task $task): void
    {
        $data = [
            'text' => $task->getText()
        ];

        $response = Http::post(self::API_BASE_URL . '/todos', $data);

        $task->setId($response['id']);
        $task->setCreatedAtFromTimestamp($response['createdAt']);
        $task->setUpdatedAtFromTimestamp($response['updatedAt']);

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

    public function delete(Task $task)
    {
        Http::delete(self::API_BASE_URL . '/todos/' . $task->getId());
    }
}
