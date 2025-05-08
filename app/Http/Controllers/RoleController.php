<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
     {
        $this->middleware('permission:rol-list|rol-create|rol-edit|rol-delete', ['only' => ['index','store']]);
        $this->middleware('permission:rol-list', ['only' => ['index']]);
        $this->middleware('permission:rol-create', ['only' => ['create','store']]);
        $this->middleware('permission:rol-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:rol-delete', ['only' => ['destroy']]);
     }

    public function roles_api(Request $vrequest)
     {  
        $vstatus=200;
        $vrespuesta=[
            'codigo'=> 1,
            'icono'=> 'sucess',
            'mensaje'=> 'Exito'
        ];
        try {
            switch ($vrequest->input('method')) {
                case 'show':
                    $id=$vrequest->input('id');
                    $vrespuesta['rol_usuario']=Role::find($id);
                    $vrespuesta['permisos']=Permission::get();
                    $vrespuesta['permisos_usuario']=DB::table('role_has_permissions')
                        ->where('role_has_permissions.role_id', $id)
                        ->select('role_has_permissions.permission_id')
                        ->get();
                  break;
                case 'get':
                    $vrespuesta['respuesta']=Role::orderBy('id','DESC')->get();
                  break;
                default:
                    $vrespuesta['mensaje']='Metodo de petición, no definido.';
                  break;
            }
        }
        catch(Exception $vexception ){
            $vstatus=500;
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> $vexception->getMessage()
            ];
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
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $status= 1; $code= 201;$route_redirect= "";$data= [];$tipo_alert="success";
    
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));

            $msg= "El rol fue creado satisfactoriamente";
            $route_redirect = route('roles.index');

            DB::commit();
        }
        catch (\Exception $e) {
            $status= 3; $code= 409; $msg= $e->getMessage();$tipo_alert="danger";
            DB::rollback();
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$role, 'tipo_alert'=>$tipo_alert], $code);
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', 'permissions.id')
            ->where('role_has_permissions.role_id',$id)
            ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return view('roles.edit', compact('role'));
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
            'permission' => 'required',
        ]);
    
        $vHTTPCode=201;
        $vrespuesta=[
            'codigo'=> 0,
            'icono'=>'warning',
            'mensaje'=>'No se pudieron actualizar los datos, intente de nuevo.',
            'redireccion'=>''
        ];

        DB::beginTransaction();
        try {
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();
        
            $role->syncPermissions($request->input('permission'));

            $vrespuesta=[
                'codigo'=> 1,
                'icono'=>'success',
                'mensaje'=>'El rol fue actualizado satisfactoriamente.',
                'redireccion'=>route('roles.index')
            ];
            DB::commit();
        }
        catch (Exception $e) {
            $vHTTPCode=409;
            $vrespuesta=[
                'codigo' => 0,
                'icono' => 'danger',
                'mensaje' => $e->getMessage(),
                'redireccion' => ''
            ];
            DB::rollback();
        }
    
        return response()->json($vrespuesta, $vHTTPCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vstatus=200;
        $vrespuesta=array();
        try {
            DB::table("roles")->where('id',$id)->delete();
            $vrespuesta['respuesta']='El rol ha sido eliminado correctamente';
        }
        catch(Exception $vexception ){
            $vstatus=500;
            $vrespuesta['message']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
    }
}
