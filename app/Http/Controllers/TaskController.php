<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('dashboard', compact('tasks'));
    }
    public function create()
    {
        $users = User::all(); 
        return view('create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'status' => 0,
        ]);

        return redirect()->route('dashboard')->with('success', 'Görev başarıyla eklendi.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Görev başarıyla silindi.');
    }

    public function edit(Task $task)
    {
        $users = User::all(); 
        return view('edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|integer',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard')->with('success', 'Görev başarıyla güncellendi.');
    }
    public function complete(Task $task)
    {
        $task->update([
            'status' => 1, 
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Görev başarıyla tamamlandı.');
    }
    
}
