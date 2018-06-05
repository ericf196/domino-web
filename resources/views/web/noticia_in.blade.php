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
                                    <h2 class="my-5">{{ $new->title }}</h2>
                                    <div class="my-5">
                                        <img src="{{asset($new->url_image)}}" class="img-fluid"/>
                                    </div>
                                    <p class="text-primary">{!! ($new->updated_at)->format('m/d/Y H:i') !!}</p>
                                    <p class="my-5 text-justify">{!! nl2br($new->description) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- row -->
        </div><!-- container-fluid -->
    </section><!-- fin subContent -->

@endsection