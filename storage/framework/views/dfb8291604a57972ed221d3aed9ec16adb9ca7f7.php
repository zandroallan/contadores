    

        <?php $__env->startSection('breadcrumb'); ?>

            <li class="breadcrumb-item">
                <a class="link-fx" href="<?php echo e(route('contadores.index')); ?>">Rtecs</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx text-dark" href="#">
                    Detalle rtec
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
                </div>
            </div>
            <?php endif; ?>

        <?php $__env->stopSection(); ?>


        <?php $__env->startSection('content'); ?>

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

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('js'); ?>

            <!-- Personal Js-Script -->
            <script src="<?php echo e(asset('public/views/contadores/show.js')); ?>"></script>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('script'); ?>

            show(<?php echo e($id); ?>);

        <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\contadores\resources\views/contadores/show.blade.php ENDPATH**/ ?>