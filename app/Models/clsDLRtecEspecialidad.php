<?php
/*************************************************
Nombre: clsDLRtecEspecialidad.php
Descripción: Consultas a la tabla p_rtec_especialidades.
Creación: Martes 18 de Febrero de 2025
**************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class clsDLRtecEspecialidad extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'p_rtec_especialidades';
    protected $fillable = [
        'id',
        'id_rtec',
        'id_especialidad',
        'anio'
    ];

    protected $hidden = [ ];

    public static function queryToDB($vfiltros=[])
     {
        return clsDLRtecEspecialidad::select(
            'p_rtec_especialidades.id',
            'p_rtec_especialidades.id_rtec',
            'p_rtec_especialidades.id_especialidad',
            'c_especialidades.clave',
            'c_especialidades.especialidad'
        )
        ->join('p_rtec', 'p_rtec_especialidades.id_rtec', '=', 'p_rtec.id')
        ->join('c_especialidades', 'p_rtec_especialidades.id_especialidad', '=', 'c_especialidades.id')
        ->where(function($vsql) use ($vfiltros) {
            if(array_key_exists('id', $vfiltros))
                $vsql->where('p_rtec_especialidades.id', $vfiltros['id']);               
        })
        ->where(function($vsql) use ($vfiltros) {
            if(array_key_exists('id_rtec', $vfiltros))
                $vsql->where('p_rtec_especialidades.id_rtec', $vfiltros['id_rtec']);               
        })
        ->where(function($vsql) use ($vfiltros) {
            if(array_key_exists('id_especialidad', $vfiltros))
                $vsql->where('p_rtec_especialidades.id_especialidad', $vfiltros['id_especialidad']);               
        })
        ->orderBy('p_rtec_especialidades.id', 'ASC'); 
     }
}