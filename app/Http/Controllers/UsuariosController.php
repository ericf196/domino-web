<?php

namespace App\Http\Controllers;

use App\Category;
use App\League;
use App\Publicity;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Intervention\Image\Facades\Image;

class UsuariosController extends Controller
{

    public function form_nuevo_usuario()
    {
        //carga el formulario para agregar un nuevo usuario
        $roles = Role::all();
        return view("adminlte::formularios.form_nuevo_usuario")->with("roles", $roles);

    }


    public function form_nuevo_rol()
    {
        //carga el formulario para agregar un nuevo rol
        $roles = Role::all();
        return view("adminlte::formularios.form_nuevo_rol")->with("roles", $roles);
    }

    public function form_nuevo_permiso()
    {
        //carga el formulario para agregar un nuevo permiso
        $roles = Role::all();
        $permisos = Permission::all();
        return view("adminlte::formularios.form_nuevo_permiso")->with("roles", $roles)->with("permisos", $permisos);
    }


    public function form_nuevo_liga()
    {
        //carga el formulario para agregar un nueva liga
        $roles = Role::all();
        return view("adminlte::formularios.form_nuevo_liga")->with("roles", $roles);

    }


    public function listado_usuarios()
    {
        //presenta un listado de usuarios paginados de 100 en 100
        $usuarios = User::paginate(100);
        $leagues = League::paginate(100);
        if (Auth::user()->isRole('administrador') || Auth::user()->isRole('super_usuario')) {
            return view("adminlte::listados.listado_usuarios")->with("usuarios", $usuarios)->with("leagues", $leagues);
        } else {
            return view("adminlte::errors.404");
        }
    }


    public function listado_jugadores()
    {
        //$userLeague = Auth::user()->league_id;
        $userId = Auth::user()->id;
        $league = League::where('user_id', '=', $userId)->first();
        $userLeagueEmail = Auth::user()->email;
        $players = User::where([['league_id', '=', $league->id], ['email', '<>', $userLeagueEmail]])->orderBy('name', 'asc')->paginate(100);

        if (Auth::user()->isRole('admin_liga')) {
            return view("adminlte::listados.listado_jugadores")->with("players", $players);
        } else {
            return view("adminlte::errors.404");
        }

    }


    public function crear_usuario(Request $request)
    {
        $reglas = ['password' => 'required|min:8|confirmed',
            'email' => 'required|email|unique:users'];

        $mensajes = ['password.min' => 'El password debe tener al menos 8 caracteres',
            'email.unique' => 'El email ya se encuentra registrado en la base de datos',
            'password.confirmed' => 'Su password no coincide',];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if ($validator->fails()) {
            return view("adminlte::mensajes.mensaje_error")->with("msj", "...Existen errores...")
                ->withErrors($validator->errors());
        }

        $idUser = Auth::user()->id;
        $idLeague = League::where('user_id', '=', $idUser)->first()->id;

        $usuario = new User;
        $usuario->name = strtoupper($request->input("nombres") . " " . $request->input("apellidos"));
        $usuario->nombres = strtoupper($request->input("nombres"));
        $usuario->apellidos = strtoupper($request->input("apellidos"));
        $usuario->cedula = $request->input("cedula");
        $usuario->state = strtoupper($request->input("state"));
        $usuario->city = strtoupper($request->input("city"));
        $usuario->telefono = $request->input("phone");
        $usuario->association = strtoupper($request->input("association"));
        $usuario->federation = strtoupper($request->input("federation"));
        $usuario->team = strtoupper($request->input("team"));
        $usuario->email = $request->input("email");
        $usuario->password = bcrypt($request->input("password"));
        $usuario->league_id = $idLeague;
        $usuario->url_image = 'img/avatar.jpg';
        $save = $usuario->save();
        $userIdInclude = User::where('email', '=', $request->input("email"))->first()->id;

        $rolIdInclude = User::find($userIdInclude);
        $rolIdInclude->roles()->attach(3);

        if ($save) {
            return view("mensajes.msj_correcto")->with("msj", "Usuario agregado correctamente");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "...Hubo un error al agregar ;...");
        }

    }


    public function crear_administrador(Request $request)
    {
        $reglas = ['password' => 'required|min:8|confirmed',
            'email' => 'required|email|unique:users'];

        $mensajes = ['password.min' => 'El password debe tener al menos 8 caracteres',
            'email.unique' => 'El email ya se encuentra registrado en la base de datos',
            'password.confirmed' => 'Su password no coincide',];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if ($validator->fails()) {
            return view("adminlte::mensajes.mensaje_error")->with("msj", "...Existen errores...")
                ->withErrors($validator->errors());
        }

        /*$idUser = Auth::user()->id;
        $idLeague = League::where('user_id', '=', $idUser)->first()->id;*/

        $usuario = new User;
        $usuario->name = strtoupper($request->input("nombres") . " " . $request->input("apellidos"));
        $usuario->nombres = strtoupper($request->input("nombres"));
        $usuario->apellidos = strtoupper($request->input("apellidos"));
        $usuario->cedula = $request->input("cedula");
        $usuario->state = strtoupper($request->input("state"));
        $usuario->city = strtoupper($request->input("city"));
        $usuario->telefono = $request->input("phone");
        $usuario->association = strtoupper($request->input("association"));
        $usuario->federation = strtoupper($request->input("federation"));
        $usuario->team = strtoupper($request->input("team"));
        $usuario->email = $request->input("email");
        $usuario->password = bcrypt($request->input("password"));
        $usuario->league_id = 0;
        $save = $usuario->save();
        $userIdInclude = User::where('email', '=', $request->input("email"))->first()->id;

        $rolIdInclude = User::find($userIdInclude);
        $rolIdInclude->roles()->attach(1);

        if ($save) {
            return view("adminlte::mensajes.msj_usuario_creado")->with("msj", "Usuario agregado correctamente");
        } else {
            return view("adminlte::mensajes.mensaje_error")->with("msj", "...Hubo un error al agregar ;...");
        }

    }
    public function form_nuevo_administrador()
    {
        //carga el formulario para agregar un nuevo usuario
        $roles = Role::all();
        return view("adminlte::formularios.form_nuevo_administrador")->with("roles", $roles);

    }


    public function crear_liga(Request $request)
    {

        /*$reglas = ['email' => 'required|email|unique:leagues', 'image_liga' => 'required|image|mimes:jpeg,jpg,bmp,png,gif|max:900'];

        $mensajes = ['email.unique' => 'El email ya se encuentra registrado en la base de datos', 'image_liga.mimes' => 'La imagen no es valida',];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if ($validator->fails()) {
            return view("adminlte::mensajes.mensaje_error")->with("msj", "...Existen errores...")
                ->withErrors($validator->errors());
        }*/

        DB::beginTransaction();

        try {
            $usuario = new User;
            $usuario->name = strtoupper($request->get("name") . " " . $request->get("apellido"));
            $usuario->nombres = strtoupper($request->get("name"));
            $usuario->apellidos = strtoupper($request->get("apellido"));
            $usuario->telefono = $request->get("phone");
            $usuario->password = bcrypt($request->get("password"));
            $usuario->city = strtoupper($request->get("city"));
            $usuario->state = strtoupper($request->get("state"));
            $usuario->cedula = $request->get("cedula");
            $usuario->email = $request->get("email");
            $usuario->url_image  = 'img/avatar.jpg';
            $usuario->league_id = 0;

            $usuario->save();

            $userIdInclude = User::where('email', '=', $request->get("email"))->first()->id;

            $rolIdInclude = User::find($userIdInclude);
            $rolIdInclude->roles()->attach(2);

            $league = new League();
            $league->name_league = strtoupper($request->get("name_league"));
            $league->description = strtoupper($request->get("description_league"));
            $league->state = strtoupper($request->get("state_league"));
            $league->city = strtoupper($request->get("city_league"));
            $league->address = strtoupper($request->get("address_league"));
            $league->name_admin = strtoupper($request->get("name_admin"));
            $league->email = $request->get("email_league");
            $league->phone = $request->get("phone_league");
            $league->user_id = $userIdInclude;
            $league->url_logo = 'img/logo-liga.jpg';
            $league->url_portada = 'img/portada.jpg';
            $league->save();

            /*$archivo = $request->file('image_liga');*/

            $leagueId = League::where('email', '=', $request->get("email_league"))->first()->id;

            $directory = 'img/league_' . $leagueId;

            File::makeDirectory($directory, $mode = 0777, true, true);
            File::makeDirectory($directory . '/users', $mode = 0777, true, true);
            File::makeDirectory($directory . '/news', $mode = 0777, true, true);
            File::makeDirectory($directory . '/logo', $mode = 0777, true, true);
            File::makeDirectory($directory . '/publicity', $mode = 0777, true, true);


            for ($i=0; $i<8; $i++){
                $publicidad= new Publicity();
                $publicidad->name='Publicidad';
                $publicidad->league_id=$leagueId;
                $publicidad->url_publicity='img/imgAnun.jpg';
                $publicidad->status=0;
                $publicidad->save();
            }

            DB::commit();

            return view("mensajes.msj_correcto")->with("msj", "Liga agregada correctamente"); // el with esta de prueba a ver si se puede tener el la url y meterla el donde va la imagen

        } catch (Exception $e) {
            return view("mensajes.msj_rechazado")->with("msj", "Error al agregar liga");
        }

    }


    public function crear_rol(Request $request)
    {

        $rol = new Role;
        $rol->name = $request->input("rol_nombre");
        $rol->slug = $request->input("rol_slug");
        $rol->description = $request->input("rol_descripcion");
        if ($rol->save()) {
            return view("adminlte::mensajes.msj_rol_creado")->with("msj", "Rol agregado correctamente");
        } else {
            return view("adminlte::mensajes.mensaje_error")->with("msj", "...Hubo un error al agregar ;...");
        }
    }


    public function crear_permiso(Request $request)
    {

        $permiso = new Permission;
        $permiso->name = $request->input("permiso_nombre");
        $permiso->slug = $request->input("permiso_slug");
        $permiso->description = $request->input("permiso_descripcion");
        if ($permiso->save()) {
            return view("adminlte::mensajes.msj_permiso_creado")->with("msj", "Permiso creado correctamente");
        } else {
            return view("adminlte::mensajes.mensaje_error")->with("msj", "...Hubo un error al agregar ;...");
        }


    }

    public function asignar_permiso(Request $request)
    {

        $roleid = $request->input("rol_sel");
        $idper = $request->input("permiso_rol");
        $rol = Role::find($roleid);
        $rol->assignPermission($idper);

        if ($rol->save()) {
            return view("vendor.adminlte.mensajes.msj_permiso_creado")->with("msj", "Permiso asignado correctamente");
        } else {
            return view("vendor.adminlte.mensajes.mensaje_error")->with("msj", "...Hubo un error al agregar ;...");
        }


    }


    public function form_editar_usuario($id)
    {
        $usuario = User::find($id);
        $roles = Role::all();
        return view("vendor.adminlte.formularios.form_editar_usuario")->with("usuario", $usuario)
            ->with("roles", $roles);
    }


    public function editar_usuario(Request $request)
    {
        $idusuario = $request->input("id_usuario");

        $usuario = User::find($idusuario);
        $usuario->name = strtoupper($request->input("nombres") . " " . $request->input("apellidos"));
        $usuario->nombres = strtoupper($request->input("nombres"));
        $usuario->apellidos = strtoupper($request->input("apellidos"));
        $usuario->cedula = $request->input("cedula");
        $usuario->state = strtoupper($request->input("state"));
        $usuario->city = strtoupper($request->input("city"));
        $usuario->telefono = $request->input("telefono");
        $usuario->association = strtoupper($request->input("association"));
        $usuario->federation = strtoupper($request->input("federation"));
        $usuario->team = strtoupper($request->input("team"));
//        $usuario->email = $request->input("email");

        if ($request->has("rol")) {
            $rol = $request->input("rol");
            $usuario->revokeAllRoles();
            $usuario->assignRole($rol);
        }

        if ($usuario->save()) {
            return view("vendor.adminlte.mensajes.msj_usuario_actualizado")->with("msj", "Usuario actualizado correctamente")
                ->with("idusuario", $idusuario);
        } else {
            return view("vendor.adminlte.mensajes.mensaje_error")->with("msj", "..Hubo un error al agregar ; intentarlo nuevamente..");
        }
    }


    public function form_editar_league($id)
    {
        $league = League::find($id);
        $usuario = $league->user;
        //$roles = Role::all();
        return view("vendor.adminlte.formularios.form_editar_league")->with("league", $league)->with("usuario", $usuario);

    }

    public function editar_league(Request $request)
    {
        $idleague = $request->input("id_league");
        $iduser = $request->input("id_user");
        $league = League::find($idleague);

        $reglas = ['password' => 'required|min:8|confirmed',
            'email' => 'required|email|unique:users,email,' . $iduser . 'id'];

        $mensajes = ['password.min' => 'El password debe tener al menos 8 caracteres',
            'email.unique' => 'El email ya se encuentra registrado en la base de datos',
            'password.confirmed' => 'Su password no coincide',];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if ($validator->fails()) {
            return view("adminlte::mensajes.mensaje_error")->with("msj", "...Existen errores...")
                ->withErrors($validator->errors());
        }

        $league->name_league = strtoupper($request->input("name_league"));
        $league->description = strtoupper($request->input("description_league"));
        $league->state = strtoupper($request->input("state_league"));
        $league->city = strtoupper($request->input("city_league"));
        $league->address = strtoupper($request->input("address_league"));
        $league->name_admin = strtoupper($request->input("name_admin"));
        $league->email = $request->input("email_league");
        $league->phone = $request->input("phone_league");

        $usuario = User::find($iduser);

        $usuario->name = strtoupper($request->input("nombres") . " " . $request->input("apellidos"));
        $usuario->nombres = strtoupper($request->input("nombres"));
        $usuario->apellidos = strtoupper($request->input("apellidos"));
        $usuario->telefono = $request->input("phone");
        $usuario->email = $request->input("email");
        $usuario->password = bcrypt($request->input("password"));
        $usuario->save();

        if ($league->save()) {
            return view("vendor.adminlte.mensajes.msj_usuario_actualizado")->with("msj", "Liga actualizado correctamente")
                ->with("idleague", $idleague);
        } else {
            return view("vendor.adminlte.mensajes.mensaje_error")->with("msj", "..Hubo un error al editar ; intentarlo nuevamente..");
        }
    }


    public function buscar_usuario(Request $request)
    {
        $userId = Auth::user()->id;
        $league = League::where('user_id', '=', $userId)->first();

        $dato = $request->input("dato_buscado");
        $usuarios = User::where([['league_id', '=', $league->id], ["name", "like", "%" . $dato . "%"]])->orwhere([['league_id', '=', $league->id], ["apellidos", "like", "%" . $dato . "%"]])->paginate(100);
        return view('vendor.adminlte.listados.listado_usuarios')->with("usuarios", $usuarios);
    }

    public function buscar_jugador(Request $request)
    {
        $userId = Auth::user()->id;
        $league = League::where('user_id', '=', $userId)->first();

        $dato = $request->input("dato_buscado");
        $players = User::where([['league_id', '=', $league->id], ["name", "like", "%" . $dato . "%"]])->orwhere([['league_id', '=', $league->id], ["apellidos", "like", "%" . $dato . "%"]])->paginate(100);
        return view('vendor.adminlte.listados.listado_jugadores')->with("players", $players);
    }

    public function buscar_league(Request $request)
    {
        $dato = $request->input("dato_buscado1");
        $leagues = League::where("name_league", "like", "%" . $dato . "%")->orwhere("description", "like", "%" . $dato . "%")->paginate(100);
        return view('vendor.adminlte.listados.listado_usuarios')->with("leagues", $leagues);
    }


    public function borrar_usuario(Request $request)
    {
        $idusuario = $request->input("id_usuario");
        $usuario = User::find($idusuario);

        if ($usuario->delete()) {
            return view("vendor.adminlte.mensajes.msj_usuario_borrado")->with("msj", "Usuario borrado correctamente");
        } else {
            return view("vendor.adminlte.mensajes.mensaje_error")->with("msj", "..Hubo un error al agregar ; intentarlo nuevamente..");
        }


    }

    public function editar_acceso(Request $request)
    {
        $iduser = $request->input("id_usuario");

        $reglas = ['password' => 'required|min:8|confirmed',
            'email' => 'required|email|unique:users,email,' . $iduser . 'id'];

        $mensajes = ['password.min' => 'El password debe tener al menos 8 caracteres',
            'email.unique' => 'El email ya se encuentra registrado en la base de datos',
            'password.confirmed' => 'Su password no coincide',];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if ($validator->fails()) {
            return view("adminlte::mensajes.mensaje_error")->with("msj", "...Existen errores...")
                ->withErrors($validator->errors());
        }

        $idusuario = $request->input("id_usuario");
        $usuario = User::find($idusuario);
        $usuario->email = $request->input("email");
        $usuario->password = bcrypt($request->input("password"));
        if ($usuario->save()) {
            return view("vendor.adminlte.mensajes.msj_usuario_actualizado")->with("msj", "Usuario actualizado correctamente")->with("idusuario", $idusuario);
        } else {
            return view("vendor.adminlte.mensajes.mensaje_error")->with("msj", "...Hubo un error al agregar ; intentarlo nuevamente ...");
        }
    }


    public function asignar_rol($idusu, $idrol)
    {

        $usuario = User::find($idusu);
        $usuario->assignRole($idrol);
        $usuario = User::find($idusu);
        $rolesasignados = $usuario->getRoles();
        return json_encode($rolesasignados);


    }


    public function quitar_rol($idusu, $idrol)
    {

        $usuario = User::find($idusu);
        $usuario->revokeRole($idrol);
        $rolesasignados = $usuario->getRoles();
        return json_encode($rolesasignados);


    }


    public function form_borrado_usuario($id)
    {
        $usuario = User::find($id);
        return view("vendor.adminlte.confirmaciones.form_borrado_usuario")->with("usuario", $usuario);

    }


    public function quitar_permiso($idrole, $idper)
    {

        $role = Role::find($idrole);
        $role->revokePermission($idper);
        $role->save();

        return "ok";
    }


    public function borrar_rol($idrole)
    {

        $role = Role::find($idrole);
        $role->delete();
        return "ok";
    }


    public function editar_perfil()
    {
        return view("adminlte::mensajes.msj_usuario_creado");
    }

    public function form_editar_perfil()
    {
        $usuario = Auth::user();
        return view("adminlte::formularios.form_editar_perfil")->with('usuario', $usuario);

    }

    public function form_editar_league_admin()
    {
        $usuario = Auth::user();
        $league = League::where('user_id', '=', $usuario->id)->first();
        return view("adminlte::formularios.form_editar_league")->with('usuario', $usuario)->with('league', $league);
    }


    public function cambiar_password(Request $request)
    {
        $id = $request->get("id_usuario_password");
        $email = $request->get("email_usuario");
        $nombres = $request->get("nombres");
        $apellidos = $request->get("apellidos");
        $phone = $request->get("phone");
        $password = $request->get("password_usuario");

        $usuario = User::find($id);

        $usuario->email = $email;
        $usuario->telefono = $phone;
        $usuario->nombres = $nombres;
        $usuario->apellidos = $apellidos;
        $usuario->password = bcrypt($password);
        $save = $usuario->save();

        if ($save) {
            return view("mensajes.msj_correcto")->with("msj", "Password actualizado correctamente");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Error al actualizar el password");
        }

    }

    public function cambiar_informacion(Request $request)
    {

        $id = $request->input("id_usuario");

        $usuario = User::find($id);
        $usuario->name = strtoupper($request->input("nombres") . " " . $request->input("apellidos"));
        $usuario->nombres = strtoupper($request->input("nombres"));
        $usuario->apellidos = strtoupper($request->input("apellidos"));
        $usuario->cedula = $request->input("cedula");
        $usuario->state = strtoupper($request->input("state"));
        $usuario->city = strtoupper($request->input("city"));
        $usuario->telefono = $request->input("telefono");
        $usuario->association = strtoupper($request->input("association"));
        $usuario->federation = strtoupper($request->input("federation"));
        $usuario->team = strtoupper($request->input("team"));
        $save = $usuario->save();

        if ($save) {
            return view("mensajes.msj_correcto")->with("msj", "Campos actualizado correctamente");
        } else {
            return view("mensajes.msj_rechazado")->with("msj", "Error al actualizar los campos");
        }
    }


    public function subir_imagen_usuario(Request $request)
    {

        $id = $request->input('id_usuario_foto');
        $archivo = $request->file('archivo');
        $input = array('image' => $archivo);
        $reglas = array('image' => 'required|image|mimes:jpeg,jpg,bmp,png,gif|max:900');
        $validacion = Validator::make($input, $reglas);
        if ($validacion->fails()) {
            return view("mensajes.msj_rechazado")->with("msj", "El archivo no es una imagen valida");
        } else {
            try {
                $usuario = Auth::user();
                $extension = $archivo->getClientOriginalExtension(); //formato (jpg,gif etc)

                if ($usuario->league_id) {
                    $directory = 'league_' . $usuario->league_id;

                    $nuevo_nombre = "user_avatar_id_" . $id . "." . $extension;
                    Image::make($request->file('archivo'))->resize(215, 214)->save('img/' . $directory . '/' . 'users/' . $nuevo_nombre);
                    $usuario->url_image = 'img/' . $directory . '/' . 'users/' . $nuevo_nombre;
                    $usuario->save();
                } else {

                    $leagueId = League::where('user_id', '=', $usuario->id)->first()->id;

                    $nuevo_nombre = "admin_avatar_id_" . $id . "." . $extension;
                    Image::make($request->file('archivo'))->resize(215, 214)->save('img/league_' . $leagueId .'/users/' . $nuevo_nombre);
                    $usuario->url_image = 'img/league_' . $leagueId .'/users/' . $nuevo_nombre;
                    $usuario->save();
                }
                return view("mensajes.msj_correcto")->with("msj", "Imagen agregada correctamente");
            } catch (Exception $e) {
                return view("mensajes.msj_rechazado")->with("msj", "Hubo un error al modificar la foto");
            }

        }
    }

    public function all()
    {
        // Auth::user()->id; // Adminsitrador de liga
        /*$prueba=User::find(3)->league;
        echo($prueba);
        $prueba=User::find(4)->categories()->withPivot('jj ', 'jg','jp','pts_p','pts_n ','avg ','efec','pro','pro_g ')->get();
        echo($prueba);*/

        /*$idleague = 10;
        $league = League::find($idleague);
        echo($league->user);*/

        /*$idleague = 2;
        $league = League::find($idleague);*/
//        echo($league->categories()->wherePivot('category_id', '=', 3)->get());

        /*foreach ($league->categories()->wherePivot('category_id', '=', 3)->get() as $category) {
            echo $category->users()->withPivot('jj', 'jg', 'jp', 'pts_p', 'pts_n', 'avg', 'efec', 'pro', 'pro_g', 'created_at')->get();
        }*/
        echo "test";
    }

}
