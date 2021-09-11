<?php
include 'main/sesion.php';
if (isset($_GET["empresa"])) {
    $id_empresa = $_GET["empresa"];
}
$empresa_query = mysqli_query($link, "SELECT * FROM empresa WHERE id = $id_empresa");
$empresa = mysqli_fetch_assoc($empresa_query);
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<?php $page_title = "Plantilla";
include 'main/head.php'; ?>
<link rel="stylesheet" type="text/css" href="../origen/app-assets/vendors/css/charts/apexcharts.css">
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
                <section class="simple-validation">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Editar empresa</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal" method="POST" action="empresas/acciones/editar_empresa.php" novalidate>
                                            <div class="row">
                                                <input type="hidden" value="<?php echo $id_empresa;?>" name="id_empresa">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Nombre</label>
                                                        <div class="controls">
                                                            <input type="text" name="nombre" value="<?php echo $empresa["nombre"];?>" disabled class="form-control" placeholder="Nombre" required data-validation-required-message="Campo obligatorio">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Dirección</label>
                                                        <div class="controls">
                                                            <input type="text" name="direccion" value="<?php echo $empresa["direccion"];?>" class="form-control" placeholder="Dirección" required data-validation-required-message="Campo obligatorio">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Teléfono</label>
                                                        <div class="controls">
                                                            <input type="text" name="telefono" value="<?php echo $empresa["telefono"];?>" class="form-control" placeholder="Teléfono" required data-validation-required-message="Campo obligatorio">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Correo</label>
                                                        <div class="controls">
                                                            <input type="email" name="correo" value="<?php echo $empresa["correo"];?>" class="form-control" placeholder="Correo" required data-validation-required-message="Campo obligatorio">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

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