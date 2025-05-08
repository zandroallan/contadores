<?php
/*************************************************
Nombre: clsDLRtec.php
Descripción: Consultas a la tabla p_rtec
Creación: Martes 21 de Enero de 2025.
**************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class clsDLRtec extends Model
 {
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'p_rtec';
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
        $query = clsDLRtec::select(
            'p_rtec.id',
            'p_rtec.id_status',
            'p_rtec.id_users',
            'p_rtec.id_sujeto',
            'p_rtec.uniqid',
            'p_rtec.folio',
            'p_rtec.nombre',
            'p_rtec.direccion',
            'p_rtec.telefono',
            'p_rtec.correo',
            'p_rtec.no_cedula_profesional',
            'p_rtec.no_rtec_interno',
            'p_rtec.fecha_expedicion',
            'p_rtec.claves',
            'p_rtec.anexo',
            'p_rtec.anexo_path',
            'users.name as colegio',
            'c_sujeto.sujeto',
            'c_status.status'
        )
        ->join('users', 'p_rtec.id_users', '=', 'users.id')
        ->join('c_sujeto', 'p_rtec.id_sujeto', '=', 'c_sujeto.id')
        ->join('c_status', 'p_rtec.id_status', '=', 'c_status.id')
        ->when($vfiltros['id']          ?? null, fn($query, $val) => $query->where('p_rtec.id', $val))
        ->when($vfiltros['id_users']    ?? null, fn($query, $val) => $query->where('p_rtec.id_users', $val))
        ->when($vfiltros['id_status']   ?? null, fn($query, $val) => $query->where('p_rtec.id_status', $val))
        ->when($vfiltros['id_sujeto']   ?? null, fn($query, $val) => $query->where('p_rtec.id_sujeto', $val))
        ->when($vfiltros['uniqid']      ?? null, fn($query, $val) => $query->where('p_rtec.uniqid', $val))
        ->orderByDesc('p_rtec.id');

        if ($limit != 0) {
            $query->limit($limit);
        }

        return $query;


        // return clsDLRtec::select(
        //     'p_rtec.id',
        //     'p_rtec.id_status',
        //     'p_rtec.id_users',
        //     'p_rtec.id_sujeto',
        //     'p_rtec.folio',
        //     'p_rtec.nombre',
        //     'p_rtec.direccion',
        //     'p_rtec.telefono',
        //     'p_rtec.correo',
        //     'p_rtec.no_cedula_profesional',
        //     'p_rtec.no_rtec_interno',
        //     'p_rtec.fecha_expedicion',
        //     'p_rtec.claves',
        //     'p_rtec.anexo',
        //     'p_rtec.anexo_path',
        //     'users.name as colegio'
        // )
        // ->join('users', 'p_rtec.id_users', '=', 'users.id')
        // ->join('c_sujeto', 'p_rtec.id_sujeto', '=', 'c_sujeto.id')
        // ->where(function($vsql) use ($vfiltros) {
        //     if(array_key_exists('id', $vfiltros))
        //         $vsql->where('p_rtec.id', $vfiltros['id']);               
        // })
        // ->where(function($vsql) use ($vfiltros) {
        //     if(array_key_exists('id_users', $vfiltros))
        //         $vsql->where('p_rtec.id_users', $vfiltros['id_users']);
        // })
        // ->where(function($vsql) use ($vfiltros) {
        //     if(array_key_exists('id_status', $vfiltros))
        //         $vsql->where('p_rtec.id_status', $vfiltros['id_status']);
        // })
        // ->where(function($vsql) use ($vfiltros) {
        //     if(array_key_exists('id_sujeto', $vfiltros))
        //         $vsql->where('p_rtec.id_sujeto', $vfiltros['id_sujeto']);
        // })
        // ->orderBy('p_rtec.id', 'DESC')
        // if ( $limit != 0 ) {
        //     ->limit($limit)
        // };
     }

    // public static function queryEstadisticasToDB($vfiltros=[])
    //  {
    //     return clsDLRtec::select(
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