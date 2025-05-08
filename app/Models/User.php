<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $dates = ['deleted_at'];
    protected $table = 'users';

    protected $fillable = [
        'id',
        'name',
        'rfc',
        'telefono',
        'direccion',
        'foto',
        'email',
        'email_verified_at',
        'password',
        'password_recover',
        'theme',
        'ok',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function queryToDB($vfiltros=[])
     {
        $vqueryToDB=User::select(
            'users.*'
        );
        // $vqueryToDB=$vqueryToDB->join('c_dependencia', 'users.id_dependencia', '=', 'c_dependencia.id');

        if ( array_key_exists('id', $vfiltros) ) {
            $vdatoFiltro=$vfiltros["id"];
            $vqueryToDB=$vqueryToDB->where( function($sql) use ($vdatoFiltro) {
                $sql->where('users.id', $vdatoFiltro);
            });
        }
        if ( array_key_exists('ok', $vfiltros) ) {
            $vdatoFiltro=$vfiltros["ok"];
            $vqueryToDB=$vqueryToDB->where( function($sql) use ($vdatoFiltro) {
                $sql->where('users.ok', $vdatoFiltro);
            });
        }

        // if ( array_key_exists('id_dependencia', $vfiltros) ) {
        //     $vdatoFiltro=$vfiltros["id_dependencia"];
        //     $vqueryToDB=$vqueryToDB->where( function($sql) use ($vdatoFiltro) {
        //         $sql->where('users.id_dependencia', $vdatoFiltro);
        //     });
        // }
        $vqueryToDB=$vqueryToDB->orderBy('users.id', 'DESC');
        return $vqueryToDB;
     }

    public static function mi_perfil()
     {
        return User::select(
            'users.*'
        )
        ->where('users.id', Auth::User()->id);
     }
}
