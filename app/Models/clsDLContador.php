<?php
/*************************************************
Nombre: clsDLContador.php
Descripción: Consultas a la tabla p_contadores
Creación: Martes 21 de Enero de 2025.
**************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class clsDLContador extends Model
 {
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'p_contadores';
    protected $fillable = [
        'id',
        'id_users',
        'id_status',
        'id_sujeto',
        'uniqid',
        'folio',
        'nombre',
        'direccion',
        'telefono',
        'correo',
        'no_cedula_profesional',
        'no_rtec_interno',
        'fecha_expedicion',
        'claves',
        'anexo',
        'anexo_path'
    ];

    protected $hidden = [ ];

    public static function queryToDB($vfiltros=[], $limit=0)
     {
        $query = clsDLContador::select(
            'p_contadores.id',
            'p_contadores.id_status',
            'p_contadores.id_users',
            'p_contadores.id_sujeto',
            'p_contadores.uniqid',
            'p_contadores.folio',
            'p_contadores.nombre',
            'p_contadores.direccion',
            'p_contadores.telefono',
            'p_contadores.correo',
            'p_contadores.no_cedula_profesional',
            'p_contadores.no_rtec_interno',
            'p_contadores.fecha_expedicion',
            'p_contadores.claves',
            'p_contadores.anexo',
            'p_contadores.anexo_path',
            'users.name as colegio',
            'c_status.status'
        )
        ->join('users', 'p_contadores.id_users', '=', 'users.id')
        ->join('c_status', 'p_contadores.id_status', '=', 'c_status.id')
        ->when($vfiltros['id']          ?? null, fn($query, $val) => $query->where('p_contadores.id', $val))
        ->when($vfiltros['id_users']    ?? null, fn($query, $val) => $query->where('p_contadores.id_users', $val))
        ->when($vfiltros['id_status']   ?? null, fn($query, $val) => $query->where('p_contadores.id_status', $val))
        ->when($vfiltros['uniqid']      ?? null, fn($query, $val) => $query->where('p_contadores.uniqid', $val))
        ->orderByDesc('p_contadores.id');

        if ($limit != 0) {
            $query->limit($limit);
        }

        return $query;


        // return clsDLContador::select(
        //     'p_contadores.id',
        //     'p_contadores.id_status',
        //     'p_contadores.id_users',
        //     'p_contadores.id_sujeto',
        //     'p_contadores.folio',
        //     'p_contadores.nombre',
        //     'p_contadores.direccion',
        //     'p_contadores.telefono',
        //     'p_contadores.correo',
        //     'p_contadores.no_cedula_profesional',
        //     'p_contadores.no_rtec_interno',
        //     'p_contadores.fecha_expedicion',
        //     'p_contadores.claves',
        //     'p_contadores.anexo',
        //     'p_contadores.anexo_path',
        //     'users.name as colegio'
        // )
        // ->join('users', 'p_contadores.id_users', '=', 'users.id')
        // ->join('c_sujeto', 'p_contadores.id_sujeto', '=', 'c_sujeto.id')
        // ->where(function($vsql) use ($vfiltros) {
        //     if(array_key_exists('id', $vfiltros))
        //         $vsql->where('p_contadores.id', $vfiltros['id']);               
        // })
        // ->where(function($vsql) use ($vfiltros) {
        //     if(array_key_exists('id_users', $vfiltros))
        //         $vsql->where('p_contadores.id_users', $vfiltros['id_users']);
        // })
        // ->where(function($vsql) use ($vfiltros) {
        //     if(array_key_exists('id_status', $vfiltros))
        //         $vsql->where('p_contadores.id_status', $vfiltros['id_status']);
        // })
        // ->where(function($vsql) use ($vfiltros) {
        //     if(array_key_exists('id_sujeto', $vfiltros))
        //         $vsql->where('p_contadores.id_sujeto', $vfiltros['id_sujeto']);
        // })
        // ->orderBy('p_contadores.id', 'DESC')
        // if ( $limit != 0 ) {
        //     ->limit($limit)
        // };
     }

    // public static function queryEstadisticasToDB($vfiltros=[])
    //  {
    //     return clsDLContador::select(
    //         'c_curso.id',
    //         'c_curso.anio',
    //         'c_curso.curso',
    //         'c_curso.descripcion',
    //         DB::raw('
    //             (
    //                 SELECT count(p_users_curso.id_curso)
    //                 FROM p_users_curso
    //                 WHERE p_users_curso.id_curso=c_curso.id
    //                     AND p_users_curso.deleted_at IS NULL
    //                 GROUP BY p_users_curso.id_curso
    //             ) as ttl_inscritos
    //         ')
    //     )
    //     ->join('c_grupo', 'c_curso.id_grupo', '=', 'c_grupo.id')
    //     ->where(function($vsql) use ($vfiltros) {
    //         if(array_key_exists('id', $vfiltros))
    //             $vsql->where('c_curso.id', $vfiltros['id']);
    //     })
    //     ->where(function($vsql) use ($vfiltros) {
    //         if(array_key_exists('id_grupo', $vfiltros))
    //             $vsql->where('c_curso.id_grupo', $vfiltros['id_grupo']);
    //     })
    //     ->where(function($vsql) use ($vfiltros) {
    //         if(array_key_exists('status', $vfiltros))
    //             $vsql->where('c_grupo.status', $vfiltros['status']);
    //     })
    //     ->orderBy('c_curso.id', 'DESC'); 
    //  }
 }