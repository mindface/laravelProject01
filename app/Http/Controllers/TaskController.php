<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
// use App\Models\Todo;

class TaskController extends Controller
{
    public function index(Request $request) {
      $tasks = Task::where('user_id', Auth::id())->get();
      return view('task.index',['tasks' => $tasks]);
      // return view('tasks.index', compact('tasks'));
    }

    public function create(){
      return view('task.create');
    }

    public function store(Request $request) {
      $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
      ]);

      $userId = Auth::id();

      $task = Task::create(array_merge($validatedData, ['user_id' => $userId]));
      return redirect()->route('task.create')->with('success', 'Task created successfully!');
    }

    public function update(Request $request, $id) {
      $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
      ]);

      $task = Task::find($id);

      if(!$task) {
        return response()->json(['message' => 'Task not found'], 404);
      }

      $task->update($validatedData);

      return response()->json($task, 200);
    }
}
