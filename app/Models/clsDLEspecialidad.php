<?php
/*************************************************
Nombre: clsDLEspecialidad.php
Descripción: Consultas a la tabla p_curso
Creación: Martes 21 de Enero de 2025.
**************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class clsDLEspecialidad extends Model
 {
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_especialidades';
    protected $fillable = [
        'id',
        'clave',
        'especialidad'
    ];

    protected $hidden = [ ];

    public static function queryToDB($vfiltros=[])
     {
        return clsDLEspecialidad::select(
            'c_especialidades.id',
            'c_especialidades.clave',
            'c_especialidades.especialidad',
            'c_sujeto.sujeto'
        )
        ->join('c_sujeto', 'c_especialidades.id_sujeto', '=', 'c_sujeto.id')
        ->where(function($vsql) use ($vfiltros) {
            if(array_key_exists('id', $vfiltros))
                $vsql->where('c_especialidades.id', $vfiltros['id']);
        })
        ->where(function($vsql) use ($vfiltros) {
            if(array_key_exists('id_sujeto', $vfiltros))
                $vsql->where('c_especialidades.id_sujeto', $vfiltros['id_sujeto']);               
        })
        ->where(function($vsql) use ($vfiltros) {
            if(array_key_exists('clave', $vfiltros))
                $vsql->where('c_especialidades.clave', $vfiltros['clave']);
        })
        ->orderBy('c_especialidades.clave', 'ASC'); 
     }
 }