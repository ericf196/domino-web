@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Home
@endsection


@section('main-content')

    <section id="contenido_principal">

        <div class="box box-primary box-gris">

            @role('admin_liga')
            <div class="box-header">
                <h4 class="box-title">Usuarios</h4>
                <form action="{{ url('buscar_usuario') }}" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="dato_buscado" name="dato_buscado" required>
                        <span class="input-group-btn">
					<input type="submit" class="btn btn-primary" value="buscar">
					</span>
                    </div>

                </form>
                <div class="margin" id="botones_control">
                    <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(6);">Agregar
                        Noticias</a>
                    <a href="{{ url("/panel_noticias") }}" class="btn btn-xs btn-primary">Listado de Noticias</a>
                </div>

            </div>
            <br>
            @endrole

                    <!-- busqueda liga sin resultados -->
            {{--{{ $players->links() }}

            @if(count($players)==0)
                <div class="box box-primary col-xs-12">
                    <div class='aprobado' style="margin-top:70px; text-align: center">
                        <label style='color:#177F6B'>
                            ... no se encontraron resultados para su busqueda...
                        </label>
                    </div>
                </div>
            @endif--}}

        </div>


        <div class="box-body box-white">

            <div class="table-responsive">

                <table class="table table-hover table-striped" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($noticias as $noticia)
                        <tr role="row" class="odd">
                            <td>{{ $noticia->id }}</td>
                            {{--<td class="mailbox-messages mailbox-name">
                                <div class="enlaceJs" onclick="verinfo_usuario({{  $noticia->id }})"
                                     style="display:block"><i
                                            class="fa fa-user"></i>&nbsp;&nbsp;{{ $noticia->name  }}</div>
                            </td>--}}
                            <td><div class="width-6 text-truncate">{{ $noticia->title }}</div></td>
                            <td><div class="width-6 text-truncate">{{ $noticia->description }}</div></td>
                            <td>

                                <button type="button" class="btn  btn-default btn-xs"
                                        onclick="verinfo_noticia({{  $noticia->id }})" ><i
                                            class="fa fa-fw fa-edit"></i></button>
                                <button type="button" class="btn  btn-danger btn-xs"
                                        onclick="borrado_usuario({{  $noticia->id }});" disabled><i
                                            class="fa fa-fw fa-remove"></i></button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    </section>
@endsection