<?php
include 'main/sesion.php';

if (isset($_GET["evaluacion"])) {
    $id_evaluacion = $_GET["evaluacion"];
}

$evaluacion_query = mysqli_query($link, "SELECT evaluacion_articulos.*, articulo.nombre AS articulo FROM evaluacion_articulos, articulo WHERE id_evaluacion = $id_evaluacion AND evaluacion_articulos.id_articulo = articulo.id");

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
                            <form method="POST" action="evaluaciones/acciones/ingresar_evaluacion.php" enctype='multipart/form-data'>
                            <input type="hidden" name="evaluacion_id" value="<?php echo $id_evaluacion;?>">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Evaluar artículos
                                            <button type="submit" class="btn btn-outline-primary block">
                                                Guardar cambios
                                            </button>
                                        </h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body card-dashboard">
                                            <div class="table-responsive">
                                                <table class="table zero-configuration">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Artículo</th>
                                                            <th>Evidencia</th>
                                                            <th>Evaluación</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $num = 0;
                                                        while ($evaluaciones = mysqli_fetch_assoc($evaluacion_query)) {
                                                            $num++;
                                                            
                                                            if (empty($evaluaciones["evidencia"])) {
                                                                $evidencia = "";
                                                            } else {
                                                                $evidencia = "<a class='btn btn-icon btn-warning mr-1 mb-1' href='evaluaciones/evidencias/evidencia_$id_evaluacion/{$evaluaciones["evidencia"]}' target='_blank'><i class='bx bx-file'></i></a>";
                                                            }
                                                            $noCumple_select = ($evaluaciones["punteo"] == 0) ? "selected" : NULL ;
                                                            $cumple_select = ($evaluaciones["punteo"] == 1) ? "selected" : NULL ;
                                                            $cumpleParcialmente_select = ($evaluaciones["punteo"] == 0.5) ? "selected" : NULL ;
                                                            if (!empty($evaluaciones["articulo"])) {
                                                                $punteo = "<select name='punteo[]' disabled>
                                                                        <option value='0' $noCumple_select>No cumple</option>
                                                                        <option value='1' $cumple_select>Cumple</option>
                                                                        <option value='0.5' $cumpleParcialmente_select>Cumple parcialmente</option>";
                                                            } else {
                                                                $punteo = "<a href='{$evaluaciones["punteo"]}' target='_blank'>{$evaluaciones["punteo"]}</a>";
                                                            }
                                                            
                                                            echo "<tr>
                                                                <td>
                                                                    $num
                                                                    <input name='id_evaluacion[]' type='hidden' value='{$evaluaciones["id"]}'>
                                                                    <input name='eval_id' type='hidden' value='$id_evaluacion'>
                                                                    <input name='articulo_evaluado[]' type='hidden' value='{$evaluaciones["articulo"]}'>
                                                                </td>
                                                                <td><a href='#' data-id='{$evaluaciones["id_articulo"]}' class='ver_articulo'>{$evaluaciones["articulo"]}</a></td>
                                                                <td><input type='file' name='evidencia[]'>$evidencia</td>
                                                                <td>$punteo</td>
                                                            </tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Artículo</th>
                                                            <th>Evidencia</th>
                                                            <th>Evaluación</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

                <!--FORMULARIO CREAR LEY -->
                <div class="modal fade text-left" id="informacion_articulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel1">Crear evaluación</h3>
                                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- DESCRIPCIÓN DEL ARTÍCULO -->
                                <!-- END DESCRIPCIÓN DEL ARTÍCULO -->
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
    <script>
        $('.ver_articulo').on('click', function() {
            var id = $(this).data('id');
            $('.modal-body').load('evaluaciones/acciones/ver_articulo.php?articulo=' + id, function() {
                $('#informacion_articulo').modal({
                    show: true
                });
            });
        });
    </script>
</body>
<!-- END: Body-->

</html>