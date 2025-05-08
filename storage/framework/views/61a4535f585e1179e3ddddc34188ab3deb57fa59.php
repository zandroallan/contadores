    

        <?php $__env->startSection('css'); ?>

            <link rel="stylesheet" id="css-main" href="<?php echo e(asset('public/template/assets/js/plugins/select2/css/select2.min.css')); ?>">

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('title'); ?>

            <h1 class="h3 fw-bold mb-0">Registro de rtec</h1>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('breadcrumb'); ?>

            <li class="breadcrumb-item">
                <a class="link-fx" href="<?php echo e(route('contadores.index')); ?>">Rtecs</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx text-dark" href="#">
                    Registro de rtec
                </a>
            </li>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('button-action'); ?>
           
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a class="btn btn-inverse btn-theme" href="<?php echo e(route('contadores.index')); ?>">
                        <i class="text-primary fa fa-reply-all"></i> Regresar
                    </a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rtec-create')): ?>
                    <a class="btn btn-inverse btn-theme btn-rtec-store" href="#">
                        <i class="text-primary fa fa-save"></i> Registrar contador
                    </a>
                    <?php endif; ?>
                </div>
            </div>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('content'); ?>

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

                        <?php echo $__env->make('contadores.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </form>
                </div>
            </div>
        
        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('js'); ?>

            <!-- Personal Js-Script -->
            <script src="<?php echo e(asset('public/template/assets/js/plugins/select2/js/select2.full.min.js')); ?>"></script>
            <script src="<?php echo e(asset('public/tools/assets/plugins/jquery.maskedinput/jquery.maskedinput.min.js')); ?>"></script>
            <script src="<?php echo e(asset('public/views/contadores/create.js')); ?>"></script>

        <?php $__env->stopSection(); ?>


        <?php $__env->startSection('script'); ?>

            
        <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\contadores\resources\views/contadores/create.blade.php ENDPATH**/ ?>