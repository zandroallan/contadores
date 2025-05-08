    @extends('layouts.app')

        @section('css')

            <link rel="stylesheet" id="css-main" href="{{ asset('public/template/assets/js/plugins/select2/css/select2.min.css') }}">

        @endsection

        @section('title')

            <h1 class="h3 fw-bold mb-0">Registro de usuarios</h1>

        @endsection

        @section('breadcrumb')

            <li class="breadcrumb-item">
                <a class="link-fx" href="{{ route('usuarios.index') }}">Usuarios</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx text-dark" href="#">
                    Registro de usuarios
                </a>
            </li>

        @endsection

        @section('button-action')

            @can('usuario-create')
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a class="btn btn-inverse btn-theme" href="{{ route('usuarios.index') }}"> 
                        <i class="text-primary fa fa-reply-all"></i> Regresar
                    </a>
                    @can('usuario-create')
                    <a class="btn btn-inverse btn-theme btn-usuario-store" href="#"> 
                        <i class="text-primary fa fa-save"></i> Registrar usuario
                    </a>
                    @endcan
                </div>
            </div>
            @endcan

        @endsection

        @section('content')

            <div class="checkout">
                <div class="checkout-header" style="color: #fff;">
                    <h4 >
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Registro de usuario
                    </h4>
                    <p>
                        Este procedimiento es fundamental para gestionar la creación de cuentas de usuarios y garantizar que todos los nuevos integrantes tengan la información necesaria para su integración.
                    </p>
                </div>
                <div class="checkout-body">                    
                    <form name="frm-usuario-store" id="frm-usuario-store">

                        @include('users.form')

                    </form>
                </div>
            </div>
        
        @endsection

        @section('js')

            <!-- Personal Js-Script -->
            <script src="{{ asset('public/template/assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
            <script src="{{ asset('public/views/users/create.js') }}"></script>

        @endsection


        @section('script')

            $('._usuario').addClass('active');
            
        @endsection