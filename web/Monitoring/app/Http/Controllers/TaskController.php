<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Destination;
use App\Models\Driver;
use App\Models\Location;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data penugasan dengan driver dan mobil (mobil) terkait
        $tasksQuery = Task::with(['driver', 'mobil']);

        // Lakukan pencarian jika parameter 'search' ada dalam request
        if ($request->has('search')) {
            $search = $request->search;
            $tasksQuery->where(function ($query) use ($search) {
                $query->whereHas('driver', function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%');
                })->orWhereHas('mobil', function ($query) use ($search) {
                    $query->where('nopol', 'like', '%' . $search . '%');
                })->orWhere('penugasan', 'like', '%' . $search . '%')
                  ->orWhere('tanggal', 'like', '%' . $search . '%');
            });
        }

        $tasks = $tasksQuery->get();
        // Ambil semua data driver dan mobil
        $drivers = Driver::all();
        $cars = Car::all();

        // Ambil ID mobil dan driver yang sudah dipilih
        $selectedCars = Task::where('status', '!=', 'finish')->pluck('mobil_id')->toArray();
        $selectedDrivers = Task::where('status', '!=', 'finish')->pluck('driver_id')->toArray();

        // Cari mobil dan driver yang tersedia yang belum dipilih dalam penugasan
        $availableCars = Car::whereNotIn('nopol', $selectedCars)->orWhereIn('nopol', function ($query) {
            $query->select('mobil_id')
                  ->from('tugas')
                  ->where('status', 'finish');
        })->get();

        $availableDrivers = Driver::whereNotIn('id', $selectedDrivers)->orWhereIn('id', function ($query) {
            $query->select('driver_id')
                  ->from('tugas')
                  ->where('status', 'finish');
        })->get();

        return view('task.penugasan', compact('tasks', 'drivers', 'availableDrivers', 'cars', 'availableCars'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'driver_id' => 'nullable|integer',
            'mobil_id' => 'nullable|string|max:12',
            // 'lokasi_id' => 'nullable|integer',
            // 'admin_id' => 'nullable|integer',
            // 'tujuan_id' => 'nullable|integer',
            'penugasan' => 'required|string',
            'tanggal' => 'nullable|date',
        ]);

        Task::create($validatedData);

        return redirect()->route('admin.tasks.index')->with('success', 'Task berhasil ditambahkan');
    }

    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'driver_id' => 'nullable|integer',
            'mobil_id' => 'nullable|string|max:12',
            // 'lokasi_id' => 'nullable|integer',
            // 'admin_id' => 'nullable|integer',
            // 'tujuan_id' => 'nullable|integer',
            'penugasan' => 'required|string',
            'tanggal' => 'nullable|date',
        ]);

        $task->update($validatedData);

        return redirect()->route('admin.tasks.index')->with('success', 'Task berhasil diperbarui');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('admin.tasks.index')->with('success', 'Task berhasil dihapus');
    }

    public function finishTask(Task $task)
    {
        $task->status = 'finish';
        $task->save();

        return redirect()->route('admin.tasks.index')->with('success', 'Status tugas berhasil diubah menjadi finish.');
    }





}
