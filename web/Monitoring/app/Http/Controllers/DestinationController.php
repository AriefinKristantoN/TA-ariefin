<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Task;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::with('task')->get();
        return view('task.penugasan', compact('destinations'));
    }

    public function create()
    {
        $tasks = Task::all();
        return view('destinations.create', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'awal' => 'required|string|max:255',
            'akhir' => 'required|string|max:255',
            'tambahan' => 'nullable|string|max:255',
            'task_id' => 'required|exists:tasks,id', // Ubah 'tugas' menjadi 'tasks' sesuai dengan nama tabel
        ]);

        Destination::create($validatedData);

        return redirect()->route('admin.destinations.index')->with('success', 'Destination created successfully.');
    }

    public function edit(Destination $destination)
    {
        $tasks = Task::all();
        return view('destinations.edit', compact('destination', 'tasks')); // Ubah view ke 'destinations.edit'
    }

    public function update(Request $request, Destination $destination)
    {
        $validatedData = $request->validate([
            'awal' => 'required|string|max:255',
            'akhir' => 'required|string|max:255',
            'tambahan' => 'nullable|string|max:255',
            'task_id' => 'required|exists:tasks,id', // Ubah 'tugas' menjadi 'tasks' sesuai dengan nama tabel
        ]);

        $destination->update($validatedData);

        return redirect()->route('admin.destinations.index')->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()->route('admin.destinations.index')->with('success', 'Destination deleted successfully.');
    }
}
