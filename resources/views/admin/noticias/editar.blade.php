@extends('layouts.admin')

@section('content')

    <h3>
        <a href="{{ route("admin") }}" title="Inicio">Inicio</a> <span>| </span>
        <a href="{{ url("admin/noticias") }}" title="Noticias">Noticias</a> <span>| </span>
        @if ($row->id)
            <span>Editar {{ $row->titulo }}</span>
        @else
            <span>Nueva noticia</span>
        @endif
    </h3>
    <div class="row">
        @php $accion = ($row->id) ? "actualizar/".$row->id : "guardar" @endphp
        <form class="col s12" method="POST" enctype="multipart/form-data" action="{{ url("admin/noticias/".$accion) }}">
            @csrf
            <div class="col m12 l6">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="titulo" type="text" name="titulo" value="{{ $row->titulo }}">
                        <label for="titulo">Título</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="autor" type="text" name="autor" value="{{ $row->autor }}">
                        <label for="autor">Autor</label>
                    </div>
                    <div class="input-field col s12">
                        @php $fecha = ($row->fecha) ? date("d-m-Y", strtotime($row->fecha)) : date("d-m-Y") @endphp
                        <input id="fecha" type="text" name="fecha" class="datepicker" value="{{ $fecha }}">
                        <label for="fecha">Fecha</label>
                    </div>
                </div>
            </div>
            <div class="col m12 l6 center-align">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>Imagen</span>
                        <input type="file" name="imagen">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                @if ($row->imagen)
                    {{ Html::image('img/'.$row->imagen, $row->titulo, ['class' => 'responsive-img']) }}
                @endif
            </div>
            <div class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="entradilla" class="materialize-textarea" name="entradilla">{{ $row->entradilla }}</textarea>
                        <label for="entradilla">Entradilla</label>
                    </div>
                    <div class="input-field col s12">
                        <textarea id="texto" class="materialize-textarea" name="texto">{{ $row->texto }}</textarea>
                        <label for="texto">Texto</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <a href="{{ url("admin/noticias/") }}" title="Volver">
                        <button class="btn waves-effect waves-light" type="button">Volver
                            <i class="material-icons right">replay</i>
                        </button>
                    </a>
                    <button class="btn waves-effect waves-light" type="submit" name="guardar">Guardar
                        <i class="material-icons right">save</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
