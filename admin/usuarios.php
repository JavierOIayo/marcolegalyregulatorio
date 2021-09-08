<?php
include 'main/sesion.php';

$usuarios_query = mysqli_query($link, "SELECT * FROM usuario");
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
                                    <h4 class="card-title">Usuarios
                                        <button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#formulario_crear_usuario">
                                            Crear usuario
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
                                                        <th>Apellido</th>
                                                        <th>Correo</th>
                                                        <th>Rol</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($usuarios = mysqli_fetch_assoc($usuarios_query)) {
                                                        $estado_usuario = ($usuarios["estado"] == 1) ? "success" : "danger";
                                                        echo "<tr>
                                                                <td>{$usuarios["nombre"]}</td>
                                                                <td>{$usuarios["apellido"]}</td>
                                                                <td class='$estado_usuario'>{$usuarios["correo"]}</td>
                                                                <td>{$usuarios["rol"]}</td>
                                                                <td>
                                                                <div class='dropdown'>
                                                                    <button class='btn btn-primary dropdown-toggle mr-1' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                        Acciones
                                                                    </button>
                                                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                                        <a class='dropdown-item' href='usuarios/acciones/hacer_administrador.php?usuario={$usuarios["id"]}'>Hacer administrador</a>
                                                                        <a class='dropdown-item' href='usuarios/acciones/hacer_evaluador.php?usuario={$usuarios["id"]}'>Hacer evaluador</a>
                                                                        <a class='dropdown-item' href='usuarios/acciones/hacer_gerente.php?usuario={$usuarios["id"]}'>Hacer gerente</a>
                                                                        <a class='dropdown-item' href='usuarios/acciones/desactivar_usuario.php?usuario={$usuarios["id"]}'>Desactivar usuario</a>
                                                                        <a class='dropdown-item' href='usuarios/acciones/eliminar_usuario.php?usuario={$usuarios["id"]}'>Eliminar usuario</a>
                                                                        <a class='dropdown-item' href='usuarios/acciones/activar_usuario.php?usuario={$usuarios["id"]}'>Activar usuario</a>
                                                                        <a class='dropdown-item' href='usuarios/acciones/reiniciar_pass.php?usuario={$usuarios["id"]}'>Reiniciar contraseña</a>
                                                                    </div>
                                                                </div></td>
                                                            </tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Apellido</th>
                                                        <th>Correo</th>
                                                        <th>Rol</th>
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

                <!--FORMULARIO CREAR USUARIO -->
                <div class="modal fade text-left" id="formulario_crear_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel1">Crear usuario</h3>
                                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form" method="POST" action="usuarios/acciones/crear_usuario.php">
                                    <div class="form-group">
                                        <label>Nombre:</label>
                                        <input type="text" name="nombre" required class="form-control form-control-solid" placeholder="Ingrese nombre" />
                                    </div>
                                    <div class="form-group">
                                        <label>Apellido:</label>
                                        <input type="text" name="apellido" required class="form-control form-control-solid" placeholder="Ingrese apellido" />
                                    </div>
                                    <div class="form-group">
                                        <label>Correo:</label>
                                        <input type="text" name="correo" required class="form-control form-control-solid" placeholder="Ingrese correo" />
                                    </div>
                                    <div class="form-group">
                                        <label>Rol:</label>
                                        <select name="rol" required class="form-control selectpicker" data-live-search="true">
                                            <option></option>
                                            <option>Administrador</option>
                                            <option>Evaluador</option>
                                            <option>Gerente</option>
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
                <!-- END FORMULARIO CREAR USUARIO -->

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