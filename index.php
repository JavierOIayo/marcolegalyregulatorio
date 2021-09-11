<?php include 'auth/validate.php';?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <?php $page_title = "Login"; include 'auth/main/head.php';?>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- login page start -->
                <section id="auth-login" class="row flexbox-container">
                    <div class="col-xl-8 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Margo legal y regulatorio</h4>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="divider">
                                                    <div class="divider-text text-uppercase text-muted">
                                                        <small>Ingrese su información para iniciar sesión</small>
                                                    </div>
                                                </div>
                                                <form method="POST" novalidate>
                                                    <div class="form-group mb-50">
                                                        <div class="controls">
                                                            <label class="text-bold-600" for="usuario">Usuario</label>
                                                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required autofocus>
                                                            <span class="danger"><?php echo $usuario_err; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="text-bold-600" for="pass">Contraseña</label>
                                                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
                                                            <span class="danger"><?php echo $pass_err; ?></span>
                                                            <span class="danger"><?php echo $act_err; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                                        <div class="text-left"></div>
                                                        <!--<div class="text-right"><a href="forgot.php" class="card-link"><small>Forgot Password?</small></a></div>-->
                                                    </div>
                                                    <button type="submit" class="btn btn-primary glow w-100 position-relative">Ingresar<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                </form>
                                                <hr>
                                                <!-- <a class="btn btn-primary glow w-100 position-relative" href="members/">Olvidé mi contraseña <i id="icon-arrow" class="bx bx-right-arrow-alt"></i></a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- right section image -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <div class="card-content">
                                        <img class="img-fluid" src="origen/misfotos/logo_umg.png" alt="branding logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- login page ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!--MAIN JS-->
    <?php include 'auth/main/mainjs.php';?>
    <!--END MAIN JS-->
    
    <!--CONFIRMED EMAIL MESSAGE-->
    <?php
        if(isset($_GET["status"])){
            $status = $_GET["status"];
            if($status == "emailConfirmed"){
               echo "<script>
                    Swal.fire({
                        title: 'Email confirmed!',
                        text: 'You may now login.',
                        type: 'success',
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    });
                </script>"; 
            }else if($status == "updateSuccess"){
                echo "<script>
                    Swal.fire({
                        title: 'Your password was reset!',
                        text: 'You may now login.',
                        type: 'success',
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    });
                </script>"; 
            }
            
        }
    ?>
    <!--END CONFIRMED EMAIL MESSAGE-->
</body>
<!-- END: Body-->

</html>