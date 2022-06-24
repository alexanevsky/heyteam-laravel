<?php

namespace App\Http\Controllers;

use App\Api\Tasks\Task;
use App\Api\Tasks\TaskManager;

class TaskController extends Controller
{
    private TaskManager $tasksManager;

    public function __construct(TaskManager $tasksManager)
    {
        $this->tasksManager = $tasksManager;
    }

    public function index()
    {
        $tasks = $this->tasksManager->all();

        return view('tasks/index', [
            'tasks' => $tasks
        ]);
    }

    public function addForm()
    {
        return view('tasks/form', [
            'task' => null
        ]);
    }

    public function updateForm(string $id)
    {
        $task = $this->tasksManager->get($id);

        return view('tasks/form', [
            'task' => $task
        ]);
    }

    public function add()
    {
        $this->validate(request(), [
            'text' => 'required'
        ]);

        $data = request()->all();
        $task = (new Task())
            ->setText($data['text']);

        $this->tasksManager->add($task);

        return redirect('/')->with('success', 'Task added successfully!');
    }

    public function update(string $id)
    {
        $this->validate(request(), [
            'text' => 'required'
        ]);

        $data = request()->all();
        $task = ($this->tasksManager->get($id))
            ->setText($data['text'])
            ->setChecked((bool) ($data['checked'] ?? false));

        $this->tasksManager->update($task);

        return redirect('/')->with('success', 'Task updated successfully!');
    }

    public function delete(string $id)
    {
        $task = $this->tasksManager->get($id);

        $this->tasksManager->delete($task);

        return redirect('/')->with('success', 'Task deleted successfully!');
    }
}
