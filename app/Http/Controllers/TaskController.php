<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use App\Http\Requests\CreateTask;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id)
    {
        //get all folders
        $folders = Folder::all();

        //get a selected folder
        $current_folder = Folder::find($id);

        //get tasks from selected folder
        $tasks = $current_folder->tasks()->get();

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
        ]);
    }

    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;
        $task->folder_id = $current_folder->id;
        $task->save();

//        $current_folder->tasks->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
            ]);
    }
}
