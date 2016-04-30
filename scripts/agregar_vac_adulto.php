<?php

$fecha = date("Y-m-d");
require("../conexion.php");
require ("restringir_acceso.php");
$vacunado = $_POST['vacunado'];
$id_vacuna = $_POST['id_vacuna'];
$id_paciente = $_GET['id_paciente'];
//echo $vacunado;
for ($i = 0; $i <= count($vacunado); $i++) {
    if ($vacunado[$i] != "") {
//        echo $vacunado[$i];
        $existe = mysql_query(" SELECT * FROM vacunacion_adultos,vacunas WHERE vacunas.id_vacuna=vacunacion_adultos.id_vacuna AND vacunacion_adultos.id_paciente = '$id_paciente' AND vacunacion_adultos.id_vacuna = $vacunado[$i]")or die(mysql_error());
        $existe_fila = mysql_fetch_array($existe);
        $nombre_vac = $existe_fila['nombre_vac'];
        $cant = mysql_num_rows($existe);
        if ($cant > 0) {
            echo "<script> alert('La vacuna $nombre_vac ya existe en el paciente '); location.href='../Form/Vacunacion/vacunacion_adulto.php?id_paciente=$id_paciente';</script>";
            exit;
        } else {
            $guardar = mysql_query("INSERT INTO vacunacion_adultos VALUES(
            '',
        '1',  
        '$fecha',  
        '$id_paciente',
        '$vacunado[$i]'
        )") or die(mysql_error());
//Insertando fechas para los refuerzos
            $cantidad_vacunas = mysql_query("SELECT * FROM vacunas WHERE id_vacuna='$vacunado[$i]'") or die(mysql_error());
            $cant_ref = mysql_fetch_array($cantidad_vacunas);

            $periodo = ($cant_ref['frecuencia_vac']);
            $cantidad_ref = $cant_ref['cantidad_ref'];
            $c = $periodo;
            for ($r = 1; $r <= $cantidad_ref; $r++) {

                $fecha_prox = date('Y-m-d', strtotime('+' . $periodo . ' month'));

                $guardar_ref = mysql_query("INSERT INTO refuerzo_vacunas VALUES('','$fecha_prox','0','$vacunado[$i]','$id_paciente','0')") or die(mysql_error());
                $periodo = $periodo + $c;
            }
//Fin refuerzos
//Descuentos de cantidad de vacunas
            $consulta = mysql_query("SELECT * FROM entrada_vacunas WHERE id_entrada='$vacunado[$i]'") or die(mysql_error());
            $fila = mysql_fetch_array($consulta);
            $resta = $fila['cantidad_entrada'] - 1;
            $editar = mysql_query("UPDATE entrada_vacunas SET cantidad_entrada='$resta' WHERE id_entrada='$vacunado[$i]'") or die(mysql_error());
//Salida
            $existe_salida_inventario = mysql_query(" SELECT * FROM salida_inventario WHERE id_paciente = '$id_paciente'")or die(mysql_error());
            $cant_salida_inv = mysql_num_rows($existe_salida_inventario);
            $fila_salida_inv = mysql_fetch_array($existe_salida_inventario);

            $contador +=count($vacunado[$i]);
            if (($contador == 1) && ($cant_salida_inv == 0)) {
                // $salida = mysql_query("INSERT INTO salida_vacunas VALUES('','$contador','$fecha','$id_paciente','0')") or die(mysql_error());
                $salida_inventario = mysql_query("INSERT INTO salida_inventario VALUES('','$contador','$id_paciente','0')") or die(mysql_error());
            } else {

                if ($cant_salida_inv > 0) {
                    $contador2 = count($vacunado[$i]);
                    $total = $contador2 + $fila_salida_inv['cantidad_salida'];
                    //$actualizar = mysql_query("UPDATE salida_vacunas SET cantidad_salida='$contador2' WHERE id_paciente='$id_paciente' AND fecha_salida='$fecha'") or die(mysql_error());
                    $actualizar_salida = mysql_query("UPDATE salida_inventario SET cantidad_salida='$total' WHERE id_paciente='$id_paciente'") or die(mysql_error());
                }
            }
            //Ingresar la fecha de las vacunas aplicadas al paciente
            $salida_vacunas = mysql_query("INSERT INTO salida_vacunas VALUES('','$fecha','$id_paciente','0','$vacunado[$i]')") or die(mysql_error());
        }
    }
}

header("location:../Form/Vacunacion/listado_adultos.php?idmsg=1");
