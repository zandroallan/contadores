@extends('layouts.app')
    
        @section('button-action')

            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a class="btn btn-inverse btn-theme" href="{{ route('usuarios.index') }}">
                        <i class="text-primary fa fa-reply-all"></i> Regresar
                    </a>
                    
                </div>
            </div>

        @endsection

        @section('content')

            <div class="checkout">
                <div class="checkout-header" style="color: #fff;">
                    <h4 >
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Detalle de cuenta colegios
                    </h4>
                    <p>El detalle de las cuentas de los colegios incluye la información esencial para ver los datos de acceso al sistema.</p>
                </div>
                <div class="checkout-body">
                    <div class="checkout-message">
                        <div class="table-responsive tbl-response">
                            <table class="table table-payment-summary">
                                <tbody>
                                    <tr>
                                        <td class="field">Nombre colegio</td>
                                        <td class="value">{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Registro Federeal de Contribuyente</td>
                                        <td class="value">{{ $user->rfc }}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Teléfono</td>
                                        <td class="value">{{ $user->telefono }}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Dirección fiscal</td>
                                        <td class="value">{{ $user->direccion }}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Correo electrónico</td>
                                        <td class="value">{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Rol de usuario</td>
                                        <td class="value">
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        @endsection

        @section('script')

            $('._usuarios').addClass('active');
            
        @endsection