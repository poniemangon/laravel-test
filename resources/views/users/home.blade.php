@include('layouts.head')

<section class="home-section container-fluid">
    <div class="row">
        @include('layouts.sidebar')
        <div class="col-sm-12 col-md-9 users-table-body">
                <table class="table users-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>E-Mail</th>
                            <th>Fecha de registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="user-card">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->registration_date }}</td>
                            <td>
                                <a href="{{ route('edicion-user', ['userId' => $user->user_id]) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                <i class="fas fa-trash" data-toggle="modal" data-target="#exampleModal{{$user->user_id}}"></i> 
                            </td>
                        </tr>
                    
                        <div class="modal fade" id="exampleModal{{$user->user_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$user->user_id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex align-center justify-between">
                                        <h2 class="modal-title full-width" id="exampleModalLabel{{$user->user_id}}">Eliminar usuario</h2>
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
                        @endforeach
                    </tbody>

                </table>
                <div class="custom-pagination-buttons">
                @if ($users->previousPageUrl())
                    <a href="{{ $users->previousPageUrl() }}" class="btn btn-custom">Previous</a>
                @endif

                @if ($users->nextPageUrl())
                    <a href="{{ $users->nextPageUrl() }}" class="btn btn-custom">Next</a>
                @endif
            </div>
        </div>

    </div>
</div>



@include('layouts.footer')