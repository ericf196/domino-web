<?php

namespace App\Http\Controllers;

use App\News;
use App\League;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function panel_noticias()
    {
        $usuario = Auth::user();
        $league = League::where('user_id', '=', $usuario->id)->first();

        $noticias = News::where('league_id', '=', $league->id)->get();
        return view("adminlte::contenido.news")->with("noticias", $noticias);
    }

    public function form_nuevo_noticia()
    {
        return view("adminlte::formularios.form_nuevo_noticia");
    }

    public function form_editar_noticia($id)
    {
        $noticia = News::find($id);
        return view("adminlte::formularios.form_editar_noticia")->with('noticia', $noticia);
    }


    public function nuevo_noticia(Request $request)
    {
        $archivo = $request->file('image_news');

        $input = array('image' => $archivo);
        $reglas = array('image' => 'required|image|mimes:jpeg,jpg,bmp,png,gif|max:900');
        $validacion = Validator::make($input, $reglas);
        if ($validacion->fails()) {
            return view("mensajes.msj_rechazado")->with("msj", "El archivo no es una imagen valida");
        } else {
            try {
                DB::beginTransaction();
                $usuario = Auth::user();
                $leagueId = $usuario->league->id;

                $noticia = new News;
                $noticia->title = $request->get('title');
                $noticia->description = $request->get('description');
                $noticia->league_id = $leagueId;
                $noticia->save();

                $maxId = DB::table('news')->max('id');

                $directory = 'league_' . $leagueId;
                $extension = $archivo->getClientOriginalExtension(); //formato (jpg,gif etc)

                $imagen_nombre = "noticia_id_" . $maxId . "." . $extension;
                $imagen_nombre_p = "noticia_id_p_" . $maxId . "." . $extension;
                Image::make($archivo)->resize(640, 360)->save('img/' . $directory . '/news/' . $imagen_nombre);
                Image::make($archivo)->resize(460, 314)->save('img/' . $directory . '/news/' . $imagen_nombre_p);
                $noticia = News::find($maxId);
                $url_noticia = $noticia->url_image = 'img/' . $directory . '/news/' . $imagen_nombre;
                $noticia->save();
                DB::commit();
                return view("mensajes.msj_correcto")->with("msj", "Noticia agregada correctamente");

            } catch (Exception $e) {
                return view("mensajes.msj_rechazado")->with("msj", "Error al agregar noticia");
            }
        }
    }


    public function editar_noticia(Request $request)
    {
        $Idnoticia = $request->get('id_noticia');
        $noticia = News::find($Idnoticia);
        DB::beginTransaction();
        if ($request->file('image_news')) {
            $archivo = $request->file('image_news');
            $input = array('image' => $archivo);
            $reglas = array('image' => 'required|image|mimes:jpeg,jpg,bmp,png,gif|max:900');
            $validacion = Validator::make($input, $reglas);

            if ($validacion->fails()) {
                return view("mensajes.msj_rechazado")->with("msj", "El archivo no es una imagen valida");
            }
            $usuario = Auth::user();
            $leagueId = $usuario->league->id;

            $directory = 'league_' . $leagueId;
            $extension = $archivo->getClientOriginalExtension();

            $imagen_nombre = "noticia_id_" . $Idnoticia . "." . $extension;
            $imagen_nombre_p = "noticia_id_p_" . $Idnoticia . "." . $extension;
            Image::make($archivo)->resize(640, 360)->save('img/' . $directory . '/news/' . $imagen_nombre);
            Image::make($archivo)->resize(460, 314)->save('img/' . $directory . '/news/' . $imagen_nombre_p);
            $noticia->url_image = 'img/' . $directory . '/news/' . $imagen_nombre;
        }
        try {
            $noticia->title = $request->get('title');
            $noticia->description = $request->get('description');

            $noticia->save();
            DB::commit();
            return view("mensajes.msj_correcto")->with("msj", "Noticia actualizada correctamente");

        } catch (Exception $e) {
            return view("mensajes.msj_rechazado")->with("msj", "Error al agregar noticia");
        }

        return "probando";
    }
}
