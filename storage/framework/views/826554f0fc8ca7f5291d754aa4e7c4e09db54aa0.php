<!DOCTYPE doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Contadores | Web</title>
        <meta name="description" content="Contadores - Sistema Solicitud de Folios de Contadores Certificados">
        <meta name="author" content="Sandro Alan Gomez Aceituno">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Rtecs - Sistema Solicitud de Folios de Rtecs">
        <meta property="og:site_name" content="RTECS">
        <meta property="og:description" content="Sistema Solicitud de Folios de Rtecs">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://apps.anticorrupcionybg.gob.mx/rtecs">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo e(asset('public/template/assets/media/favicons/favicon.png')); ?>">
        <link rel="icon" type="image/png" sizes="192x192" href="<?php echo e(asset('public/template/assets/media/favicons/favicon-192x192.png')); ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('public/template/assets/media/favicons/apple-touch-icon-180x180.png')); ?>">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- OneUI framework -->
        <link rel="stylesheet" id="css-main" href="<?php echo e(asset('public/template/assets/css/oneui.min.css')); ?>">
        <!-- END Stylesheets -->
         <style>
            .bg-image {
                background-position:0 20%;
                background-size: cover;
            }
         </style>
    </head>
    <body>
        <div id="page-container">
            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('public/tools/assets/img/login.png');">
                    <div class="row g-0 bg-primary-dark-op">
                        <!-- Meta Info Section -->
                        <div class="hero-static col-lg-4 d-none d-lg-flex flex-column justify-content-center">
                            <div class="p-4 p-xl-5 flex-grow-1 d-flex align-items-center">
                                <div class="w-100">
                                    <a class="link-fx fw-semibold fs-2 text-white" href="index.html">
                                        Con<span class="fw-normal">tadores</span>
                                    </a>
                                    <p class="text-white-75 me-xl-8 mt-2">
                                        Solicitud de Folios
                                    </p>
                                </div>
                            </div>
                            <div class="p-4 p-xl-5 d-xl-flex justify-content-between align-items-center fs-sm">
                                <p class="fw-medium text-white-50 mb-0">
                                    <strong> Contadores v1.0 </strong> © <span data-toggle="year-copy"></span>
                                </p>
                            </div>
                        </div>
                        <!-- END Meta Info Section -->
                        <!-- Main Section -->
                        <div class="hero-static col-lg-8 d-flex flex-column align-items-center bg-body-extra-light">
                            <div class="p-3 w-100 d-lg-none text-center">
                                <a class="link-fx fw-semibold fs-3 text-dark" href="index.html">
                                    Con<span class="fw-normal">tadores</span>
                                </a>
                            </div>
                            <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
                                <div class="w-100">
                                    <!-- Header -->
                                    <div class="text-center mb-5">
                                        <p class="mb-3">
                                            <i class="fa fa-2x fa-circle-notch text-primary-light"></i>
                                        </p>
                                        <h1 class="fw-bold mb-2">
                                            Iniciar Sesión
                                        </h1>
                                        <p class="fw-medium text-muted">
                                            Bienvenido, inicie sesión para poder accesar.
                                        </p>
                                    </div>
                                    <!-- END Header -->
                                    <div class="row g-0 justify-content-center">
                                        <div class="col-sm-8 col-xl-4">
                                            <form method="POST" action="<?php echo e(route('login')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="mb-4">
                                                    <input type="text" class="form-control form-control-lg form-control-alt py-3" id="email" name="email" placeholder="Correo electrónico">
                                                    </input>
                                                </div>
                                                <div class="mb-4">
                                                    <input type="password" class="form-control form-control-lg form-control-alt py-3" id="password" name="password" placeholder="Contraseña">
                                                    </input>
                                                </div>
                                                <div class="mb-4 d-flex justify-content-between d-grid gap-2">
                                                    <button class="btn btn-lg btn-alt-primary" type="submit">
                                                        <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Iniciar sesión
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- END Sign In Form -->
                                </div>
                            </div>
                            <div class="px-4 py-3 w-100 d-lg-none d-flex flex-column flex-sm-row justify-content-between fs-sm text-center text-sm-start">
                                <p class="fw-medium text-black-50 py-2 mb-0">
                                    <strong> Contadores v1.0 </strong> © <span data-toggle="year-copy"></span>
                                </p>
                            </div>
                        </div>
                        <!-- END Main Section -->
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        <script src="<?php echo e(asset('public/template/assets/js/oneui.app.min.js')); ?>">
        </script>
        <script src="<?php echo e(asset('public/template/assets/js/lib/jquery.min.js')); ?>">
        </script>
        <script src="<?php echo e(asset('public/template/assets/js/plugins/jquery-validation/jquery.validate.min.js')); ?>">
        </script>
        <!-- Page JS Code -->
        <script src="<?php echo e(asset('public/template/assets/js/pages/op_auth_signup.min.js')); ?>">
        </script>
    </body>
</html><?php /**PATH C:\AppServ\www\contadores\resources\views/auth/login.blade.php ENDPATH**/ ?>