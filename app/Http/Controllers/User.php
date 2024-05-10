<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Users;

use Session;

class user extends Controller 
{
    public function list(){

        if(!Session::has('administrator')){
            return Redirect('/login');
        }

        $users = Users::select('user_id','name', 'surname', 'email', 'registration_date')->orderBy('user_id', 'desc')->paginate(20);

        $scripts = array('users.js');

        $administrator = Session::get('administrator');

        return view('users.home', compact('users', 'scripts', 'administrator'));
    }

    public function register(){
   
        $scripts = array('users.js');

        if(Session::has('administrator')){
            $isAdmin = true;
            

        }
        else {
            $isAdmin = false;
        }


        return view('users.register', compact('scripts', 'isAdmin'));
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
        $usersModel->registration_date = date('Y-m-d');
        $usersModel->save();

        return Response()->json([
            'success'=> true,
            'message'=> 'Usuario registrado con exito'
        ]);
    }
    public function edit($userId){
        
        if(!Session::has('administrator')){
            return Redirect('/login');
        }
        $userData = Users::select('user_id', 'name', 'surname', 'email')->where('user_id', $userId)->first();

        if(!$userData){
            return Redirect('/');
        }

        $scripts = array('users.js');

        return view('users.edit', compact('scripts', 'userData'));
    }
    public function editUser(Request $request, $userId){

        if(!Session::has('administrator')){
            return Redirect('/login');
        }
 

        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $password = $request->input('password');

        

        $rules = [
            'name' => 'required|string|min:3|max:255',
            'surname' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:la_users,email,'.$userId.',user_id|max:255',
            'password' => 'nullable|string|min:8|max:255',
        ];

        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'surname.required' => 'El apellido es obligatorio.',
            'surname.min' => 'El apellido debe tener al menos 3 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];


        
        $validatedData = $request->validate($rules, $messages);


        if ($password) {
            Users::where('user_id', $userId)->update([
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
                'password' => Hash::make($password),
    
            ]);
        }
        else {
            Users::where('user_id', $userId)->update([
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
            ]);
        }


        return Response()->json([
            'success'=> true,
            'message'=> 'Usuario editado con exito'
        ]);
 

    
    }
    public function deleteUser($userId){
        
        if(!Session::has('administrator')){
            return Redirect('/login');
        }
        Users::where('user_id', $userId)->delete();
        return Response()->json([
            'success'=> true,
            'message'=> 'Usuario eliminado con éxito'
        ]);
    }
    public function login(){
        
        if(Session::has('administrator')){
            return Redirect('/');
        }
        $scripts = array('users.js');


        return view('users.login', compact('scripts'));
    }
    public function loginUser(Request $request){
        if(Session::has('administrator')){
            return Redirect('/');
        }
        $email = $request->input('email');
        $password = $request->input('password');

        if ($email == '') {
            return response()->json([
                'success' => false,
                'message' => 'Email no puede estar vacío'
            ]);
        }
    

        if ($password == '') {
            return response()->json([
                'success' => false,
                'message' => 'Contraseña no puede estar vacía'
            ]);
        }

        $verifyEmail = Users::where('email', $email)->first();

        if (!$verifyEmail){
            return Response()->json([
                'success' => false,
                'message' => 'Email inexistente'
            ]);
        }
        if (!Hash::check($password, $verifyEmail->password)){
            return Response()->json([
                'success' => false,
                'message' => 'Contraseña incorrecta'
            ]);
        }
        $userData = [
            'userId' => $verifyEmail->user_id,
            'name'=> $verifyEmail->name,
            'surname'=> $verifyEmail->surname,
            'email'=> $verifyEmail->email,
            
        ];

        Session::put('administrator', $userData);
        

        return Response()->json([
            'success'=> true
        ]);
    }
    public function logoutUser(){
        if(Session::has('administrator')){
            Session::forget('administrator');
        }
    
        return Redirect('/login');
    }
    
}

