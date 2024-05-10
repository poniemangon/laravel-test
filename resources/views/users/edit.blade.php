@include('layouts.head')

<div class="container">
    <div class="row">
        <div class="col-md-6 mt-3 m-auto form-col">
            <h3 class="text-center">Editar user {{ $userData->name }}</h3>
            <form action="{{ url('edit-user', ['userId' => $userData->user_id]) }}" method="post" id="user-edition-form">
              <div class="form-group mt-3"> 
                <label for="control-label"> Nombre: </label>
                <input type="text" autocomplete="off" name="name" class="form-control" placeholder="Nombre" value="{{ $userData->name}}">
               </div> 
               <div class="form-group mt-3"> 
                <label for="control-label"> Apellido: </label>
                <input type="text" autocomplete="off" name="surname" class="form-control" placeholder="Apellido" value="{{ $userData->surname}}">
               </div> 
               <div class="form-group mt-3"> 
                <label for="control-label"> Email: </label>
                <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Email" value="{{ $userData->email}}">
               </div> 
               <div class="form-group mt-3"> 
                <label for="control-label"> Contrasena: </label>
                <input type="password" autocomplete="off" name="password" class="form-control" placeholder="Contrasena" value="{{ $userData->password}}">
               </div> 
               <button type="submit" class="btn btn-sm btn-primary" id="user-edition-button">Enviar</button>
            </form>
            <a href="{{ route('list') }}">Ir a listado</a>
        </div>

    </div>
</div>

@include('layouts.footer')