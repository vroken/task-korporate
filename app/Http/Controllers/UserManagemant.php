<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class UserManagemant extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index',compact('users'));
    }

    public function userView($id)
    {
        $users = User::where('id',$id)->first();
        return view('user.show',[
            "user" => $users,
        ]);
    }

    public function editUser($id)
    {
        try {
            $student = User::findOrFail($id);
    
            return view('user.edit', ['users' => $student]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle not found exception (e.g., redirect to a 404 page)
            return abort(404);
        }
    }

    public function userUpdate(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ];
        
        if ($request->filled('new_password')) {
            $rules['current_password'] = ['required', new MatchOldPassword];
            $rules['new_password'] = 'required';
            $rules['new_confirm_password'] = 'same:new_password';
        }
        
        $validatedData = $request->validate($rules);
        
        // Find the user by ID and update the attributes
        $user = User::find($id);
        
        if (!$user) {
            return redirect()->back()->with('message', 'User not found');
        }
        
        $user->update($validatedData);
        
        return redirect()->back()->with('message', 'User has been updated!');        
    }

    public function userDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            User::destroy($request->id);
            DB::commit();
            return redirect()->back()->with('message', 'User has been deleted!');
    
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('message', 'User failed to delete!');
        }
    }
}
