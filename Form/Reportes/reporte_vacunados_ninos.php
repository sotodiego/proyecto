<?php
require("../../conexion.php");
require ("../../scripts/restringir_acceso.php");
require ("../../scripts/recibir_variables.php");
include ("../../scripts/funciones.php");

if (!empty($chkcedula)) {
    $criterio0 = " cedula_pac LIKE '" . $cedula . "' '%'";
}
if (!empty($chkedad)) {
    if (!empty($criterio0)) {
        $criterio1 = " AND";
    }
    $criterio1 = $criterio1 . " edad_bebe <= '" . $edad . "' '%'";
}
if (!empty($chksexo)) {
    if (!empty($criterio1) || !empty($criterio0)) {
        $criterio2 = " AND";
    }
    $criterio2 = $criterio2 . " sexo_bebe LIKE '" . $sexo . "' '%'";
}
if (!empty($chkfecha)) {
    if (!empty($criterio1) || !empty($criterio0) || !empty($criterio2)) {
        $criterio3 = " AND";
    }
    $criterio3 = $criterio3 . " fecha_salida >='" . $fecha1 . "' AND fecha_salida <='" . $fecha2 . "'";
}
if (!empty($chkhijos)) {
    if (!empty($criterio1) || !empty($criterio0) || !empty($criterio2) || !empty($criterio3)) {
        $criterio4 = " AND";
    }
    $criterio4 = $criterio4 . " hijos LIKE '" . $hijos . "' '%'";
}
if (!empty($chkingresos)) {
    if (!empty($criterio1) || !empty($criterio0) || !empty($criterio2) || !empty($criterio3) || !empty($criterio4)) {
        $criterio5 = " AND";
    }
    $criterio5 = $criterio5 . " ingresos LIKE '" . $ingresos . "' '%'";
}
if (!empty($chkdiscapacidad)) {
    if (!empty($criterio1) || !empty($criterio0) || !empty($criterio2) || !empty($criterio3) || !empty($criterio4) || !empty($criterio5)) {
        $criterio6 = " AND";
    }
    $criterio6 = $criterio6 . " p_discapacidad LIKE '" . $discapacidad . "' '%'";
}
if (!empty($chkn_ingresos)) {
    if (!empty($criterio1) || !empty($criterio0) || !empty($criterio2) || !empty($criterio3) || !empty($criterio4) || !empty($criterio5) || !empty($criterio6)) {
        $criterio7 = " AND";
    }
    $criterio7 = $criterio7 . " monto_familiar <= '" . $n_ingresos . "'";
}
if (!empty($chkgrupo)) {
    if (!empty($criterio1) || !empty($criterio0) || !empty($criterio2) || !empty($criterio3) || !empty($criterio4) || !empty($criterio5) || !empty($criterio6) || !empty($criterio7)) {
        $criterio8 = " AND";
    }
    $criterio8 = $criterio8 . " grupo LIKE '" . $grupo . "' '%'";
}
if (!empty($criterio0) || !empty($criterio1) || !empty($criterio2) || !empty($criterio3) || !empty($criterio4) || !empty($criterio5) || !empty($criterio6) || !empty($criterio7) || !empty($criterio8)) {
    $criterio = " AND " . $criterio0 . $criterio1 . $criterio2 . $criterio3 . $criterio4 . $criterio5 . $criterio6 . $criterio7 . $criterio8;
}
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_listado = 15;
$pageNum_listado = 0;
if (isset($_GET['pageNum_listado'])) {
    $pageNum_listado = $_GET['pageNum_listado'];
}
$startRow_listado = $pageNum_listado * $maxRows_listado;

mysql_select_db($database_conexion, $conexion);
$query_listado = "SELECT * FROM salida_inventario, registro_bebes, pacientes WHERE salida_inventario.id_bebe=registro_bebes.id_bebe AND registro_bebes.id_paciente=pacientes.id_paciente" . $criterio;
$query_limit_listado = sprintf("%s LIMIT %d, %d", $query_listado, $startRow_listado, $maxRows_listado);
$listado = mysql_query($query_limit_listado, $conexion) or die(mysql_error());
$row_listado = mysql_fetch_assoc($listado);

if (isset($_GET['totalRows_listado'])) {
    $totalRows_listado = $_GET['totalRows_listado'];
} else {
    $all_listado = mysql_query($query_listado);
    $totalRows_listado = mysql_num_rows($all_listado);
}
$totalPages_listado = ceil($totalRows_listado / $maxRows_listado) - 1;

$queryString_listado = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum_listado") == false &&
                stristr($param, "totalRows_listado") == false &&
                stristr($param, "chkcedula") == false &&
                stristr($param, "chkedad") == false &&
                stristr($param, "chksexo") == false &&
                stristr($param, "chkfecha") == false &&
                stristr($param, "chkhijos") == false &&
                stristr($param, "chkingresos") == false &&
                stristr($param, "chkdiscapacidad") == false &&
                stristr($param, "chkn_ingresos") == false &&
                stristr($param, "cedula") == false &&
                stristr($param, "edad") == false &&
                stristr($param, "sexo") == false &&
                stristr($param, "fecha1") == false &&
                stristr($param, "fecha2") == false &&
                stristr($param, "hijos") == false &&
                stristr($param, "ingresos") == false &&
                stristr($param, "discapacidad") == false &&
                stristr($param, "n_ingresos") == false &&
                stristr($param, "grupo") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString_listado = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_listado = sprintf("&chkcedula=%d&chkedad=%d&chksexo=%d&chkfecha=%d&chkhijos=%d&chkingresos=%d&chkdiscapacidad=%d&chkn_ingresos=%d&chkgrupo=%s&cedula=%s&edad=%s&sexo=%s&fecha1=%s&fecha2=%s&hijos=%s&ingresos=%s&discapacidad=%s&n_ingresos=%s&grupo=%s&totalRows_listado=%d%s", $chkcedula, $chkedad, $chksexo, $chkfecha, $chkhijos, $chkingresos, $chkdiscapacidad, $chkn_ingresos, $chkgrupo, $cedula, $edad, $sexo, $fecha1, $fecha2, $hijos, $ingresos, $discapacidad, $n_ingresos, $grupo, $totalRows_listado, $queryString_listado);
?>

<?php include '../../scripts/totales.php'; ?> <!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/index.dwt.php" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta charset="UTF-8">
        <!-- InstanceBeginEditable name="doctitle" -->
        <title>Control vacunas | Inicio</title>
        <!-- InstanceEndEditable -->
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="Developed By M Abdur Rokib Promy">
        <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="../../css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="../../css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="../../css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <!-- <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->
        <!-- Daterange picker -->

        <!-- iCheck for checkboxes and radio inputs -->
        <link href="../../css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <!-- <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <!-- Theme style -->
        <link href="../../css/style.css" rel="stylesheet" type="text/css" />



        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->

        <style type="text/css">

        </style>
        <!-- InstanceBeginEditable name="head" -->
        <!-- InstanceEndEditable -->
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="../../index.html" class="logo" >
                Panel de control </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">                         <div style="float:left">                             <img src="../../img/cintillo.png"  height="50" width="100%">                         </div>

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php echo $_SESSION['nickusu']; ?>  <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="dropdown-header text-center">Cuenta</li>



                                <li class="divider"></li>

                                <li>
                                     <a href="../Usuarios/editar_usuario.php?idusu=<?php echo $_SESSION['idusu']; ?>">
                                        <i class="fa fa-user fa-fw pull-right"></i>
                                        Perfil
                                    </a>
                                    <a data-toggle="modal" href="#">
                                        
                                       
                                    </a>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="../../login_index.php"><i class="fa fa-ban fa-fw pull-right"></i> Cerrar sesi�n</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->

                    <!-- search form -->
                    <!--                    <form action="../Vacunacion/vacunacion_adulto.php" method="get" class="sidebar-form">
                                            <div class="input-group">
                                                <input type="text" name="cedula2" class="form-control" placeholder="Cédula..."/>
                                                <span class="input-group-btn">
                                                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </form>-->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="../../index.php">
                                <i class="fa fa-dashboard"></i> <span>Inicio</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Pacientes/agregar_paciente.php">
                                <i class="fa fa-plus-square"></i> <span>Pacientes</span>
                            </a>
                        </li>

                        <li>
                            <a href="../Vacunas/agregar_vacuna.php">
                                <i class="glyphicon glyphicon-plus-sign"></i> <span>Vacunas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Inventario/listado_cantidad.php">
                                <i class="fa fa-medkit"></i> <span>Inventario Vacunas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Vacunacion/buscar_paciente.php">
                                <i class="glyphicon glyphicon-plus-sign"></i> <span>Vacunar pacientes</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Reportes/menu_reporte.php">
                                <i class="glyphicon glyphicon-list-alt"></i> <span>Reportes</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Mantenimiento/menu.php">
                                <i class="glyphicon glyphicon-cog"></i> <span>Mantenimiento del sistema</span>
                            </a>
                        </li>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <aside class="right-side">

                <!-- Main content -->
                <section class="content">

                    <div class="row" style="margin-bottom:5px;">


                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-red"><i class="fa fa-hospital-o"></i></span>
                                <div class="sm-st-info">

                                    <span><?php echo $fila1['total']; ?></span>Total vacunas aplicadas
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-violet"><i class="fa fa-medkit"></i></span>
                                <div class="sm-st-info">

                                    <span><?php echo $fila2['total_inventario']; ?></span>Total vacunas en inventario
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-blue"><i class="fa fa-plus-square"></i></span>
                                <div class="sm-st-info">

                                    <span><?php echo $fila3['total_pac'] + $fila4['total_bebe']; ?></span>Total pacientes registrados
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Main row -->
                    <EditableRegion>

                        <div class="col-md-10">
                            <div class="panel panel-info">
                                <header class="panel-heading">
                                    Niños vacunados
                                </header>
                                <form name="form1" id="form1" action="">
                                    <table class="table table-condensed">
                                        <tr class="form-group col-sm-12 ">

                                            <td> 
                                                <input type="checkbox" name="chkcedula" id="chkcedula" class=" list-child" value="1" onclick="
                                                        javascript: document.form1.cedula.value = '';
                                                        document.form1.cedula.disabled = !document.form1.chkcedula.checked;" <?php
                                                       if ($chkcedula == 1) {
                                                           echo "checked='checked'";
                                                       }
                                                       ?>/>
                                            </td>
                                            <td>
                                                <input name="cedula" type="text" class="form-control" id="cedula" placeholder="Cédula representante..." 
                                                       value="<?php echo $cedula; ?>" 
                                                       <?php if (empty($chkcedula)) { ?>
                                                           disabled="disabled"
                                                       <?php } ?>>
                                            </td>
                                            <td> 
                                                <input type="checkbox" name="chkedad" id="chkedad" class=" list-child" value="1" onclick="
                                                        javascript: document.form1.edad.value = '';
                                                        document.form1.edad.disabled = !document.form1.chkedad.checked;" <?php
                                                       if ($chkedad == 1) {
                                                           echo "checked='checked'";
                                                       }
                                                       ?>/>
                                            </td>
                                            <td>
                                                <input name="edad" type="text" class="form-control" id="edad" placeholder="Edad menor a..." 
                                                       value="<?php echo $edad; ?>" 
                                                       <?php if (empty($chkedad)) { ?>
                                                           disabled="disabled"
                                                       <?php } ?>>
                                            </td>
                                            <td> 
                                                <input type="checkbox" name="chksexo" id="chksexo" class=" list-child" value="1" onclick="
                                                        javascript: document.form1.sexo.value = '';
                                                        document.form1.sexo.disabled = !document.form1.chksexo.checked;" <?php
                                                       if ($chksexo == 1) {
                                                           echo "checked='checked'";
                                                       }
                                                       ?>/>
                                            </td>
                                            <td>
                                                <input name="sexo" type="text" class="form-control" id="sexo" placeholder="Sexo..." 
                                                       value="<?php echo $sexo; ?>" 
                                                       <?php if (empty($chksexo)) { ?>
                                                           disabled="disabled"
                                                       <?php } ?>>
                                            </td>
                                            <td> 
                                                <input type="checkbox" name="chkfecha" id="chkfecha" class=" list-child" value="1" onclick="javascript: document.form1.fecha1.value = '';
                                                        document.form1.fecha1.disabled = !document.form1.chkfecha.checked;
                                                        document.form1.fecha2.value = '';
                                                        document.form1.fecha2.disabled = !document.form1.chkfecha.checked;
                                                        document.form1.chkfecha2.checked = !document.form1.chkfecha.checked;" <?php
                                                       if ($chkfecha == 1) {
                                                           echo "checked='checked'";
                                                       }
                                                       ?>/>
                                            </td>
                                            <td>
                                                <input name="fecha1" type="text" class="form-control" id="fecha1" placeholder="Desde..." 
                                                       value="<?php echo $fecha1; ?>" 
                                                       <?php if (empty($chkfecha1)) { ?>
                                                           disabled="disabled"
                                                       <?php } ?>>
                                            </td>
                                            <td>
                                                <input name="fecha2" type="text" class="form-control" id="fecha2" placeholder="Hasta..." 
                                                       value="<?php echo $fecha2; ?>" 
                                                       <?php if (empty($chkfecha2)) { ?>
                                                           disabled="disabled"
                                                       <?php } ?>>
                                            </td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>
                                                <span class="input-group-btn">
                                                    <button type='submit' name='button' id='search-btn' value="Buscar" class="btn btn-flat"><i class="fa fa-search"></i></button>
                                                </span>
                                            </td>
                                        </tr>
                                    </table>


                            </div>
                            </form>
                            <div class="panel-body">

                                <table class="table table-hover table-striped">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Nº partida</th>
                                        <th colspan="2">Opciones</th>
                                    </tr>
                                    <div class = "alert alert-warning ">

                                        <button data-dismiss = "alert" class = "close close-sm" type = "button">
                                            <i class = "fa fa-times"></i>
                                        </button>
                                        Registros encontrados:  <?php echo $totalRows_listado; ?>
                                    </div>

                                    <?php if ($totalRows_listado > 0) { // Show if recordset not empty    ?>
                                        <?php
                                        do {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td scope="row"><?php echo $i; ?></td>
                                                <td><?php echo $row_listado['nombre_bebe']; ?></td>
                                                <td><?php echo $row_listado['apellido_bebe']; ?></td>
                                                <td><?php echo $row_listado['partida_bebe']; ?></td>
                                                <td><a href="../Vacunacion/listado_bebes_vacunados.php?id_paciente=<?php echo $row_listado['id_paciente']; ?>"<span>Ver vacunas</span></a></td>
                                                <td><a href="../Bebes/ver_bebe.php?id_bebe=<?php echo $row_listado['id_bebe']; ?>"<span>Información</span></a></td>
                                            </tr>
                                        <?php } while ($row_listado = mysql_fetch_assoc($listado)); ?>
                                    <?php } // Show if recordset not empty         ?>
                                    <div class="box-tools">
                                        <ul class="pagination pagination-sm m-b-10 m-t-10 pull-right">
                                            <li><?php if ($pageNum_listado > 0) { // Show if not first page              ?><a href="<?php printf("%s?pageNum_listado=%d%s", $currentPage, 0, $queryString_listado); ?>">Inicio</a>  <?php } // Show if not first page              ?></li>
                                            <li><?php if ($pageNum_listado > 0) { // Show if not first page            ?><a href="<?php printf("%s?pageNum_listado=%d%s", $currentPage, max(0, $pageNum_listado - 1), $queryString_listado); ?>">Atras</a> <?php } // Show if not first page            ?></li>
                                            <li><?php if ($pageNum_listado < $totalPages_listado) { // Show if not last page           ?><a href="<?php printf("%s?pageNum_listado=%d%s", $currentPage, min($totalPages_listado, $pageNum_listado + 1), $queryString_listado); ?>">Siguiente</a><?php } // Show if not last page           ?></li>
                                            <li><?php if ($pageNum_listado < $totalPages_listado) { // Show if not last page          ?><a href="<?php printf("%s?pageNum_listado=%d%s", $currentPage, $totalPages_listado, $queryString_listado); ?>">Final</a> <?php } // Show if not last page          ?></li>
                                        </ul>
                                    </div>

                                </table>
                            </div><!-- /.panel-body -->
                        </div><!-- /.panel -->


                        </div><!-- /.col -->
                    </EditableRegion>

                    <!-- row end -->
                </section><!-- /.content -->
                <div class="footer-main">
                    Ambulatorio Cerromar 2016
                </div>
            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="../../js/jquery.min.js" type="text/javascript"></script>

        <!-- jQuery UI 1.10.3 -->
        <script src="../../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

        <script src="../../js/plugins/chart.js" type="text/javascript"></script>

        <!-- datepicker
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
        <!-- Bootstrap WYSIHTML5
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->
        <!-- iCheck -->
        <script src="../../js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- calendar -->
        <script src="../../js/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>

        <!-- Director App -->
        <script src="../../js/Director/app.js" type="text/javascript"></script>

        <!-- Director dashboard demo (This is only for demo purposes) -->
        <script src="../../js/Director/dashboard.js" type="text/javascript"></script>
        <script>
                                                    $(function () {
                                                        $("#datepicker").datepicker();
                                                    });
        </script>   
    </body>
    <!-- InstanceEnd --></html>