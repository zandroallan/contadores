    

        <?php $__env->startSection('css'); ?>

            <link rel="stylesheet" href="<?php echo e(asset('public/template/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')); ?>">
            <!-- <link rel="stylesheet" href="<?php echo e(asset('template/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')); ?>"> -->
            <link rel="stylesheet" href="<?php echo e(asset('public/template/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')); ?>">

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('breadcrumb'); ?>

            <li class="breadcrumb-item">
                <a href="<?php echo e(route('contadores.index')); ?>">
                    Contadores
                </a>
            </li>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('button-action'); ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rtec-create')): ?>
            <div class="form-group row">
                <label class="col-form-label col-md-12"></label>
                <div class="col-md-12">
                    <a href="<?php echo e(route('contadores.create')); ?>" class="btn btn-inverse btn-theme">
                        <i class="text-primary fa fa-plus"></i> Nuevo registro
                    </a>
                </div>
            </div>
            <?php endif; ?>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('content'); ?>

            <div class="checkout">
                <div class="checkout-header" style="color: #fff;">
                    <h4 >
                        <i class="fab fa-slideshare fa-fw text-primary"></i> Listado de contadores
                    </h4>
                    <p>Este vista contiene el registro actualizado de los Contadores Certificados autorizados en los colegios correspondientes. </p>
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

                    <div class="table-responsive tbl-contadores"></div>

                </div>
            </div>

            <div class="modal fade mdl-anexo" data-backdrop="static" data-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cargar constancia</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>              
                        <div class="modal-body">
                            <legend>¿ Esta seguro de cargar la <b>Constancia</b> a este folio ?</legend>
                            <p>
                                <b>Nota: </b>
                                Por favor, asegúrese de cargar la constancia en el formato adecuado (PDF) y de que el archivo no exceda el tamaño máximo permitido de 5MB. Recuerde que la constancia debe ser clara y legible.
                            </p>
                            <form id="frm-constancia-store" name="frm-constancia-store">
                                <input type="hidden" name="id" id="id" value="0">
                                <label class="control-label">
                                    Seleccionar la constancia a cargar
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <input type="file" class="form-control" name="file" id="file" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-light btn-theme" data-dismiss="modal">Cerrar</a>
                            <button type="button" class="btn btn-inverse btn-theme btn-constancia-store">
                                <i class="fas fa-upload t-plus-1 fa-fw"></i> Cargar constancia
                            </button>
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
            <script src="<?php echo e(asset('public/views/contadores/index.js')); ?>"></script>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('script'); ?>

            $('._contadores').addClass('active');
            
            var _permissionEdit=false;
            var _permissionDelete=false;

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rtec-edit')): ?>

                _permissionEdit=true;
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rtec-delete')): ?>

                _permissionDelete=true;
            <?php endif; ?>

        <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\contadores\resources\views/contadores/index.blade.php ENDPATH**/ ?>