    @extends('layouts.app')

        @section('breadcrumb')

            <li class="breadcrumb-item">
                <a class="link-fx" href="{{ route('rtecs.index') }}">Rtecs</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx text-dark" href="#">
                    Detalle rtec
                </a>
            </li>

        @endsection
        
        @section('button-action')

            @can('usuario-create')
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a class="btn btn-inverse btn-theme" href="{{ route('rtecs.index') }}">
                        <i class="text-primary fa fa-reply-all"></i> Regresar
                    </a>
                </div>
            </div>
            @endcan

        @endsection


        @section('content')

            <div class="checkout">
                <div class="checkout-header" style="color: #fff;">
                    <h4 >
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Detalle de RTEC
                    </h4>
                    <p>El detalle de los Representantes Técnicos (RTEC) incluye la información esencial de cada profesional autorizado para desempeñar funciones técnicas.</p>
                </div>
                <div class="checkout-body">
                    <div class="checkout-message _response"></div>
                </div>
            </div>

        @endsection

        @section('js')

            <!-- Personal Js-Script -->
            <script src="{{ asset('public/views/rtecs/show.js') }}"></script>

        @endsection

        @section('script')

            show({{ $id }});

        @endsection