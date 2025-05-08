<?php
namespace App\Http\Classes;
class Tools 
 {
    public static function fechaCastellano($fecha) 
     {
        //devuelve ej: 01/marzo/2017

        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $numeroDia." de ".$nombreMes." de ".$anio;
     }

    public static function trimestre($datetime)
     {
        $mes = date("m",strtotime($datetime));//Referencias: http://stackoverflow.com/a/3768112/1883256
        $mes = is_null($mes) ? date('m') : $mes;
        $trim=floor(($mes-1) / 3)+1;
        return $trim;
     }

    public static function shortDateFormat($fecha, $tipus=1)
     {
        $año=substr($fecha,0,4);
        $mes=substr($fecha,5,2);
        $dia=substr($fecha,8,2);

        if ($fecha != '' && $tipus == 0 || $tipus == 1) {
            if ($tipus == 1){ $fecha = mktime(0,0,0,(int)$mes,(int)$dia,(int)$año); }
            return date('d', $fecha).'/'.date('m',$fecha).'/'.date('Y', $fecha);
        }
        else {
            return 0;
        }
     }

    // public static function yyyy_mm_dd($date, $type=0)
    //  {
    //     if ( ($date=='') || ($date=='0000-00-00') ) {
    //         return '';
    //     }
    //     if ( $type == 1 ) {
    //         $char='-';
    //         $charto='/';
    //     }
    //     if ( $type == 2 ) {
    //         $char='-';
    //         $charto='-';
    //     }
    //     else {
    //         $char='/';
    //         $charto='-';
    //     }

    //     $arr = explode(" ", $date);
    //     $date= $arr['0'];
    //     $time= $arr['1'];
    //     $time = substr($time, 0, -3);

    //     $vector_fecha=explode($char,$date);
    //     $aux=$vector_fecha[2];
    //     $vector_fecha[2]=$vector_fecha[0];
    //     $vector_fecha[0]=$aux;
    //     $result= implode($charto,$vector_fecha).' '.$time;
    //     return $result;
    //  }

    //devuelve ej: 01 de Marzo de 2017
    static function longDateFormat_day($fecha, $tipus=1)
     {
        $año=substr($fecha, 0, 4);
        $mes=substr($fecha, 5, 2);
        $dia=substr($fecha, 8, 2);

        if ($fecha != '' && $tipus == 0 || $tipus == 1) {
            $mest = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
            if ( $tipus == 1 ) {
                $fecha = mktime(0, 0, 0, (int)$mes, (int)$dia, (int)$año);
            }
            return date('d', $fecha).' de '.$mest[date('m',$fecha)-1].' de '.date('Y', $fecha);
        }
        else {
            return 0;
        }
     }

    //devuelve ej: 01 de Marzo
    static function solo_dia_mes($fecha, $tipus=1)
    {
        $año=substr($fecha,0,4);
        $mes=substr($fecha,5,2);
        $dia=substr($fecha,8,2);

        if ($fecha != '' && $tipus == 0 || $tipus == 1) {
            $mest = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
            if ( $tipus == 1 ) {
                $fecha = mktime(0,0,0,(int)$mes,(int)$dia,(int)$año);
            }
            return date('d', $fecha).' de '.$mest[date('m',$fecha)-1];
        }
        else {
            return 0;
        }
    }


    public static function anio_mes_dia($date, $type=0)
     {
        if ( ($date=='') || ($date=='0000-00-00') ) {
            return '';
        }
        if( $type==1 ) {
            $char='-';
            $charto='/';
        }
        if( $type==2 ) {
            $char='-';
            $charto='-';
        }
        else {
            $char='/';
            $charto='-';
        }

        $vector_fecha=explode($char,$date);
        $aux=$vector_fecha[2];
        $vector_fecha[2]=$vector_fecha[0];
        $vector_fecha[0]=$aux;
        return str_replace(' ', '', implode($charto, $vector_fecha));
     }

    public static function dia_mes_anio($fecha, $tipus=1)
     {
        $año=substr($fecha, 0, 4);
        $mes=substr($fecha, 5, 2);
        $dia=substr($fecha, 8, 2);

        if ($fecha != '' && $tipus == 0 || $tipus == 1) {
            if ($tipus == 1)
                $fecha = mktime(0,0,0,(int)$mes,(int)$dia,(int)$año); 
            return 
                date('d', $fecha).'/'.date('m',$fecha).'/'.date('Y', $fecha);
        }
        else {
            return 0;
        }
     }
 }
?>
