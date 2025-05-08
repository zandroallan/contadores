    @extends('layouts.app')

        @section('meta')
            <meta name="csrf-token" content="<?= csrf_token() ?>">
        @endsection

        @section('css')

            <link rel="stylesheet" href="{{ asset('template/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
            <!-- <link rel="stylesheet" href="{{ asset('template/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}"> -->
            <link rel="stylesheet" href="{{ asset('template/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
            <link rel="stylesheet" id="css-main" href="{{ asset('template/assets/js/plugins/select2/css/select2.min.css') }}">
        
        @endsection

        @section('breadcrumbs')
            <a href="#" class="text-muted">Coordinadores</a>  
        @endsection

        @section('button-action')

            @can('permiso-create')
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a href="{{ route('permisos.create') }}" class="btn btn-inverse btn-theme">
                        Crear nuevo permiso
                    </a>
                </div>
            </div>
            @endcan

        @endsection

        @section('content')

            <div class="checkout">
                <div class="checkout-header" style="color: #fff;">
                    <h4 >
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Listado de permisos de usuarios
                    </h4>
                    <p>
                        Los permisos de usuario son configuraciones que determinan el nivel de acceso y las acciones que un usuario puede realizar dentro del sistema de la Secretaría Anticorrupción y Buen Gobierno.
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

                    <div class="table-responsive tbl-permisos"></div>

                </div>
            </div>


        @endsection

        @section('js')
            
            <script src="{{ asset('public/template/assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('public/template/assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
            <script src="{{ asset('public/template/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ asset('public/template/assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
            <script src="{{ asset('public/views/permisos/index.js') }}"></script>
            <!-- <script src="{{ asset('views/tools.js') }}"></script> -->

        @endsection

        @section('script')  

            $('._permiso').addClass('active');
            var _permissionEdit=false;
            var _permissionDelete=false;

            @can('rol-edit')

                _permissionEdit=true;
            @endcan
            @can('rol-delete')

                _permissionDelete=true;
            @endcan

        @endsection