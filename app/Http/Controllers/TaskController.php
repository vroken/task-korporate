<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tasks.index', [
            "tasks" => Task::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateDate = $request->validate([
            'nama' => 'required|max:255',
            'status' => 'required',
            'images' => 'image|mimes:jpeg,png|max:3050',
            'deskripsi' => 'max:5000|nullable',
        ]);

        
        $foto = $request->file('images')->store('image-store', 'public');
        
        if ($request->file('images')) {
            $validatedData['images'] = $request->file('images')->store('post-images');
        }
        
        $validateData['user_id'] = auth()->user()->id;
        Task::create([
            'user_id' => auth()->user()->id,
            'images' => $foto,
            'nama' => $request->nama,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect('/home/task')->with('message', 'Postingan baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', [
            'tasks' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'tasks' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $rules = [
            'nama' => 'required|max:255',
            'status' => 'required',
            'images' => 'image|mimes:jpeg,png|max:3050',
            'deskripsi' => 'max:5000|nullable',
        ];

        $validateDate = $request->validate($rules);

        if($request->file('images')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateDate['images'] = $request->file('images')->store('image-store');
        }

        $validateDate['user_id'] = auth()->user()->id;

        Task::where('id', $task->id)->update($validateDate);

        return redirect('/home/task')->with('message', 'Post has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
    {
        DB::beginTransaction();
        try {

            Task::destroy($request->id);
            DB::commit();
            return redirect()->back()->with('message', 'Post has been Deleted!');
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('message', 'Post failed to delete');
        }
    }

    public function deleteAll(Request $request) {
        $ids = $request->ids;
        Task::whereIn('id', $ids)->delete();
        return response()->json(["message" => "All Post has been Deleted!"]);
    }

}
