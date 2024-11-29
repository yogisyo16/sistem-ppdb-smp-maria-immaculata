<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolePanitiaController extends Controller
{
    public function roleManyShow(User $user){
        $user = Auth::user();
        $roles = $user->role;
        $rolecount = count($roles);
        return view('pages.user-auth.many-role-user', compact('roles', 'rolecount'));
    }
}
