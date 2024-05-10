@include('layouts.head')

<div class="container">
        <h1>Bienvenido {{ $administrator['name'] }} {{ $administrator['surname'] }}</h1>
        <h2>Lista de Usuarios</h2>
        <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo Electrónico</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->surname }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('edicion-user', ['userId' => $user->user_id]) }}"><i class="fa-solid fa-pen-to-square"></i></a>

                   
                    <i class="fas fa-trash" data-toggle="modal" data-target="#exampleModal" ></i> 
              



                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header d-flex align-center justify-between">
                            <h2 class="modal-title full-width" id="exampleModalLabel">Eliminar usuario</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Confirmar eliminación de usuario {{ $user->name }} {{ $user->surname }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           
                            <button type="button" class="btn btn-primary delete-user-button" data-user-id="{{ $user->user_id }}">Eliminar</button>

                        </div>
                        </div>
                    </div>
                    </div>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $users->links() }}
    </div>
    <div class="d-flex justify-between">
        <a href="{{ route('register') }}">Registrar usuario nuevo</a>
        <a href="{{ route('logout') }}">Cerrar sesión</a>
    </div>



    </div>

@include('layouts.footer')
