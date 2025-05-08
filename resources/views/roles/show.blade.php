    @extends('layouts.app')

        @section('meta')

            <meta name="csrf-token" content="<?= csrf_token() ?>">
            
        @endsection

        @section('breadcrumb')

            <li class="breadcrumb-item">
                <a class="link-fx" href="{{ route('roles.index') }}">Roles de Usuario</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx text-dark" href="#">
                    Detalle del Rol de Usuario
                </a>
            </li>

        @endsection

        @section('content')

            <div class="block block-themed">
                <div class="block-header bg-flat-dark">
                    <h3 class="block-title"> Datos del rol <small> a continuación se visualiza la información detallada del rol</small></h3>
                    <div class="block-options">
                        <a class="btn btn-outline-light" href="{{ route('roles.index') }}"> 
                            <i class="fa fa-arrow-rotate-left"></i> Regresar
                        </a>
                    </div>
                </div>
                <div class="block-content">

                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">

                            <h5 class="border-bottom pb-2">Datos Generales</h5>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" value="{{ $role->name }}" disabled placeholder="Rol de Usuario">
                                <label>Rol de Usuario</label>
                            </div>

                            <h5 class="border-bottom pb-2">Permisos del Usuario</h5>
                            <!-- <div class="block-content"> -->
                                @if(!empty($rolePermissions))                                    
                                <ul class="nav nav-pills flex-column push">
                                    @foreach($rolePermissions as $data)
                                    <li class="nav-item mb-1">
                                        <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                            {{ $data->name }} <i class="far fa-2x fa-square-check text-success"></i>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                    <h3 class="block-title"> Lo sentimos <small> hasta el momento no existen permisos asignados a este rol de usuario.</small></h3>
                                @endif
                            <!-- </div> -->

                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                    
                </div>
            </div>

        @endsection

        @section('script')

            $('#_rol').addClass('active');
            
        @endsection