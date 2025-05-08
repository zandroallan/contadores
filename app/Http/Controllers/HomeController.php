<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\clsDLRtec;
use App\Models\clsDLSesion;
use App\Models\clsDLSesionOrdenDiaAcuerdo;
use App\Models\clsDLSesionOrdenDiaAsuntoAcuerdo;
use App\Models\clsDLSesionOrdenDiaCedulaAcuerdo;
use Auth;
use Hash;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tablero_api(Request $vrequest)
     {
        $vrespuesta=[];
        $vrespuesta=['codigo'=>0, 'icono'=> 'warning', 'mensaje'=>'No se pudieron actualizar las contraseñas, intenten de nuevo.'];
        $vstatusHTTP=200;
        DB::beginTransaction();
        try {
            $vfiltros=[];
            if ( auth()->user()->hasRole('Colegios') ) {
                $vfiltros['id_users']=auth()->user()->id;
            }
            $vrespuesta['data']=clsDLRtec::queryToDB($vfiltros, 10)->get();

            $vfiltros['id_status']=1;
            $vrespuesta['proceso']=clsDLRtec::queryToDB($vfiltros)->get();

            $vfiltros['id_status']=2;
            $vrespuesta['concluidos']=clsDLRtec::queryToDB($vfiltros)->get();

            $vfiltros['id_status']=3;
            $vrespuesta['cancelados']=clsDLRtec::queryToDB($vfiltros)->get();
            
            $vrespuesta['codigo']=1;
            $vrespuesta['icono']='success';
            $vrespuesta['mensaje']='Los datos han sido guardados exitosamente. ';
            DB::commit();           
        }
        catch ( Exception $vexception ) {
            DB::rollback();
            $vrespuesta=['codigo'=>-1, 'mensaje'=> $vexception->getMessage()];
            $vstatusHTTP=500;
        }
        return response()->json($vrespuesta, $vstatusHTTP, [], JSON_HEX_APOS|JSON_HEX_QUOT);
     }

    public function passwordUsers()
     {
        $vrespuesta=[];
        $vrespuesta=['codigo'=>0, 'icono'=> 'warning', 'mensaje'=>'No se pudieron actualizar las contraseñas, intenten de nuevo.'];
        $vstatusHTTP=200;
        DB::beginTransaction();
        try {
            $_MDL_Data_Users=User::queryToDB([])->get();
            
            foreach($_MDL_Data_Users as $_Data_User) {
                
                $_MDL_Data_User=User::find($_Data_User->id);
                $_MDL_Data_User->fill(['password' => Hash::make($_Data_User->curp)])->save();

                unset($_MDL_Data_User);
            }
            
            $vrespuesta['codigo']=1;
            $vrespuesta['icono']='success';
            $vrespuesta['mensaje']='Los datos han sido guardados exitosamente. ';
            DB::commit();           
        }
        catch ( Exception $vexception ) {
            DB::rollback();
            $vrespuesta=['codigo'=>-1, 'mensaje'=> $vexception->getMessage()];
            $vstatusHTTP=500;
        }
        return response()->json($vrespuesta, $vstatusHTTP, [], JSON_HEX_APOS|JSON_HEX_QUOT);
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
     {
        return view('home');
     }

    public function show($id_curso)
     {
        return view('home_show', ['id_curso' => $id_curso]);
     }

    public static function getDependenciasAPI(Request $vrequest)
     {
        $vrespuesta=[];
        $vrespuesta=['codigo'=>0, 'mensaje'=>'No se encontraron registros.'];
        $vstatusHTTP=200;
        try {
            $vflUser=clsDLDependencia::lst_dependencia()->get();
            if ( count($vflUser) > 0 ) {
                $vrespuesta=[
                    'codigo'=>0,
                    'mensaje'=>'No se encontraron registros.',
                    'dependencias'=>$vflUser
                ];
            }
        }
        catch ( Exception $vexception ) {
            $vrespuesta=['codigo'=>-1, 'mensaje'=> $vexception->getMessage()];
            $vstatusHTTP=500;
        }
        return response()->json($vrespuesta, $vstatusHTTP, [], JSON_HEX_APOS|JSON_HEX_QUOT);
     }

    public static function getNoAcuerdoAPI(Request $vrequest)
     {
        $vrespuesta=[];
        $vrespuesta=['codigo'=>1, 'mensaje'=>'Exito.'];
        $vstatusHTTP=200;
        try {
            $tipo_sesion='';
            $vflSeccion=clsDLSesion::findOrFail($vrequest->id_sesion);
            switch ( $vflSeccion->id_tipo_sesion ) {
                case 1: $tipo_sesion='ORD'; break;
                case 2: $tipo_sesion='EXT'; break;
            }

            $vtotalSesiones=clsDLSesion::queryToDB([
                'id_sesion'=> $vrequest->id_sesion,
                'id_dependencia'=>session('id_dependencia_slc')
            ])->get();

            $vflAcuerdo=clsDLSesionOrdenDiaAcuerdo::queryToDB(['id_sesion'=>$vrequest->id_sesion])->get();
            $vflAcuerdoAsuntoGeneral=clsDLSesionOrdenDiaAsuntoAcuerdo::queryToDB(['id_sesion'=>$vrequest->id_sesion])->get();
            $vflAcuerdoCedulaProblematica=clsDLSesionOrdenDiaCedulaAcuerdo::queryToDB(['id_sesion'=>$vrequest->id_sesion])->get();

            $totalAcuerdos=(int)count($vflAcuerdo) + (int)count($vflAcuerdoAsuntoGeneral) + (int)count($vflAcuerdoCedulaProblematica) + 1;

            $vrespuesta['no_acuerdo']='CCDI-'. count($vtotalSesiones) .'/'. date('Y') .'/'. $tipo_sesion .'/'. $totalAcuerdos;
        }
        catch ( Exception $vexception ) {
            $vrespuesta=['codigo'=>-1, 'mensaje'=> $vexception->getMessage()];
            $vstatusHTTP=500;
        }
        return response()->json($vrespuesta, $vstatusHTTP, [], JSON_HEX_APOS|JSON_HEX_QUOT);
     }

    public static function acuerdo_index()
     {
        return view('acuerdos.index');
     }

    public function mi_perfil()
     {
        return view('perfil.index');
     }

    public function perfil_datos()
    {
        $vstatusHTTP=200;
        $vrespuesta=[];
        $vrespuesta=['numero'=> 1, 'respuesta'=> 'Datos de mi perfil.'];
        try {
            $vrespuesta['data']=User::mi_perfil()->first();
        }
        catch(Exception $vexception ) {
            $vstatusHTTP=500;
            $vrespuesta['message']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatusHTTP);
    }

    public function updateData(Request $vrequest)
     {   
        $vstatus=200;
        $vrespuesta=['numero'=> 0, 'icon'=>'warning', 'respuesta'=> 'No se ha podido registrar los datos, intente de nuevo.'];

        $validator = Validator::make($vrequest->all(), [
            'nombre'=> ['required', 'string', 'max:60'],
            'profesion'=> ['required', 'string', 'max:60'],
            'puesto'=> ['required', 'string', 'max:60'],
            'telefono_ext'=> ['required', 'string', 'max:18']
        ]);

        if ( $validator->fails() ) {
            return response()->json(['numero'=>0, 'icon'=>'warning', 'respuesta'=> $validator->errors()->toJson()], 202);
        }

        $vrespuesta=['numero'=> 1, 'icon'=>'success', 'respuesta'=> 'Datos registrados correctamente.'];
        DB::beginTransaction();
        try {
            $_new_data=true;
            $_Data_User=$vrequest->all();
            $_Data_User['name']=$_Data_User['nombre'];
            // $id_usuario=(int)$_Data_User['id'];

            $_new_data=false;
            $_MDL_Data_User=User::findOrFail(Auth::User()->id);

            $_url_file='/tools/perfiles';
            $_imagen_form = $vrequest->file('imagen');
            if ( $vrequest->hasFile('imagen') ) {
                if ( $vrequest->file('imagen')->isValid() ) {
                    // $_name_file_extention=$_imagen_form->getClientOriginalName();
                    $_file_extention=$_imagen_form->getClientOriginalExtension();
                    $_name_file_extention='image_profile_'. Auth::User()->id .'.'. $_file_extention;

                    $vrequest->file('imagen')->storeAs($_url_file, $_name_file_extention, 'fotos');

                    $_Data_User["foto"]= $_url_file .'/'. $_name_file_extention;
                }
            }

            $_MDL_Data_User->fill($_Data_User)->save();
            DB::commit();
        }
        catch ( Exception $vexception ){
            $vstatus=500;
            $vrespuesta=['numero'=> 1, 'icon'=>'danger', 'respuesta'=> $vexception->getMessage()];
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public function updatePassword(Request $vrequest)
     {   
        $vstatus=200;
        $vrespuesta=['numero'=> 0, 'icon'=>'warning', 'respuesta'=> 'No se ha podido actualizar la contraseña.'];

        $validator = Validator::make($vrequest->all(), [
            'password' => 'required|same:confirm-password'
        ]);

        if ( $validator->fails() ) {
            return response()->json(['numero'=>0, 'icon'=>'warning', 'respuesta'=> $validator->errors()->toJson()], 202);
        }

        $vrespuesta=['numero'=> 1, 'icon'=>'success', 'respuesta'=> 'Contraseña actualizado correctamente.'];
        DB::beginTransaction();
        try {
            $_MDL_Data_User=User::findOrFail(Auth::User()->id);

            $_Data_User=$vrequest->all();
            $_Data_User['password_recover']=base64_encode($_Data_User['password']);
            $_Data_User['password']=Hash::make($_Data_User['password']);            
            
            $_MDL_Data_User->fill($_Data_User)->save();
            DB::commit();
        }
        catch ( Exception $vexception ){
            $vstatus=500;
            $vrespuesta=['numero'=> 1, 'icon'=>'danger', 'respuesta'=> $vexception->getMessage()];
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public function changeTheme(Request $vrequest)
     {
        $vstatusHTTP=200;
        $vrespuesta=[];
        $vrespuesta=['numero'=> 1, 'respuesta'=> 'El tema ha sido cambiado exitosamente.'];
        try {
            $_Data_User=User::find((int)Auth::User()->id);
            $_Data_User->fill(['theme'=> $vrequest->theme])->save();
        }
        catch(Exception $vexception ) {
            $vstatusHTTP=500;
            $vrespuesta['message']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatusHTTP);
     }
}
