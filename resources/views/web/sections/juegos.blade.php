<div id="contenidoFront"><!-- contenidoFront -->
    <h3 class="title-front text-center">Juegos</h3>
    <div class="divider"></div>
    <div class="pestanas">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#superpolla" role="tab">Super Polla</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" data-toggle="tab" href="#grandSlam" role="tab">Grand Slam</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" data-toggle="tab" href="#batallas" role="tab">Batalla de Escuderías</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" data-toggle="tab" href="#masterSerie" role="tab">Master series del
                    domino</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="superpolla" role="tabpanel">
                <h5 class="title-front text-center">Últimas partidas</h5>
                <div class="divider"></div>

                @if (count($rankingsS) != 0)
                    <div id="accordion" role="tablist" aria-multiselectable="true"><!-- inicio accordion -->
                        <?php $numCo2 = 1  ?>
                        <div class="row">
                            @foreach($rankingsS as $key=>$super)
                                <div class="col">
                                    <a data-toggle="collapse" class="show-hide" href="#collapse-{{ $numCo2 }}"
                                       aria-expanded="false" aria-controls="collapse-20">
                                        <div class="cuadro1">
                                            <img src="{{ asset('img/game-img.jpg') }}">
                                            <h5>{{$key}}</h5>
                                        </div>
                                    </a>
                                </div>
                                <?php $numCo2++ ?>
                            @endforeach
                        </div>

                        <?php $numCo1 = 1  ?>
                        <?php $numCo3 = 1  ?>
                        @foreach($rankingsS as $key=>$super)
                            <div class="card-">
                                <div class="collapse" id="collapse-{{ $numCo1 }}">
                                    <ul class="fichaConten">

                                        @foreach ($super as $k => $value)
                                            {{-- ' => ' .$k . ' => ' . $value->name --}}
                                            <li class="nomJugador">
                                                <a data-toggle="collapse" href="#coll-{{$numCo3}}" aria-expanded="false"
                                                   aria-controls="coll-{{$numCo3}}">
                                                    <img class="imgCircle" src="{{ asset($value->url_image) }}">
                                                    <h5>{{ $value->name }}</h5>
                                                    <span>PTS {{$value->pivot->pro_g}}</span>
                                                </a>
                                            </li>
                                            <div class="collapse" id="coll-{{$numCo3}}">
                                                <div class="fichaConten">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>Categoría</th>
                                                                <th>J/J</th>
                                                                <th>J/G</th>
                                                                <th>J/P</th>
                                                                <th>PTS +</th>
                                                                <th>PTS -</th>
                                                                <th>AVE</th>
                                                                <th>EFEC</th>
                                                                <th>PRO</th>
                                                                <th>ZA</th>
                                                                <th>PTS</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row">Superpolla</th>
                                                                <td>{{$value->pivot->jj}}</td>
                                                                <td>{{$value->pivot->jg}}</td>
                                                                <td>{{$value->pivot->jp}}</td>
                                                                <td>{{$value->pivot->pts_p}}</td>
                                                                <td>{{$value->pivot->pts_n}}</td>
                                                                <td>{{$value->pivot->avg}}</td>
                                                                <td>{{$value->pivot->efec}}</td>
                                                                <td>{{$value->pivot->pro}}</td>
                                                                <td>{{$value->pivot->z}}</td>
                                                                <td>{{$value->pivot->pro_g}}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $numCo3++ ?>
                                        @endforeach
                                        <?php
                                        //$l=["/", " ",":"]; $l2=str_replace($l, "", $key);
                                        $keyFecha0 = base64_encode($key);
                                        ?>
                                        <div class="text-right">
                                            <a class="btn btn-sm btn-primary"
                                               href="/{!!strtolower($league->state)!!}/{{ $league->id }}/jugadores/{!! $keyFecha0 !!}">
                                                Ver todos los jugadores </a>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            <?php $numCo1++ ?>

                        @endforeach

                        {{-- @if ($key == '')
                             {{'hola'}}
                         @endif --}}
                        <div class="text-right">
                            <a class="btn btn-primary"
                               href="/{!!strtolower($league->state)!!}/{{ $league->id }}/superpollas/{{ $league->id }}">
                                Ver Todas las Superollas </a>
                        </div>


                    </div><!-- fin accordion -->

                @else
                    <div class="m-5 text-center">

                        <p style="font-size: 1.5rem">No hay partidas disputadas en esta liga</p>

                    </div>
                @endif
            <!-- segunda info -->
                <div class="space1">
                    <h5 class="title-front text-center">Ranking Super Polla individual</h5>
                    <div class="divider"></div>
                </div>


                @if (count($rankings) != 0)

                        <div class="row text-center d-flex justify-content-center flex-wrap">
                            @foreach($rankings as $key=>$ranking)

                                <div style="width: 20%">
                                    <a class="show-hide" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapse-{{ $ranking->id }}" aria-expanded="false"
                                       aria-controls="collapse-3">
                                        <img class="jugadorInd" src="{{ asset($ranking->url_image) }}">
                                        <div class="">
                                            <h6 class="text-primary title-h text-truncate2">({{ $ranking->id }}) {{ $ranking->nombres }}</h6>
                                            <span class="span-text text-truncate2">{!! ucwords(strtolower( $ranking->apellidos ))  !!}</span>
                                        </div>
                                    </a>
                                </div>

                            @endforeach
                        </div>
                    @foreach($rankings as $key=>$ranking)
                        <div class="collapse" id="collapse-{{ $ranking->id }}">
                            <div class="fichaConten">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Categoría</th>
                                            <th>J/J</th>
                                            <th>J/G</th>
                                            <th>J/P</th>
                                            <th>PTS +</th>
                                            <th>PTS -</th>
                                            <th>AVE</th>
                                            <th>EFEC</th>
                                            <th>PRO</th>
                                            <th>ZA</th>
                                            <th>PTS</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">Superpolla</th>
                                            <td>{{number_format($ranking->pivot->jj)}}</td>
                                            <td>{{number_format($ranking->pivot->jg)}}</td>
                                            <td>{{number_format($ranking->pivot->jp)}}</td>
                                            <td>{{number_format($ranking->pivot->pts_p)}}</td>
                                            <td>{{number_format($ranking->pivot->pts_n)}}</td>
                                            <td>{{number_format($ranking->pivot->avg)}}</td>
                                            <td>{{number_format($ranking->pivot->efec)}}</td>
                                            <td>{{number_format($ranking->pivot->pro)}}</td>
                                            <td>{{number_format($ranking->pivot->z)}}</td>
                                            <td>{{number_format($ranking->pivot->pro_g)}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="text-right">
                        <a class="btn btn-primary" href="#"> Ver Todos </a>
                    </div>


                @else
                    <div class="m-5 text-center">
                        <p style="font-size: 1.5rem">No hay Ranking Super Polla individual en esta liga</p>
                    </div>
                @endif

            </div>


            <div class="tab-pane" id="grandSlam" role="tabpanel">
                <h5 class="title-front text-center">Torneos individuales</h5>
                <div class="divider"></div>
                <div class="row text-center">
                    <div class="col">
                        <div class="cuadro2">
                            <!--<img src="img/logo-el-tigre.jpg"> -->
                        </div>
                        <h6>1er GRAND SLAM 2017 COPA TIGRE DE CARAYACA</h6>
                    </div>
                    <div class="col">
                        <div class="cuadro2">
                            <!--<img src="img/logo-luso.png"> -->
                        </div>
                        <h6>2do GRAND SLAM 2017 COPA CENTRO LUSO LARENSE</h6>
                    </div>
                    <div class="col">
                        <div class="cuadro2">
                            <!--<img src="img/logo-copa-lara.jpg"> -->
                        </div>
                        <h6>3er GRAND SLAM 2017 COPA ESTADO LARA</h6>
                    </div>
                    <div class="col">
                        <div class="cuadro2">
                            <!--<img src="img/logo-pena.jpg"> -->
                        </div>
                        <h6>4to GRAND SLAM 2017 COPA LA PEÑA DEL DOMINO</h6>
                    </div>
                </div>
                <p align="justify"><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi a urna enim. Mauris sodales velit sit
                    amet eros posuere fermentum. Morbi ut dui suscipit, semper libero nec, luctus orci. Nam tristique
                    est ac lobortis ornare. In sagittis posuere luctus. In egestas tempor mauris. Sed a erat in lorem
                    fermentum rhoncus. Vestibulum rhoncus massa in faucibus rhoncus. Cras eu libero sollicitudin libero
                    euismod mollis eu et elit. Suspendisse potenti. Aliquam erat volutpat.</p>
            </div>
            <div class="tab-pane" id="batallas" role="tabpanel">
                <h5 class="title-front text-center">Batalla de escuderías</h5>
                <div class="divider"></div>
                <p align="justify">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi a urna enim. Mauris sodales velit sit
                    amet eros posuere fermentum. Morbi ut dui suscipit, semper libero nec, luctus orci. Nam tristique
                    est ac lobortis ornare. In sagittis posuere luctus. In egestas tempor mauris. Sed a erat in lorem
                    fermentum rhoncus. Vestibulum rhoncus massa in faucibus rhoncus. Cras eu libero sollicitudin libero
                    euismod mollis eu et elit. Suspendisse potenti. Aliquam erat volutpat.
                </p>
                <div class="table-responsive">
                    <table class="table table-striped">

                        <tr>
                            <th></th>
                            <th>J/J</th>
                            <th>J/G</th>
                            <th>J/P</th>
                            <th>PTS +</th>
                            <th>PTS -</th>
                            <th>PTS+%</th>
                            <th>PTS-%</th>
                            <th>PROM</th>
                            <th>EFEC</th>
                            <th>CH</th>
                            <th>ZA</th>
                            <th>PTS</th>
                        </tr>

                        <tr>
                            <!--<td><img class="escuderiaLogo" src="img/logo-pena.jpg"></td> -->
                            <td>123</td>
                            <td>321</td>
                            <td>25</td>
                            <td>12345</td>
                            <td>12345</td>
                            <td>45,5</td>
                            <td>2525</td>
                            <td>45,5</td>
                            <td>25</td>
                            <td>15</td>
                            <td>25</td>
                            <td>45,5</td>
                        </tr>

                        <tr>
                            <!--<td><img class="escuderiaLogo" src="img/logo-luso.png"></td> -->
                            <td>123</td>
                            <td>321</td>
                            <td>25</td>
                            <td>12345</td>
                            <td>12345</td>
                            <td>45,5</td>
                            <td>2525</td>
                            <td>45,5</td>
                            <td>25</td>
                            <td>15</td>
                            <td>25</td>
                            <td>45,5</td>
                        </tr>

                        <tr>
                            <!--<td><img class="escuderiaLogo" src="img/logo-el-tigre.jpg"></td> -->
                            <td>123</td>
                            <td>321</td>
                            <td>25</td>
                            <td>12345</td>
                            <td>12345</td>
                            <td>45,5</td>
                            <td>2525</td>
                            <td>45,5</td>
                            <td>25</td>
                            <td>15</td>
                            <td>25</td>
                            <td>45,5</td>
                        </tr>

                    </table>
                </div>


            </div>
            <div class="tab-pane" id="masterSerie" role="tabpanel">
                <h5 class="title-front text-center">Master series del domino</h5>
                <div class="divider"></div>
                <p align="justify">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi a urna enim. Mauris sodales velit sit
                    amet eros posuere fermentum. Morbi ut dui suscipit, semper libero nec, luctus orci. Nam tristique
                    est ac lobortis ornare. In sagittis posuere luctus. In egestas tempor mauris. Sed a erat in lorem
                    fermentum rhoncus. Vestibulum rhoncus massa in faucibus rhoncus. Cras eu libero sollicitudin libero
                    euismod mollis eu et elit. Suspendisse potenti. Aliquam erat volutpat.
                </p>
            </div>

        </div>

    </div>


</div><!-- fin contenidoFront -->