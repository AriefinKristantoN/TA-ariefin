<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Car;

class ApitaskController extends Controller
{
    public function fetchTugas(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|integer',
        ]);

        $tasks = Task::where('driver_id', $request->driver_id)
                     ->where('status', 'pending')
                     ->with('car') // Assuming Task model has relation with Car model
                     ->get();

        return response()->json($tasks);
    }

    public function acceptTugas(Request $request)
    {
        $request->validate([
            'task_id' => 'required|integer',
        ]);

        $task = Task::find($request->task_id);

        if ($task) {
            $task->status = 'accepted';
            $task->save();

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Task not found'], 404);
        }
    }
}
