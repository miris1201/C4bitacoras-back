<?php
/**
 * * Funciones generales
 */
class cFunction
{
    function __construct()
    {

    }
    //Orden de la fecha para insertar
    public function formatear_fecha_ins($fecha){
        

        $explote = explode ('/',$fecha);                       //división de la fecha utilizando el separador /
        $fecha   = $explote [2].'-'.$explote [1].'-'.$explote [0];   //alteramos el orden de la variable

        return $fecha;

    }

    //Formato de hora para inserar (unicamente cuando se manda en AM y PM) ---- By JF 20/05/15
    public function formatear_hora_ins($hora){

        $hora_formato = strtotime($hora);
        $hora_formato = date("H:i", $hora_formato);

        return $hora_formato;
    }

    public function obtenerFechaEnLetra($fecha){
        $dia  = $this->conocerDiaSemanaFecha($fecha);
        $num  = date("j", strtotime($fecha));
        $anno = date("Y", strtotime($fecha));
        $mes  = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        $mes  = $mes[(date('m', strtotime($fecha))*1)-1];
        return $dia.', '.$num.' de '.$mes.' del '.$anno;
    }

    public function conocerDiaSemanaFecha($fecha) {
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $dia  = $dias[date('w', strtotime($fecha))];
        return $dia;
    }

    public function get_sub_string($string, $length=NULL)
    {
        //Primero eliminamos las etiquetas html y luego cortamos el string
        $stringDisplay = substr(strip_tags($string), 0, $length);
        //Si el texto es mayor que la longitud se agrega puntos suspensivos
        if (strlen(strip_tags($string)) > $length)
            $stringDisplay .= '';
        return trim($stringDisplay);
    }

    /**
     * Extrae del CURP la fecha de nacimiento y la regresa en formato yyyy-mm-dd
     * osea  pues listo para insertar en la base de datos :) (También se puede con RFC.
     *
     * @param type string $curp Curp o Rfc
     *
     * By JF! aka JF! aka JC! :)
     */
    public function getFechaByCurp($curp)
    {
        $rCurp = "";
        if(str_replace(' ', '',$curp) != "" || !empty($curp)){
            $fCurp = substr($curp, 4, 6);
            $yy    = substr($fCurp, 0, 2);
            $mm    = substr($fCurp, 2, 2);
            $dd    = substr($fCurp, 4, 2);

            if($yy > 29){ //Si está pasando del año 2029 entonces se pondra con fecha de 1900
                $yy = "19".$yy;
            }

            $rCurp = $yy."-".$mm."-".$dd;

            $date_ = new DateTime($rCurp);
            $rCurp = $date_->format('Y-m-d');
        }
        return $rCurp;
    }

    public function getUltimoDiaMes($mes, $Y){
        $f_limite = date("d/m/Y",(mktime(0,0,0, $mes+1 ,1 , $Y)-1));

        return $f_limite;
    }

    public function getVigenciaUltimoDia($mes, $Y){
        $mes = 2;
        $Y = 2021;
        $dia = date("d",(mktime(0,0,0, $mes+1 ,1 , $Y)-1));
        $txtMes  = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
        $mes  = $txtMes[$mes-1];

        $vigencia = 'VIGENCIA DEL 1 AL '. $dia . ' DE ' .$mes. ' DE '.$Y;

        return $vigencia;
    }

    public function getFechaLimite($mes, $Y){

        if ($mes == 1) {
            $f_limite = '31/01/' . $Y;
        }
        if ($mes == 2) {
            $f_limite = '28/02/' . $Y;
        }
        if ($mes == 3) {
            $f_limite = '31/03/' . $Y;
        }
        if ($mes == 4) {
            $f_limite = '30/04/' . $Y;
        }
        if ($mes == 5) {
            $f_limite = '31/05/' . $Y;
        }
        if ($mes == 6) {
            $f_limite = '30/06/' . $Y;
        }
        if ($mes == 7) {
            $f_limite = '31/07/' . $Y;
        }
        if ($mes == 8) {
            $f_limite = '31/08/' . $Y;
        }
        if ($mes == 9) {
            $f_limite = '30/09/' . $Y;
        }
        if ($mes == 10) {
            $f_limite = '31/10/' . $Y;
        }
        if ($mes == 11) {
            $f_limite = '30/11/' . $Y;
        }
        if ($mes == 12) {
            $f_limite = '31/12/' . $Y;
        }

        return $f_limite;
    }

    public function getFecLimiteOxxo($mes, $Y){

        if ($mes == 1) {
            $fecLimOxxo = $Y . '0131';
        }
        if ($mes == 2) {
            $fecLimOxxo = $Y . '0229';
        }
        if ($mes == 3) {
            $fecLimOxxo = $Y . '0331';
        }
        if ($mes == 4) {
            $fecLimOxxo = $Y . '0430';
        }
        if ($mes == 5) {
            $fecLimOxxo = $Y . '0531';
        }
        if ($mes == 6) {
            $fecLimOxxo = $Y . '0630';
        }
        if ($mes == 7) {
            $fecLimOxxo = $Y . '0731';
        }
        if ($mes == 8) {
            $fecLimOxxo = $Y . '0831';
        }
        if ($mes == 9) {
            $fecLimOxxo = $Y . '0930';
        }
        if ($mes == 10) {
            $fecLimOxxo = $Y . '1031';
        }
        if ($mes == 11) {
            $fecLimOxxo = $Y . '1130';
        }
        if ($mes == 12) {
            $fecLimOxxo = $Y . '1231';
        }

        return $fecLimOxxo;
    }
    
    public function getVigencia($mes, $Y){

        if ($mes == 1) {
            $vigencia = 'VIGENCIA DEL 1 AL 31 DE ENERO DE '.$Y;
        }
        if ($mes == 2) {
            $vigencia = 'VIGENCIA DEL 1 AL 28 DE FEBRERO DE '.$Y;
        }
        if ($mes == 3) {
            $vigencia = 'VIGENCIA DEL 1 AL 31 DE MARZO DE ' . $Y;
        }
        if ($mes == 4) {
            $vigencia = 'VIGENCIA DEL 1 AL 30 DE ABRIL DE ' . $Y;
        }
        if ($mes == 5) {
            $vigencia = 'VIGENCIA DEL 1 AL 31 DE MAYO DE ' . $Y;
        }
        if ($mes == 6) {
            $vigencia = 'VIGENCIA DEL 1 AL 30 DE JUNIO DE ' . $Y;
        }
        if ($mes == 7) {
            $vigencia = 'VIGENCIA DEL 1 AL 31 DE JULIO DE ' . $Y;
        }
        if ($mes == 8) {
            $vigencia = 'VIGENCIA DEL 1 AL 31 DE AGOSTO DE ' . $Y;
        }
        if ($mes == 9) {
            $vigencia = 'VIGENCIA DEL 1 AL 30 DE SEPTIEMBRE DE ' . $Y;
        }
        if ($mes == 10) {
            $vigencia = 'VIGENCIA DEL 1 AL 31 DE OCTUBRE DE ' . $Y;
        }
        if ($mes == 11) {
            $vigencia = 'VIGENCIA DEL 1 AL 30 DE NOVIEMBRE DE ' . $Y;
        }
        if ($mes == 12) {
            $vigencia = 'VIGENCIA DEL 1 AL 31 DE DICIEMBRE DE' . $Y;
        }

        return $vigencia;
    }
    
    /**
     * Generación de Linea de Captura para Bancos
     * @param type int $cve Cvelec
     * @param type string $f_limite Fecha límite
     * @param type int $fli Folio
     * @param type doble $importe Importe
     *
     * By JF! aka JF! aka JC! :)
     */
    public function generaLineaCaptura($cvelc, $f_limite, $fli, $importe)
    {
        $folioliq   = $fli;
        // $importelc  = $importe;

        $folio      = $folioliq;
        $fecha      = $f_limite;

        // $cantidad   = round($importe);
       
        /*
        * Se tendrá que calcular cuando tenga 3 y agarrar 9 en lugar de 10 caracteres
        */
        $no_c    = strlen($cvelc);

        $lim_car = 10;

        if($no_c == 3){
            $lim_car = 9;
        }
        /*
        * Fin de cálculo
        */

        $anio = (substr($fecha, 6, 4));
        $anio = ($anio - 2013) * 372;

        $mes = (substr($fecha, 3, 2) - 1);
        $mes = ($mes * 31);
        $diaa = (substr($fecha, 0, 2));

        $diaa = ($diaa) - 1;

        $fechacond = $anio + $mes + $diaa;
        $importelc = (round($importe) * 100);

        $z1 = 0;
        $z2 = 0;
        $z3 = 0;
        $z4 = 0;
        $z5 = 0;
        $z6 = 0;
        $z7 = 0;
        $z8 = 0;
        $z9 = 0;

        if (strlen($importelc) == 3) {
            $z1 = (substr($importelc, 2, 1) * 7);
            $z2 = (substr($importelc, 1, 1) * 3);
            $z3 = (substr($importelc, 0, 1) * 1);
        }

        if (strlen($importelc) == 4) {
            $z1 = (substr($importelc, 3, 1) * 7);
            $z2 = (substr($importelc, 2, 1) * 3);
            $z3 = (substr($importelc, 1, 1) * 1);
            $z4 = (substr($importelc, 0, 1) * 7);
        }

        if (strlen($importelc) == 5) {
            $z1 = (substr($importelc, 4, 1) * 7);
            $z2 = (substr($importelc, 3, 1) * 3);
            $z3 = (substr($importelc, 2, 1) * 1);
            $z4 = (substr($importelc, 1, 1) * 7);
            $z5 = (substr($importelc, 0, 1) * 3);
        }

        if (strlen($importelc) == 6) {
            $z1 = (substr($importelc, 5, 1) * 7);
            $z2 = (substr($importelc, 4, 1) * 3);
            $z3 = (substr($importelc, 3, 1) * 1);
            $z4 = (substr($importelc, 2, 1) * 7);
            $z5 = (substr($importelc, 1, 1) * 3);
            $z6 = (substr($importelc, 0, 1) * 1);
            
        }

        if (strlen($importelc) == 7) {
            $z1 = (substr($importelc, 6, 1) * 7);
            $z2 = (substr($importelc, 5, 1) * 3);
            $z3 = (substr($importelc, 4, 1) * 1);
            $z4 = (substr($importelc, 3, 1) * 7);
            $z5 = (substr($importelc, 2, 1) * 3);
            $z6 = (substr($importelc, 1, 1) * 1);
            $z7 = (substr($importelc, 0, 1) * 7);
        }

        if (strlen($importelc) == 8) {
            $z1 = (substr($importelc, 7, 1) * 7);
            $z2 = (substr($importelc, 6, 1) * 3);
            $z3 = (substr($importelc, 5, 1) * 1);
            $z4 = (substr($importelc, 4, 1) * 7);
            $z5 = (substr($importelc, 3, 1) * 3);
            $z6 = (substr($importelc, 2, 1) * 1);
            $z7 = (substr($importelc, 1, 1) * 7);
            $z8 = (substr($importelc, 0, 1) * 3);
        }

        if (strlen($importelc) == 9) {
            $z1 = (substr($importelc, 8, 1) * 7);
            $z2 = (substr($importelc, 7, 1) * 3);
            $z3 = (substr($importelc, 6, 1) * 1);
            $z4 = (substr($importelc, 5, 1) * 7);
            $z5 = (substr($importelc, 4, 1) * 3);
            $z6 = (substr($importelc, 3, 1) * 1);
            $z7 = (substr($importelc, 2, 1) * 7);
            $z8 = (substr($importelc, 1, 1) * 3);
            $z9 = (substr($importelc, 0, 1) * 1);
        }

        $zzz = $z1 + $z2 + $z3 + $z4 + $z5 + $z6 + $z7 + $z8 + $z9;

        if (strlen($zzz) == 1) {
            $cantcond = (substr($zzz, 0, 1));
      
        } else {
            $cantcond = (substr($zzz, 1, 1));

        }

      
        while (strlen($folio) < $lim_car) {
            $folio = "0" . $folio;
            
        }

        // echo $folio;

        $calculaLinea = $cvelc . $folio . $fechacond . $cantcond . "2";

        // echo $calculaLinea;
        $i = 1;
        $dv = 0;

        for ($z = 1; $z <= (strlen($calculaLinea));) {
            $num = (substr($calculaLinea, (strlen($calculaLinea) - $z), 1));            
            if ($num <> ' ') {

                switch ($i) {
                    case 1:
                        $dv = $dv + ($num * 11);
                        $i = 2;
                        break;
                    case 2:
                        $dv = $dv + ($num * 13);
                        $i = 3;
                        break;
                    case 3:
                        $dv = $dv + ($num * 17);
                        $i = 4;
                        break;
                    case 4:
                        $dv = $dv + ($num * 19);
                        $i = 5;
                        break;
                    case 5:
                        $dv = $dv + ($num * 23);
                        $i = 1;
                }
            }
            $z++;
        }

        $dv = (($dv % 97) + 1);
        if (strlen($dv) < 2) {
            $dv = "0" . $dv;
        }

        $calculaLinea = $calculaLinea . $dv;
        return $calculaLinea;
        
        //  hasta aqui linea de captura bancos----------------
    }

    /**
     * Gneración de linea de captura para OXXO
     *
     * @param type string $curp Curp o Rfc
     *
     * By JF! aka JF! aka JC! :)
     */

     /**
     * Generación de Linea de Captura para OXXO
     * @param type string $f_limite Fecha límite
     * @param type int $fli Folio
     * @param type doble $importe Importe
     *
     * By JF! aka JF! aka JC! :)
     */

    public function generaLineaCapturaOxxo($fecLimOxxo, $fli, $importe){

        $impoxo = round($importe);
        while (strlen($impoxo) < 5) {
            $impoxo = "0" . $impoxo;
        }


        $folioliq = $fli;
        while (strlen($folioliq) < 6) {
            $folioliq = "0" . $folioliq;
        }

        //$OXO1 = "1810" . $folioliq . $f_limite . $impoxo . "00";
        $OXO1 = "1810" . $folioliq . $fecLimOxxo . $impoxo . "00";


        $pos1 = substr($OXO1, 24, 1);
        $pos1 = ($pos1 * 2);
        if (strlen($pos1) == 2) {
            $pos11 = substr($pos1, 0, 1);
            $pos12 = substr($pos1, 1, 1);
            $pos1 = ($pos11 + $pos12);
        }
        $pos2 = substr($OXO1, 23, 1);
        $pos2 = ($pos2 * 1);
        if (strlen($pos2) == 2) {
            $pos21 = substr($pos2, 0, 1);
            $pos22 = substr($pos2, 1, 1);
            $pos2 = ($pos21 + $pos22);
        }
        $pos3 = substr($OXO1, 22, 1);
        $pos3 = ($pos3 * 2);
        if (strlen($pos3) == 2) {
            $pos31 = substr($pos3, 1, 1);
            $pos32 = substr($pos3, 1, 1);
            $pos3 = ($pos31 + $pos32);
        }
        $pos4 = substr($OXO1, 21, 1);
        $pos4 = ($pos4 * 1);
        if (strlen($pos4) == 2) {
            $pos41 = substr($pos4, 0, 1);
            $pos42 = substr($pos4, 1, 1);
            $pos4 = ($pos41 + $pos42);
        }
        $pos5 = substr($OXO1, 20, 1);
        $pos5 = ($pos5 * 2);
        if (strlen($pos5) == 2) {
            $pos51 = substr($pos5, 0, 1);
            $pos52 = substr($pos5, 1, 1);
            $pos5 = ($pos51 + $pos52);
        }
        $pos6 = substr($OXO1, 19, 1);
        $pos6 = ($pos6 * 1);
        if (strlen($pos6) == 2) {
            $pos61 = substr($pos6, 0, 1);
            $pos62 = substr($pos6, 1, 1);
            $pos6 = ($pos61 + $pos62);
        }
        $pos7 = substr($OXO1, 18, 1);
        $pos7 = ($pos7 * 2);
        if (strlen($pos7) == 2) {
            $pos71 = substr($pos7, 0, 1);
            $pos72 = substr($pos7, 1, 1);
            $pos7 = ($pos71 + $pos72);
        }
        $pos8 = substr($OXO1, 17, 1);
        $pos8 = ($pos8 * 1);
        if (strlen($pos8) == 2) {
            $pos81 = substr($pos8, 0, 1);
            $pos82 = substr($pos8, 1, 1);
            $pos8 = ($pos81 + $pos82);
        }

        $pos9 = substr($OXO1, 16, 1);
        $pos9 = ($pos9 * 2);
        if (strlen($pos9) == 2) {
            $pos91 = substr($pos9, 0, 1);
            $pos92 = substr($pos9, 1, 1);
            $pos9 = ($pos91 + $pos92);
        }

        $pos10 = substr($OXO1, 15, 1);
        $pos10 = ($pos10 * 1);
        if (strlen($pos10) == 2) {
            $pos101 = substr($pos10, 0, 1);
            $pos102 = substr($pos10, 1, 1);
            $pos10 = ($pos101 + $pos102);
        }

        $pos11 = substr($OXO1, 14, 1);
        $pos11 = ($pos11 * 2);
        if (strlen($pos11) == 2) {
            $pos111 = substr($pos11, 0, 1);
            $pos112 = substr($pos11, 1, 1);
            $pos11 = ($pos111 + $pos112);
        }

        $pos12 = substr($OXO1, 13, 1);
        $pos12 = ($pos12 * 1);
        if (strlen($pos12) == 2) {
            $pos121 = substr($pos12, 0, 1);
            $pos122 = substr($pos12, 1, 1);
            $pos12 = ($pos121 + $pos122);
        }

        $pos13 = substr($OXO1, 12, 1);
        $pos13 = ($pos13 * 2);
        if (strlen($pos13) == 2) {
            $pos131 = substr($pos13, 0, 1);
            $pos132 = substr($pos13, 1, 1);
            $pos13 = ($pos131 + $pos132);
        }

        $pos14 = substr($OXO1, 11, 1);
        $pos14 = ($pos14 * 1);
        if (strlen($pos14) == 2) {
            $pos141 = substr($pos14, 0, 1);
            $pos142 = substr($pos14, 1, 1);
            $pos14 = ($pos141 + $pos142);
        }

        $pos15 = substr($OXO1, 10, 1);
        $pos15 = ($pos15 * 2);
        if (strlen($pos15) == 2) {
            $pos151 = substr($pos15, 0, 1);
            $pos152 = substr($pos15, 1, 1);
            $pos15 = ($pos151 + $pos152);
        }

        $pos16 = substr($OXO1, 9, 1);
        $pos16 = ($pos16 * 1);
        if (strlen($pos16) == 2) {
            $pos161 = substr($pos16, 0, 1);
            $pos162 = substr($pos16, 1, 1);
            $pos16 = ($pos161 + $pos162);
        }

        $pos17 = substr($OXO1, 8, 1);
        $pos17 = ($pos17 * 2);
        if (strlen($pos17) == 2) {
            $pos171 = substr($pos17, 0, 1);
            $pos172 = substr($pos17, 1, 1);
            $pos17 = ($pos171 + $pos172);
        }

        $pos18 = substr($OXO1, 7, 1);
        $pos18 = ($pos18 * 1);
        if (strlen($pos18) == 2) {
            $pos181 = substr($pos18, 0, 1);
            $pos182 = substr($pos1, 1, 1);
            $pos18 = ($pos181 + $pos182);
        }

        $pos19 = substr($OXO1, 6, 1);
        $pos19 = ($pos19 * 2);
        if (strlen($pos19) == 2) {
            $pos191 = substr($pos19, 0, 1);
            $pos192 = substr($pos19, 1, 1);
            $pos19 = ($pos191 + $pos192);
        }

        $pos20 = substr($OXO1, 5, 1);
        $pos20 = ($pos20 * 1);
        if (strlen($pos20) == 2) {
            $pos201 = substr($pos20, 0, 1);
            $pos202 = substr($pos20, 1, 1);
            $pos20 = ($pos201 + $pos202);
        }

        $pos21 = substr($OXO1, 4, 1);
        $pos21 = ($pos21 * 2);
        if (strlen($pos21) == 2) {
            $pos211 = substr($pos21, 0, 1);
            $pos212 = substr($pos21, 1, 1);
            $pos21 = ($pos211 + $pos212);
        }

        $pos22 = substr($OXO1, 3, 1);
        $pos22 = ($pos22 * 1);
        if (strlen($pos22) == 2) {
            $pos221 = substr($pos22, 0, 1);
            $pos222 = substr($pos22, 1, 1);
            $pos22 = ($pos221 + $pos222);
        }

        $pos23 = substr($OXO1, 2, 1);
        $pos23 = ($pos23 * 2);
        if (strlen($pos23) == 2) {
            $pos231 = substr($pos23, 0, 1);
            $pos232 = substr($pos23, 1, 1);
            $pos23 = ($pos231 + $pos232);
        }

        $pos24 = substr($OXO1, 1, 1);
        $pos24 = ($pos24 * 1);
        if (strlen($pos24) == 2) {
            $pos241 = substr($pos24, 0, 1);
            $pos242 = substr($pos24, 1, 1);
            $pos24 = ($pos241 + $pos242);
        }

        $pos25 = substr($OXO1, 0, 1);
        $pos25 = ($pos25 * 2);
        if (strlen($pos25) == 2) {
            $pos251 = substr($pos25, 0, 1);
            $pos252 = substr($pos25, 1, 1);
            $pos25 = ($pos251 + $pos252);
        }

        $oxxo = ($pos1 + $pos2 + $pos3 + $pos4 + $pos5 + $pos6 + $pos7 +
            $pos8 + $pos9 + $pos10 + $pos11 + $pos12 + $pos13 + $pos14 +
            $pos15 + $pos16 + $pos17 + $pos18 + $pos19 + $pos20 + $pos21 +
            $pos22 + $pos23 + $pos24 + $pos25);

        if (strlen($oxxo) == 2) {
            $res = substr($oxxo, 2, 1);
            if ($res == 0) {
                $resi = 0;
            } else {
                $resi = (10 - $res);
            }
        } else {
            if (strlen($oxxo) == 3) {
                $res = substr($oxxo, 3, 1);
                if ($res == 0) {
                    $resi = 0;
                } else {
                    $resi = (10 - $res);
                }
            }
        }
        $oxxook = ($OXO1 . $resi);
        return $oxxook;
    }

    public function obtenerEdad($fecha_nac)
    {
        $fecha = time() - strtotime($fecha_nac);
        $edad = floor((($fecha / 3600) / 24) / 360);
        return $edad;
    }

    function comprimir_string_html($buffer) {
        $busca = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');
        $reemplaza = array('>','<','\\1');
        return preg_replace($busca, $reemplaza, $buffer);
    }

    /**
     * Crea un thumbail de un imagen con el ancho y el alto pasados como parametros,
     * recortando en caso de ser necesario la dimension mas grande por ambos lados.
     *
     * @param type $nombreImagen Nombre completo de la imagen incluida la ruta y la extension.
     * @param type $nombreThumbnail Nombre completo para el thumbnail incluida la ruta y la extension.
     * @param type $nuevoAncho Ancho para el thumbnail.
     * @param type $nuevoAlto Alto para el thumbnail.
     */
    function crearThumbnailRecortado($nombreImagen, $nombreThumbnail, $nuevoAncho, $nuevoAlto){

        // Obtiene las dimensiones de la imagen.
        list($ancho, $alto) = getimagesize($nombreImagen);

        // Si la division del ancho de la imagen entre el ancho del thumbnail es mayor
        // que el alto de la imagen entre el alto del thumbnail entoces igulamos el
        // alto de la imagen  con el alto del thumbnail y calculamos cual deberia ser
        // el ancho para la imagen (Seria mayor que el ancho del thumbnail).
        // Si la relacion entre los altos fuese mayor entonces el altoImagen seria
        // mayor que el alto del thumbnail.
        if ($ancho/$nuevoAncho > $alto/$nuevoAlto){
            $altoImagen = $nuevoAlto;
            $factorReduccion = $alto / $nuevoAlto;
            $anchoImagen = $ancho / $factorReduccion;
        }
        else{
            $anchoImagen = $nuevoAncho;
            $factorReduccion = $ancho / $nuevoAncho;
            $altoImagen = $alto / $factorReduccion;
        }

        // Abre la imagen original.
        list($imagen, $tipo)= $this->abrirImagen($nombreImagen);

        // Crea la nueva imagen (el thumbnail).
        $thumbnail = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

        // Si la relacion entre los anchos es mayor que la relacion entre los altos
        // entonces el ancho de la imagen que se esta creando sera mayor que el del
        // thumbnail porlo que se centrara para que se corte por la derecha y por la
        // izquierda. Si el alto fuese mayor lo mismo se cortaria la imagen por arriba
        // y por abajo.
        if ($ancho/$nuevoAncho > $alto/$nuevoAlto){
            imagecopyresampled($thumbnail , $imagen, ($nuevoAncho-$anchoImagen)/2, 0, 0, 0, $anchoImagen, $altoImagen, $ancho, $alto);
        }  else {
            imagecopyresampled($thumbnail , $imagen, 0, ($nuevoAlto-$altoImagen)/2, 0, 0, $anchoImagen, $altoImagen, $ancho, $alto);
        }

        // Guarda la imagen.
        $this->guardarImagen($thumbnail, $nombreThumbnail, $tipo);
    }

    /**
     * Abre la imagen con el nombre pasado como parametro y devuelve un array con la imagen y el tipo de imagen.
     *
     * @param type $nombre Nombre completo de la imagen incluida la ruta y la extension.
     * @return Devuelve la imagen abierta.
     */
    function abrirImagen($nombre){
        $info = getimagesize($nombre);
        switch ($info["mime"]){
            case "image/jpeg":
                $imagen = imagecreatefromjpeg($nombre);
                break;
            case "image/gif":
                $imagen = imagecreatefromgif($nombre);
                break;
            case "image/png":
                $imagen = imagecreatefrompng($nombre);
                break;
            default :
                echo "Error: No es un tipo de imagen permitido.";
        }
        $resultado[0]= $imagen;
        $resultado[1]= $info["mime"];
        return $resultado;
    }

    /**
     * Guarda la imagen con el nombre pasado como parametro.
     *
     * @param type $imagen La imagen que se quiere guardar
     * @param type $nombre Nombre completo de la imagen incluida la ruta y la extension.
     * @param type $tipo Formato en el que se guardara la imagen.
     */
    function guardarImagen($imagen, $nombre, $tipo){

        switch ($tipo){
            case "image/jpeg":
                imagejpeg($imagen, $nombre, 70); // El 100 es la calidade de la imagen (entre 1 y 100. Con 100 sin compresion ni perdida de calidad.).
                break;
            case "image/gif":
                imagegif($imagen, $nombre);
                break;
            case "image/png":
                imagepng($imagen, $nombre, 6); // El 9 es grado de compresion de la imagen (entre 0 y 9. Con 9 maxima compresion pero igual calidad.).
                break;
            default :
                echo "Error: Tipo de imagen no permitido.";
        }
    }

    function getToken( $headers ){
        
        if( !isset($headers["HTTP_AUTHORIZATION"])){
            return false;
        }
        
        $auth = $headers["HTTP_AUTHORIZATION"][0];
        //$headers = apache_request_headers();
            
        if($auth != ""){
            $arrayAuthHead  = explode(" ", $auth);
    
            return $arrayAuthHead[1];
        }
        
        return "";
    
    }

}
