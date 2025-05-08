    @extends('layouts.app')

        @section('css')

            <link rel="stylesheet" id="css-main" href="{{ asset('public/template/assets/js/plugins/select2/css/select2.min.css') }}">

        @endsection

        @section('breadcrumb')

            <li class="breadcrumb-item">
                <a class="link-fx" href="{{ route('usuarios.index') }}">Usuarios</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx text-dark" href="#">
                    Edición de usuarios
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
                    <a class="btn btn-inverse btn-theme btn-usuario-update" href="#"> 
                        <i class="text-primary fa fa-save"></i> Editar usuario
                    </a>
                </div>
            </div>
            @endcan

        @endsection

        @section('content')

            <div class="checkout">
                <div class="checkout-header" style="color: #fff;">
                    <h4 >
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Actualización de usuario
                    </h4>
                    <p>
                        Este procedimiento es esencial para mantener la base de datos de usuarios actualizada, asegurando que los registros sean precisos y reflejen de manera correcta las condiciones actuales de cada usuario.
                    </p>
                </div>
                <div class="checkout-body">                    
                    <form name="frm-usuario-update" id="frm-usuario-update">
                        <input type="hidden" name="id_user" id="id_user" value="{{ $id_user }}" />

                        @include('users.form')

                    </form>
                </div>
            </div>

        @endsection

        @section('js')

            <!-- Personal Js-Script -->
            <script src="{{ asset('public/template/assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
            <script src="{{ asset('public/views/users/edit.js') }}"></script>

        @endsection


        @section('script')

            $('._usuario').addClass('active');
            
        @endsection