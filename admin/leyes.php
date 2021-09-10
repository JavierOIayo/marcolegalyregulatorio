<?php
include 'main/sesion.php';

$leyes_query = mysqli_query($link, "SELECT * FROM ley");
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
                                    <h4 class="card-title">Leyes
                                        <button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#formulario_crear_ley">
                                            Crear una ley
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
                                                        <th>Descripción</th>
                                                        <th>Fecha</th>
                                                        <th>País</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($leyes = mysqli_fetch_assoc($leyes_query)) {
                                                        $estado_leyes = ($leyes["estado"] == 1) ? "success" : "danger";
                                                        echo "<tr>
                                                                <td class='$estado_leyes'>{$leyes["nombre"]}</td>
                                                                <td>{$leyes["descripcion"]}</td>
                                                                <td>{$leyes["fecha"]}</td>
                                                                <td>{$leyes["pais"]}</td>
                                                                <td>
                                                                <div class='dropdown'>
                                                                    <button class='btn btn-primary dropdown-toggle mr-1' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                        Acciones
                                                                    </button>
                                                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                                        <a class='dropdown-item' href='leyes/acciones/desactivar_ley.php?ley={$leyes["id"]}'>Desactivar ley</a>
                                                                        <a class='dropdown-item' href='leyes/acciones/eliminar_ley.php?ley={$leyes["id"]}'>Eliminar ley</a>
                                                                        <a class='dropdown-item' href='leyes/acciones/activar_ley.php?ley={$leyes["id"]}'>Activar ley</a>
                                                                    </div>
                                                                </div></td>
                                                            </tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Descripción</th>
                                                        <th>Fecha</th>
                                                        <th>País</th>
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
                <div class="modal fade text-left" id="formulario_crear_ley" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel1">Crear ley</h3>
                                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form" method="POST" action="leyes/acciones/crear_ley.php">
                                    <div class="form-group">
                                        <label>Nombre:</label>
                                        <input type="text" name="nombre" required class="form-control form-control-solid" placeholder="Ingrese nombre" />
                                    </div>
                                    <div class="form-group">
                                        <label>Descripción:</label>
                                        <input type="text" name="descripcion" required class="form-control form-control-solid" placeholder="Ingrese descripción" />
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha:</label>
                                        <input type="date" name="fecha" required class="form-control form-control-solid" placeholder="Ingrese fecha" />
                                    </div>
                                    <div class="form-group">
                                        <label>País:</label>
                                        <input type="text" name="pais" required class="form-control form-control-solid" placeholder="Ingrese país" />
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