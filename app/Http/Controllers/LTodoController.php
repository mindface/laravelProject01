<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Todo;

class TodoController extends Controller
{
  public function index(Request $request) {
    // $todos = Todo::all();
    return []//view('todo.index',['todos',$todos]);
  }
}
