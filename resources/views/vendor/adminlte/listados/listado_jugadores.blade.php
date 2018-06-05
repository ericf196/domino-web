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
                <form action="{{ url('buscar_jugador') }}" method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="dato_buscado" name="dato_buscado" required>
                        <span class="input-group-btn">
					<input type="submit" class="btn btn-primary" value="buscar">
					</span>

                    </div>

                </form>

                <div class="margin" id="botones_control">
                    <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(1);">Agregar Jugador</a>
                    <a href="{{ url("/listado_jugadores") }}" class="btn btn-xs btn-primary">Listado Jugadores</a>
                </div>

            </div>

            <div class="box-body box-white">

                <div class="table-responsive">

                    <table class="table table-hover table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>codigo</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($players as $player)
                            <tr role="row" class="odd">
                                <td>{{ $player->id }}</td>
                                <td class="mailbox-messages mailbox-name">
                                    <div class="enlaceJs" onclick="verinfo_usuario({{  $player->id }})"
                                         style="display:block"><i
                                                class="fa fa-user"></i>&nbsp;&nbsp;{{ $player->name  }}</div>
                                </td>
                                <td>{{ $player->email }}</td>
                                <td>

                                    <button type="button" class="btn  btn-default btn-xs"
                                            onclick="verinfo_usuario({{  $player->id }})"><i
                                                class="fa fa-fw fa-edit"></i></button>
                                    <button type="button" class="btn  btn-danger btn-xs"
                                            onclick="borrado_usuario({{  $player->id }});"><i
                                                class="fa fa-fw fa-remove"></i></button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
            <br>

            @endrole



            <!-- busqueda liga sin resultados -->
            {{ $players->links() }}

            @if(count($players)==0)
                <div class="box box-primary">
                    <div class='aprobado' style="margin-top:70px; text-align: center">
                        <label style='color:#177F6B'>
                            ... no se encontraron resultados para su busqueda...
                        </label>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection