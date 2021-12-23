<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class ManagerController extends Controller
{
    public function indexAdmins() 
    {
        $active = "managerAdmins";
        $admins = Admin::paginate(5);
        return view('backend.manager.admins.index', compact('active','admins'));
    }

    public function createAdmin() 
    {
        return view('backend.manager.admins.create');
    }
    
    public function storeAdmin(Request $request) 
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'unique:admins,email'],
            'name' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        if ($validated) {
            Admin::create($request->input());
            $request->session()->flash('success', 'Added an admin to the table successfully!');
            return redirect('/admin/manager/admins');
        }
    }
    
    public function showAdmin(Admin $admin) 
    {
        return view('backend.manager.admins.show', ['admin' => $admin]);
    }

    public function editAdmin(Admin $admin)
    {
        return view('backend.manager.admins.edit', ['admin' => $admin]);
    }
    public function updateAdmin(Request $request, Admin $admin) 
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('admins')->ignore($admin)],
            'role' => ['required']
        ]);
        if ($validated) {
            Admin::where('id', $request->input('id'))->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => $request->input('role'),
                'updated_at' => now()
            ]);
            return redirect('/admin/manager/admins')->with('success', 'Update Information Completed!');
        }
    }
    public function deleteAdmin(Admin $admin) {
        Admin::where('id', $admin->id)->delete();
        session()->flash('success', 'Delete Completed!');
        return redirect('/admin/manager/admins');
    }
    public function indexUsers() 
    {
        $active = "managerUsers";
        $users = User::paginate(15);
        return view('backend.manager.users.index', compact('active', 'users'));
    }
    public function createUser() 
    {
        return view('backend.manager.users.create');
    }
    public function storeUser()
    {   
        request()->validate([
            'email' => ['required','unique:users,email'],
            'name' => 'required',
            'password' => 'required',
            'phonenumber' => 'required',
        ]);
        User::create([
            'email' => request()->input('email'),
            'name' => request()->input('name'),
            'password' => request()->input('password'),
            'phonenumber' => request()->input('phonenumber')
        ]);
        return redirect('/admin/manager/users')->with('success','I have added an user record to the table!');
    }
    public function showUser(User $user) {
        return view('backend.manager.users.show', ['user' => $user]);
    }
    public function editUser(User $user) {
        return view('backend.manager.users.edit', ['user' => $user]);
    }
    public function updateUser(User $user) {
        request()->validate([
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'name' => 'required',
            'phonenumber' => 'required',
        ]);
        User::where('id', $user->id)->update([
            'email' => request()->input('email'),
            'name' => request()->input('name'),
            'phonenumber' => request()->input('phonenumber'),
            'updated_at' => now()
        ]);
        return redirect('/admin/manager/users')->with('success', 'Change Information Completed');
    }
    public function deleteUser(User $user) {
        User::where('id', $user->id)->delete();
        return redirect('/admin/manager/users')->with('success', 'Successfully Removed A User Record!');
    }
}
