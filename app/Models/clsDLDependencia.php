<?php
/*************************************************
Nombre: clsDLDependencia.php
Descripción: Consultas a la tabla .
Creación: Martes 17 de Enero de 2023
**************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class clsDLDependencia extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_dependencia';
    protected $fillable = [
        'id',
        'id_poder',
        'dependencia'
    ];

    protected $hidden = [ ];

    public static function queryToDB($vfiltros=[])
     {
        return clsDLDependencia::select(
            'c_dependencia.id',
            'c_dependencia.id_poder',
            'c_poder.poder',
            'c_dependencia.dependencia'
        )
        ->join('c_poder', 'c_dependencia.id_poder', '=', 'c_poder.id')
        ->where(function($vsql) use ($vfiltros) {
            if(array_key_exists('id_poder', $vfiltros))
                $vsql->where('c_dependencia.id_poder', $vfiltros['id_poder']);
        })
        ->orderBy('c_dependencia.id', 'ASC'); 
     }
}