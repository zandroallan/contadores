    @extends('layouts.app')

        @section('css')

            <link rel="stylesheet" href="{{ asset('public/template/assets/js/plugins/flatpickr/flatpickr.min.css') }}">
            <link rel="stylesheet" id="css-main" href="{{ asset('public/template/assets/js/plugins/select2/css/select2.min.css') }}">

        @endsection

        @section('title')

            <h1 class="h3 fw-bold mb-0">Registro de sesión</h1>

        @endsection

        @section('breadcrumb')

            <li class="breadcrumb-item">
                <a class="link-fx" href="{{ route('sesiones.index') }}">Sesiones</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                Registro de sesiones
            </li>

        @endsection

        @section('content')

            <div class="block block-themed">
                <div class="block-header bg-flat-dark">
                    <h3 class="block-title">Registrar sesión</h3>
                    <div class="block-options">
                        <a class="btn btn-outline-light" href="{{ route('sesiones.index') }}">
                            <i class="fa fa-arrow-rotate-left"></i> Regresar
                        </a>
                        @can('sesion-create')
                        <a class="btn btn-outline-success btn-sesion-store" href="#">
                            <i class="fa fa-square-plus"></i> Registro de sesión
                        </a>
                        @endcan
                    </div>
                </div>
                <div class="block-content">
                    <form name="frm-sesion-store" id="frm-sesion-store">
                        
                        @include('sesiones.form')

                    </form>
                </div>
            </div>
        
        @endsection

        @section('js')

            <!-- Personal Js-Script -->
            <script src="{{ asset('public/template/assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
            <script src="{{ asset('public/template/assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
            <script src="{{ asset('public/views/sesiones/create.js') }}"></script>

        @endsection


        @section('script')

            $('._sesion').addClass('active');

        @endsection