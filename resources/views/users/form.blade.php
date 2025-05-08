
						<div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">

                                <h5 class="border-bottom pb-2">Datos generales</h5>
                                <div class="form-floating mb-3">
                                    <label for="name">Nombre colegio</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre completo">
                                </div>
                                <div class="row g-4">
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="rfc">Registro Federal de Contribuyentes (RFC)</label>
                                            <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Registro Federal de Contribuyentes">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <label for="direccion">Dirección fiscal</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
                                        </div>
                                    </div>
                                </div>

                                
                                @if ( !isset($id_usuario) )
                                <h5 class="border-bottom pb-2">Seguridad de la cuenta</h5>
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="form-floating mb-3 ">
                                            <label for="email">Correo electrónico</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Correo electrónico">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="password">Contraseña</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <label for="confirm-password">Confirmar contraseña</label>
                                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Password">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <h5 class="border-bottom pb-2">Rol de usuario</h5>
                                <div class="row items-push div-rol"></div>
                                
                            </div>
                            <div class="col-lg-2"></div>
                        </div>