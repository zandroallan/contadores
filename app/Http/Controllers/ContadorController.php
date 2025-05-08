<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\clsDLContador;
use App\Models\clsDLContadorEspecialidad;
use App\Models\clsDLEspecialidad;
use App\Models\clsDLFoliador;
use Auth;
use Hash;
use DB;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class ContadorController extends Controller
{
    public function verificarFolio($uniqid)
     {
        /**
         * Sandro Alan Gomez Aceituno
         * 27 de febrero de 2025
         * Muestra la vista de verificació de los folios.
         */

        return view('contadores.verify', ['uniqid' => $uniqid]);
     }

    public function contadores_api(Request $vrequest)
     {
        /**
         * Sandro Alan Gomez Aceituno
         * 12 de Febrero de 2025
         * Muestra todos los contadores registrados.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response json
         */

        $vstatus=200;
        $vfiltro=array();
        $vrespuesta=[
            'codigo'=> 1,
            'icono'=> 'success',
            'mensaje'=> 'Exito'
        ];
        try {            
            switch ($vrequest->input('method')) {
                case 'edit':
                    $vrespuesta['data']=clsDLContador::queryToDB(['id' => $vrequest->id])->first();
                    // $vrespuesta['espds']=clsDLEspecialidad::queryToDB($vfiltro)->get();
                    // $vrespuesta['espds_select']=clsDLContadorEspecialidad::queryToDB(['id_rtec' => $vrequest->id])->get();
                  break;
                case 'show':
                    $_MDL_DATA_Rtec=clsDLContador::queryToDB(['uniqid' => $vrequest->uniqid])->first();
                    $vrespuesta['data']=$_MDL_DATA_Rtec;
                    // $vrespuesta['espds']=clsDLContadorEspecialidad::queryToDB(['id_rtec' => $_MDL_DATA_Rtec->id])->get();

                    $qrCode = new QrCode('https://apps.anticorrupcionybg.gob.mx/contadores/verificar/'. $_MDL_DATA_Rtec->uniqid .'/folio');  

                    $qrCode->setSize(230);
                    // Usar el escritor PNG para generar la imagen
                    $writer = new PngWriter();

                    // Generar la imagen del QR como una cadena binaria (PNG)
                    $result = $writer->write($qrCode);

                    // Convertir la imagen a base64
                    $base64QR = base64_encode($result->getString());

                    // Devolver el QR en formato base64 como respuesta JSON
                    // return response()->json(['qr_code' => $base64QR]);

                    $vrespuesta['qr_code']=$base64QR;

                  break;
                case 'get':
                    if ( auth()->user()->hasRole('Colegios') ) {
                        $vfiltro['id_users']=auth()->user()->id;
                    }

                    $vrespuesta['data']=clsDLContador::queryToDB($vfiltro)->get();
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

    public function constanciaUpload(Request $vrequest)
     {
        /**
         * Sandro Alan Gomez Aceituno
         * 25 de Febrero de 2025
         * Muestra todos los contadores registrados.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response json
         */

        $vstatusHTTP=201;
        $vrespuesta=['icon'=>'warning', 'codigo'=> 0, 'mensaje'=> 'No se pudo agregar el archivo.'];
        $vdatosFoliador=$vrequest->all();
        DB::beginTransaction();
        try {

            $vdatosRegistro=[];
            $validator = Validator::make($vrequest->all(), [
                'file' => 'required',
                'id' => 'required'
            ]);

            if ( $validator->fails() ) {
                return response()->json(['icon'=>'warning', 'cove'=>0, 'mensaje'=> 'Favor de llenar todos los campos, ', $validator->errors()->toJson()], 400);
            }

            $_MDL_Data_Rtec=clsDLContador::findOrFail((int)$vrequest->input('id'));
            $_PATH_File= '/constancia/'. date('Y') .'/'. $_MDL_Data_Rtec->folio;
            
            $_Input_File = $vrequest->file('file');
            if ( $vrequest->hasFile('file') ) {
                if ( $vrequest->file('file')->isValid() ) {
                    $_Name_File_Extension=$_Input_File->getClientOriginalName();
                    $vrequest->file('file')->storeAs($_PATH_File, $_Name_File_Extension);                  
                    
                    $_Data_Rtec["anexo_path"]='/app'.$_PATH_File;
                    $_Data_Rtec["anexo"]=$_Name_File_Extension;
                    $_Data_Rtec['id_status']=2;
                }
            }
            $_MDL_Data_Rtec->fill($_Data_Rtec)->save();

            $vrespuesta=['icon'=>'danger', 'icon'=>'success', 'codigo'=> 1, 'mensaje'=> 'El anexo ha sido subido satisfactoriamente'];
            DB::commit();
        }
        catch( Exception $vexception ) {
            DB::rollback();
            $vstatusHTTP=500;
            $vrespuesta=['codigo'=> -1, 'mensaje'=> $vexception->getMessage()];
        }
        return response()->json($vrespuesta, $vstatusHTTP, [], JSON_HEX_APOS|JSON_HEX_QUOT);
     }

    public function constanciaDownload($id)
     {
        $_MDL_Data_Rtec=clsDLContador::findOrFail($id);
        $_PATH_File=storage_path() . $_MDL_Data_Rtec->anexo_path.'/'.$_MDL_Data_Rtec->anexo;

        if ( File::exists($_PATH_File) ) {
            return response()->download($_PATH_File);
        }
     }

    public function dowloadQRCode($id)
     {
        $_MDL_Data_Rtec=clsDLContador::find($id);

        $qrCode = new QrCode('https://apps.anticorrupcionybg.gob.mx/contadores/verificar/'. $_MDL_Data_Rtec->uniqid .'/folio');

        // Usar el escritor PNG para generar la imagen
        $writer = new PngWriter();

        // Generar el código QR como una cadena binaria (imagen en formato PNG)
        $result = $writer->write($qrCode);

        // Descargar la imagen generada como un archivo PNG
        return response($result->getString())
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="codigo-Qr-'. $_MDL_Data_Rtec->folio .'.png"');
     }

    public function generateQRCode()
     {
        $qrCode = new QrCode('https://apps.anticorrupcionybg.gob.mx/contadores/'); 

        // Usar el escritor PNG para generar la imagen
        $writer = new PngWriter();

        // Generar la imagen del QR como una cadena binaria (PNG)
        $result = $writer->write($qrCode);

        // Convertir la imagen a base64
        // $base64QR = base64_encode($result->getString());

        // Devolver el QR en formato base64 como respuesta JSON
        // return response()->json(['qr_code' => $base64QR]);


        return response($result->getString())
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="codigo-Qr-RTEC.png"');
     }

    public function index()
     {
        return view('contadores.index');
     }
    
    public function create()
     {
        /**
         * Sandro Alan Gomez Aceituno
         * 12 de Febrero de 2025
         * Muestra el formulario para crear un nuevo recurso.
         *
         * @return \Illuminate\Http\Response
         */

        return view('contadores.create');
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
            'mensaje'=> 'El registro del <b>Representante técnico</b> no se ha realizado correctamente.'
        ];

        $validator=Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string',
            'telefono' => ['required', 'regex:/^[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}$/'],
            'correo' => 'required|email',
            'no_cedula_profesional' => 'required|integer|min:13',
            'no_rtec_interno' => 'required|integer|min:13',
            'fecha_expedicion' => 'required|date_format:Y-m-d'
            // 'especialidades' => 'required|array|min:1'
        ]);

        if ( $validator->fails() ) {
            return response()->json(['codigo'=>0, 'icono'=>'warning', 'mensaje'=> $validator->errors()->toJson()], 201);
        }
        DB::beginTransaction();
        try {   

            $_Data_Rtec = $request->all();
            $_Data_Rtec['id_users']=Auth::user()->id;
            $_Data_Rtec['uniqid']=strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 10));
            $_Data_Rtec['id_sujeto']=1;
            $_Data_Rtec['id_status']=1;

            $_Data_Rtec['folio']=clsDLFoliador::getSingleFolio();

            $_MDL_Data_Rtec=new clsDLContador;
            $_MDL_Data_Rtec->fill($_Data_Rtec)->save();

            if ( !empty($_Data_Rtec['especialidades']) && is_array($_Data_Rtec['especialidades']) ) {
                foreach ( $_Data_Rtec['especialidades'] as $array) {
                    
                    $_MDL_Data_Rtec_Especialidad=new clsDLContadorEspecialidad;
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
                'mensaje'=> 'El registro del RTEC se ha realizado con éxito.'
            ];
            DB::commit();
        }
        catch( Exception $vexception ) {
            DB::rollback();
            $vstatus=500;
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> 'Hubo un error al registrar el RTEC. Intenta nuevamente. '. $vexception->getMessage()
            ];
        }
        return response()->json($vrespuesta, $vstatus);
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
     {
        return view('contadores.show', ['id'=> $id]);
     }


    public function edit($id)
     {
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */

        return view('contadores.edit', [ 'id' => $id ]);
     }

    public function update(Request $request, $id)
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
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string',
            'telefono' => ['required', 'regex:/^[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}$/'],
            'correo' => [
                'required',
                Rule::unique('p_rtec', 'correo')->ignore($id),
            ],
            'no_cedula_profesional' => 'required|integer|min:13',
            'no_rtec_interno' => 'required|integer|min:13',
            'fecha_expedicion' => 'required|date_format:Y-m-d',
            'especialidades' => 'required|array|min:1'
        ]);

        if ( $validator->fails() ) {
            return response()->json(['codigo'=>0, 'icono'=>'warning', 'mensaje'=> $validator->errors()->toJson()], 201);
        }
        try {
            $_Data_Rtec = $request->all();

            $_MDL_Data_Rtec=clsDLContador::findOrFail($id);
            $_MDL_Data_Rtec->fill($_Data_Rtec)->save();

            clsDLContadorEspecialidad::where('id_rtec', $id)->delete();

            if ( !empty($_Data_Rtec['especialidades']) && is_array($_Data_Rtec['especialidades']) ) {
                foreach ( $_Data_Rtec['especialidades'] as $array) {
                    
                    $_MDL_Data_Rtec_Especialidad=new clsDLContadorEspecialidad;
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
                'mensaje'=> 'El registro del <b>Representante técnico</b> se ha actualizado con éxito.'
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
            clsDLContador::find($id)->delete();
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