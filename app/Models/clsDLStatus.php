<?php
/*************************************************
Nombre: clsDLStatus.php
Descripción: Consultas a la tabla c_status.
Creación: Miercoles 22 de Febrero de 2023
**************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class clsDLStatus extends Model
 {
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_status';
    protected $fillable = [
        'id',
        'status',
        'status_color'
    ];

    protected $hidden = [ ];
 }