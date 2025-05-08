    @extends('layouts.app')

        @section('meta')

            <meta name="csrf-token" content="<?= csrf_token() ?>">

        @endsection

        @section('breadcrumb')

            <li class="breadcrumb-item">
                <a class="link-fx" href="{{ route('permisos.index') }}">Permisos de Usuario</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx text-dark" href="#">
                    Detalles de Permisos de Usuario
                </a>
            </li>

        @endsection

        @section('content')

            <div class="block block-themed">
                <div class="block-header bg-flat-dark">
                    <h3 class="block-title"> Información del Permiso <small> detalles del permiso</small></h3>
                    <div class="block-options">
                        <a class="btn btn-outline-light" href="{{ route('permisos.index') }}"> 
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
                                <input type="text" class="form-control" value="{{ $permission->name }}" disabled placeholder="Descripción Permiso">
                                <label>Descripción Permiso</label>
                            </div>

                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                    
                </div>
            </div>

        @endsection

        @section('script')

            $('._permiso').addClass('active');
            
        @endsection