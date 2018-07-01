<?php

namespace App\Http\Controllers;

use App\Category;
use App\League;
use App\News;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function estado($estado)
    {
        $leagues = League::where('state', '=', strtoupper($estado))->get();
        if (!count($leagues)) {
            return view("adminlte::errors.404");
        }
        return view('web.estado')->with(array('leagues' => $leagues, 'estado' => $estado));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liga($estado, $idLiga)
    {
        $league = League::where('id', '=', $idLiga)->first();
        $news = $league->news()->orderBy('id', 'desc')->take(3)->get();
        $rankingFive = Category::find(1)->users()->where('league_id', $idLiga)->orderBy('games.pro_g', 'desc')->take(5)->get(); //Cinco mejores de la super polla de esa liga

        $rankingSupP = $this->ranking_super_polla($idLiga);
        //dd($rankingSupP);
        //dd($rankingSupP['super_polla_1'][0]->id);
        $anuns = $league->publicities()->get();
        if (!count($league)) {
            return view("adminlte::errors.404");
        }
        return view('web.liga')->with(array('league' => $league, 'news' => $news, 'rankings' => $rankingFive, 'rankingsS' => $rankingSupP, 'anuns' => $anuns));

    }

    public function detalle_n($estado, $idLiga, $idNoticia)
    {
        $league = League::where('id', '=', $idLiga)->first();
        $new = News::where('id', '=', $idNoticia)->first();
        $anuns = $league->publicities()->get();
        return view('web.noticia_in')->with(array('league' => $league, 'new' => $new, 'anuns' => $anuns));

    }

    public function noticias_all($estado, $idLiga, $idNoticias)
    {
        $league = League::where('id', '=', $idLiga)->first();
        $idLeague = League::where('id', '=', $idNoticias)->first();
        $news = $idLeague->news()->orderBy('id', 'desc')->get();
        $anuns = $league->publicities()->get();
        if (!count($idLeague)) {
            return view("adminlte::errors.404");
        }
        return view('web.noticias_all')->with(array('league' => $league, 'news' => $news, 'anuns' => $anuns));
    }
    

    public function jugadores_all($estado, $idLiga, $fecha)
    {

        $league = League::where('id', '=', $idLiga)->first();
        $fechaDeco = htmlentities($fecha);
        $fechaDecoFecha = base64_decode($fechaDeco);
        $anuns = $league->publicities()->get();

        $dates = Category::find(1)->users_individual()->where('league_id', $idLiga)->where(DB::raw("(DATE_FORMAT(games_individual.created_at,'%Y-%m-%d'))"),$fechaDecoFecha)->get();


        return view('web.jugadores_juegos_all')->with(array('league' => $league, 'fecha' => $fechaDecoFecha, 'data' => $dates, 'dates' => $dates, 'anuns' => $anuns));

    }

    public function superpollas_all($estado, $idLiga)
    {
        $league = League::where('id', '=', $idLiga)->first();

        //$dates = Category::find(1)->users_individual()->distinct('games_individual.created_at')->select('games_individual.created_at')->where('league_id', $idLiga)->take(4)->get();
        $dates= DB::table('category_league')->where('league_id', $idLiga)->orderBy('created_at', 'desc')->select('created_at')->distinct('created_at')->take(4)->get();
        $data = [];
        foreach ($dates as $key => $date) {
            $collection = Category::find(1)->users_individual()->where('league_id', $idLiga)->orderBy('games_individual.pro_g', 'desc')->where(DB::raw("(DATE_FORMAT(games_individual.created_at,'%Y-%m-%d'))"), $date->created_at)->get();
            $data['' . Carbon::parse($date->created_at)->format('Y-m-d')] = $collection;
        }
        $anuns = $league->publicities()->get();

        return view('web.superpollas_all')->with(array('league' => $league, 'data' => $data, 'dates' => $dates, 'anuns' => $anuns));
    }


    public function ranking_super_polla($idLiga) //Metodo donde se cargan las ultimas superpollas
    {
         $dates= DB::table('category_league')->where('league_id', $idLiga)->orderBy('created_at', 'desc')->select('created_at')->distinct('created_at')->take(4)->get();
        //return $dates = Category::find(1)->users_individual()->distinct('games_individual.created_at')->select('games_individual.created_at')->where('league_id', 1)->take(4)->get(); // between

        $data = [];
        foreach ($dates as $key => $date) {
            $collection = Category::find(1)->users_individual()->where('league_id', $idLiga)->orderBy('games_individual.pro_g', 'desc')
                ->where(DB::raw("(DATE_FORMAT(games_individual.created_at,'%Y-%m-%d'))"),Carbon::parse($date->created_at)->format('Y-m-d'))->take(3)->get();
            $data['' . Carbon::parse($date->created_at)->format('Y-m-d')] = $collection;

        }

        return ($data);
    }

    public function estado_pais()
    {
         return $querys = DB::table('estado')
            ->join('pais', 'pais.id', '=', 'estado.ubicacionpaisid')->where('pais.estatus', '1')->where('estado.estatus', '1')
            ->get();

        $valorDentro = 0;
        $i = 0;
        $data = [];
        $array1 = [];
        $array = [];
        $arrayT = [];

        foreach ($querys as $query) {
            $valor = $query->id;

            foreach ($querys as $key=>$queryD) {
                //$valorDentro = $queryD->id;
                if ($valor == $queryD->id) {
                    $array = array(
                        "estadonombre" => $queryD->estadonombre,
                        "ubicacionpaisid" => "foo",
                    );
                }
                else{
                    $valorD=$queryD->id;
                }
                array_push($arrayT, $array);
            }

            $valorV = $query->id;
            $array1[$query->paisnombre] = $arrayT;
            //$array = [];
        }
        return $array1;
        //return ($data);

    }

    public function estado_pais1()
    {
        //return $users = DB::table('users')->get();
        return $querys = DB::table('estado')
            ->join('pais', 'pais.id', '=', 'estado.ubicacionpaisid')->where('pais.estatus', '1')->where('estado.estatus', '1')
            ->get();
        //echo count($querys);


        $data = [];
        $valorI = 0;

        foreach ($querys as $query) {
            $valor = $query->id;
            foreach ($querys as $queryD) {
                if ($valor == $queryD->id || $valorI == 0) {

                }
            }
        }
    }





}
