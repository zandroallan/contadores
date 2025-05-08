    @extends('layouts.app')

        @section('css')

            <link rel="stylesheet" href="{{ asset('public/template/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
            <!-- <link rel="stylesheet" href="{{ asset('template/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}"> -->
            <link rel="stylesheet" href="{{ asset('public/template/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">

        @endsection

        @section('breadcrumb')

            <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx" href="{{ route('usuarios.index') }}">
                    Usuarios
                </a>
            </li>

        @endsection

        @section('button-action')

            
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a href="{{ route('home') }}" class="btn btn-inverse btn-theme">Regresar</a>
                </div>
            </div>

        @endsection

        @section('content')  

        <div class="account-container">
            <div class="account-body">
                <div class="policy-info">
                    <h4>
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Listado de usuarios
                    </h4>
                    <p>Listado de usuarios corresponde a los empleados activos de la Secretaría Anticorrupción y Buen Gobierno. </p>
                </div>
                
                <div class="input-group">
                    <input type="text" class="form-control" name="txt-search" id="txt-search" placeholder="Ingresa el término que deseas encontrar en el campo de búsqueda ">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-inverse">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <hr />

                <div class="table-responsive tbl-usuarios"></div>
            </div>
        </div>

        @endsection


        @section('js')

            <!-- Page JS Plugins -->
            <script src="{{ asset('public/template/assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('public/template/assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
            <script src="{{ asset('public/template/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ asset('public/template/assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
            <!-- Personal Js-Script -->
            <script src="{{ asset('public/views/home_show.js') }}"></script>

        @endsection

        @section('script')

            $('._usuario').addClass('active');
            
            index({{ $id_curso }});

        @endsection