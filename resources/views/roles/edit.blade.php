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
                    Edición de Rol de Usuario
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
                    @can('rol-edit')
                    <a class="btn btn-inverse btn-theme btn-rol-update" href="#"> 
                        <i class="text-primary fa fa-save"></i> Editar rol de usuario
                    </a>
                    @endcan
                </div>
            </div>
            
        @endsection


        @section('content')

            <div id="dvErrors" name="dvErrors" class="dvErrors"></div>

            <div class="account-container">
                <div class="account-body">
                    <div class="policy-info">
                        <h4>
                            <i class="fab fa-slideshare fa-fw text-primary"></i> Actualización de Rol de Usuario
                        </h4>
                        <p>
                            Este procedimiento es fundamental para gestionar la edicion de cuentas de usuarios y garantizar que todos los nuevos integrantes tengan la información necesaria para su integración.
                        </p>
                    </div>
                    <form name="frm-rol-update" id="frm-rol-update">                        
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <input type="hidden" id="idRol" name="idRol" value="{{ $role->id }}">
                                
                                @include('roles.form')
                                
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </form>
                </div>
            </div>

        @endsection

        @section('js')

            <script src="{{ asset('public/views/roles/edit.js') }}"></script>

        @endsection

        @section('script')

            $('._roles').addClass('active');

            $('.btn-rol-update').attr('onclick', 'confirmUpdate({{ $role->id }})');
            data_edit({{ $role->id }});
            

        @endsection