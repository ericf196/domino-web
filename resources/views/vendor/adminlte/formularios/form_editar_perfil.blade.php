<section class="content">

    <div class="row">

        <div class="col-md-6">

            <div class="box box-primary box-gris">

                <div class="box-header">
                    <h3 class="box-title">Editar información del Usuario</h3>
                </div><!-- /.box-header -->

                <div id="notificacion_resul_feu"></div>

                <form id="f_editar_perfil" method="post" action="cambiar_informacion"
                      class="form-horizontal formentrada">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id_usuario" value="{{ $usuario->id }}">

                    <div class="box-body ">
                        <div class="form-group col-xs-12">
                            <label for="nombre">Nombres*</label>
                            <input type="text" class="form-control" id="nombres" name="nombres"
                                   value="{{ $usuario->nombres }}">
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="apellido">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos"
                                   value="{{ $usuario->apellidos }}">
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="cedula">Cedula</label>
                            <input type="text" class="form-control" id="cedula" name="cedula"
                                   value="{{ $usuario->cedula }}">
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="city">Ciudad</label>
                            <input type="text" class="form-control" id="city" name="city"
                                   value="{{ $usuario->city }}">
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="state">Estado</label>
                            <input type="text" class="form-control" id="state" name="state"
                                   value="{{ $usuario->state }}">
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="phone">Telefono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono"
                                   value="{{ $usuario->telefono }}">
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="team">Equipo</label>
                            <input type="text" class="form-control" id="team" name="team"
                                   value="{{ $usuario->team }}">
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="federation">Federacion</label>
                            <input type="text" class="form-control" id="federation" name="federation"
                                   value="{{ $usuario->federation }}">
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="association">Asociacion</label>
                            <input type="text" class="form-control" id="association" name="association"
                                   value="{{ $usuario->association }}">
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                        </div>

                    </div>

                </form>
            </div>

        </div> <!-- end col mod 6 -->

        <div class="col-md-6">

            <div class="box box-primary box-gris">
                <div class="box-header">
                        <h3 class="box-title">Cambiar Fotografia</h3>
                </div><!-- /.box-header -->

                <div id="notificacion_resul_fci"></div>

                <form id="f_subir_imagen" name="f_subir_imagen" method="post" action="subir_imagen_usuario"
                      class="formarchivo" enctype="multipart/form-data">

                    <input type="hidden" name="id_usuario_foto" value="{{$usuario->id}}">
                    <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">

                    <div class="box-body">

                        <div class="form-group">

                            <?php if ($usuario->url_image == "") {
                                $usuario->url_image = "img/avatar.jpg";
                            }  ?>
                            <img src="<?=  $usuario->url_image;  ?>" alt="User Image"
                                 style="width:160px;height:160px;"
                                 id="fotografia_usuario">
                            <!-- User image -->

                        </div>

                        <div class="form-group">
                            <label>Agregar Imagen </label>
                            <input name="archivo" id="archivo" type="file" class="archivo form-control"
                                   onchange="document.getElementById('fotografia_usuario').src = window.URL.createObjectURL(this.files[0])"
                                   required/><br/><br/>
                        </div>


                        <button type="submit" class="btn btn-primary">Actualizar Imagen</button>

                    </div>

                </form>

            </div>
        </div>    <!-- end col mod 6 -->


        <div class="col-md-6">

            <div class="box box-primary box-gris">
                <div class="box-header with-border">
                    <h3 class="box-title">Cambiar Password</h3>
                </div><!-- /.box-header -->

                <div id="notificacion_resul_fcp"></div>
                <!-- form start -->

                <form method="post" id="f_cambiar_password" class="formentrada" action="cambiar_password">
                    <input type="hidden" name="id_usuario_password" value="{{ $usuario->id }}">
                    <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="email" class="form-control" id="email_usuario" name="email_usuario"
                                   placeholder="Entrar email" value="{{ $usuario->email }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="password_usuario"
                                   name="password_usuario"
                                   placeholder="Password">
                        </div>
                        <div class="pt-4">
                            <button  type="submit" class="btn btn-primary ">Cambiar Password</button>
                        </div>
                    </div><!-- /.box-body -->


                </form>
            </div>

        </div>    <!-- end col mod 6 -->

    </div> <!-- end row -->

</section>

