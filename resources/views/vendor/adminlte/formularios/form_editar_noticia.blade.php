<section class="content">


    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary box-gris">

                <div class="box-header with-border my-box-header">
                    <h3 class="box-title"><strong>Agregar nueva noticia</strong></h3>
                </div><!-- /.box-header -->
                <div id="notificacion_editar_noticia"></div>
                <div class="box-body">

                    <form action="{{ url('editar_noticia') }}" method="post" id="f_editar_noticia"
                          class="formentrada_noticias_liga"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="id_noticia" value="{{$noticia->id}}">

                        <div class="form-group">
                            <label for="title">Titulo*</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$noticia->title}}"
                                   required>
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <label for="description">Descripcion*</label>
                            <textarea rows="10" class="form-control" id="description" name="description"
                                      value="{{$noticia->description}}" required>{{$noticia->description}}</textarea>
                        </div><!-- /.form-group -->

                        <br>
                        <br>
                        <br>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <img src="{{asset($noticia->url_image)}}" alt="Notice Image"
                                     style="width:220px; height:160px;" id="fotografia_noticia">
                            </div>

                            <label for="image_news">Agregar Imagen de la noticia*</label>
                            <input name="image_news" id="image_news" type="file" class="archivo form-control"
                                   onchange="document.getElementById('fotografia_noticia').src = window.URL.createObjectURL(this.files[0])"
                            /><br/><br/>
                        </div><!-- /.col -->

                        <div class="box-footer col-xs-12 box-gris ">
                            <button id="submit_editar_noticia" type="submit" class="btn btn-primary">Actualizar Noticias
                            </button>
                        </div>

                    </form>
                </div>

            </div><!-- /.box box-primary box-gris -->

        </div>
    </div>


</section>
