<?php
include 'main/sesion.php';
$admins_query = mysqli_query($link, "SELECT COUNT(id) AS administrador FROM usuario WHERE rol = 'Administrador'");
$gerente_query = mysqli_query($link, "SELECT COUNT(id) AS gerente FROM usuario WHERE rol = 'Gerente'");
$evaluador_query = mysqli_query($link, "SELECT COUNT(id) AS evaluador FROM usuario WHERE rol = 'Evaluador'");
$empresa_query = mysqli_query($link, "SELECT COUNT(id) AS empresa FROM empresa WHERE estado = 1");
$evaluacion_query = mysqli_query($link, "SELECT COUNT(id) AS evaluacion FROM evaluacion WHERE estado = 'En progreso'");
$ley_query = mysqli_query($link, "SELECT COUNT(id) AS ley FROM ley WHERE estado = 1");

$admins = mysqli_fetch_assoc($admins_query);
$gerente = mysqli_fetch_assoc($gerente_query);
$evaluador = mysqli_fetch_assoc($evaluador_query);
$empresa = mysqli_fetch_assoc($empresa_query);
$evaluacion = mysqli_fetch_assoc($evaluacion_query);
$ley = mysqli_fetch_assoc($ley_query);
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

                <section id="widgets-Statistics">
                    <div class="row">
                        <div class="col-12 mt-1 mb-2">
                            <h4>Estadísticas</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <div class="card text-center">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="badge-circle badge-circle-lg badge-circle-light-info mx-auto my-1">
                                            <i class="bx bx-user font-medium-5"></i>
                                        </div>
                                        <p class="text-muted mb-0 line-ellipsis">Administradores</p>
                                        <h2 class="mb-0"><?php echo $admins["administrador"];?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <div class="card text-center">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="badge-circle badge-circle-lg badge-circle-light-warning mx-auto my-1">
                                            <i class="bx bx-user font-medium-5"></i>
                                        </div>
                                        <p class="text-muted mb-0 line-ellipsis">Evaluadores</p>
                                        <h2 class="mb-0"><?php echo $evaluador["evaluador"];?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <div class="card text-center">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto my-1">
                                            <i class="bx bx-user font-medium-5"></i>
                                        </div>
                                        <p class="text-muted mb-0 line-ellipsis">Gerentes</p>
                                        <h2 class="mb-0"><?php echo $gerente["gerente"];?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <div class="card text-center">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                            <i class="bx bx-buildings font-medium-5"></i>
                                        </div>
                                        <p class="text-muted mb-0 line-ellipsis">Empresas</p>
                                        <h2 class="mb-0"><?php echo $empresa["empresa"];?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <div class="card text-center">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto my-1">
                                            <i class="bx bx-chart font-medium-5"></i>
                                        </div>
                                        <p class="text-muted mb-0 line-ellipsis">Evaluación</p>
                                        <h2 class="mb-0"><?php echo $evaluacion["evaluacion"];?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <div class="card text-center">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto my-1">
                                            <i class="bx bx-briefcase font-medium-5"></i>
                                        </div>
                                        <p class="text-muted mb-0 line-ellipsis">Leyes</p>
                                        <h2 class="mb-0"><?php echo $ley["ley"];?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="apexchart">
                    <div class="row">
                        <!-- Pie Chart -->
                        <?php
                        $script_pie = "";
                        $evaluaciones_progreso_query = mysqli_query($link, "SELECT evaluacion.*, empresa.nombre AS empresa FROM evaluacion, empresa WHERE evaluacion.estado = 'En progreso' AND evaluacion.id_empresa = empresa.id");
                        while ($evaluaciones_progreso = mysqli_fetch_assoc($evaluaciones_progreso_query)) {
                            echo "<div class='col-lg-6 col-md-12'>
                            <div class='card'>
                                <div class='card-header'>
                                    <h4 class='card-title'>{$evaluaciones_progreso["empresa"]}</h4>
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