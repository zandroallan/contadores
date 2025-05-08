    

        <?php $__env->startSection('css'); ?>

            <link rel="stylesheet" id="css-main" href="<?php echo e(asset('public/template/assets/js/plugins/select2/css/select2.min.css')); ?>">

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('breadcrumb'); ?>

            <li class="breadcrumb-item">
                <a class="link-fx" href="<?php echo e(route('usuarios.index')); ?>">Usuarios</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx text-dark" href="#">
                    Edición de usuarios
                </a>
            </li>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('button-action'); ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('usuario-create')): ?>
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a class="btn btn-inverse btn-theme" href="<?php echo e(route('contadores.index')); ?>">
                        <i class="text-primary fa fa-reply-all"></i> Regresar
                    </a>
                    <a class="btn btn-inverse btn-theme btn-usuario-update" href="#">
                        <i class="text-primary fa fa-save"></i>  Editar registro
                    </a>
                </div>
            </div>
            <?php endif; ?>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('content'); ?>

            <div class="checkout">
                <div class="checkout-header" style="color: #fff;">
                    <h4 >
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Actualización de contadores certificados
                    </h4>
                    <p>
                        Este procedimiento es esencial para mantener la base de datos de usuarios actualizada, asegurando que los registros sean precisos y reflejen de manera correcta las condiciones actuales de cada Contador certificado.
                    </p>
                </div>
                <div class="checkout-body">                    
                    <form name="frm-contadores-update" id="frm-contadores-update">
                        <input type="hidden" name="id" id="id" value="<?php echo e($id); ?>" />

                        <?php echo $__env->make('contadores.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </form>
                </div>
            </div>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('js'); ?>

            <!-- Personal Js-Script -->
            <script src="<?php echo e(asset('public/template/assets/js/plugins/select2/js/select2.full.min.js')); ?>"></script>
            <script src="<?php echo e(asset('public/tools/assets/plugins/jquery.maskedinput/jquery.maskedinput.min.js')); ?>"></script>
            <script src="<?php echo e(asset('public/views/rtecs/edit.js')); ?>"></script>

        <?php $__env->stopSection(); ?>


        <?php $__env->startSection('script'); ?>

            
        <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\contadores\resources\views/contadores/edit.blade.php ENDPATH**/ ?>