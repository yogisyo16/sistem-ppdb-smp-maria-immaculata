<?php

namespace App\Http\Controllers;

use App\Models\Periodic;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminShowhome(User $user){
        $user = User::get();
        $role_now = Auth::user();
        $roles = $role_now->role;
        $periodic = Periodic::get();
        return view('pages.panitia.admin.home-admin', compact('user', 'periodic', 'roles'));
    }

    public function adminCreateShow(){
        $role_now = Auth::user();
        $roles = $role_now->role;
        return view('pages.panitia.admin.admin-user-create', compact('roles'));
    }

    public function adminCreateSubmit(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'role.*' => 'in:admin,inti,keuangan,wawancara,seragam',
        ]);
        

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect(route('adminShowhome'));
    }

    public function adminEditShow($id){
        $users = User::where('id', $id)->get();
        $role_now = Auth::user();
        $roles = $role_now->role;
        return view('pages.panitia.admin.admin-user-edit', compact('users', 'roles'));
    }

    public function adminEditSubmit(Request $request, $id){
        $getPass = User::where('id', $id)->get();
        if($request['password'] != null){
            $password = Hash::make($request['password']);
        }else{
            $password = $getPass[0]->password;
        }
        User::where('id', $id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $password,
            'role' => $request['role'],
        ]);
        return redirect(route('adminShowhome'));
    }

    public function adminDeleteUser($id){
        User::where('id', $id)->delete();
        return redirect(route('adminShowhome'));
    }

    public function adminCreatePeriodShow(){
        $role_now = Auth::user();
        $roles = $role_now->role;
        return view('pages.panitia.admin.admin-periodic-create', compact('roles'));
    }

    public function adminCreatePeriodSubmit(Request $request){
        $validated = $request->validate([
            'tahun_ajaran' => 'required',
        ]);

        $period = Periodic::create([
            'tahun_ajaran' => $validated['tahun_ajaran'],
        ]);
        return redirect(route('adminShowhome'));
    }

    public function deletePeriodic($id){
        $period = Periodic::where('id', $id)->delete();
        return redirect(route('adminShowhome'));
    }
}
