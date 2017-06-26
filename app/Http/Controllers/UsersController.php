<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

class UsersController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function edit() {
        $user = Auth::user();
        return view('users.edit')->withUser($user);
    }
    
    public function update() {
        $user = Auth::user();
        $user->name = (request()->has('name')) ? request()->name : $user->name;
        $user->surname = (request()->has('surname')) ? request()->surname : $user->surname;
        
        /*
            Por si el email necesita poder ser cambiado también

        $emailYaUsado = User::where('email', request()->email)->count() > 0;

        if ($emailYaUsado) return redirect()->back()->withErrors('email', 'El email ya está siendo utilizado por otra persona');

        $user->email = empty(request()->email) ? request()->email : $user->email;

        */

        $user->date_of_birth = (request()->has('date_of_birth')) ? request()->date_of_birth : $user->date_of_birth;
        if (request()->has('caracteristica') && request()->has('phone')) {
            $user->phone = request()->caracteristica . '-' . request()->phone;
        }
        if (request()->hasFile('photo')) {
            $directory = 'usuarios';
            $path = '/storage/' . request()->photo->store($directory, 'public');
            $user->photo = $path;
        }
        $user->save();
        session()->flash('alert', 'Los cambios han sido guardados con éxito');
        return redirect()->back();
    }

    public function editPassword() {
        return view('users.change_password');
    }

    public function updatePassword() {

        if (request()->has('old_password')) {
            $user = Auth::user();

            if (Hash::check(request()->old_password, $user->password)) {
                $user->password = request()->new_password;
                $user->save();

                session()->flash('alert', 'La contraseña ha sido cambiada.');
               
                Auth::logout();
                return redirect('/');
            } else {
                return redirect()->back()->withErrors(['old_password' => 'La contraseña no coincide.']);
            }
        }

    }
    
}
