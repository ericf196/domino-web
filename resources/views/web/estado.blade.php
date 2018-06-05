@extends('layouts.home')
@section('content')

    @include('web.sections.top')

    <section id="subContent">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>Venezuela / {!! ucwords(strtolower($estado)) !!} </h4>
                        </div>
                        <div class="card-block">
                            <ul class="nomLigaUl">
                                @foreach($leagues as $league)
                                    <li class="nomLiga">
                                        <a href="{{ url($estado.'/'. $league->id) }}">
                                            <img class="imgCircle" src="{{ asset($league->url_logo) }}">
                                            <h4>{!! ucwords(strtolower($league->name_league)) !!}</h4>
                                            <span>{!! ucwords(strtolower($league->city)) !!}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h2 class="h5 display display"></h2>
                        </div>
                        <div class="card-block">
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection