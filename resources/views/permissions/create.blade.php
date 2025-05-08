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
                    Creación de Permisos de Usuario
                </a>
            </li>

        @endsection


        @section('button-action')

            
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a class="btn btn-inverse btn-theme" href="{{ route('permisos.index') }}"> 
                        <i class="fa fa-arrow-rotate-left"></i> Regresar
                    </a>
                    @can('permiso-create')
                    <button type="button" class="btn btn-inverse btn-theme btn-permiso-crate">
                        Crear nuevo curso
                    </button>
                    @endcan
                </div>
            </div>
            

        @endsection


        @section('content')

            <div class="account-container">
                <div class="account-body">
                    <div class="policy-info">
                        <h4>
                            <i class="fab fa-slideshare fa-fw text-primary"></i> Creción de permisos a usuario
                        </h4>
                        <p>
                            Los permisos de usuario son configuraciones que determinan el nivel de acceso y las acciones que un usuario puede realizar dentro del sistema de la Secretaría Anticorrupción y Buen Gobierno.
                        </p>
                    </div>
                    
                    <form name="frm-permiso-crate" id="frm-permiso-crate">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <h5 class="border-bottom pb-2">Datos generales del permiso</h5>
                                <div class="form-floating mb-3">
                                    <label for="name">Ingresar el nombre del permiso</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Ingresar el nombre del permiso">
                                </div>
                                <div class="form-floating mb-3">
                                    <label for="name">Ingresar una descripcion del permiso</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Ingresar una descripcion del permiso">
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </form>

                </div>
            </div>


        @endsection

        @section('js')

            <script src="{{ asset('public/views/permisos/create.js') }}"></script>

        @endsection

        @section('script')

            $('._permiso').addClass('active');
            
        @endsection