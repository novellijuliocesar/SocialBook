<?php
//Espacio de nombre
namespace App\Helpers;
  
use Illuminate\Support\Facades\DB;

//Calcula y formatea el tiempo transcurrido de una publicación o un registro de usuario.
class TimeFormat {
 
    public static function Since($fecha) {
        //Comprueba si hay una fecha registrada.
        if ($fecha == null) {
            return "No hay fecha registrada";
        }
        //Recoge el valor de la fecha sobre la que hará el cálculo.
        $fechaInicio = $fecha;
        //Da el formato al valor del tiempo e indica un valor inicial.
        $inicioDesde = $fechaInicio->diff(new \DateTime(date("Y-m-d") . " " . date("H:i:s")));
        //Realiza los cálculos
        if ($inicioDesde->y == 0) {
            if ($inicioDesde->m == 0) {
                if ($inicioDesde->d == 0) {
                    if ($inicioDesde->h == 0) {
                        if ($inicioDesde->i == 0) {
                            if ($inicioDesde->s == 0) {
                                $resultado = $inicioDesde->s . ' segundos';
                            } else {
                                if ($inicioDesde->s == 1) {
                                    $resultado = $inicioDesde->s . ' segundo';
                                } else {
                                    $resultado = $inicioDesde->s . ' segundos';
                                }
                            }
                        } else {
                            if ($inicioDesde->i == 1) {
                                $resultado = $inicioDesde->i . ' minuto';
                            } else {
                                $resultado = $inicioDesde->i . ' minutos';
                            }
                        }
                    } else {
                        if ($inicioDesde->h == 1) {
                            $resultado = $inicioDesde->h . ' hora';
                        } else {
                            $resultado = $inicioDesde->h . ' horas';
                        }
                    }
                } else {
                    if ($inicioDesde->d == 1) {
                        $resultado = $inicioDesde->d . ' día';
                    } else {
                        $resultado = $inicioDesde->d . ' días';
                    }
                }
            } else {
                if ($inicioDesde->m == 1) {
                    $resultado = $inicioDesde->m . ' mes';
                } else {
                    $resultado = $inicioDesde->m . ' meses';
                }
            }
        } else {
            if ($inicioDesde->y == 1) {
                $resultado = $inicioDesde->y . ' año';
            } else {
                $resultado = $inicioDesde->y . ' años';
            }
        }
        //Devuelve el resultado
        return "Hace " . $resultado;
    }
}
