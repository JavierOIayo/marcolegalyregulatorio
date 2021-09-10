<?php
include 'main/sesion.php';

$evaluacion_query = mysqli_query($link, "SELECT evaluacion.*, empresa.nombre AS empresa, ley.nombre AS ley FROM evaluacion, empresa, ley WHERE evaluacion.id_empresa = empresa.id AND evaluacion.id_ley = ley.id");
$empresas_query = mysqli_query($link, "SELECT * FROM empresa WHERE estado = 1");
$leyes_query = mysqli_query($link, "SELECT * FROM ley WHERE estado = 1");
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<?php $page_title = "Plantilla";
include 'main/head.php'; ?>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">

    <!-- BEGIN: Header-->
    <?php include 'main/top_nav.php'; ?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <?php include 'main/menu.php'; ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!--MAIN CONTENT-->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Evaluaciones
                                        <button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#formulario_crear_evaluacion">
                                            Crear una evaluación
                                        </button>
                                    </h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>Empresa</th>
                                                        <th>ley evaluada</th>
                                                        <th>Estado</th>
                                                        <th>Fecha de inicio</th>
                                                        <th>Fecha de finalización</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($evaluaciones = mysqli_fetch_assoc($evaluacion_query)) {
                                                        // $estado_evaluaciones = ($evaluaciones["estado"] == 1) ? "success" : "danger";
                                                        $fecha_inicio = date_format(date_create($evaluaciones["fecha_inicio"]), "d-m-Y");
                                                        $fecha_final = "";
                                                        if (!empty($evaluaciones["fecha_final"])) {
                                                            $fecha_final = date_format(date_create($evaluaciones["fecha_final"]), "d-m-Y");
                                                        }

                                                        echo "<tr>
                                                                <td>{$evaluaciones["empresa"]}</td>
                                                                <td>{$evaluaciones["ley"]}</td>
                                                                <td>{$evaluaciones["estado"]}</td>
                                                                <td>$fecha_inicio</td>
                                                                <td>$fecha_final</td>
                                                                <td>
                                                                <div class='dropdown'>
                                                                    <button class='btn btn-primary dropdown-toggle mr-1' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                        Acciones
                                                                    </button>
                                                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                                        <a class='dropdown-item' href='evaluar_articulos.php?evaluacion={$evaluaciones["id"]}'>Evaluar Artículos</a>    
                                                                        <a class='dropdown-item' href='evaluaciones/acciones/finalizar_evaluacion.php?evaluacion={$evaluaciones["id"]}'>Finalizar evaluación</a>
                                                                    </div>
                                                                </div></td>
                                                            </tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Empresa</th>
                                                        <th>ley evaluada</th>
                                                        <th>Estado</th>
                                                        <th>Fecha de inicio</th>
                                                        <th>Fecha de finalización</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!--FORMULARIO CREAR LEY -->
                <div class="modal fade text-left" id="formulario_crear_evaluacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel1">Crear evaluación</h3>
                                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form" method="POST" action="evaluaciones/acciones/crear_evaluacion.php">
                                    <div class="form-group">
                                        <label>Empresa:</label>
                                        <select name="empresa" required class="form-control selectpicker" data-live-search="true">
                                            <option></option>
                                            <?php
                                            while ($empresas = mysqli_fetch_assoc($empresas_query)) {
                                                echo "<option value='{$empresas["id"]}'>{$empresas["nombre"]}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ley:</label>
                                        <select name="ley" required class="form-control selectpicker" data-live-search="true">
                                            <option></option>
                                            <?php
                                            while ($leyes = mysqli_fetch_assoc($leyes_query)) {
                                                echo "<option value='{$leyes["id"]}'>{$leyes["nombre"]}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold">Crear</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END FORMULARIO CREAR LEY -->

                <!--END MAIN CONTENT-->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php include 'main/footer.php'; ?>
    <!-- END: Footer-->


    <!--MAIN JS-->
    <?php include 'main/main_js.php' ?>;
    <!--END MAIN JS-->

</body>
<!-- END: Body-->

</html>