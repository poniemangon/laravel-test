<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Users;

class user extends Controller
{
    public function list(){
        $users = Users::select('name', 'surname', 'email')->orderBy('user_id', 'desc')->get();

        $scripts = array('users.js');

        return view('users.list', compact('users', 'scripts'));
    }

    public function register(){
        $scripts = array('users.js');


        return view('users.register', compact('scripts'));
    }



    public function registerUser(Request $request){

        

        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $rules = [
            'name' => 'required|string|min:3|max:255',
            'surname' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:la_users|max:255',
            'password' => 'required|string|min:8|max:255',
        ];

        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'surname.required' => 'El apellido es obligatorio.',
            'surname.min' => 'El apellido debe tener al menos 3 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $usersModel = new users();
        $usersModel->name = $name; 
        $usersModel->surname = $surname; 
        $usersModel->email = $email;
        $usersModel->password = $password; 
        $usersModel->save();

        return Response()->json([
            'success'=> true,
            'message'=> 'Usuario registrado con exito'
        ]);
    }
}
