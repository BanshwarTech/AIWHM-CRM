<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\admin\task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function tasks()
    {
        $result['tasks'] = task::with('user')->get();
        $result['user'] = currentUser();
        return view('common.tasks', $result);
    }

    public function manageTasks($id = null)
    {
        $result['task'] = $id ? Task::with('user')->findOrFail($id) : null;
        $result['users'] = User::select('id', 'name')->where('role', '!=', 'admin')->get();
        $result['user'] = currentUser();
        return view('common.manage-tasks', $result);
    }

    public function manageTasksCreate(Request $request, $id = null)
    {
        // dd($request->all());
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'user_id'     => 'required|exists:users,id',
                'title'       => 'required|string|max:255',
                'description' => 'required|string',
                'status'      => 'required|string|in:pending,in_progress,completed',
                'start_date'  => 'required|date',
                'due_date'    => 'required|date|after_or_equal:start_date',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($id) {
                // Update existing task
                $task = Task::findOrFail($id);
                $task->update($request->only(['user_id', 'title', 'description', 'status', 'start_date', 'due_date']));
                $message = 'Task updated successfully.';
            } else {
                // Create new task
                Task::create($request->only(['user_id', 'title', 'description', 'status', 'start_date', 'due_date']));
                $message = 'Task created successfully.';
            }

            return redirect()->route('tasks')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Task creation/update failed: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => $request->user_id ?? null,
                'task_id' => $id,
            ]);

            return redirect()->back()->with('error', 'An error occurred while processing the task.')->withInput();
        }
    }

    public function destroyTask($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();

            return redirect()->route('tasks')->with('success', 'Task deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Task deletion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the task.');
        }
    }
    public function viewTask()
    {
        $result['user'] = currentUser();
        return view('common.view-task', $result);
    }
}
