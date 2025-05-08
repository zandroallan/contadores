<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <title>Rtecs | Web</title>
   
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
    <link rel="stylesheet" id="css-main" href="{{ asset('public/template/assets/js/plugins/jquery-confirm/css/jquery-confirm.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('public/template/assets/js/plugins/animate/animate.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('public/tools/assets/css/e-commerce/theme/'.  Auth::user()->theme .'.min.css') }}">

    <style type="text/css">
        .dataTables_filter {
            display: none;
        }
    </style>
</head>
<body>
    <div id="page-container" class="fade">
        <!-- BEGIN #top-nav -->
        <div id="top-nav" class="top-nav">
            <!-- BEGIN container -->
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
            <!-- END container -->
        </div>

            <div id="header" class="header header-inverse">
                <div class="container">
                    <div class="header-container">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="header-logo">
                            <a href="{{ route('home') }}">
                                <span class="brand-logo"></span>
                                <span class="brand-text">
                                    <span class="text-primary">R</span>tecs
                                    <small>Solicitud de folios</small>
                                </span>
                            </a>
                        </div>
                        <div class="header-nav">

                            @include('layouts.navigations')
                            
                        </div>
                        <div class="header-nav">
                            <ul class="nav pull-right">
                                <li class="dropdown dropdown-hover">
                                    <a href="#" data-toggle="dropdown">
                                        <img src="{{ asset('public/template/assets/media/avatars/avatar.jpg') }}" class="user-img" alt="" /> 
                                        <span class="d-none d-xl-inline">{{ Auth::user()->rfc }}</span>
                                        <b class="caret"></b>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('mi/perfil') }}">Mi perfil</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}" 
                                            onclick="event.preventDefault(); 
                                            document.getElementById('logout-form').submit();">Cerrar sesión</a>

                                        <input type="hidden" id="id_usuario" name="id_usuario" value="{{ Auth::user()->id }}">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>        

            <div id="about-us-cover" class="section-container">
                <div class="container">
                    <ul class="breadcrumb mb-3">
                        
                        @yield('breadcrumb')

                    </ul>

                    @yield('button-action')

                    @yield('content')
                    
                </div>
            </div>

            <div id="footer" class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <h4 class="footer-header">Sobre nosotros</h4>
                            <p>
                                Ser un organismo público reconocido por su objetividad, imparcialidad, profesionalismo y transparencia, garantizando los derechos fundamentales y humanos en la función pública, para generar confianza de la sociedad en las instituciones.  
                            </p>
                        </div>                    
                        <div class="col-lg-5">
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

        <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn">
                <i class="fa fa-cog"></i>
            </a>
            <div class="theme-panel-content">
                <ul class="theme-list clearfix">
                    <li>
                        <a href="#" class="bg-red"  onclick="changeTheme('red')"     data-title="Red"  title="">&nbsp;</a>
                    </li>
                    <li>
                        <a href="#" class="bg-pink"  onclick="changeTheme('pink')"     data-title="Pink"  title="">&nbsp;</a>
                    </li>
                    <li>
                        <a href="#" class="bg-orange" onclick="changeTheme('orange')"     data-title="Orange"  title="">&nbsp;</a>
                    </li>
                    <li>
                        <a href="#" class="bg-yellow"  onclick="changeTheme('yellow')"     data-title="Yellow"  title="">&nbsp;</a>
                    </li>
                    <li>
                        <a href="#" class="bg-lime"  onclick="changeTheme('lime')"     data-title="Lime"  title="">&nbsp;</a>
                    </li>
                    <li>
                        <a href="#" class="bg-green"  onclick="changeTheme('green')"     data-title="Green"  title="">&nbsp;</a>
                    </li>
                    <li>
                        <a href="#" class="bg-teal"  onclick="changeTheme('data')"   data-title="Default"  title="">&nbsp;</a>
                    </li>
                    <li>
                        <a href="#" class="bg-aqua"  onclick="changeTheme('aqua')"     data-title="Aqua"  title="">&nbsp;</a>
                    </li>
                    <li>
                        <a href="#" class="bg-blue"  onclick="changeTheme('blue')"     data-title="Blue"  title="">&nbsp;</a>
                    </li>
                    <li>
                        <a href="#" class="bg-purple" onclick="changeTheme('purple')"     data-title="Purple"  title="">&nbsp;</a>
                    </li>
                    <li>
                        <a href="#" class="bg-indigo" onclick="changeTheme('indigo')"     data-title="Indigo"  title="">&nbsp;</a>
                    </li>
                    <li>
                        <a href="#" class="bg-black"  onclick="changeTheme('black')"     data-title="Black"  title="">&nbsp;</a>
                    </li>
                </ul>
            </div>
        </div>


        <script src="{{ asset('public/tools/assets/js/e-commerce/app.min.js') }}"></script>
        <script src="{{ asset('public/template/assets/js/plugins/jquery-confirm/js/jquery-confirm.js') }}"></script>
        <!-- Personal Js-Script -->
        <script src="{{ asset('public/views/tools.js') }}"></script>
        <script>var vURL=window.location.origin + '/.rtec';</script>

        @yield('js')

        <script type="text/javascript">

            function changeTheme(name)
             {
                $.confirm({
                    title: 'Advertencia',
                    content: 'Esta seguro de cambiar el tema?',
                    type: 'orange',
                    theme: 'material',
                    buttons: {
                        Cambiar: function() {
                            theme( name )
                        },
                        Cancelar: function() {
                            swalFire('', 'Mensaje', '¡La accion fue cancelada por el usuario.');
                        }
                    }
                });
             }

            function theme( name )
             {
               $.ajax({
                    type: 'POST',
                    url: vURL + '/change/theme',
                    dataType: "JSON",
                    data: {
                        theme: name
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },        
                    success: function(vresponse, vtextStatus, vjqXHR) {

                        swalFire('', 'Mensaje', 'El tema ha sido cambiado correctamente.', '/home');
         
                    },
                    error: function(vjqXHR, vtextStatus, verrorThrown){ }
                }); 
             }

            @yield('script')
        </script>
    </body>
</html>