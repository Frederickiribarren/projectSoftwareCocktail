<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function create(){
        return view('usuario.create');
    }
    public function update(){

    }
    public function destroy(User $usuario){
        $usuario->delete();
        return redirect()->route('user')->with('success','usuario eliminado correctamente');
    }
}
