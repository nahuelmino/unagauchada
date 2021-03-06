<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;
use App\Compra;

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

            if (! Hash::check(request()->old_password, $user->password)) {
                return redirect()->back()->withErrors(['old_password' => 'La contraseña no coincide.']);
            }
            if (request()->password !== request()->password_confirmation) {
                return redirect()->back()->withErrors(['password_confirmation' => 'Las contraseñas nuevas no coinciden.']);
            }
            $user->password = Hash::make(request()->password);
        /*    dd(Hash::check(request()->password,$user->password)); */
            $user->save();

            session()->flash('alert', 'La contraseña ha sido cambiada.');
           
            Auth::logout();
            return redirect('/');
        }

    }

    public function admin() {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
        return view('admin.tools');
    }

    public function balances() {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
        if (request()->has('fecha_inicio') && request()->has('fecha_fin')) {
            $fecha_inicio = Carbon::createFromFormat('m/Y', request()->fecha_inicio)->format('Y-m-d');
            $fecha_fin = Carbon::createFromFormat('m/Y', request()->fecha_fin)->format('Y-m-d');
            $compras = Compra::with('usuario')->whereBetween('created_at', [$fecha_inicio, $fecha_fin])->get();
        }
        elseif (request()->has('fecha_inicio') && !request()->has('fecha_fin')) {
            $fecha_inicio = Carbon::createFromFormat('m/Y', request()->fecha_inicio)->format('Y-m-d');
            $fecha_fin = Carbon::createFromFormat('m/Y', request()->fecha_fin)->format('Y-m-d');
            $compras = Compra::with('usuario')->where('created_at', '>', $fecha_inicio)->get();
        }
        elseif(!request()->has('fecha_inicio') && request()->has('fecha_fin')) {
            $fecha_inicio = Carbon::createFromFormat('m/Y', request()->fecha_inicio)->format('Y-m-d');
            $fecha_fin = Carbon::createFromFormat('m/Y', request()->fecha_fin)->format('Y-m-d');
            $compras = Compra::with('usuario')->where('created_at', '<', $fecha_fin)->get();
        } else {
            $compras = Compra::with('usuario')->get();
        }
        return view('admin.balances',compact('compras'));
    }

    public function listusers() {
        if (! (Auth::check() && Auth::user()->esAdmin()) )
            return redirect('/home');
        $users = User::all();
        return view('admin.listusers',compact('users'));
    }
    
}
