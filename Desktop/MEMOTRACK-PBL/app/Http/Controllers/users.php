<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\View\View; // <-- ini untuk return View
use App\Http\Controllers\Controller; // <-- ini untuk extend Controller

class userscontroller extends Controller
{
    public function show(): View
    {
        $data = Users::all();

        $nama = [];
        $email = [];
        $role = [];
        $password = [];

        foreach ($data as $user) {
            $nama[] = $user->nama;
            $email[] = $user->email;
            $role[] = $user->role;
            $password[] = $user->password;
        }

        return view('user.index', compact('nama', 'email', 'role', 'password'));
    }
}
