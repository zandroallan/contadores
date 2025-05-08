<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\clsDLEspecialidad;
use App\Http\Classes\Tools;
use App\Models\User;
use Auth;
use DB;

class EspecialidadController extends Controller
 {
    public function __construct()
     {
        // $this->middleware('permission:grupo-list|grupo-create|grupo-edit|grupo-delete', ['only' => ['index','store']]);
        // $this->middleware('permission:grupo-create',   ['only' => ['create','store']]);
        // $this->middleware('permission:grupo-edit',     ['only' => ['edit','update']]);
        // $this->middleware('permission:grupo-delete',   ['only' => ['destroy']]);
     }

    public static function especialidades_api(Request $vrequest)
     {
        // code...
        $vstatus=200;
        $vfiltro=array();
        $vrespuesta=[
            'codigo'=> 1,
            'icono'=> 'sucess',
            'mensaje'=> 'Exito'
        ];
        try {            
            switch ($vrequest->input('method')) {
                case 'show':
                    $vrespuesta['data']=clsDLEspecialidad::queryToDB(['id' => $vrequest->id_grupo])->first();                    
                  break;
                case 'get':
                    if ( isset($vrequest->id_sujeto) ) {
                        $vfiltro['id_sujeto']=(int)$vrequest->id_sujeto;
                    }

                    $vrespuesta['data']=clsDLEspecialidad::queryToDB($vfiltro)->get();
                  break;
                default:
                    $vrespuesta['mensaje']='Metodo de petición, no definido.';
                  break;
            }
        }
        catch( Exception $vexception ) {
            $vstatus=500;
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> $vexception->getMessage()
            ];
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public static function index()
     {
        return view('especialidades.index');
     }

    public static function show($id_grupo)
     {
        return view('especialidades.show', ['id_grupo' => $id_grupo]);
     }

    public function store(Request $vrequest)
     {
        /**
         * Sandro Alan Gomez Aceituno
         * 09 de Febrero de 2023
         * Mostrar el formulario para crear un nuevo recurso sesion ya sea ordinaria o extraordinaria.
         * Almacena un recurso recién creado en la base de datos.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response json
         */

        $vstatus=201;
        $vfiltro=array();
        $vrespuesta=[
            'codigo'=> 0,
            'icono'=> 'warning',
            'mensaje'=> 'Le informamos que el curso solicitado no ha podido ser creado en este momento, verifique si selecciono los datos requeridos.'
        ];

        $validator=Validator::make($vrequest->all(), [
            'chqb_select' => 'required|array|min:1'
        ]);

        if ( $validator->fails() ) {
            return response()->json(['codigo'=>0, 'icono'=>'warning', 'mensaje'=> $validator->errors()], 201);
        }
        DB::beginTransaction();
        try {
            $_Data_Request=$vrequest->all();

            if ( !empty($_Data_Request['chqb_select']) && is_array($_Data_Request['chqb_select']) ) {

                if ( !empty($_Data_Request['txt-sugerencia']) ) {
                    $_MDL_Data_Curso=new clsDLCurso;
                    $_MDL_Data_Curso->fill([
                        'id_grupo' => 2,
                        'anio' => date('Y'),
                        'curso' => $_Data_Request['txt-sugerencia']
                    ])->save();
                }
                
                $vrespuesta['codigo']=1;
                $vrespuesta['icono']='success';
                $vrespuesta['mensaje']='Los datos han sido guardados exitosamente.';         
            }
            else {
                $vrespuesta['codigo']=0;
                $vrespuesta['icono']='warning';
                $vrespuesta['mensaje']='No se pudieron enviar los datos a validar, o no selecciono ningún registro.';
            }

            DB::commit();
        }
        catch( Exception $vexception ) {
            DB::rollback();
            $vstatus=500;
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> $vexception->getMessage()
            ];
        }
        return response()->json($vrespuesta, $vstatus);
     }


    public function destroy($id_sesion)
     {
        /**
         * Sandro Alan Gomez Aceituno
         * 21 de Febrero de 2023
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
       
        $vstatus=200;
        $vfiltro=array();
        $vrespuesta=[
            'codigo'=> 1,
            'icono'=> 'success',
            'mensaje'=> 'Sesión eliminado satisfactoriamente.'
        ];
        try {            
            clsDLCurso::find($id_sesion)->delete();
        }
        catch( Exception $vexception ) {
            $vstatus=500;
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> $vexception->getMessage()
            ];
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public function onOff($id_grupo, $status)
     {
        /**
         * Sandro Alan Gomez Aceituno
         * 21 de Febrero de 2023
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */

        $status_text='Desactivado';
        if ( $status == 1 ) $status_text='Activado';
       
        $vstatus=200;
        $vfiltro=array();
        $vrespuesta=[
            'codigo'=> 1,
            'icono'=> 'success',
            'mensaje'=> $status .'El grupo ha sido '. $status_text .', satisfactoriamente.'
        ];
        try {            
            $_MDL_Grupo=clsDLGrupo::find($id_grupo);
            $_MDL_Grupo->status=(int)$status;
            $_MDL_Grupo->save();
            
            unset($_MDL_Grupo);
        }
        catch( Exception $vexception ) {
            $vstatus=500;
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> $vexception->getMessage()
            ];
        }
        return response()->json($vrespuesta, $vstatus);
     }
 }
