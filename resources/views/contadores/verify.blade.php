<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <title>Rtecss | Web</title>
       
        <!-- Otras etiquetas meta y recursos -->
        <link rel="icon" href="{{ asset('public/template/image/favicon.ico') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('public/template/image/favicon.ico') }}" type="image/x-icon">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('public/tools/assets/css/e-commerce/app.min.css') }}" />
        <link rel="stylesheet" id="css-main" href="{{ asset('public/template/assets/js/plugins/animate/animate.min.css') }}">
    </head>
    <body>
        <div id="page-container" class="fade">
            <!-- BEGIN #top-nav -->
            <div id="top-nav" class="top-nav">
                <div class="container">
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"><i class="fab fa-facebook-f f-s-14"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter f-s-14"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram f-s-14"></i></a></li>
                            <li><a href="#"><i class="fab fa-dribbble f-s-14"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>       

            <div id="about-us-cover" class="section-container">
                <div class="container">
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
                </div>
            </div>

            <div id="footer" class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h4 class="footer-header">Sobre nosotros</h4>
                            <p>
                                Ser un organismo público reconocido por su objetividad, imparcialidad, profesionalismo y transparencia, garantizando los derechos fundamentales y humanos en la función pública, para generar confianza de la sociedad en las instituciones.  
                            </p>
                            <!-- <p class="mb-lg-4 mb-0">
                                Vestibulum porttitor lorem et vestibulum pharetra. Phasellus sit amet mi congue, hendrerit mi ut, dignissim eros.
                            </p> -->
                        </div>                    
                        <div class="col-lg-4">
                            <h4 class="footer-header">Contáctanos</h4>
                            <address class="mb-lg-6 mb-0">
                                Blvd. Los Castillos No. 410, Fracc.<br />
                                Montes Azules C.P. 29056<br />
                                Teléfono: Quejas y denuncias 800-900-9000 <br />
                                <a href="https://anticorrupcionybg.gob.mx">https://anticorrupcionybg.gob.mx/</a><br />
                                Tuxtla Gutiérrez, Chiapas. <br /><br />
                                <abbr title="Phone">Conmutador:</abbr> (961) 61 8 75 30 <br />
                                <abbr title="Email">Email:</abbr> <a href="mailto:oficialiadepartes@anticorrupcionybg.gob.mx ">oficialiadepartes@anticorrupcionybg.gob.mx </a>
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div id="footer-copyright" class="footer-copyright">
                <div class="container">
                    <div class="payment-method"></div>
                    <div class="copyright">
                        Todos los derechos reservados &copy; 2025 Secretaría Anticorrupción y Buen Gobierno.
                    </div>
                </div>
            </div>
        </div>


        <script src="{{ asset('public/tools/assets/js/e-commerce/app.min.js') }}"></script>
        <!-- Personal Js-Script -->
        <!-- <script>var vURL=window.location.origin + '/rtec';</script> -->
        <script type="text/javascript">
            // $(document).ready(
            //     function () {
            //         show('{{ $uniqid }}');
            //     }
            // );

            document.addEventListener("DOMContentLoaded", 
                function () {
                    show('{{ $uniqid }}');
                }
            );

            function show( uniqid )
             {


                $.ajax({
                    type: 'GET',
                    url: 'https://apps.anticorrupcionybg.gob.mx/rtec/api/verificar/folio',
                    dataType: "JSON",
                    data: {
                        method: 'show',
                        uniqid: uniqid
                    },
                    success: function(vresponse, vtextStatus, vjqXHR) {

                        let _html_espds ='';
                            _html_espds+='  <ul class="fa-ul mb-lg-4 mb-0">';
                            $.each(vresponse.espds, function(index, value) {
                                _html_espds+='  <li>';
                                _html_espds+='      <i class="fa fa-li fa-angle-right"></i><b>'+ value.clave +'</b> '+ value.especialidad;
                                _html_espds+='  </li>';
                            });
                            _html_espds+='  </ul>';

                        let _html ='';
                            _html+='<h2 class="text-center">'+ vresponse.data.nombre +'</br><small><b>'+ vresponse.data.colegio +'</b></small></h2>';
                            
                            _html+='<div class="row">';
                            _html+='    <div class="col-md-1"></div>';
                            _html+='    <div class="col-md-10 table-responsive tbl-response">';
                            _html+='        <table class="table table-payment-summary">';
                            _html+='            <tbody>';
                            _html+='                <tr>';
                            _html+='                    <td class="field">Folio</td>';
                            _html+='                    <td class="value"><b>'+ vresponse.data.folio +'</b></td>';
                            _html+='                </tr>';
                            _html+='                <tr>';
                            _html+='                    <td class="field">Sujeto</td>';
                            _html+='                    <td class="value">'+ vresponse.data.sujeto +'</td>';
                            _html+='                </tr>';
                            // _html+='                <tr>';
                            // _html+='                    <td class="field">Teléfono</td>';
                            // _html+='                    <td class="value">'+ vresponse.data.telefono +'</td>';
                            // _html+='                </tr>';
                            // _html+='                <tr>';
                            // _html+='                    <td class="field">Correo electrónico</td>';
                            // _html+='                    <td class="value">'+ vresponse.data.correo +'</td>';
                            // _html+='                </tr>';
                            _html+='                <tr>';
                            _html+='                    <td class="field">Número de cedula profesional</td>';
                            _html+='                    <td class="value">'+ vresponse.data.no_cedula_profesional +'</td>';
                            _html+='                </tr>';
                            // _html+='                <tr>';
                            // _html+='                    <td class="field">Número de RTEC interno</td>';
                            // _html+='                    <td class="value">'+ vresponse.data.no_rtec_interno +'</td>';
                            // _html+='                </tr>';
                            _html+='                <tr>';
                            _html+='                    <td class="field">Fecha expedición</td>';
                            _html+='                    <td class="value">'+ vresponse.data.fecha_expedicion +'</td>';
                            _html+='                </tr>';
                            _html+='                <tr>';
                            _html+='                    <td class="field">Especialidades</td>';
                            _html+='                    <td class="value">';
                            _html+=                         _html_espds;
                            _html+='                    </td>';
                            _html+='                </tr>';
                            _html+='            </tbody>';
                            _html+='        </table>';
                            _html+='    </div>';
                            _html+='    <div class="col-md-1"></div>';
                            _html+='</div>';

                            $('._response').html(_html);

                            // $('#qr-image').attr('src', 'data:image/png;base64,' + vresponse.qr_code).show();
                    },
                    error: function(vjqXHR, vtextStatus, verrorThrown){
                        console.log('AJAX error:', vjqXHR, vtextStatus, verrorThrown);
                    }
                });
             }
        </script>
    </body>
</html>