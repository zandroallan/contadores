    @extends('layouts.app')

        @section('meta')
            <meta name="csrf-token" content="<?= csrf_token() ?>">
        @endsection

        @section('css')

            <link rel="stylesheet" href="{{ asset('public/template/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
            <!-- <link rel="stylesheet" href="{{ asset('template/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}"> -->
            <link rel="stylesheet" href="{{ asset('public/template/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
            <link rel="stylesheet" id="css-main" href="{{ asset('public/template/assets/js/plugins/select2/css/select2.min.css') }}">
        
        @endsection

        @section('breadcrumb')
            
            <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx" href="{{ route('roles.index') }}">
                    Roles de Usuarios
                </a>
            </li>

        @endsection

        @section('button-action')

            @can('usuario-create')
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a href="{{ route('roles.create') }}" class="btn btn-inverse btn-theme">
                        Crear nuevo rol
                    </a>
                </div>
            </div>
            @endcan

        @endsection

        @section('content')


            <div class="checkout">
                <div class="checkout-header" style="color: #fff;">
                    <h4 >
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Listado de roles de usuario
                    </h4>
                    <p>
                        Listado de Roles de usuario,  Cada rol define las responsabilidades, permisos y limitaciones de los usuarios dentro del entorno laboral
                    </p>
                </div>
                <div class="checkout-body">
                    
                    <div class="input-group">
                        <input type="text" class="form-control" id="txt-search" placeholder="Ingresa el término que deseas encontrar en el campo de búsqueda ">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-inverse">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <hr />

                    <div class="table-responsive tbl-roles"></div>

                </div>
            </div>

        @endsection

        @section('js')  
            <!-- Page JS Plugins -->
            <script src="{{ asset('public/template/assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('public/template/assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
            <script src="{{ asset('public/template/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ asset('public/template/assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
            <script src="{{ asset('public/template/assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
            <script src="{{ asset('public/views/roles/index.js') }}"></script>
        @endsection

        @section('script')
            
            $('._rol').addClass('active');

            var _permissionEdit=false;
            var _permissionDelete=false;

            @can('rol-edit')

                _permissionEdit=true;
            @endcan
            @can('rol-delete')

                _permissionDelete=true;
            @endcan

        @endsection