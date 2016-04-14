<?php 
function convertir_fecha($CampoFecha){
	if(!empty($CampoFecha)){
		if(strpos($CampoFecha,"-")){
			$conv_fecha=split("-",$CampoFecha); $conv_fecha=$conv_fecha[2]."/".$conv_fecha[1]."/".$conv_fecha[0];
		}else{
			$conv_fecha=split("/",$CampoFecha); $conv_fecha=$conv_fecha[2]."-".$conv_fecha[1]."-".$conv_fecha[0];	
		}
		return $conv_fecha;
	}
}

function calcular_fecha_llenado($dias, $mes, $anio, $dia){ 
	$ultimo_dia = date( "d", mktime(0, 0, 0, $mes + 1, 0, $anio) ) ;
	$dias_adelanto = $dias;
	$siguiente = $dia + $dias_adelanto;
	if ($ultimo_dia < $siguiente){
		 $dia_final = $siguiente - $ultimo_dia;
		 $mes++;
		 if ($mes == '13'){
			$anio++;
			$mes = '01';
		 }
		 $fecha_final = $dia_final.'/'.$mes.'/'.$anio;         
	 }else{
		 $fecha_final = $siguiente .'/'.$mes.'/'.$anio;         
	 }
	 return $fecha_final;
}
?>