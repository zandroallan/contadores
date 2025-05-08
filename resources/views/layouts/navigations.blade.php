                        <div class=" collapse navbar-collapse" id="navbar-collapse">
                            <ul class="nav">

                                <li class="_inicio">
                                    <a href="{{ route('home') }}">Inicio</a>
                                </li>

                                @can('usuario-list')
                                <li class="_usuarios">
                                    <a href="{{ route('usuarios.index') }}">Colegios</a>
                                </li>
                                @endcan

                                @can('rol-list')
                                <li class="_roles">
                                    <a href="{{ route('roles.index') }}">Roles</a>
                                </li>
                                @endcan

                                @can('permiso-list')
                                <li class="_permisos">
                                    <a href="{{ route('permisos.index') }}">Permisos</a>
                                </li>
                                @endcan

                                @can('rtec-list')
                                <li class="_rtecs">
                                    <a href="{{ route('rtecs.index') }}">Rtecs</a>
                                </li>
                                @endcan

                                

                                <li class="_especialidades">
                                    <a href="{{ route('especialidades.index') }}">Especialidades</a>
                                </li>
                                                                
                                <!-- <li class="dropdown dropdown-hover">
                                    <a href="#" data-toggle="dropdown">
                                        <i class="fa fa-search search-btn"></i>
                                        <span class="arrow top"></span>
                                    </a>
                                    <div class="dropdown-menu p-15">
                                        <form action="search_results.html" method="POST" name="search_form">
                                            <div class="input-group">
                                                <input type="text" placeholder="Search" class="form-control bg-silver-lighter" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-inverse" type="submit"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li> -->
                            </ul>
                        </div>