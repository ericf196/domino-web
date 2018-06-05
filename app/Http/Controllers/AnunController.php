<?php

namespace App\Http\Controllers;

use App\League;
use App\Publicity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class AnunController extends Controller
{

    public function panel_anun()
    {
        $usuario = Auth::user();
        $league = League::where('user_id', '=', $usuario->id)->first();
        $anuns = $league->publicities()->get();
        return view("publicidad.publicidad")->with('anuns', $anuns);
    }

    public function form_nuevo_anun()
    {
        $usuario = Auth::user();
        $league = League::where('user_id', '=', $usuario->id)->first();
        $anuns = $league->publicities()->get();
        return view("publicidad.form_nuevo_anun")->with('anuns', $anuns);
    }

    public function nueva_publicidad(Request $request)
    {
        $idAnun = $request->get('id_anun');
        $archivo = $request->file('image_pub');
        $input = array('image' => $archivo);
        $reglas = array('image' => 'required|image|mimes:jpeg,jpg,bmp,png,gif');
        $validacion = Validator::make($input, $reglas);
        if ($validacion->fails()) {
            return view("mensajes.msj_rechazado")->with("msj", "El archivo no es una imagen valida");
        } else {
            try {
                DB::beginTransaction();
                $usuario = Auth::user();
                $leagueId = $usuario->league->id;

                $publicity = Publicity::find($idAnun);
                $publicity->name = $request->get('name');
                $publicity->league_id = $leagueId;
                $publicity->status = 0;
                $directory = 'league_' . $leagueId;
                $extension = $archivo->getClientOriginalExtension(); //formato (jpg,gif etc)
                $imagen_nombre = "publi_id_" . $idAnun . "." . $extension;
                Image::make($archivo)->resize(500, 500)->save('img/' . $directory . '/publicity/' . $imagen_nombre);
                $publicity->url_publicity = 'img/' . $directory . '/publicity/' . $imagen_nombre;
                $publicity->save();
                DB::commit();
                return view("mensajes.msj_correcto")->with("msj", "Noticia agregada correctamente");

            } catch (Exception $e) {
                return view("mensajes.msj_rechazado")->with("msj", "Error al agregar noticia");
            }
        }
    }

    public function form_borrado_anun($id)
    {
        $publicacion = Publicity::find($id);
        $publicacion->url_publicity='img/imgAnun.jpg';
        $publicacion->name='Publicidad';
        $publicacion->save();
        //return view("vendor.adminlte.confirmaciones.form_borrado_usuario")->with("usuario", $publicacion);
        return view("mensajes.msj_correcto")->with("msj", "Publicidad eliminada correctamente");
    }


}