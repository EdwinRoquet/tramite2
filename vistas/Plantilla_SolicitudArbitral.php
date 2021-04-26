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


$diaActual = date('d');
$nroMes = date('m');
$anioActual = date('Y');

switch($nroMes)
{   
case 1:
$mesActual = "Enero";
break;
case 2:
$mesActual = "Febrero";
break;
case 3:
$mesActual = "Marzo";
break;
case 4:
$mesActual = "Abril";
break;
case 5:
$mesActual = "Mayo";
break;
case 6:
$mesActual = "Junio";
break;
case 7:
$mesActual = "Julio";
break;
case 8:
$mesActual = "Agosto";
break;
case 9:
$mesActual = "Setiembre";
break;
case 10:
$mesActual = "Octubre";
break;
case 11:
$mesActual = "Noviembre";
break;
case 12:
$mesActual = "Diciembre";
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




$nombre="Juan Carlos Tadeo Sanchez";

/*---------------------------------------Estilos-------------------------------------------*/

$margin_doc = "padding:40px 40px 40px 40px;font-family:Optima;";
$titulo = "font-weight: bold;text-align:center;font-size:14px;padding-bottom:12px;";
$Subtitulo = "font-weight: bold;font-size:14px;margin-top:5px;margin-bottom:-10px;padding-top:5px;";
$Subtitulo2 = "font-weight: bold;font-size:14px;margin-top:5px;margin-bottom:-10px;padding-top:0px;";
$Subtitulo_subra = "font-weight: bold;font-size:14px;margin-top:-10px;margin-bottom:-10px;text-decoration: underline;";
$Subtitulo_principal = "font-weight: bold;font-size:14px;margin-top:-10px;margin-bottom:5px;text-align:justify;";
$parrafo_bold = "font-weight: bold;font-size:13px;";
$parrafo_bold2 = "font-weight: bold;font-size:13px;margin-bottom:5px;margin-top:50px;padding-top:10px;";
$parrafo_bold_underline_space = "font-weight: bold;font-size:13px;text-decoration: underline;padding-left:18px;";
$parrafo = "font-size:14px;padding-left:25px;padding-bottom:-10px;padding-top:0px;";
$parrafo_space = "font-size:14px;padding-left:35px;margin-bottom:-10px;margin-top:-19px;text-align:justify;";
$parrafo_space_help = "font-size:12px;margin-left:33px,color:darkslategray;border-top: 1px solid #9e9e9e;margin-bottom:-5px";
$parrafo_space_table = "font-size:14px;padding-left:33px;margin-bottom:0px;margin-top:-13px;padding-bottom:-19px;";
$parrafo_rigth = "font-size:14px;text-align:right;padding-bottom:-15px;padding-top:-15px;";
$parrafo_rigth_line = "font-size:14px;text-align:right;padding-bottom:-15px;padding-top:45px;";
$parrafo_rigth_firma = "font-size:14px;text-align:right;margin-rigth:15px;padding-rigth:20px;";
$parrafo_rigth_bold = "font-size:14px;text-align:right;margin-bottom:-14px;font-weight: bold;";
$parrafo_rigth_bold_2 = "font-size:14px;text-align:right;margin-bottom:18px;font-weight: bold;";
?>

<!-- ------------------------------------ PLANTILLA -------------------------------------------------->
<div style="<?php echo $margin_doc; ?>">
	<!--<p style="<?php echo $titulo; ?>">SOLICITUD DE INICIO DE PROCEDIMIENTO ARBITRAL<p>-->
	<p style="<?php echo $parrafo_rigth_bold; ?>">Sumilla:<span> SOLICITUD DE INICIO DE</span><p>
	<p style="<?php echo $parrafo_rigth_bold_2; ?>"><span> ARBITRAJE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><p>
	<p style="<?php echo $Subtitulo_principal; ?>">A LA SECRETARÍA GENERAL DEL CENTRO DE ARBITRAJE LATINOAMERICANO E INVESTIGACIONES JURÍDICAS<p>
	<p style="<?php echo $parrafo_bold; ?>">Dirección: Av. Faustino Sánchez Carrión Nº 615 Oficina 306 – Edificio Vértice 22 – Distrito de Jesús María – Lima<p>
	
	<!-- DATOS DEL DEMANDANTE ¡-->
	<p style="<?php echo $Subtitulo; ?>">1.&nbsp;&nbsp;&nbsp;&nbsp;DATOS DEL DEMANDANTE:<p>
	
	<p style="<?php echo $parrafo; ?>">•	Nombre o Razón social<p>
	<p style="<?php echo $parrafo_space; ?>"><?php echo titleCase($VSolicitud['RazSocDem']) ;?><p>
	
	<p style="<?php echo $parrafo; ?>">•	<?php echo titleCase($VSolicitud['tipdoc']).": ".$VSolicitud['NumDocDem'] ;?><p>
	
	<p style="<?php echo $parrafo; ?>">•	Domicilio:<p>
	<p style="<?php echo $parrafo_space; ?>"><?php echo titleCase($VSolicitud['DesDirDem']) ;?><p>
	
	<p style="<?php echo $parrafo; ?>">•	Representante legal: <p>
	<p style="<?php echo $parrafo_space; ?>"><?php echo titleCase($VSolicitud['ApeNomLeg']).", con ".titleCase($VSolicitud['tipDocRep']) . " N° ".$VSolicitud['NumDocRep'].", facultado según: ";?><p>
	<p style="<?php echo $parrafo_space; ?>"><?php echo $VSolicitud['EscPubDem'];?><p>
	
	<p style="<?php echo $parrafo; ?>"><span><?php echo "•	Teléfono: ".$VSolicitud['NumTelRep'];?></span><span style="padding-left: 150px"><?php echo "•	Celular: ".$VSolicitud['NumCelRep'];?></span><p>

	<p style="<?php echo $parrafo; ?>"><?php echo "•	Correo electrónico: ".$VSolicitud['DirEmaRep'];?><p>
	<p style="<?php echo $parrafo; ?>"><?php echo "•	La factura o boleta se deberá de emitir a nombre de: ".titleCase($VSolicitud['RazSocEmiCom']);?><p>

	<p style="<?php echo $parrafo_bold2; ?>">La presente solicitud de inicio de arbitraje se dirige contra: <p>

	<!-- DATOS DEL DEMANDADO ¡-->
	<p style="<?php echo $Subtitulo; ?>">2.&nbsp;&nbsp;&nbsp;&nbsp;DATOS DEL DEMANDADO:<p>
	
	<p style="<?php echo $parrafo; ?>"><?php echo "•	Nombre o Razón social: ".$VSolicitud['RazSocDmd'];?><p>
	
	<p style="<?php echo $parrafo; ?>"><?php echo "•	Domicilio: ".titleCase($VSolicitud['DesDirDmd']);?><p>

	<p style="<?php echo $parrafo; ?>"><span><?php echo "•	Teléfono: ".$VSolicitud['NumTelDmd'];?></span><span style="padding-left: 150px"><?php echo "•	Celular: ".$VSolicitud['NumCelDmd'];?></span><p>

	<p style="<?php echo $parrafo; ?>"><?php echo "•	Correo electrónico: ".$VSolicitud['DirEmaDmd'];?><p>
	
	<p style="<?php echo $parrafo; ?>">•	<?php echo titleCase($VSolicitud['DesTipDocDmd']).": ".$VSolicitud['NumDocDmd'] ;?><p>
	<p style="<?php echo $parrafo; ?>"><?php echo "•	Autoridad representante: ".$VSolicitud['AutRepDmd'];?><p>
	<p style="<?php echo $parrafo; ?>"><?php echo "•	Procurador publico de corresponder: ".$VSolicitud['ProPubDmd'];?><p>

	<!-- 3.	CONVENIO ARBITRAL¡-->
	<p style="<?php echo $Subtitulo; ?>">3.&nbsp;&nbsp;&nbsp;&nbsp;CONVENIO ARBITRAL:<p>

	<p style="<?php echo $parrafo_space; ?>">Indicar su interés que la controversia existente se organice y administre a través del Centro de Arbitraje Latinoamericano e Investigacioines Jurídicas, o indicar la cláusula arbitral. <p>

	<p style="<?php echo $parrafo_space; ?>"><?php echo $VSolicitud['DesConArb'];?><p>

	<!-- 3.	TIPO ARBITRAJE¡-->
	<p style="<?php echo $Subtitulo; ?>">4.&nbsp;&nbsp;&nbsp;&nbsp;TIPO DE ARBITRAJE:<p>
	
	<p style="<?php echo $parrafo_space; ?>">(<?php echo $VSolicitud['flgCtrDer'];?>) De Derecho Pública<p>
	<p style="<?php echo $parrafo_space; ?>">(<?php echo $VSolicitud['flgCtrCon'];?>) De Conciencia<p>
	<p style="<?php echo $parrafo_space; ?>">(<?php echo $VSolicitud['flgCtrNac'];?>) Nacional<p>
	<p style="<?php echo $parrafo_space; ?>">(<?php echo $VSolicitud['flgCtrInt'];?>) Internacional<p>

	<p style="<?php echo $parrafo_bold_underline_space; ?>">Especialidad:<p>
	<p style="<?php echo $parrafo_space; ?>">(<?php echo $VSolicitud['flgEspCtr'];?>) Contratación Pública<p>
	<p style="<?php echo $parrafo_space; ?>">(<?php echo $VSolicitud['flgEspCiv'];?>) Civil<p>
	<p style="<?php echo $parrafo_space; ?>">(<?php echo $VSolicitud['flgEspLey'];?>) Ley General de Sociades<p>
	<p style="<?php echo $parrafo_space; ?>">(<?php echo $VSolicitud['flgEspMin'];?>) Minero<p>
	<p style="<?php echo $parrafo_space; ?>">(<?php echo $VSolicitud['flgEspCon'];?>) Concesiones<p>
	<p style="<?php echo $parrafo_space; ?>">(<?php echo $VSolicitud['flgEspOtr'];?>) Otros<p>

	<!-- 5.Narración breve de los hechos que desee someter a arbitraje:¡-->
	<p style="<?php echo $Subtitulo; ?>">5.&nbsp;&nbsp;&nbsp;&nbsp;Narración breve de los hechos que desee someter a arbitraje:<p>
	<p style="<?php echo $parrafo_space; ?>"><?php echo $VSolicitud['DesNarHec'];?><p>

	<!--6.	PRETENSIONES -->
	<p style="<?php echo $Subtitulo; ?>">6.&nbsp;&nbsp;&nbsp;&nbsp;PRETENSIONES:<span>(El petitorio debe ser determinado con claridad y precisión)</span><p>
	<table style="<?php echo $parrafo_space_table;?>">
	  <!--<tr><td><?php echo "1.".$PretensionDesc;?></td></tr>-->
	  <?php 
	  $contador=1;
	  foreach ($VPretensiones as $key => $value) {
	  	
	  	echo '<tr>
	  			<td>'.$contador.'. '.$value['desPretension'].'.</td>
	  		  </tr>';
	  	 $contador= $contador + 1; 
	  }
	 
	   ?>
	</table>
	<br>
	<!--7.	Información sobre procesos extra arbitrales  -->
	<p style="<?php echo $Subtitulo; ?>">7.&nbsp;&nbsp;&nbsp;&nbsp;Información sobre procesos extra arbitrales interpuestos ante el árbitro de emergencia o ante el órgano jurisdiccional – poder judicial ‐ sobre la materia en arbitraje:<p>
	<p style="<?php echo $parrafo_space; ?>"><?php echo $VSolicitud['DesMedCau'];?><p>
	<!--8.	CUANTIA  -->
	<p style="<?php echo $Subtitulo; ?>">8.&nbsp;&nbsp;&nbsp;&nbsp;CUANTÍA:<p>
	<p style="<?php echo $parrafo_space; ?>">Se estima que el importe controvertido en el presente arbitraje asciende a (en números y letras):<p>
	<p style="<?php echo $parrafo_space; ?>"><?php echo $VSolicitud['SimMon']." ".$VSolicitud['ImpNCuant']." ".$VSolicitud['ImpLCuant'].".";?><p>

	<!--9.	DESIGNACION DE ARBITRO -->
	<p style="<?php echo $Subtitulo; ?>">9.&nbsp;&nbsp;&nbsp;&nbsp;Designación de árbitro, de corresponder:<p>
	
	<p style="<?php echo $parrafo_space; ?>"><?php echo "Que designamos como árbitro de parte a ". $VSolicitud['ApeNomArb'] .", cuya dirección es ". $VSolicitud['DesDirArb'] .", su teléfono ".$VSolicitud['NumTelArb']." y su correo electrónico es ". $VSolicitud['DirEmaArb'].".";?><p>

	<p style="<?php echo $parrafo_space; ?>">En caso que la Parte no quiera designar directamente al Árbitro de parte, marque la siguiente opción: <p>
	<p style="<?php echo $parrafo_space; ?>"><?php echo "(".$VSolicitud['FlgPrtArb'].")"." El Centro de Arbitraje designe al árbitro de parte.";?><p>

	<p style="<?php echo $parrafo_space; ?>">En caso de Árbitro Único y no exista intención de acuerdo sobre la designación de Árbitro Único, maque la siguiente opción: <p>

	<p style="<?php echo $parrafo_space; ?>"><?php echo "(".$VSolicitud['FlgUniArb'].")"." El Centro de Arbitraje designe al árbitro Único.";?><p>

	<!--10.	DOCUMENTOS ANEXOS -->
	<p style="<?php echo $Subtitulo; ?>">10.&nbsp;&nbsp;&nbsp;&nbsp;DOCUMENTOS ANEXOS:<p>
	<table style="<?php echo $parrafo_space_table;?>">
	<?php 
	$contador=1;
	  foreach ($VAnexos as $key => $value) {
	  	echo '<tr>
	  			<td>'.$contador.'. '.$value['desanx'].'.</td>
	  		  </tr>';
	  	$contador= $contador + 1; 
	  }
	  ?>
	</table>
	<br>

	<p style="<?php echo $parrafo_rigth; ?>"><?php echo "Lima,".$diaActual." de ".$mesActual." de ".$anioActual.".";?><p>
	<p style="<?php echo $parrafo_rigth_line; ?>">_______________________<p>
	<p style="<?php echo $parrafo_rigth_firma; ?>">Firma&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p>
	<br>

	
	<!--
	<p style="<?php echo $Subtitulo; ?>">1.- NOTA PARA EFECTOS DE NOTIFICACIÓN: <p><p style="<?php echo $parrafo_space; ?>">El artículo 2 del Reglamento Procesal de Arbitraje, establece que las comunicaciones y/o notificaciones se remitirán por correo electrónico, para tal efecto, deberán de señalar la(s) cuenta(s) electrónica(s) para la notificación o comunicación correspondiente, solo de manera excepcional y debidamente justificado, se podrá notificar de manera física, por lo que, se adicionará un costo de S/ 1,200.00 (un mil doscientos y 00/100 soles), el mismo que no incluye el IGV.<p>
	!-->
	<p style="<?php echo $Subtitulo_subra; ?>">1.-&nbsp;&nbsp;&nbsp;&nbsp;NOTA PARA EFECTOS DE NOTIFICACIÓN: <p>
	<p style="<?php echo $parrafo_space; ?>">El artículo 2 del Reglamento Procesal de Arbitraje, establece que las comunicaciones y/o notificaciones se remitirá a través de Casilla Electrónica, para tal efecto, deberán de señalar la(s) cuenta(s) electrónica(s) para la notificación o comunicación correspondiente, solo de manera excepcional y debidamente justificado, se podrá notificar de manera física, por lo que, se adicionará un costo de S/ 1,500.00 (un mil quinientos y 00/100 soles), el mismo que no incluye el IGV.<p>

	<p style="<?php echo $Subtitulo_subra; ?>">2.-&nbsp;&nbsp;&nbsp;&nbsp;EN CASO SOLICITES MEDIDA CAUTELAR ANTE EL ÁRBITRO DE EMERGENCIA: <p>
	<p style="<?php echo $parrafo_space; ?>">Deberás de tener en cuenta el artículo 66 del Reglamento Procesal de Arbitraje, remitiendo tu solicitud cautelar ante la Secretaría General o en su defecto utilizando el Sistema Electrónico Arbitral.<p>


<div>