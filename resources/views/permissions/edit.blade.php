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
                    Edicion de Permisos de Usuario
                </a>
            </li>

        @endsection


        @section('button-action')
            
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a class="btn btn-inverse btn-theme" href="{{ route('permisos.index') }}"> Regresar</a>
                    @can('permiso-edit')
                    <a class="btn btn-inverse btn-theme btn-usuario-store" href="#"> Editar permisos de usuario</a>
                    @endcan
                </div>
            </div>

        @endsection

        @section('content')

        <div class="account-container">
            <div class="account-body">
                <div class="policy-info">
                    <h4>
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Actualización de Permisos de Usuario
                    </h4>
                    <p>
                        Los permisos definen lo que un usuario puede hacer, ver o modificar.
                    </p>
                </div>
                <form name="frm-permiso-update" id="frm-permiso-update">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <h5 class="border-bottom pb-2">Datos Generales</h5>
                            <div class="form-floating mb-3">
                                <label for="name">Ingresar el nombre del permiso</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Ingresar el nombre del permiso">                             
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </form>
            </div>
        </div>

        @endsection

        @section('js')

            <script src="{{ asset('public/views/permisos/edit.js') }}"></script>

        @endsection

        @section('script')

            $('._permiso').addClass('active');

            $('.btn-permiso-update').attr('onclick', 'confirmUpdate({{ $permission->id }})');
            data_edit({{ $permission->id }});
            
        @endsection