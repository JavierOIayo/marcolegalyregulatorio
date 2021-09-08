<!-- BEGIN: Vendor JS-->
<script src="../origen/app-assets/vendors/js/vendors.min.js"></script>
<script src="../origen/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
<script src="main/js/LivIconsEvo.default.js"></script>
<script src="../origen/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="../origen/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script src="../origen/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="../origen/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<script src="../origen/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
<script src="../origen/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>

<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="../origen/app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
<script src="../origen/app-assets/js/core/app-menu.js"></script>
<script src="../origen/app-assets/js/core/app.js"></script>
<script src="../origen/app-assets/js/scripts/components.js"></script>
<script src="../origen/app-assets/js/scripts/footer.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="../origen/app-assets/js/scripts/extensions/sweet-alerts.js"></script>
<script src="../origen/app-assets/js/scripts/datatables/datatable.js"></script>
<script src="../origen/app-assets/js/scripts/forms/validation/form-validation.js"></script>

<!-- END: Page JS-->

<?php
function alertas($pStatus, $pTitulo, $pMsg)
{
    echo "<script>Swal.fire('$pTitulo', '$pMsg', '$pStatus');</script>";
}

if (isset($_GET["status"]) && isset($_GET["titulo"]) && isset($_GET["msg"])) {
    $status = $_GET["status"];
    $titulo = $_GET["titulo"];
    $msg = $_GET["msg"];
    alertas($status, $titulo, $msg);
    echo "<script>window.history.replaceState(null, null, '?login');</script>";
}

echo $dbAlert;
?>