@include('layouts.head')

<div class="container">
    <div class="row">
        <div class="col-md-6 mt-3 m-auto form-col">
            <h3 class="text-center title">Log-in</h3>
            <form action="{{ url('login-user') }}" method="post" id="login-form">
               <div class="form-group mt-3"> 
                <label for="control-label"> Email: </label>
                <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Email" >
               </div> 
               <div class="form-group mt-3"> 
                <label for="control-label"> Contraseña: </label>
                <input type="password" autocomplete="off" name="password" class="form-control" placeholder="Contrasena" >
               </div> 
               <button type="submit" class="btn btn-sm btn-primary" id="user-login-button">Enviar</button>
            </form>
            <a href="{{ route('register') }}">Registrarse</a>
        </div>
        
    </div>
    
</div>

@include('layouts.footer')