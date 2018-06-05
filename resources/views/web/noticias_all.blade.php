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
                            <h4>Noticia de <span class="text-primary">{!! ucwords(strtolower($league->name_league)) !!}</span>
                            </h4>
                        </div>
                        <div class="card-block">
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    @foreach($news as $new)
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="{{ asset($new->url_image) }}" class="mt-2 img-fluid">
                                                </div>
                                                <div class="col-md-9">
                                                    <div>
                                                        <a href="/{!!strtolower($league->state)!!}/{{ $league->id }}/{{ $new->id }}"><h5 class="text-primary mt-2 mx-2 line-clamp-title">{{ $new->title }}</h5></a>
                                                    </div>
                                                    <div class="height-1">
                                                        <p class="mx-2 line-clamp-content">{{ $new->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- row -->
        </div><!-- container-fluid -->
    </section><!-- fin subContent -->

@endsection