<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
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
        else {
            $request->session()->flash('message', 'Register failed, please check again!');
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
        else 
        {
            $request->session()->flash('message', 'Update failed, please try again!');
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
        return view('backend.manager.users.index', compact('active'));
    }
}
