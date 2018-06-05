<section class="content">

    <div class="row">

        <div class="col-md-6">

            <div class="box box-primary box-gris">

                <div class="box-header">
                    <h3 class="box-title">Editar información de la liga</h3>
                </div><!-- /.box-header -->

                <div id="notificacion_resul_cil"></div>

                <form action="{{ url('cambiar_informacion_league') }}" method="post" id="f_editar_league" class="formentrada">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id_league" value="{{ $league->id }}">

                    <div class="box-body">
                        <div class="form-group col-xs-12">
                            <label for="name_league">Nombre*</label>
                            <input type="text" class="form-control" id="name_league" name="name_league"
                                   value="{{ $league->name_league }}" required>
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="description_league">Descripción*</label>
                            <input type="text" class="form-control" id="description_league"
                                   name="description_league" value="{{ $league->description }}" required>
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="state_league">Estado*</label>
                            <input type="text" class="form-control" id="state_league" name="state_league"
                                   value="{{ $league->state }}" required>
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="city_league">Ciudad*</label>
                            <input type="text" class="form-control" id="city_league" name="city_league"
                                   value="{{ $league->city }}" required>
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="address_league">Direccion*</label>
                            <input type="text" class="form-control" id="address_league" name="address_league"
                                   value="{{ $league->address }}" required>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="name_admin">Admin*</label>
                            <input type="text" class="form-control" id="name_admin" name="name_admin"
                                   value="{{ $league->name_admin }}" required>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="email_league">Email*</label>
                            <input type="email" class="form-control" id="email_league" name="email_league"
                                   value="{{ $league->email }}" required>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="phone_league">Teléfono*</label>
                            <input type="text" class="form-control" id="phone_league" name="phone_league"
                                   value="{{ $league->phone }}" required>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                        </div>

                    </div>

                </form>
            </div>

            <!--informacion usuario -->

            <div class="box box-primary box-gris">
                <div class="box-header with-border">
                    <h3 class="box-title">Informacion de Usuario Administrador</h3>
                </div><!-- /.box-header -->

                <div id="notificacion_resul_cp"></div>
                <!-- form start -->

                <form method="post" id="f_cambiar_password" class="formentrada" action="cambiar_password">
                    <input type="hidden" name="id_usuario_password" value="{{ $usuario->id }}">
                    <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nombres">Nombre*</label>
                            <input type="text" class="form-control" id="nombres" name="nombres"
                                   value="{{ $usuario->nombres }}" required>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="apellidos">Apellidos*</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos"
                                   value="{{ $usuario->apellidos }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Teléfono*</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   value="{{ $usuario->telefono }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email_usuario">Email*</label>
                            <input type="email" class="form-control" id="email_usuario" name="email_usuario"
                                   value="{{ $usuario->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password_usuario">Password*</label>
                            <input type="password" class="form-control" id="password_usuario" name="password_usuario" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Password*</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                   name="password_confirmation" required>
                        </div>


                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary ">Actualizar Datos</button>
                        </div>
                    </div><!-- /.box-body -->
                </form>
            </div>



        </div> <!-- end col mod 6 -->



        <div class="col-md-6">

            <div class="box box-primary box-gris">
                <div class="box-header">
                    <h3 class="box-title">Cambiar Logo Liga</h3>
                </div><!-- /.box-header -->

                <div id="notificacion_resul_logo"></div>

                <form id="f_subir_logo" name="f_subir_logo" method="post" action="subir_logo_league"
                      class="formarchivo" enctype="multipart/form-data">
                    <input type="hidden" name="id_league" value="{{$league->id}}">
                    <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">

                    <div class="box-body">

                        <div class="form-group">

                            <?php if ($league->url_logo == "") {
                                $league->url_logo = "img/avatar.jpg";
                            }  ?>
                            <img src="<?=  $league->url_logo;  ?>" alt="Logo Image"
                                 style="width:160px;height:160px;"
                                 id="fotografia_liga">
                        </div>

                        <div class="form-group">
                            <label>Agregar Imagen </label>
                            <input name="archivo_logo" id="archivo_logo" type="file" class="archivo form-control"
                                   onchange="document.getElementById('fotografia_liga').src = window.URL.createObjectURL(this.files[0])"
                                   required/><br/><br/>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Logo</button>

                    </div>

                </form>

            </div>

            <!-- portada -->

            <div class="box box-primary box-gris">
                <div class="box-header">
                    <h3 class="box-title">Cambiar Portada</h3>
                </div><!-- /.box-header -->

                <div id="notificacion_resul_portada"></div>

                <form id="f_subir_portada" name="f_subir_portada" method="post" action="subir_portada_league"
                      class="formarchivo" enctype="multipart/form-data">
                    <input type="hidden" name="id_league" value="{{$league->id}}">
                    <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">

                    <div class="box-body">

                        <div class="form-group">

                            <?php if ($league->url_portada == "") {
                                $league->url_portada = "img/avatar.jpg";
                            }  ?>
                            <img src="<?=  $league->url_portada;  ?>" alt="Portada"
                                 style="width:100%;max-width:600px;height:160px;"
                                 id="fotografia_portada">
                        </div>

                        <div class="form-group">
                            <label>Agregar Imagen </label>
                            <input name="archivo_portada" id="archivo_portada" type="file" class="archivo form-control"
                                   onchange="document.getElementById('fotografia_portada').src = window.URL.createObjectURL(this.files[0])"
                                   required/><br/><br/>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Portada</button>

                    </div>

                </form>

            </div>


        </div>    <!-- end col mod 6 -->



    </div> <!-- end row -->

</section>
