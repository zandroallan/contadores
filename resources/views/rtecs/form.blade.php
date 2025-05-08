
						<div class="row">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-10">

                                <h5 class="border-bottom pb-2"><b>Datos personales</b></h5>
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <label for="nombre">
                                                <b class="text-primary">Nombre completo RTEC</b>
                                                <span style="color: red">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required/>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="telefono">
                                                <b class="text-primary">Telefono</b>
                                                <span style="color: red">*</span>
                                            </label>
                                            <input type="text" class="form-control js-masked-phone" id="telefono" name="telefono" placeholder="Teléfono" required/>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="correo">
                                                <b class="text-primary">Correo</b>
                                                <span style="color: red">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" required/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <label for="direccion">
                                                <b class="text-primary">Dirección</b>
                                                <span style="color: red">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" required/>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="border-bottom pb-2"><b>Datos generales</b></h5>
                                <div class="row g-4">
                                    <div class="col-4">
                                        <label for="no_cedula_profesional">
                                            <b class="text-primary">Número de cedula profesional</b>
                                            <span style="color: red">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="no_cedula_profesional" name="no_cedula_profesional" placeholder="Número de cedula profesional" required/>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-floating mb-3">
                                            <label for="no_rtec_interno">
                                                <b class="text-primary">Número de Rtec interno</b>
                                                <span style="color: red">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="no_rtec_interno" name="no_rtec_interno" placeholder="Número de Rtec interno" required/>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-floating mb-3">
                                            <label for="fecha_expedicion">
                                                <b class="text-primary">Fecha expedición</b>
                                                <span style="color: red">*</span>
                                            </label>
                                            <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion" placeholder="Número de Rtec interno" required/>
                                        </div>
                                    </div>
                                </div>
                                
                                <h5 class="border-bottom pb-2"><b>Listado de especialidades</b></h5>
                                <div class="row items-push div-especialidades"></div>
                                
                            </div>
                            <div class="col-lg-1"></div>
                        </div>