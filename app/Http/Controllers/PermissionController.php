<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
     {
        $this->middleware('permission:permiso-list|permiso-create|permiso-edit|permiso-delete', ['only' => ['index','store']]);
        $this->middleware('permission:permiso-create', ['only' => ['create','store']]);
        $this->middleware('permission:permiso-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permiso-delete', ['only' => ['destroy']]);
     }

    public function permisos_api(Request $vrequest)
     {
        $vstatus=200;
        $vrespuesta=array();
        try {
            switch ( $vrequest->method ) {
                case 'show':
                    $vrespuesta['respuesta'] = Permission::find($vrequest->id);
                  break;
                case 'get':
                    $vrespuesta['respuesta'] = Permission::queryToDB()->get();
                  break;
            }
           
        }
        catch(Exception $vexception ) {
            $vstatus=500;
            $vrespuesta['message']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = Permission::orderBy('id','DESC')->paginate(5);
        //return view('permissions.index', compact('data'));
        $data = Permission::queryToDB()->get();

        return view('permissions.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     {
        $vHTTPCode=201;
        $vrespuesta=[
            'codigo'=> 0,
            'icono'=>'warning',
            'mensaje'=>'No se pudieron agregar los datos, intente de nuevo.',
            'redireccion'=>''
        ];

        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'description' => 'required'
        ]);
        
        try {
            Permission::create(['name' => $request->input('name')]);

            $vrespuesta=[
                'codigo'=> 1,
                'icono'=>'success',
                'mensaje'=>'El Permiso fue agregado satisfactoriamente.',
                'redireccion'=>route('permisos.index')
            ];
        }
        catch(Exception $vexception ) {
            $vHTTPCode=409;
            $vrespuesta=[
                'codigo' => 0,
                'icono' => 'danger',
                'mensaje' => $e->getMessage(),
                'redireccion' => ''
            ];
        }
        return response()->json($vrespuesta, $vHTTPCode);
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
    
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
    
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
    
        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();
        
        return redirect()->route('permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::find($id)->delete();
        
        return redirect()->route('permissions.index')
            ->with('success', 'Permission deleted successfully');
    }
}
