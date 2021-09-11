<?php
include 'main/sesion.php';
if (isset($_GET["empresa"])) {
    $id_empresa = $_GET["empresa"];
}else {
    $id_empresa = 0;
}
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
                <form method="POST" action="reportes/acciones/ver_graficas.php">
                <label>Empresa</label>
                    <select name="empresa" required class="form-group form-control">
                        <option></option>
                        <?php
                        echo $id_empresa;
                            $empresas_query = mysqli_query($link, "SELECT * FROM empresa WHERE estado = 1");
                            while ($empresas = mysqli_fetch_assoc($empresas_query)) {
                                echo "<option value='{$empresas["id"]}'>{$empresas["nombre"]}</option>";
                            }
                        ?>
                    </select>
                    <input type="submit" value="Ver" class="btn btn-primary">
                    <br><br>
                </form>
                <section id="apexchart">
                    <div class="row">
                        <!-- Pie Chart -->
                        <?php
                        $script_pie = "";
                        $evaluaciones_progreso_query = mysqli_query($link, "SELECT evaluacion.*, empresa.nombre AS empresa, ley.nombre AS ley FROM evaluacion, empresa, ley WHERE evaluacion.estado = 'En progreso' AND evaluacion.id_empresa = empresa.id AND evaluacion.id_empresa = $id_empresa AND evaluacion.id_ley = ley.id");
                        while ($evaluaciones_progreso = mysqli_fetch_assoc($evaluaciones_progreso_query)) {
                            echo "<div class='col-lg-6 col-md-12'>
                            <div class='card'>
                                <div class='card-header'>
                                    <h4 class='card-title'><a href='evaluar_articulos.php?evaluacion={$evaluaciones_progreso["id"]}'>{$evaluaciones_progreso["empresa"]}<br>{$evaluaciones_progreso["ley"]}</a></h4>
                                </div>
                                <div class='card-content'>
                                    <div class='card-body'>
                                        <div id='pie-chart_{$evaluaciones_progreso["id"]}' class='d-flex justify-content-center'></div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                            $punteos_query = mysqli_query($link, "SELECT COUNT(punteo) AS punteo FROM evaluacion_articulos WHERE id_evaluacion = {$evaluaciones_progreso["id"]} GROUP BY punteo");

                            $script_pie .= "var pieChartOptions = {
                            chart: {
                                type: 'pie',
                                height: 320
                            },
                            colors: themeColors,
                            labels: ['No cumple', 'Parcialmente', 'Cumple'],
                            series: [";
                            while ($punteos = mysqli_fetch_assoc($punteos_query)) {
                                $script_pie .= $punteos["punteo"] . ",";
                            }
                            $script_pie .= "],
                            legend: {
                                itemMargin: {
                                    horizontal: 2
                                },
                            },
                            responsive: [{
                                breakpoint: 576,
                                options: {
                                    chart: {
                                        width: 300
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }]
                        }
                        var pieChart = new ApexCharts(
                            document.querySelector('#pie-chart_{$evaluaciones_progreso["id"]}'),
                            pieChartOptions
                        );
                        pieChart.render();";
                        }

                        ?>
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
    <script src="../origen/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script>
        $(document).ready(function() {

            var $primary = '#5A8DEE',
                $success = '#39DA8A',
                $danger = '#FF5B5C',
                $warning = '#FDAC41',
                $info = '#00CFDD',
                $label_color_light = '#E6EAEE';

            var themeColors = [$primary, $warning, $danger, $success, $info];

            <?php echo $script_pie; ?>
        });
    </script>
    <!--END MAIN JS-->

</body>
<!-- END: Body-->

</html>