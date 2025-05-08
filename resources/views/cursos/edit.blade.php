    @extends('layouts.app')

        @section('css')

            <link rel="stylesheet" href="{{ asset('public/template/assets/js/plugins/flatpickr/flatpickr.min.css') }}">
            <link rel="stylesheet" id="css-main" href="{{ asset('public/template/assets/js/plugins/select2/css/select2.min.css') }}">

        @endsection

        @section('title')

            <h1 class="h3 fw-bold mb-0">Edición de sesión</h1>

        @endsection

        @section('breadcrumb')

            <li class="breadcrumb-item">
                <a class="link-fx" href="{{ route('sesiones.index') }}">Sesiones</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                Edición de sesiones
            </li>

        @endsection

        @section('content')

            <div class="block block-themed">
                <div class="block-header bg-flat-dark">
                    <h3 class="block-title">Edición de sesión</h3>
                    <div class="block-options">
                        <a class="btn btn-outline-light" href="{{ route('sesiones.index') }}"> 
                            <i class="fa fa-arrow-rotate-left"></i> Regresar
                        </a>
                        <a class="btn btn-outline-success btn-sesion-update" href="#"> 
                            <i class="fa fa-pencil"></i> Editar sesión
                        </a>
                    </div>
                </div>
                <div class="block-content">
                    <form name="frm-sesion-update" id="frm-sesion-update">
                        <input type="hidden" name="id_sesion" id="id_sesion" value="{{ $id_sesion }}">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">                                
                                <h6 class="border-bottom pb-2">Datos de la sesión</h6>
                                <div class="row items-push">
                                    <div class="col-md-12">
                                        <div class="form-check form-block">
                                            <label class="form-check-label" for="example-checkbox-block1">
                                                <span class="d-flex align-items-center">
                                                    <!-- <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar1.jpg" alt=""> -->
                                                    <i class="fa fa-2x fa-scroll"></i>
                                                    <span class="ms-2">
                                                        <span class="fw-bold">Sesión</span>
                                                        <span class="d-block fs-sm text-muted _sesion"></span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check form-block">
                                            <label class="form-check-label" for="example-checkbox-block1">
                                                <span class="d-flex align-items-center">
                                                    <!-- <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar1.jpg" alt=""> -->
                                                    <i class="fa fa-2x fa-building-circle-check"></i>
                                                    <span class="ms-2">
                                                        <span class="fw-bold">Organismo/Dependencia</span>
                                                        <span class="d-block fs-sm text-muted _dependencia"></span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-block">
                                            <label class="form-check-label" for="example-checkbox-block1">
                                                <span class="d-flex align-items-center">
                                                    <!-- <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar1.jpg" alt=""> -->
                                                    <i class="fa fa-2x fa-calendar-days"></i>
                                                    <span class="ms-2">
                                                        <span class="fw-bold">Fecha cierre de carpeta electrónica</span>
                                                        <span class="d-block fs-sm text-muted _fechaCarpeta"></span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-block">
                                            <label class="form-check-label" for="example-checkbox-block2">
                                                <span class="d-flex align-items-center">
                                                    <!-- <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar12.jpg" alt=""> -->
                                                    <i class="fa fa-2x fa-calendar-days"></i>
                                                    <span class="ms-2">
                                                        <span class="fw-bold">Fecha de sesión</span>
                                                        <span class="d-block fs-sm text-muted _fechaSesion"></span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="border-bottom pb-2">Editar la Orden del día de la sesión</h6>
                                <div class="items-push div-orden-dia"></div>
                                
                            </div>
                            <div class="col-lg-2"></div>
                        </div>

                    </form>
                </div>
            </div>
        
        @endsection

        @section('js')

            <!-- Personal Js-Script -->
            <script src="{{ asset('public/template/assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
            <script src="{{ asset('public/template/assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
            <script src="{{ asset('public/views/sesiones/edit.js') }}"></script>

        @endsection


        @section('script')

            $('._sesion').addClass('active');

        @endsection