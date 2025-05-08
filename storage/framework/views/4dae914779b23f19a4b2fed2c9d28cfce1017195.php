    

        <?php $__env->startSection('css'); ?>

            <link rel="stylesheet" href="<?php echo e(asset('public/template/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')); ?>">
            <!-- <link rel="stylesheet" href="<?php echo e(asset('template/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')); ?>"> -->
            <link rel="stylesheet" href="<?php echo e(asset('public/template/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')); ?>">

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('breadcrumb'); ?>

            <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx" href="<?php echo e(route('home')); ?>">
                    Inicio
                </a>
            </li>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('content'); ?>

        <div id="policy" class="section-container bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                        <div class="policy">
                            <div class="policy-icon">
                            <i class="fas fa-business-time text-warning"></i>
                            </div>
                            <div class="policy-info">
                                <h4><span class="_proceso"></span> Folios en proceso</h4>
                                <p>Folios en proceso por falta de carga de la constancia de contador certificado.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                        <!-- BEGIN policy -->
                        <div class="policy">
                            <div class="policy-icon">                                
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                            <div class="policy-info">
                                <h4><span class="_concluidos"></span> Folios concluidos</h4>
                                <p>Folios concluidos tras la carga de la constancia del contador certificado.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="policy">
                            <div class="policy-icon">
                            <i class="fas fa-times-circle text-danger"></i>
                            </div>
                            <div class="policy-info">
                                <h4><span class="_cancelados"></span> Folios cancelados</h4>
                                <p>Folios cuya gestión fue cancelada por el área de coordinación.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />

        <div class="account-container">
            <!-- BEGIN account-sidebar -->
            <div class="account-sidebar">
                <div class="account-sidebar-cover">
                    <img src="../assets/img/cover/cover-14.jpg" alt="" />
                </div>
                <div class="account-sidebar-content">
                    <h4>Ultimos folios</h4>
                    <p class="mb-2 mb-lg-4">
                        Aquí puedes ver los 10 folios más nuevos registrados en el sistema.
                    </p>

                    <?php if( Auth::User()->id == 2 ): ?>
                        <hr />
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-inverse btn-reporte" href="" target="_blank">
                                    <i class="text-primary fa fa-file"></i> Reporte de Contadores registrados por colegios
                                </a>
                            </div>
                        </div>
                        <hr />
                    <?php endif; ?>  
                </div>
            </div>
            <div class="account-body">
                <div class="row">
                    

                    <div class="col-md-12 tbl-tablero-response">
                       
                    </div>
                </div>
            </div>
        </div>      

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('js'); ?>

            <!-- Page JS Plugins -->
            <script src="<?php echo e(asset('public/template/assets/js/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
            <script src="<?php echo e(asset('public/template/assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js')); ?>"></script>
            <script src="<?php echo e(asset('public/template/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
            <script src="<?php echo e(asset('public/template/assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js')); ?>"></script>
            <!-- Personal Js-Script -->
            <script src="<?php echo e(asset('public/views/home.js')); ?>"></script>
            <script src="<?php echo e(asset('public/views/tablero/index.js')); ?>"></script>

        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\contadores\resources\views/home.blade.php ENDPATH**/ ?>