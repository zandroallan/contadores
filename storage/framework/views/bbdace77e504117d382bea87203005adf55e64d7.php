    

        <?php $__env->startSection('meta'); ?>
            <meta name="csrf-token" content="<?= csrf_token() ?>">
        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('css'); ?>

            <link rel="stylesheet" href="<?php echo e(asset('template/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')); ?>">
            <!-- <link rel="stylesheet" href="<?php echo e(asset('template/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')); ?>"> -->
            <link rel="stylesheet" href="<?php echo e(asset('template/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')); ?>">
            <link rel="stylesheet" id="css-main" href="<?php echo e(asset('template/assets/js/plugins/select2/css/select2.min.css')); ?>">
        
        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('breadcrumbs'); ?>
            <a href="#" class="text-muted">Coordinadores</a>  
        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('button-action'); ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permiso-create')): ?>
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a href="<?php echo e(route('permisos.create')); ?>" class="btn btn-inverse btn-theme">
                        Crear nuevo permiso
                    </a>
                </div>
            </div>
            <?php endif; ?>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('content'); ?>

            <div class="checkout">
                <div class="checkout-header" style="color: #fff;">
                    <h4 >
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Listado de permisos de usuarios
                    </h4>
                    <p>
                        Los permisos de usuario son configuraciones que determinan el nivel de acceso y las acciones que un usuario puede realizar dentro del sistema de la Secretaría Anticorrupción y Buen Gobierno.
                    </p>
                </div>
                <div class="checkout-body">
                    
                    <div class="input-group">
                        <input type="text" class="form-control" id="txt-search" placeholder="Ingresa el término que deseas encontrar en el campo de búsqueda ">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-inverse">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <hr />

                    <div class="table-responsive tbl-permisos"></div>

                </div>
            </div>


        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('js'); ?>
            
            <script src="<?php echo e(asset('public/template/assets/js/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
            <script src="<?php echo e(asset('public/template/assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js')); ?>"></script>
            <script src="<?php echo e(asset('public/template/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
            <script src="<?php echo e(asset('public/template/assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js')); ?>"></script>
            <script src="<?php echo e(asset('public/views/permisos/index.js')); ?>"></script>
            <!-- <script src="<?php echo e(asset('views/tools.js')); ?>"></script> -->

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('script'); ?>  

            $('._permiso').addClass('active');
            var _permissionEdit=false;
            var _permissionDelete=false;

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rol-edit')): ?>

                _permissionEdit=true;
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rol-delete')): ?>

                _permissionDelete=true;
            <?php endif; ?>

        <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\contadores\resources\views/permissions/index.blade.php ENDPATH**/ ?>