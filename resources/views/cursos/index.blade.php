    @extends('layouts.app')

        @section('css')

            <link rel="stylesheet" href="{{ asset('public/template/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
            <!-- <link rel="stylesheet" href="{{ asset('template/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}"> -->
            <link rel="stylesheet" href="{{ asset('public/template/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">

        @endsection

        @section('breadcrumb')

            <li class="breadcrumb-item" >
                <a class="link-fx" href="#">
                    Cursos
                </a>
            </li>

        @endsection

        @section('button-action')

            @can('curso-create')
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    @can('curso-create')
                    <button class="btn btn-inverse btn-theme btn-seleccion-curso-store" href="{{ route('cursos.create') }}">
                        Guardar solicitud de cursos
                    </button>
                    @endcan
                </div>
            </div>
            @endcan

        @endsection

        @section('content')

            <div class="account-container">
                <div class="account-body">
                    <div class="policy-info">
                        <h4>
                            <i class="fab fa-slideshare fa-fw text-primary"></i> Listado de cursos
                        </h4>
                        <p>
                            La sección "Cursos" está diseñada para proporcionar a los usuarios un acceso fácil y organizado a los programas de capacitación posibles a solicitar dentro de la Secretaría Anticorrupción y Buen Gobierno.
                        </p>
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

                    <form class="frm-seleccion-curso-store" name="frm-seleccion-curso-store">
                        <div class="table-responsive tbl-cursos"></div>
                    </form>
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
            <script src="{{ asset('public/views/cursos/index.js') }}"></script>

        @endsection

        @section('script')

            var _okSelectCourse=false;
            var _permissionEdit=false;
            var _permissionDelete=false;

            @if ( Auth::User()->ok == 1 )

                $('.btn-seleccion-curso-store').hide();
                _okSelectCourse=true;
            @endif
            @can('sesion-edit')

                _permissionEdit=true;
            @endcan
            @can('sesion-delete')

                _permissionDelete=true;
            @endcan

        @endsection