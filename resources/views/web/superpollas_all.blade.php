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
                                <div class="col-md-11">
                                    <p>Todas las Superpolla de <span class="text-primary">{!! ucwords(strtolower($league->name_league)) !!}</span></p>
                         
                        
                    
                        
                               
                            <div id="contenidoFront">
                                <div class="row text-center d-flex justify-content-center flex-wrap">
                                    @foreach($data as $key=>$super)
                                        <div class="col-md-3">
                                            <?php $keyFecha0 = base64_encode($key); ?>
                                            <a href="/{!!strtolower($league->state)!!}/{{ $league->id }}/jugadores/{!! $keyFecha0 !!}">
                                                <div class="cuadro1">
                                                    <img src="{{ asset('img/game-img.jpg') }}">
                                                    <h5>{{$key}}</h5>
                                                </div>
                                            </a>
                                        </div> 
                                    @endforeach
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