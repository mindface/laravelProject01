<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TaskApiController extends Controller
{
  public function index(Request $request): JsonResponse
  {
    if(!Auth::check()) {
      return response()->json(['message' => 'Unauthorized. Please log in.'], 401);
    }
    $tasks = Task::where("user_id", Auth::id())->get();
    return response()->json($tasks, 200);
  }

  public function store(Request $request): JsonResponse
  {
    if(!Auth::check()) {
      return response()->json(['message' => 'Unauthorized. Please log in.'], 401);
    }
    $data = $request->json()->all();
    $validator = Validator::make($data, [
      'title' => 'required|string|max:255',
      'body' => 'required|string',
    ]);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 422);
    }
    $validatedData = $validator->validated();
    $userId = Auth::id();
    $task = Task::create(array_merge($validatedData, ['user_id' => $userId]));

    return response()->json([
      'message' => 'Task created successfully!',
      'task' => $task
    ], 201);
  }

  public function update(Request $request, $id): JsonResponse
  {
    if(!Auth::check()) {
      return response()->json(['message' => 'Unauthorized. Please log in.'], 401);
    }
    $data = $request->json()->all();
    $validatedData = Validator::make($data, [
      'title' => 'required|string|max:255',
      'body' => 'required|string',
    ]);
    if ($validatedData->fails()) {
      return response()->json(['errors' => $validatedData->errors()], 422);
    }

    $validatedDataArray = $validatedData->validated();
    $user = Auth::user();
    $task = $user->tasks()->find($id);
    if(!$task) {
      return response()->json(['message' => 'Task not found'], 404);
    }
    $task->update($validatedDataArray);
    return response()->json($task, 200);
  }

  public function destroy(Request $request, $id): JsonResponse
  {
    if(!Auth::check()) {
      return response()->json(['message' => 'Unauthorized. Please log in.'], 401);
    }

    $user = Auth::user();
    $task = $user->tasks()->find($id);
    if(!$task) {
      return response()->json(['message' => 'Task not found'], 404);
    }

    $task->delete();
    return response()->json(['message' => 'Task deleted successfully'], 200);
  }

}
