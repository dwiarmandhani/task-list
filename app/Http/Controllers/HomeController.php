<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $tasks = Task::where('task', 'LIKE', "%$request->search%")
                ->paginate(3);
        } else {
            $tasks = Task::paginate(3);
        }
        return view('welcome', [
            'data' => $tasks
        ]);
        return view('welcome');
    }
}
