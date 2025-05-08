<?php
/*************************************************
Nombre: clsDLOrdenDia.php
Descripción: Consultas a la tabla c_orden_dia.
Creación: Martes 21 de Febrero de 2023
**************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class clsDLOrdenDia extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_orden_dia';
    protected $fillable = [
        'id',
        'id_padre',
        'inciso',
        'select',
        'default',
        'orden_dia'
    ];

    protected $hidden = [ ];

    public static function queryToDB($vfiltros=[])
     {
        return clsDLOrdenDia::select(
            'c_orden_dia.id',
            'c_orden_dia.id_padre',
            'c_orden_dia.inciso',
            'c_orden_dia.select',
            'c_orden_dia.default',
            'c_orden_dia.orden_dia'
        )
        // ->join('c_poder', 'c_dependencia.id_poder', '=', 'c_poder.id')
        ->where(function($vsql) use ($vfiltros) {
            if(array_key_exists('id_orden_dia', $vfiltros))
                $vsql->where('c_orden_dia.id_orden_dia', $vfiltros['id_orden_dia']);
        })
        ->where(function($vsql) use ($vfiltros) {
            if(array_key_exists('id_padre', $vfiltros))
                $vsql->where('c_orden_dia.id_padre', $vfiltros['id_padre']);
        })
        ->where(function($vsql) use ($vfiltros) {
            if(array_key_exists('select', $vfiltros))
                $vsql->where('c_orden_dia.select', $vfiltros['select']);
        })
        ->orderBy('c_orden_dia.orden', 'ASC'); 
     }
}