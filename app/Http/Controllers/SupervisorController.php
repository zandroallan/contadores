<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\clsDLRtec;
use App\Models\clsDLRtecEspecialidad;
use App\Models\clsDLEspecialidad;
use App\Models\clsDLFoliador;
use Auth;
use Hash;
use DB;


class SupervisorController extends Controller
{
    public function create()
     {
        /**
         * Sandro Alan Gomez Aceituno
         * 05 de marzo de 2025
         * Muestra el formulario para crear un nuevo recurso.
         *
         * @return \Illuminate\Http\Response
         */

        return view('supervisores.create');
     }

    public function store(Request $request)
     {
        /**
         * Sandro Alan Gomez Aceituno
         * 07 de Febrero de 2023
         * Show the form for creating a new resource.
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */

        $vstatus=201;
        $vfiltro=array();
        $vrespuesta=[
            'codigo'=> 0,
            'icono'=> 'warning',
            'mensaje'=> 'El registro de <b>supervisor</b> no se ha realizado correctamente, intente nuevamente.'
        ];

        $validator=Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string',
            'telefono' => ['required', 'regex:/^[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}$/'],
            'correo' => 'required|email',
            'no_cedula_profesional' => 'required|integer|min:13',
            'no_rtec_interno' => 'required|integer|min:13',
            'fecha_expedicion' => 'required|date_format:Y-m-d',
            'especialidades' => 'required|array|min:1'
        ]);

        if ( $validator->fails() ) {
            return response()->json(['codigo'=>0, 'icono'=>'warning', 'mensaje'=> $validator->errors()->toJson()], 201);
        }
        DB::beginTransaction();
        try {            
            $_Data_Rtec = $request->all();
            $_Data_Rtec['id_users']=Auth::user()->id;
            $_Data_Rtec['uniqid']=strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 10));
            $_Data_Rtec['id_sujeto']=2;
            $_Data_Rtec['id_status']=1;

            $_Data_Rtec['folio']=clsDLFoliador::getSingleFolio();

            $_MDL_Data_Rtec=new clsDLRtec;
            $_MDL_Data_Rtec->fill($_Data_Rtec)->save();

            if ( !empty($_Data_Rtec['especialidades']) && is_array($_Data_Rtec['especialidades']) ) {
                foreach ( $_Data_Rtec['especialidades'] as $array) {
                    
                    $_MDL_Data_Rtec_Especialidad=new clsDLRtecEspecialidad;
                    $_MDL_Data_Rtec_Especialidad->fill([
                        'id_rtec' => $_MDL_Data_Rtec->id,                    
                        'id_especialidad' => $array,
                        'anio' => date('Y')
                    ])->save();

                }
            }

            $vrespuesta=[
                'codigo'=> 1,
                'icono'=> 'success',
                'mensaje'=> 'El registro del <b>supervisor</b> se ha realizado con éxito.'
            ];
            DB::commit();
        }
        catch( Exception $vexception ) {
            DB::rollback();
            $vstatus=500;
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> 'Hubo un error al registrar el <b>supervisor</b>. Intenta nuevamente. '. $vexception->getMessage()
            ];
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public function edit($id)
     {
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */

        return view('rtecs.edit', [ 'id' => $id ]);
     }

    public function update(Request $request, $id_usuario)
     {
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */

        $vstatus=201;
        $vfiltro=array();
        $vrespuesta=[
            'codigo'=> 0,
            'icono'=> 'warning',
            'mensaje'=> 'Los datos del usuario no se han podido actualizar.'
        ];

        $validator=Validator::make($request->all(), [
            'name' => 'required',
            'profesion' => 'required',
            'puesto' => 'required',
            'adscripcion' => 'required',
            'curp' => 'required|unique:users,curp,' . $id_usuario,
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        if ( $validator->fails() ) {
            return response()->json(['codigo'=>0, 'icono'=>'warning', 'mensaje'=> $validator->errors()->toJson()], 201);
        }
        try { 
            $input = $request->all();
            // $input['password'] = Hash::make($input['password']);

            $vdlUsuario = User::find($id_usuario);
            $vdlUsuario->update($input);
            DB::table('model_has_roles')->where('model_id', $id_usuario)->delete();

            $vdlUsuario->assignRole($request->input('roles'));

            $vrespuesta=[
                'codigo'=> 1,
                'icono'=> 'success',
                'mensaje'=> 'Usuario agregado satisfactoriamente.'
            ];
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

    public function destroy($id)
     {
        /**
         * Sandro Alan Gomez Aceituno
         * 07 de Febrero de 2023
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
            'mensaje'=> 'El registro el Rtec ha sido eliminado satisfactoriamente.'
        ];
        try {            
            clsDLRtec::find($id)->delete();
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