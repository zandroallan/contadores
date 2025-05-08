        @extends('layouts.app')
            @section('css')

                <!-- Styles para el dataTables -->
                <link rel="stylesheet" href="{{ asset('public/tools/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}" />
                <!-- <link rel="stylesheet" href="{{ asset('tools/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}"> -->
                <link rel="stylesheet" href="{{ asset('public/tools/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}" />

            @endsection
            
            @section('breadcrumb')

                <li class="breadcrumb-item">
                    <a class="link-fx" href="javascript:void(0)">Inicio</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx text-dark" href="javascript:void(0)">
                        Mi Perfil
                    </a>
                </li>

            @endsection

            @section('content')

                <div class="checkout" style="padding-top: 10px; padding-bottom: 10px;">
                    <div class="checkout-header" style="color: #fff;">
                        <h4 >
                            <i class="fab fa-slideshare fa-fw text-primary"></i> Datos personales
                        </h4>
                        <p>Listado de usuarios corresponde a los empleados activos de la Secretaría Anticorrupción y Buen Gobierno. </p>
                    </div>
                    <div class="checkout-body">
                        
                        <div class="row push">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <form class="frm-data" id="frm-data" name="frm-data">

                                <h5 class="border-bottom pb-2">Datos generales</h5>
                                <div class="form-floating mb-3">
                                    <label for="name">Nombre colegio</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre completo">
                                </div>
                                <div class="row g-4">
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="rfc">Registro Federal de Contribuyentes (RFC)</label>
                                            <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Registro Federal de Contribuyentes">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <label for="direccion">Dirección fiscal</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
                                        </div>
                                    </div>
                                </div>
                                    
                               <!--  <div class="mb-4">
                                    <div class="block block-rounded">
                                        <div class="block-content block-content-full ribbon ribbon-modern ribbon-info">
                                            <div class="ribbon-box">
                                                <i class="fa fa-fw fa-heart"></i>
                                            </div>
                                            <div class="text-center py-4 _img_perfil_1"></div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="imagen">Cambiar foto de perfil</label>
                                        <input type="file" class="form-control" id="imagen" name="imagen">
                                    </div>
                                </div> -->
                                      
                                </form>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-inverse btn-theme btn-update-data">
                                        Actualizar datos
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </div>
                </div>
                <hr />


                <div class="checkout" style="padding-top: 10px; padding-bottom: 10px;">
                    <div class="checkout-header" style="color: #fff;">
                        <h4 >
                            <i class="fab fa-slideshare fa-fw text-primary"></i> Datos de acceso
                        </h4>
                        <p>Listado de usuarios corresponde a los empleados activos de la Secretaría Anticorrupción y Buen Gobierno. </p>
                    </div>
                    <div class="checkout-body">
                        
                        <div class="row push">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <form class="frm-password" name="frm-password">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-4">
                                                <label class="form-label" for="email">Nombre usuario</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Correo de acceso" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label class="form-label" for="password">Contraseña</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label class="form-label" for="confirm-password">Confirmar contraseña</label>
                                                <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirmar contraseña">
                                            </div>                                            
                                        </div>                                          
                                    </div>
                                </form>                                    
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-inverse btn-theme btn-update-password">
                                        Actualizar datos de acceso
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>

                    </div>
                </div>

                <div class="bg-amethyst-darker" >
                    <div class="">
                        <div class="content content-full text-center">
                            <div class="my-3 _img_perfil_0">
                                
                            </div>
                            <h1 class="h2 text-white mb-0 _nombre"></h1>
                            <span class="text-white-75 _area"></span>
                        </div>
                    </div>
                </div>

            @endsection

            @section('js')

                <!-- Scripts para los dataTables -->
                <script src="{{ asset('public/tools/assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
                <script src="{{ asset('public/tools/assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
                <script src="{{ asset('public/tools/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
                <script src="{{ asset('public/tools/assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
                <script src="{{ asset('public/views/mi_perfil.js') }}"></script>

            @endsection
