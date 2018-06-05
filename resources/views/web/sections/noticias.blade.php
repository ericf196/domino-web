<div id="noticiasFront">
    <h3 class="title-front text-center">Noticias y eventos recientes</h3>
    <div class="divider"></div>
    <div class="container-fluid">
        <div class="row">
            @foreach($news as $new)
                <div class="col-sm-6 col-md-4">
                    <div class="box">
                        <img src="{!!  asset(str_replace('noticia_id_','noticia_id_p_', $new->url_image))  !!}"
                             class="img-fluid">
                        <div class="height-1">
                            <a href="/{!!strtolower($league->state)!!}/{{ $league->id }}/{{ $new->id }}"><h5 class="text-primary mt-4 mx-2 line-clamp-title">{{ $new->title }}</h5></a>
                        </div>
                        <div class="height-1">
                            <p class="mx-2 line-clamp-content">{{ $new->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-right">
            <a class="btn btn-secondary" href="/{!!strtolower($league->state)!!}/{{ $league->id }}/noticias/{{ $league->id }}"> Ver Todas </a>
        </div>
    </div>
</div><!-- fin noticiasFront -->