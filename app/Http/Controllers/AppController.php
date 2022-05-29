<?php

namespace App\Http\Controllers;
use App\Models\Noticia;

class AppController extends Controller
{
    public function index()
    {
        //Obtengo las noticias a mostrar en la home
        $rowset = Noticia::where('activo', 1)->where('home', 1)->orderBy('fecha', 'DESC')->get();

        return view('app.index',[
            'rowset' => $rowset,
        ]);
    }

    public function noticias()
    {
        //Obtengo las noticias a mostrar en el listado de noticias
        $rowset = Noticia::where('activo', 1)->orderBy('fecha', 'DESC')->get();

        return view('app.noticias',[
            'rowset' => $rowset,
        ]);
    }

    public function noticia($slug)
    {
        //Obtengo la noticia o muestro error
        $row = Noticia::where('activo', 1)->where('slug', $slug)->firstOrFail();

        return view('app.noticia',[
            'row' => $row,
        ]);
    }

    public function acercade()
    {
        return view('app.acerca-de');
    }

    public function mostrar(){

        //Obtengo las noticias a mostrar en el listado de noticias
        $rowset = Noticia::where('activo', 1)->orderBy('fecha', 'DESC')->get();

        //Opción rápida (datos completos)
        //$noticias = $rowset;

        //Opción personalizada
        foreach ($rowset as $row){
            $noticias[] = [
                'titulo' => $row->titulo,
                'entradilla' => $row->entradilla,
                'autor' => $row->autor,
                'fecha' => date("d/m/Y", strtotime($row->fecha)),
                'enlace' => url("noticia/".$row->slug),
                'imagen' => asset("img/".$row->imagen)
            ];
        }

       //Devuelvo JSON
        return response()->json(
            $noticias, //Array de objetos
            200, //Tipo de respuesta 200=OK
            [], //Headers
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE //Opciones de escape
        );

    }

    public function leer(){

        //Url de destino
        $url = route('mostrar');

        //Parseo datos a un array
        $rowset = json_decode(file_get_contents($url), true);

        //LLamo a la vista , la creo , no tiene que ver con laravel
        return view('api.leer',[
            'rowset' => $rowset,
        ]);

    }
}
