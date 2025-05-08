<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Role extends Model
 {
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'roles';
    protected $fillable = [
        'id',
        'name',
        'guard_name',
    ];

    protected $hidden = [
        //'id',
    ];

    public static function queryToDB($vfiltros=[])
     {
        $vqueryToDB=clsDLArea::select(
            'roles.*'
        );
        if(array_key_exists('c_areas.id', $vfiltros)) {
            $vdatoFiltro=$vfiltros["id"];
            $vqueryToDB=$vqueryToDB->where( function($sql) use ($vdatoFiltro) {
                $sql->where('c_areas.id', $vdatoFiltro);
            });
        }
        $vqueryToDB=$vqueryToDB->orderBy('c_areas.id', 'DESC');
        return $vqueryToDB;
     }
 }