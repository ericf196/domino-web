<section class="content">

    <div class="row">
        @foreach($anuns as $anun)
        {{--@for ($i = 0; $i < 8; $i++)--}}
            <div class="col-md-6">

                <div class="box box-primary box-gris">

                    <div class="box-header text-center">
                        <h3 class="box-title">Espacio Publicitario</h3>
                    </div><!-- /.box-header -->

                    <div id="notificacion_nueva_publicidad-{{$anun->id}}"></div>
                    <form action="{{ url('nueva_publicidad') }}" method="post" id="f_anun{{$anun->id}}" enctype="multipart/form-data"
                          class="formentrada_anun">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="id_anun" value="{{$anun->id}}">

                        <div class="box-body">
                            <div class="form-group">
                                <label for="nombre">Nombre*</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{$anun->name}}" required>
                            </div>

                            <div class="form-group">
                                <img src=" {{asset($anun->url_publicity)}} " alt="User Image"
                                     style="width:150px;height:150px;"
                                     id="fotografia_publ-{{$anun->id}}">
                            </div>

                            <div style="margin-top: 50px" class="form-group">
                                <input name="image_pub" id="image_pub" type="file" class="image_pub"
                                       onchange="document.getElementById('fotografia_publ-{{$anun->id}}').src = window.URL.createObjectURL(this.files[0])"
                                       required/><br/>

                                <button id="submit_nueva_publicidad-{{$anun->id}}" type="submit" class="btn btn-primary">Agregar
                                    Publicidad
                                </button>
                            </div>

                        </div>
                    </form>

                </div> <!-- end col mod 12 -->

            </div>
            {{--@endfor--}}
        @endforeach


    </div> <!-- end row -->

</section>

<script src="{{asset('js/juegos.js')}}"></script>