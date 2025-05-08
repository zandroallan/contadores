<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class clsDLFoliador extends Model
 {
	use HasFactory;

    protected $table = 'p_foliador';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 
        'valor', 
        'anio'
    ];

	public static function getSingleFolio()
     {
        DB::beginTransaction();
        try {
            // Obtener el último contador con un bloqueo para evitar concurrencia
            $configuracion = DB::table('p_foliador')
                ->where('nombre', 'rtec')
                ->lockForUpdate()
                ->first();

            if ( !$configuracion ) {
                // Si no existe el registro, inicializamos
                DB::table('p_foliador')->insert([
                    'nombre' => 'rtec',
                    'valor' => 1,
                    'anio'=>date('Y')
                ]);
                $contador = 1;
            } 
            else {
                // Incrementamos el contador
                $contador = $configuracion->valor + 1;
                DB::table('p_foliador')->where('nombre', 'rtec')->update([
                    'valor' => $contador
                ]);
            }

            // Formatear el folio
            $folio = 'F-' . str_pad($contador, 5, '0', STR_PAD_LEFT) .'-'.date('Y');
            
            DB::commit();
            return $folio;
        }
        catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
     }
 }