<section>
    <div class="row">
        <div class="col-md-12">
            <div id="notificacion_nuevo_ajax"></div>

            <form action="{{ url('crear_usuario') }}" method="post" id="f_crear_usuario" class="formentrada">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="col-md-12">

                    <div class="box box-primary  box-gris">

                        <div class="box-header with-border my-box-header">
                            <h3 class="box-title"><strong>Nuevo Jugador</strong></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="nombres">Nombres*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nombres" name="nombres" required>
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="apellidos">Apellido*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="apellidos" name="apellidos"
                                               required>
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="cedula">Cédula</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="cedula" name="cedula" value="">
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="state">Estado</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="state" name="state" value="">
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="city">Ciudad</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="city" name="city" value="">
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="phone">Teléfono</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="phone" name="phone">
                                    </div>

                                </div><!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="association">Asociación</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="association" name="association"
                                               value="">
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="federation">Federacion</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="federation" name="federation"
                                               value="">
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="team">Escudería</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="team" name="team" value="">
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->

                        </div>

                    </div>

                </div> <!--box -->

                <div class="col-md-12">

                    <div class="box box-primary  box-gris">

                        <div class="box-header with-border my-box-header">
                            <h3 class="box-title"><strong>Datos Acceso al sistema</strong></h3>
                        </div><!-- /.box-header -->

                        <div class="box-body">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="email">eMail*</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="email">Password*</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password"
                                               required>
                                    </div>

                                </div><!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="password_confirmation">Confirmar Password*</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_confirmation"
                                               name="password_confirmation" required>
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="box-footer col-xs-12 box-gris ">
                                <button type="submit" class="btn btn-primary">Crear Nuevo Jugador</button>
                            </div>
                        </div>
                    </div><!--box -->
                </div>
            </form>
        </div>
    </div>

</section>

