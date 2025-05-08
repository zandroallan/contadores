    @extends('layouts.app')

        @section('css')

            <link rel="stylesheet" id="css-main" href="{{ asset('public/template/assets/js/plugins/select2/css/select2.min.css') }}">

        @endsection

        @section('title')

            <h1 class="h3 fw-bold mb-0">Registro de rtec</h1>

        @endsection

        @section('breadcrumb')

            <li class="breadcrumb-item">
                <a class="link-fx" href="{{ route('contadores.index') }}">Rtecs</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx text-dark" href="#">
                    Registro de rtec
                </a>
            </li>

        @endsection

        @section('button-action')
           
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a class="btn btn-inverse btn-theme" href="{{ route('contadores.index') }}">
                        <i class="text-primary fa fa-reply-all"></i> Regresar
                    </a>
                    @can('rtec-create')
                    <a class="btn btn-inverse btn-theme btn-rtec-store" href="#">
                        <i class="text-primary fa fa-save"></i> Registrar contador
                    </a>
                    @endcan
                </div>
            </div>

        @endsection

        @section('content')

            <div class="checkout">
                <div class="checkout-header" style="color: #fff;">
                    <h4 >
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Registro de rtec
                    </h4>
                    <p>
                        Este procedimiento es fundamental para gestionar la creación de cuentas de usuarios y garantizar que todos los nuevos integrantes tengan la información necesaria para su integración.
                    </p>
                </div>
                <div class="checkout-body">                    
                    <form name="frm-rtec-store" id="frm-rtec-store">

                        @include('contadores.form')

                    </form>
                </div>
            </div>
        
        @endsection

        @section('js')

            <!-- Personal Js-Script -->
            <script src="{{ asset('public/template/assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
            <script src="{{ asset('public/tools/assets/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
            <script src="{{ asset('public/views/contadores/create.js') }}"></script>

        @endsection


        @section('script')

            
        @endsection