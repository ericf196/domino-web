<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    //return view('welcome');
    return redirect('/login');
});*/


Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes

    Route::get('/home', 'HomeController@index');
    Route::get('/listado_usuarios', 'UsuariosController@listado_usuarios');

    Route::get('/listado_jugadores', 'UsuariosController@listado_jugadores');

    Route::post('crear_usuario', 'UsuariosController@crear_usuario');
    Route::post('editar_usuario', 'UsuariosController@editar_usuario');
    Route::post('buscar_usuario', 'UsuariosController@buscar_usuario');
    Route::post('buscar_jugador', 'UsuariosController@buscar_jugador');
    Route::post('borrar_usuario', 'UsuariosController@borrar_usuario');
    Route::post('editar_acceso', 'UsuariosController@editar_acceso');

    Route::post('crear_rol', 'UsuariosController@crear_rol');
    Route::post('crear_permiso', 'UsuariosController@crear_permiso');
    Route::post('asignar_permiso', 'UsuariosController@asignar_permiso');
    Route::get('quitar_permiso/{idrol}/{idper}', 'UsuariosController@quitar_permiso');
    
    
    Route::get('form_nuevo_usuario', 'UsuariosController@form_nuevo_usuario');
    Route::get('form_nuevo_rol', 'UsuariosController@form_nuevo_rol');
    Route::get('form_nuevo_permiso', 'UsuariosController@form_nuevo_permiso');
    Route::get('form_editar_usuario/{id}', 'UsuariosController@form_editar_usuario');
    Route::get('confirmacion_borrado_usuario/{idusuario}', 'UsuariosController@confirmacion_borrado_usuario');
    Route::get('asignar_rol/{idusu}/{idrol}', 'UsuariosController@asignar_rol');
    Route::get('quitar_rol/{idusu}/{idrol}', 'UsuariosController@quitar_rol');
    Route::get('form_borrado_usuario/{idusu}', 'UsuariosController@form_borrado_usuario');
    Route::get('borrar_rol/{idrol}', 'UsuariosController@borrar_rol');

    Route::post('crear_liga', 'UsuariosController@crear_liga'); //crea liga
    Route::get('form_nuevo_liga', 'UsuariosController@form_nuevo_liga');
    //Route::get('form_editar_league/{id}', 'UsuariosController@form_editar_league');
    Route::post('editar_league', 'UsuariosController@editar_league');
    Route::post('buscar_league', 'UsuariosController@buscar_league');


    Route::post('editar_perfil', 'UsuariosController@editar_perfil');
    Route::get('form_editar_perfil', 'UsuariosController@form_editar_perfil');


    //Noticias
    Route::get('panel_noticias', 'NewsController@panel_noticias');
    Route::get('form_nuevo_noticia', 'NewsController@form_nuevo_noticia');
    Route::get('form_editar_noticia/{id}', 'NewsController@form_editar_noticia');
    Route::post('nuevo_noticia', 'NewsController@nuevo_noticia');
    Route::post('editar_noticia', 'NewsController@editar_noticia');

    //Perfil Usuario
    Route::post('cambiar_password', 'UsuariosController@cambiar_password');
    Route::post('cambiar_informacion', 'UsuariosController@cambiar_informacion');
    Route::post('subir_imagen_usuario', 'UsuariosController@subir_imagen_usuario');




    Route::post('crear_administrador', 'UsuariosController@crear_administrador');
    Route::get('form_nuevo_administrador', 'UsuariosController@form_nuevo_administrador');

    Route::get('form_editar_league/{id}', 'UsuariosController@form_editar_league');
    Route::get('form_editar_league_admin', 'UsuariosController@form_editar_league_admin');

    //Perfil liga
    Route::post('cambiar_informacion_league', 'LeagueController@cambiar_informacion_league');
    Route::post('subir_logo_league', 'LeagueController@subir_logo_league');
    Route::post('subir_portada_league', 'LeagueController@subir_portada_league');


    //Games Super Polla
    Route::get('super_polla', 'GameController@super_polla');
    Route::post('tabla_super_polla', 'GameController@tabla_super_polla');


    //Publicidad
    Route::get('panel_anun', 'AnunController@panel_anun');
    Route::post('nueva_publicidad', 'AnunController@nueva_publicidad');
    Route::get('form_nuevo_anun', 'AnunController@form_nuevo_anun');

    Route::post('form_borrado_anun/{idusu}', 'AnunController@form_borrado_anun');


    Route::post('sent_table', 'LeagueController@sent_table'); // test table


});

Route::get('test/{idLiga}/{fecha}', 'IndexController@test');

Route::get('estado/pais', 'IndexController@estado_pais');
Route::get('all', 'UsuariosController@all'); // test
Route::get('ranking_super_polla', 'IndexController@ranking_super_polla');
Route::get('/', 'IndexController@index');
//Route::post('sent_table', 'IndexController@sent_table'); // test table
Route::get('{estado}', 'IndexController@estado');
Route::get('{estado}/{idLiga}', 'IndexController@liga');
Route::get('{estado}/{idLiga}/{idNoticia}', 'IndexController@detalle_n');
Route::get('{estado}/{idLiga}/noticias/{idNoticias}', 'IndexController@noticias_all');
Route::get('{estado}/{idLiga}/jugadores/{fecha}', 'IndexController@jugadores_all');
Route::get('{estado}/{idLiga}/superpollas/{fecha}', 'IndexController@superpollas_all');


