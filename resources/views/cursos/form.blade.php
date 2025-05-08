
						<div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">

                                <h6 class="border-bottom pb-2">Seleccionar tipo sesión</h6>
                                <div class="form-check form-block mb-2">
                                   <input class="form-check-input" type="checkbox" value="1" id="ordinaria" name="id_tipo_sesion">
                                   <label class="form-check-label" for="ordinaria">
                                       <span class="d-flex align-items-center">
                                           <span class="ms-2">
                                               <span class="d-block fs-sm">Sesion ordinaria</span>
                                           </span>
                                       </span>
                                   </label>
                                </div>
                                <div class="form-check form-block mb-2">
                                   <input class="form-check-input" type="checkbox" value="2" id="extraordinaria" name="id_tipo_sesion">
                                   <label class="form-check-label" for="extraordinaria">
                                       <span class="d-flex align-items-center">
                                           <span class="ms-2">
                                               <span class="d-block fs-sm">Sesion Extraordinaria</span>
                                           </span>
                                       </span>
                                   </label>
                                </div>
                                
                                <h6 class="border-bottom pb-2">Datos de la sesión</h6>
                                <div class="row g-4">
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control flatpickr" id="fecha_carpeta" name="fecha_carpeta" placeholder="Fecha carpeta">
                                            <label for="fecha_carpeta">Fecha carpeta</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control flatpickr" id="fecha" name="fecha" placeholder="Fecha sesión">
                                            <label for="fecha">Fecha sesión</label>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="border-bottom pb-2">Seleccionar la Orden del día de la sesión</h6>
                                <div class="items-push div-orden-dia"></div>
                                
                            </div>
                            <div class="col-lg-2"></div>
                        </div>