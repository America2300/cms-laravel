@extends('layouts.app')

@section('content')

    <h3>
        <a href="{{ route('home') }}" title="Inicio">Inicio</a> <span>| </span>
        <a href="{{ route('noticias') }}" title="Noticias">Noticias</a> <span>| </span>
        <span>{{ $row->titulo }}</span>
    </h3>
    <div class="row">

        <article class="col s12">
            <div class="card horizontal large noticia">
                <div class="card-image">
                    {{ Html::image('img/'.$row->imagen, $row->titulo) }}
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <h4>{{ $row->titulo  }}</h4>
                        <p>{{ $row->entradilla  }}</p>
                        <p>{!! $row->texto !!}</p>
                        <br>
                        <p>
                            <strong>Fecha</strong>: {{ date("d/m/Y", strtotime($row->fecha)) }}<br>
                            <strong>Autor</strong>: {{ $row->autor  }}
                        </p>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endsection
