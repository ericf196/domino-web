<?php

namespace App\Http\Controllers;

use App\League;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function super_polla()
    {
        return view("adminlte::contenido.super_polla");
    }

    public function tabla_super_polla(Request $request)
    {
        $juegos = $request->get('cant_juegos');
        $idUserAdmin = Auth::user()->id;
        $leagueId = League::where('user_id', $idUserAdmin)->first()->id;

        $jugadores = User::where('league_id', '=', $leagueId)->get();
        return view("juegos.super_polla_tabla")->with(array('juegos'=> $juegos,'jugadores'=> $jugadores ));
    }


    public function sent_table(Request $request)
    {
        $response = $request->all();
        /*return $request->all();*/
        return $request->get('CnombreJG[0]');

    }

}
