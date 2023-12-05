<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('is_admin');
    }
    public function index(Request $request)
    {
        // if ($request->search) {
        //     $tasks = DB::table('tasks')
        //         ->where('task', 'LIKE', "%$request->search%")
        //         ->get();
        // } else {
        //     $tasks = DB::table('tasks')->get();
        // }
        if ($request->search) {
            $tasks = Task::where('task', 'LIKE', "%$request->search%")
                ->paginate(3);
        } else {
            $tasks = Task::paginate(3);
        }
        return view('tasks.index', [
            'data' => $tasks
        ]);
    }
    public function create()
    {
        return view('tasks.create');
    }

    public function show($id)
    {
        // if (isset($id)) {
        //     $tasks = DB::table('tasks')
        //         ->where('id', $id)
        //         ->get();

        //     return $tasks;
        // } else {
        //     $tasks = DB::table('tasks')->get();
        //     return $tasks;
        // }
        if (isset($id)) {
            $tasks = Task::find($id);

            return $tasks;
        } else {
            $tasks = Task::all();
            return $tasks;
        }
    }
    public function edit($id)
    {
        $tasks = Task::find($id);
        return view('tasks.edit', compact('tasks'));
    }
    public function store(TaskRequest $request)
    {
        if (isset($request->task) && isset($request->user)) {
            $data = [
                'task' => $request->task,
                'user' => $request->user,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            Task::create($data);

            $result = [
                'status' => true,
                'message' => 'success',
                'data' => $data
            ];
        } else {
            $result = [
                'status' => false,
                'message' => 'failed',
                'data' => 'Please fill a valid request!'
            ];
        }
        return redirect('/tasks');
    }
    public function update(TaskRequest $request, $id)
    {
        $data = [
            'task' => $request->task,
            'user' => $request->user,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $tasks = Task::find($id);
        $tasks->update($data);

        return redirect('/tasks');
    }

    public function destroy($id)
    {
        $tasks = Task::find($id);
        $tasks->delete();

        $result = [
            'status' => true,
            'message' => 'Success to Delete Data!'
        ];
        return redirect('/tasks');
    }
}
