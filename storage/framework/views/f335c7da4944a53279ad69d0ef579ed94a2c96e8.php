    

        <?php $__env->startSection('css'); ?>

            <link rel="stylesheet" href="<?php echo e(asset('public/template/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')); ?>">
            <!-- <link rel="stylesheet" href="<?php echo e(asset('template/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')); ?>"> -->
            <link rel="stylesheet" href="<?php echo e(asset('public/template/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')); ?>">

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('breadcrumb'); ?>

            <li class="breadcrumb-item">
                <a href="<?php echo e(route('usuarios.index')); ?>">
                    Usuarios
                </a>
            </li>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('button-action'); ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('usuario-create')): ?>
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a href="<?php echo e(route('usuarios.create')); ?>" class="btn btn-inverse btn-theme">
                        <i class="text-primary fa fa-plus"></i> Crear nuevo usuario
                    </a>
                </div>
            </div>
            <?php endif; ?>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('content'); ?>

            <div class="checkout">
                <div class="checkout-header" style="color: #fff;">
                    <h4 >
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Listado de usuarios
                    </h4>
                    <p>Listado de usuarios corresponde a los empleados activos de la Secretaría Anticorrupción y Buen Gobierno.</p>
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

                    <div class="table-responsive tbl-usuarios"></div>

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
            <script src="<?php echo e(asset('public/views/users/index.js')); ?>"></script>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('script'); ?>

            $('._usuario').addClass('active');
            
            var _permissionEdit=false;
            var _permissionDelete=false;

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('usuario-edit')): ?>

                _permissionEdit=true;
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('usuario-delete')): ?>

                _permissionDelete=true;
            <?php endif; ?>

        <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\contadores\resources\views/users/index.blade.php ENDPATH**/ ?>