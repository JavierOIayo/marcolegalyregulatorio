<?php
include 'main/sesion.php';

$empresas_query = mysqli_query($link, "SELECT * FROM empresa");
$evaluadores_query = mysqli_query($link, "SELECT * FROM usuario WHERE rol = 'Evaluador' AND estado = 1");
$gerentes_query = mysqli_query($link, "SELECT * FROM usuario WHERE rol = 'Gerente' AND estado = 1");
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
                                    <h4 class="card-title">Empresas
                                        <button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#formulario_crear_empresa">
                                            Crear una empresa
                                        </button>
                                    </h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Direcci??n</th>
                                                        <th>Tel??fono</th>
                                                        <th>Correo</th>
                                                        <th>Acci??n</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($empresas = mysqli_fetch_assoc($empresas_query)) {
                                                        $estado_empresas = ($empresas["estado"] == 1) ? "success" : "danger";
                                                        echo "<tr>
                                                                <td class='$estado_empresas'>{$empresas["nombre"]}</td>
                                                                <td>{$empresas["direccion"]}</td>
                                                                <td>{$empresas["telefono"]}</td>
                                                                <td>{$empresas["correo"]}</td>
                                                                <td>
                                                                <div class='dropdown'>
                                                                    <button class='btn btn-primary dropdown-toggle mr-1' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                        Acciones
                                                                    </button>
                                                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                                        <a class='dropdown-item' href='editar_empresa.php?empresa={$empresas["id"]}'>Editar empresa</a>
                                                                        <a data-id='{$empresas["id"]}' class='dropdown-item asignar_evaluador' data-toggle='modal' data-target='#formulario_asignar_evaluador'>Asignar evaluador</a>
                                                                        <a data-id='{$empresas["id"]}' class='dropdown-item asignar_gerente' data-toggle='modal' data-target='#formulario_asignar_gerente'>Asignar gerente</a>
                                                                        <a class='dropdown-item' href='empresas/acciones/desactivar_empresa.php?empresa={$empresas["id"]}'>Desactivar empresa</a>
                                                                        <a class='dropdown-item' href='empresas/acciones/eliminar_empresa.php?empresa={$empresas["id"]}'>Eliminar empresa</a>
                                                                        <a class='dropdown-item' href='empresas/acciones/activar_empresa.php?empresa={$empresas["id"]}'>Activar empresa</a>
                                                                    </div>
                                                                </div></td>
                                                            </tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Direcci??n</th>
                                                        <th>Tel??fono</th>
                                                        <th>Correo</th>
                                                        <th>Acci??n</th>
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

                <!--FORMULARIO CREAR empresa -->
                <div class="modal fade text-left" id="formulario_crear_empresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel1">Crear empresa</h3>
                                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form" method="POST" action="empresas/acciones/crear_empresa.php">
                                    <div class="form-group">
                                        <label>Nombre:</label>
                                        <input type="text" name="nombre" required class="form-control form-control-solid" placeholder="Ingrese nombre" />
                                    </div>
                                    <div class="form-group">
                                        <label>Direcci??n:</label>
                                        <input type="text" name="direccion" required class="form-control form-control-solid" placeholder="Ingrese direcci??n" />
                                    </div>
                                    <div class="form-group">
                                        <label>Tel??fono:</label>
                                        <input type="text" name="telefono" required class="form-control form-control-solid" placeholder="Ingrese tel??fono" />
                                    </div>

                                    <div class="form-group">
                                        <label>Correo:</label>
                                        <input type="email" name="correo" required class="form-control form-control-solid" placeholder="Ingrese correo" />
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
                <!-- END FORMULARIO CREAR empresa -->

                <!--FORMULARIO ASIGNAR EVALUADOR -->
                <div class="modal fade text-left" id="formulario_asignar_evaluador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel1">Asignar evaluador</h3>
                                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form" method="POST" action="empresas/acciones/asignar_evaluador.php">
                                    <div class="form-group">
                                        <label>Evaluador:</label>
                                        <input type="hidden" name="empresa" id="empresa_evaluador" value="">
                                        <select name="evaluador" required class="form-control selectpicker" data-live-search="true">
                                            <option></option>
                                            <?php
                                            while ($evaluadores = mysqli_fetch_assoc($evaluadores_query)) {
                                                echo "<option value='{$evaluadores["id"]}'>{$evaluadores["nombre"]} {$evaluadores["apellido"]}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold">Asignar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END FORMULARIO ASIGNAR EVALUADOR -->

                <!--FORMULARIO ASIGNAR GERENTE -->
                <div class="modal fade text-left" id="formulario_asignar_gerente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel1">Asignar gerente</h3>
                                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form" method="POST" action="empresas/acciones/asignar_gerente.php">
                                    <div class="form-group">
                                        <label>Gerente:</label>
                                        <input type="hidden" name="empresa" id="empresa_gerente" value="">
                                        <select name="gerente" required class="form-control selectpicker" data-live-search="true">
                                            <option></option>
                                            <?php
                                            while ($gerentes = mysqli_fetch_assoc($gerentes_query)) {
                                                echo "<option value='{$gerentes["id"]}'>{$gerentes["nombre"]} {$gerentes["apellido"]}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold">Asignar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END FORMULARIO ASIGNAR GERENTE -->

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

    <script>
        $('.asignar_evaluador').click(function() {
            var id = $(this).data('id');
            $('#empresa_evaluador').val(id);
        })
    </script>

<script>
        $('.asignar_gerente').click(function() {
            var id = $(this).data('id');
            $('#empresa_gerente').val(id);
        })
    </script>

</body>
<!-- END: Body-->

</html>