                        <div class=" collapse navbar-collapse" id="navbar-collapse">
                            <ul class="nav">

                                <li class="_inicio">
                                    <a href="<?php echo e(route('home')); ?>">Inicio</a>
                                </li>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('usuario-list')): ?>
                                <li class="_usuarios">
                                    <a href="<?php echo e(route('usuarios.index')); ?>">Colegios</a>
                                </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rol-list')): ?>
                                <li class="_roles">
                                    <a href="<?php echo e(route('roles.index')); ?>">Roles</a>
                                </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permiso-list')): ?>
                                <li class="_permisos">
                                    <a href="<?php echo e(route('permisos.index')); ?>">Permisos</a>
                                </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rtec-list')): ?>
                                <li class="_rtecs">
                                    <a href="<?php echo e(route('contadores.index')); ?>">Contadores</a>
                                </li>
                                <?php endif; ?>

                                
                
                                <!-- <li class="dropdown dropdown-hover">
                                    <a href="#" data-toggle="dropdown">
                                        <i class="fa fa-search search-btn"></i>
                                        <span class="arrow top"></span>
                                    </a>
                                    <div class="dropdown-menu p-15">
                                        <form action="search_results.html" method="POST" name="search_form">
                                            <div class="input-group">
                                                <input type="text" placeholder="Search" class="form-control bg-silver-lighter" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-inverse" type="submit"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li> -->
                            </ul>
                        </div><?php /**PATH C:\AppServ\www\contadores\resources\views/layouts/navigations.blade.php ENDPATH**/ ?>