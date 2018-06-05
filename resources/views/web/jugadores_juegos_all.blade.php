@extends('layouts.home')
@section('content')

    @include('web.sections.top')

    <section id="subContent">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-3">
                    @include('web.sections.sidebar')
                </div>

                <div class="col-md-9">

                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>Liga <span class="text-primary">{!! ucwords(strtolower($league->name_league)) !!}</span>
                            </h4>
                        </div>
                        <div class="card-block">
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <p>Superpolla del día <span class="text-primary">{{ $fecha }}</span></p>
                                    <p> {{-- $dates->games_individual->created_at --}} </p>

                        
                    <?php $numCo3 = 1  ?>
                    
                        <div class="card-">
                            <div>
                                <ul class="fichaConten">
                                    @foreach($data as $key=>$super)
                                        <li class="nomJugador">
                                            <a data-toggle="collapse" href="#coll-{{$numCo3}}" aria-expanded="false"
                                               aria-controls="coll-{{$numCo3}}">
                                                <img class="imgCircle" src="{{ asset($super->url_image) }}">
                                                <h5>{{ $super->name }}</h5>
                                                <span>PTS {{$super->pivot->pro_g}}</span>
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
                                                            <td>{{$super->pivot->jj}}</td>
                                                            <td>{{$super->pivot->jg}}</td>
                                                            <td>{{$super->pivot->jp}}</td>
                                                            <td>{{$super->pivot->pts_p}}</td>
                                                            <td>{{$super->pivot->pts_n}}</td>
                                                            <td>{{$super->pivot->avg}}</td>
                                                            <td>{{$super->pivot->efec}}</td>
                                                            <td>{{$super->pivot->pro}}</td>
                                                            <td>{{$super->pivot->z}}</td>
                                                            <td>{{$super->pivot->pro_g}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $numCo3++ ?>

                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        
                  



                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- row -->
        </div><!-- container-fluid -->
    </section><!-- fin subContent -->

@endsection