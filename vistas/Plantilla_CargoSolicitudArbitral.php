<?php
include_once '../includes/solicitud.php';
include_once '../includes/solicitudpretension.php';
include_once '../includes/solicitudanexo.php';

$id = $_GET["id"];

// $id = 4;

$Solicitud = new Solicitud();
$VSolicitud = $Solicitud->EditarSolicitud_v2($id);

$Pretensiones = new SolicitudPretension();
$VPretensiones = $Pretensiones->ListarSolicitudPretension($id);

$Anexos = new SolicitudAnexo();
$VAnexos = $Anexos->ListarSolicitudAnexo($id);

$fechSolicitud = $VSolicitud['FchUltMod'];


$diaActual = date_create($fechSolicitud);//date("d",$fechSolicitud);
$nroMes = $fechSolicitud["mon"];//date('m');
$anioActual = date('yday');

switch($nroMes)
{   
case 1:
$mesActual = "01";
break;
case 2:
$mesActual = "02";
break;
case 3:
$mesActual = "03";
break;
case 4:
$mesActual = "04";
break;
case 5:
$mesActual = "05";
break;
case 6:
$mesActual = "06";
break;
case 7:
$mesActual = "07";
break;
case 8:
$mesActual = "08";
break;
case 9:
$mesActual = "09";
break;
case 10:
$mesActual = "10";
break;
case 11:
$mesActual = "11";
break;
case 12:
$mesActual = "12";
break;

    //...
}


ob_start();

function titleCase($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("de", "da", "dos", "das", "do", "I", "II", "III", "IV", "V", "VI"))
{

    /*
     * Exceptions in lower case are words you don't want converted
     * Exceptions all in upper case are any words you don't want converted to title case
     *   but should be converted to upper case, e.g.:
     *   king henry viii or king henry Viii should be King Henry VIII
     */
    $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
    foreach ($delimiters as $dlnr => $delimiter) {
        $words = explode($delimiter, $string);
        $newwords = array();
        foreach ($words as $wordnr => $word) {
            if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtoupper($word, "UTF-8");
            } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtolower($word, "UTF-8");
            } elseif (!in_array($word, $exceptions)) {
                // convert to uppercase (non-utf8 only)
                $word = ucfirst($word);
            }
            array_push($newwords, $word);
        }
        $string = join($delimiter, $newwords);
   }//foreach
   return $string;
}

/*---------------------------------------Estilos-------------------------------------------*/

$margin_doc = "padding:25px 25px 25px 25px;font-family:Optima;";
$titulo = "font-weight: bold;text-align:center;font-size:14px;padding-bottom:12px;";
$Subtitulo = "font-size:13px;margin-top:5px;margin-bottom:-10px;padding-top:5px;font-family: sans-serif;margin-left:90px;";
$Subtitulo1 = "font-weight: bold;font-size:13px;margin-top:5px;margin-bottom:-17px;padding-top:0px;margin-left:450px;font-family: sans-serif;text-align:right;color:#9E9E9E;border: solid #cacaca 1px";
$Subtitulo2 = "font-weight: bold;font-size:13px;margin-top:5px;margin-bottom:-20px;padding-top:0px;margin-left:450px;font-family: sans-serif;text-align:right;color:#9E9E9E;border: solid #cacaca 1px";
$Subtitulo_subra = "font-weight: bold;font-size:14px;margin-top:-10px;margin-bottom:-10px;text-decoration: underline;";
$Subtitulo_principal = "font-weight: bold;font-size:14px;margin-top:-10px;margin-bottom:5px;text-align:justify;";
$parrafo_bold = "font-weight: bold;font-size:13px;";
$parrafo_bold2 = "font-weight: bold;font-size:13px;margin-bottom:5px;margin-top:50px;padding-top:10px;";
$parrafo_bold_underline_space = "font-weight: bold;font-size:13px;text-decoration: underline;padding-left:18px;";
$parrafo = "font-size:14px;padding-left:25px;padding-bottom:-10px;padding-top:0px;";
$parrafo_space = "font-size:14px;padding-left:35px;margin-bottom:-10px;margin-top:-19px;text-align:justify;";
$parrafo_space_help = "font-size:12px;margin-left:33px,color:darkslategray;border-top: 1px solid #9e9e9e;margin-bottom:-5px";
$parrafo_space_table = "font-size:14px;padding-left:120px;margin-bottom:0px;margin-top:-13px;padding-bottom:-19px;font-family: sans-serif;";
$parrafo_rigth = "font-size:14px;text-align:right;padding-bottom:-15px;padding-top:-15px;";
$parrafo_rigth_line = "font-size:14px;text-align:right;padding-bottom:-15px;padding-top:45px;";
$parrafo_rigth_firma = "font-size:14px;text-align:right;margin-rigth:15px;padding-rigth:20px;";
$parrafo_rigth_bold = "font-size:16px;text-align:center;margin-bottom:-14px;font-weight: bold;font-family: sans-serif;";
$parrafo_rigth_bold_2 = "font-size:14px;text-align:right;margin-bottom:18px;font-weight: bold;";
?>

<!-- ------------------------------------ PLANTILLA -------------------------------------------------->
<div style="<?php echo $margin_doc; ?>">
	<p style="<?php echo $Subtitulo1; ?>">RECIBIDO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p>
	<p style="<?php echo $Subtitulo2; ?>">DIGITALMENTE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p>
	<br><br>
	<br><br>
	<br>
	<img src="./img/img-log.jpeg" style="background: #00819f;color:red;width: 55%;text-align: center;margin-left:150px;margin-top:-20px">
	<br/>
	<br/>
	<br/>
	<!--<p style="<?php echo $titulo; ?>">SOLICITUD DE INICIO DE PROCEDIMIENTO ARBITRAL<p>-->
	<p style="<?php echo $parrafo_rigth_bold; ?>"><span> CARGO DE PRESENTACIÓN ELECTRÓNICA DE DOCUMENTO</span><p>
	<p style="<?php echo $parrafo_rigth_bold; ?>"><span> MESA DE PARTES VIRTUAL</span><p>

	<br><br><br>
	<!-- DATOS DEL DEMANDANTE ¡-->
	<p style="<?php echo $Subtitulo; ?>">EXPEDIENTE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo titleCase($VSolicitud['NumSol']).'-CEAR-MPV';?><p>
	<p style="<?php echo $Subtitulo; ?>">PRESENTANTE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo titleCase($VSolicitud['RazSocDem']) ;?><p>
	<p style="<?php echo $Subtitulo; ?>">FECHA DE PRESENTACIÓN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo date_format($diaActual,'d-m-Y').' '.($VSolicitud['HraCreSol']);?><p>
	<p style="<?php echo $Subtitulo; ?>">SUMILLA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo ucfirst(strtolower($VSolicitud['destipsol'])) ;?><p>
	
<div>