<div class="col-sm-12 col-md-3 sidebar">
            <div class="title-name">
                <h2>Dashboard</h2>
                <h4>Usuario: {{ $administrator['name'] }} {{ $administrator['surname'] }} </h4>
            </div>

            <ul>
                <li><a href="{{ route('register') }}"><h3>Registrar usuario nuevo</h3></a></li>
                <li><a href="{{ route('logout') }}"><h3>Cerrar sesión</h3></a></li> 
            </ul>
</div>