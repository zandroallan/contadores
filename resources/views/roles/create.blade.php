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
                    Registro de Rol de Usuario
                </a>
            </li>

        @endsection

        @section('button-action')
           
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a class="btn btn-inverse btn-theme" href="{{ route('roles.index') }}"> 
                        <i class="text-primary fa fa-reply-all"></i> Regresar
                    </a>
                    @can('rol-create')
                    <a class="btn btn-inverse btn-theme btn-rol-create" href="#"> 
                        <i class="text-primary fa fa-save"></i> Guardar Rol de Usuario
                    </a>
                    @endcan
                </div>
            </div>
            
        @endsection

        @section('content')

            <div class="checkout">
                <div class="checkout-header" style="color: #fff;">
                    <h4 >
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Registro de Rol de Usuario
                    </h4>
                    <p>
                        Este procedimiento es fundamental para gestionar la creación de cuentas de usuarios y garantizar que todos los nuevos integrantes tengan la información necesaria para su integración.
                    </p>
                </div>
                <div class="checkout-body">                    
                    <form name="frm-rol-store" id="frm-rol-store">                        
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                
                                @include('roles.form')
                                
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </form>
                </div>
            </div>

        @endsection

        @section('js')

            <script src="{{ asset('public/views/roles/create.js') }}"></script>

        @endsection

        @section('script')

            $('._roles').addClass('active');

        @endsection