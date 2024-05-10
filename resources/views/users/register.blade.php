@include('layouts.head')

<div class="container">
    <div class="row">
        <div class="col-md-6 mt-3 m-auto form-col">
            <h3 class="text-center">Registrar</h3>
            <form action="{{ url('register-user') }}" method="post" id="user-registration-form">
              <div class="form-group mt-3"> 
                <label for="control-label"> Nombre: </label>
                <input type="text" autocomplete="off" name="name" class="form-control" placeholder="Nombre">
               </div> 
               <div class="form-group mt-3"> 
                <label for="control-label"> Apellido: </label>
                <input type="text" autocomplete="off" name="surname" class="form-control" placeholder="Apellido">
               </div> 
               <div class="form-group mt-3"> 
                <label for="control-label"> Email: </label>
                <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Email">
               </div> 
               <div class="form-group mt-3"> 
                <label for="control-label"> Contrasena: </label>
                <input type="password" autocomplete="off" name="password" class="form-control" placeholder="Contrasena">
               </div> 
               <button type="submit" class="btn btn-sm btn-primary" id="user-registration-button">Enviar</button>
            </form>
    
            @if (Session::has('administrator'))
            <a href="{{ route('list') }}">Ir a listado</a>
            @endif
        </div>

    </div>
</div>

@include('layouts.footer')