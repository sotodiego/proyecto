<?php
require("../../conexion.php");
require ("../../scripts/restringir_acceso.php");
$idvac = $_GET['idvac'];
$consulta = mysql_query("SELECT * FROM vacunas WHERE id_vacuna='$idvac'");
$fila = mysql_fetch_array($consulta);
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
                    <form action="../Vacunacion/vacunacion_adulto.php" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="cedula" class="form-control" placeholder="Cédula..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
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
                             <a href="../Usuarios/editar_usuario.php?idusu=<?php echo $_SESSION['idusu']; ?>">
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
                        <div class="row">
                            <div class="col-md-12">
                                <section class="panel panel-info">
                                    <header class="panel-heading">
                                        Editar Vacuna
                                    </header>
                                    <div class="panel-body">
                                        <form class="form-group" role="form" name="form1" id="form1" method="post" action="../../scripts/editar_vac.php?idvac=<?php echo $fila['id_vacuna']; ?>">

                                            <div class="form-group col-sm-6 ">
                                                <label class="sr-only" >Códido</label>
                                                <input name="codigo_vac" type="text" class="form-control" value="<?php echo $fila['codigo_vac']; ?>" title="Código" id="codigo_vac" placeholder="Código...">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="sr-only" >Nombre vacuna</label>
                                                <input name="nombre_vac" type="text" class="form-control" value="<?php echo $fila['nombre_vac']; ?>" title="Nombre de vacuna" id="nombre_vac" placeholder="Nombre de vacuna...">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="sr-only" >Abreviatura</label>
                                                <input name="abreviatura_vac" type="text" class="form-control" value="<?php echo $fila['abreviatura_vac']; ?>" title="Abreviatura" id="abreviatura_vac" placeholder="Abreviatura...">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <select class="form-control ui dropdown" name="frecuencia_vac" id="frecuencia_vac">
                                                    <option value="<?php echo $fila['frecuencia_vac']; ?>"><?php echo "Periodo de Vacunación: " . $fila['frecuencia_vac']; ?></option>
                                                    <?php for ($i = 1; $i <= 24; $i++) { ?>
                                                        <option><?php echo $i; ?></option>
<?php } ?>

                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <input name="cantidad_ref" type="text" class="form-control" value="<?php echo$fila['cantidad_ref']; ?>" title="Cantidad refuerzos" id="cantidad_ref" placeholder="Cantidad de refuerzos...">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label class="sr-only" >Observaciones</label>
                                                <input name="observacion_vac" type="text" class="form-control" value="<?php echo $fila['observacion_vac']; ?>" title="Observaciones" id="observacion_vac" placeholder="Observaciones...">
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <button type="submit" class="btn btn-success" >Registrar</button>

                                            </div>
                                        </form>

                                    </div>
                                </section>
                            </div>
                        </div>
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

        <script>             $(function () {
                $("#datepicker").datepicker();
            });</script>      </body>
    <!-- InstanceEnd --></html>