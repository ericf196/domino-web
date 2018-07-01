<?php

namespace App\Http\Controllers;

use App\League;
use App\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class LeagueController extends Controller
{

    public function cambiar_informacion_league(Request $request)
    {
        $idleague = $request->input("id_league");
        $league = League::find($idleague);

        $reglas = ['email_league' => 'required|email|unique:leagues,email,' . $idleague];

        $mensajes = ['email.unique' => 'El email ya se encuentra registrado en la base de datos',];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if ($validator->fails()) {
            return view("mensajes.msj_rechazado")->with("msj", "...Existen errores...")
                ->withErrors($validator->errors());
        }

        DB::beginTransaction();

        $league->name_league = strtoupper($request->input("name_league"));
        $league->description = strtoupper($request->input("description_league"));
        $league->state = strtoupper($request->input("state_league"));
        $league->city = strtoupper($request->input("city_league"));
        $league->address = strtoupper($request->input("address_league"));
        $league->name_admin = strtoupper($request->input("name_admin"));
        $league->email = $request->input("email_league");
        $league->phone = $request->input("phone_league");
        $save=$league->save();

        DB::commit();

        if ($save) {
            return view("mensajes.msj_correcto")->with("msj", "Liga actualizado correctamente");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Hubo un error al actualizar");
        }
    }

    public function subir_logo_league(Request $request)
    {
        $idleague = $request->input("id_league");
        $league = League::find($idleague);

        $reglas = ['archivo_logo' => 'required|image|mimes:jpeg,jpg,bmp,png,gif|max:900'];

        $mensajes = ['archivo_logo.mimes' => 'Este tipo de imagenes no se permite',];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if ($validator->fails()) {
            return view("mensajes.msj_rechazado")->with("msj", "...Existen errores...")
                ->withErrors($validator->errors());
        }

        DB::beginTransaction();
        $archivo = $request->file('archivo_logo');

        $extension = $archivo->getClientOriginalExtension(); //formato (jpg,gif etc)
        $imagen_nombre = "logo_id_" . $idleague . "." . $extension;
        Image::make($archivo)->resize(600, 600)->save('img/league_' . $idleague . '/logo/' . $imagen_nombre);

        $league=League::find($idleague);
        $league->url_logo = 'img/league_' . $idleague . '/logo/' . $imagen_nombre;
        $save=$league->save();
        DB::commit();

        if ($save) {
            return view("mensajes.msj_correcto")->with("msj", "El logo actualizado correctamente");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Hubo un error al actualizar");
        }
    }


    public function subir_portada_league(Request $request)
    {
        $idleague = $request->input("id_league");

        $reglas = ['archivo_portada' => 'required|image|mimes:jpeg,jpg,bmp,png,gif|max:900'];

        $mensajes = ['archivo_portada.mimes' => 'Este tipo de imagenes no se permite',];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if ($validator->fails()) {
            return view("mensajes.msj_rechazado")->with("msj", "...Existen errores...")
                ->withErrors($validator->errors());
        }

        DB::beginTransaction();
        $archivo = $request->file('archivo_portada');

        $extension = $archivo->getClientOriginalExtension(); //formato (jpg,gif etc)
        $imagen_nombre = "portada_id_" . $idleague . "." . $extension;
        Image::make($archivo)->resize(900, 400)->save('img/league_' . $idleague . '/logo/' . $imagen_nombre);

        $league=League::find($idleague);
        $league->url_portada = 'img/league_' . $idleague . '/logo/' . $imagen_nombre;
        $save=$league->save();
        DB::commit();

        if ($save) {
            return view("mensajes.msj_correcto")->with("msj", "La portada fue actualizada correctamente");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Hubo un error al actualizar");
        }
    }

    

    public function sent_table(Request $request)
    {

        DB::beginTransaction();
        $userId=Auth::user()->id;
        $league=League::where('user_id','=', $userId)->first()->id;

//        $league->categories()->attach(1); // Esta vaina tira peos
        DB::table('category_league')->insert(
            ['category_id' => '1', 'league_id' => $league]
        );

        $rowTable = $request->json()->all();
        foreach ($rowTable as $row) {
            User::find($row['IDJUGADOR'])->categories_individual()->attach(array(1 => array('jj' => $row['J/J'], 'jg' => $row['J/G'], 'jp' => $row['J/P'], 'pts_p' => $row['PTOS P'], 'pts_n' => $row['PTOS N'], 'pts_n_p' => 0, 'pts_p_p' => 0, 'avg' => $row['AVG'], 'efec' => $row['EFEC'], 'pro' => $row['PRO'], 'z' => $row['Z'], 'pro_g' => $row['PRO2'], 'season' => Carbon::now()->year)));

            $t = User::find($row['IDJUGADOR'])->categories()->withPivot('jj', 'jg', 'jp', 'pts_p', 'pts_n', 'avg', 'efec', 'pro', 'pro_g', 'z')->wherePivot('category_id', 1)->wherePivot('season', '=', Carbon::now()->year)->first();

            if ($t) {
                $jj = $t->pivot->jj;
                $jg = $t->pivot->jg;
                $jp = $t->pivot->jp;
                $pts_p = $t->pivot->pts_p;
                $pts_n = $t->pivot->pts_n;
                $avg = $t->pivot->avg;
                $efec = $t->pivot->efec;
                $pro = $t->pivot->pro;
                $pro_g = $t->pivot->pro_g;
                $z = $t->pivot->z;

                $jjAcum = $jj + $row['J/J']; //Juegos Jugados
                $jgAcum = $jg + $row['J/G']; //Juegos Ganados
                $jpAcum = $jp + $row['J/P']; //Juegos Perdidos
                $ppAcum = $jp + $row['J/P']; //Juegos Positivos
                $pnAcum = $jp + $row['J/P']; //Juegos negativos
                $zAcum = $z + $row['Z'];     //Zapato
                $proAcum = $ppAcum / $jjAcum;     //Promedio(pro)
                $avgAcum = $ppAcum - $pnAcum;  //average (avg)

                //efec
                $efecAcum = ($jgAcum * 1000) / $jjAcum;
                //pro g
                $pro_gAcum = 1 + ($jgAcum * 2) + (($jjAcum - $jgAcum) * (-1)) + ($zAcum * 1) + 6;
                
                User::find($row['IDJUGADOR'])->categories()->wherePivot('season', '=', Carbon::now()->year)->updateExistingPivot
                (1, array('jj' => $jjAcum, 'jg' => $jgAcum, 'jp' => $jpAcum, 'pts_p' => $ppAcum,
                    'pts_n' => $pnAcum, 'avg' => $avgAcum, 'efec' => $efecAcum, 'pro' => $proAcum,
                    'z' => $zAcum, 'pro_g' => $pro_gAcum));
            } else {
                User::find($row['IDJUGADOR'])->categories()->attach(array(1 => array('jj' => $row['J/J'], 'jg' => $row['J/G'], 'jp' => $row['J/P'],
                    'pts_p' => $row['PTOS P'], 'pts_n' => $row['PTOS N'], 'pts_n_p' => 0, 'pts_p_p' => 0, 'avg' => $row['AVG'], 'efec' => $row['EFEC']
                , 'pro' => $row['PRO'], 'z' => $row['Z'], 'pro_g' => $row['PRO2'], 'season' => Carbon::now()->year)));
                
            }
        }


        DB::commit();
        return response()->json(['data' => 'listo']);
        //return response()->json(['data' => 'Se Agrego con exito']);

        //$user->categories_individual()->sync(array(4 => array('expires' => true)));
        //gettype($postbody);
    }

}
