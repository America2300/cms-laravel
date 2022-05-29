<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Http\Requests\NoticiaRequest;
use App\Helpers\Funciones;

class NoticiaController extends Controller
{
    public function __construct()
    {
        /**
         * Asigno el middleware auth al controlador,
         * de modo que sea necesario estar al menos autenticado
         */
        $this->middleware('auth');
    }
    /**
     * Mostrar un listado de elementos
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Página a mostrar
        $pagina = ($request->pagina) ? $request->pagina : 1;

        //Obtengo todas las noticias ordenadas por fecha más reciente
        $rowset = Noticia::orderBy("fecha","DESC")->paginate(1,['*'],'pagina',$pagina);

        return view('admin.noticias.index',[
            'rowset' => $rowset,
        ]);
    }

    /**
     * Mostrar el formulario para crear un nuevo elemento
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        //Creo un nuevo usuario vacío
        $row = new Noticia();

        return view('admin.noticias.editar',[
            'row' => $row,
        ]);
    }

    /**
     * Guardar un nuevo elemento en la bbdd
     *
     * @param  \App\Http\Requests\NoticiaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(NoticiaRequest $request)
    {
        $row = Noticia::create([
            'titulo' => $request->titulo,
            'entradilla' => $request->entradilla,
            'slug' => Funciones::getSlug($request->titulo),
            'texto' => $request->texto,
            'fecha' => \DateTime::createFromFormat("d-m-Y", $request->fecha)->format("Y-m-d H:i:s"),
            'autor' => $request->autor,
        ]);

        //Imagen
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombre = $archivo->getClientOriginalName(); //
            $archivo->move(public_path()."/img/", $nombre);
            Noticia::where('id', $row->id)->update(['imagen' => $nombre]);
            $texto = " e imagen subida.";
        }
        else{
            $texto = ".";
        }

        return redirect('admin/noticias')->with('success', 'Noticia <strong>'.$request->titulo.'</strong> creada'.$texto);
    }

    /**
     * Mostrar el formulario para editar un elemento
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        //Obtengo la noticia o muestro error
        $row = Noticia::where('id', $id)->firstOrFail();

        return view('admin.noticias.editar',[
            'row' => $row,
        ]);
    }

    /**
     * Actualizar un elemento en la bbdd
     *
     * @param  \App\Http\Requests\NoticiaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(NoticiaRequest $request, $id)
    {
        $row = Noticia::findOrFail($id);

        Noticia::where('id', $row->id)->update([
            'titulo' => $request->titulo,
            'entradilla' => $request->entradilla,
            'slug' => Funciones::getSlug($request->titulo),
            'texto' => $request->texto,
            'fecha' => \DateTime::createFromFormat("d-m-Y", $request->fecha)->format("Y-m-d H:i:s"),
            'autor' => $request->autor,
        ]);

        //Imagen
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombre = $archivo->getClientOriginalExtension();
            $archivo->move(public_path()."/img/", $nombre);
            Noticia::where('id', $row->id)->update(['imagen' => $nombre]);
            $texto = " e imagen subida.";
        }
        else{
            $texto = ".";
        }

        return redirect('admin/noticias')->with('success', 'Noticia <strong>'.$request->titulo.'</strong> guardada'.$texto);
    }

    /**
     * Activar o desactivar elemento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activar($id)
    {
        $row = Noticia::findOrFail($id);
        $valor = ($row->activo) ? 0 : 1;
        $texto = ($row->activo) ? "desactivada" : "activada";

        Noticia::where('id', $row->id)->update(['activo' => $valor]);

        return redirect('admin/noticias')->with('success', 'Noticia <strong>'.$row->titulo.'</strong> '.$texto.'.');
    }

    /**
     * Mostrar o no elemento en la home.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function home($id)
    {
        $row = Noticia::findOrFail($id);
        $valor = ($row->home) ? 0 : 1;
        $texto = ($row->home) ? "no se muestra en la home" : "se muestra en la home";

        Noticia::where('id', $row->id)->update(['home' => $valor]);

        return redirect('admin/noticias')->with('success', 'Noticia <strong>'.$row->titulo.'</strong> '.$texto.'.');
    }

    /**
     * Borrar elemento (e imagen asociada si existe).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borrar($id)
    {
        $row = Noticia::findOrFail($id);

        Noticia::destroy($row->id);

        //Borrar imagen
        $imagen = public_path()."/img/".$row->imagen;
        if (file_exists($imagen)){
            unlink($imagen);
        }

        return redirect('admin/noticias')->with('success', 'Noticia <strong>'.$row->titulo.'</strong> borrada.');
    }



}
