<?php

require_once 'lib/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$id = $_GET["id"];
$url = "http://epsilon.pe/tramite/vistas/Plantilla_CargoSolicitudArbitral.php?id=".$id;

$html=file_get_contents_curl($url);
//$html=file_get_contents_curl("http://epsilon.pe/tramite/vistas/Plantilla_CargoSolicitudArbitral.php");

$pdf = new DOMPDF();
$pdf->set_paper('A4', 'portrait');
$pdf->load_html($html, 'UTF-8');
$pdf->render();
$pdf->stream("Cargo_de_tramite.pdf");

function file_get_contents_curl($url){

	$crl=curl_init();
	$timeout = 5;
	curl_setopt($crl,CURLOPT_URL,$url);
	curl_setopt($crl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($crl,CURLOPT_CONNECTTIMEOUT,$timeout);
	$ret = curl_exec($crl);
	curl_close($crl);
	return $ret;
}

?>