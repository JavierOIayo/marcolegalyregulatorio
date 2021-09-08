<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$usuario = $pass = "";
$usuario_err = $pass_err = $act_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_GET["usuario"])) {
        $usuario = $_GET["usuario"];
    }

    // Check if pass is empty
    if (empty(trim($_POST['pass']))) {
        $pass_err = 'La contraseña es obligatoria';
    } else {
        $pass = trim($_POST['pass']);
    }

    if (empty(trim($_POST['pass2']))) {
        $pass_err = 'La contraseña es obligatoria';
    } else {
        $pass2 = trim($_POST['pass']);
    }

    if ($pass == $pass2) {
        $nueva_pass = password_hash($pass2, PASSWORD_DEFAULT);
        $actualizar_contraseña = mysqli_query($link, "UPDATE usuario SET pass = '$nueva_pass', estado = 1 WHERE correo = '$usuario'");
    } else {
        $pass_err = 'La contraseña no coincide';
    }



    // Validate credentials
    if (empty($pass_err)) {
        // Prepare a select statement
        $query = "SELECT * FROM usuario WHERE correo = '$usuario'";
        $sql = "SELECT correo, pass FROM usuario WHERE correo = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_usuario);

            // Set parameters
            $param_usuario = $usuario;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if usuario exists, if yes then verify pass
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $usuario, $hashed_pass);
                    if (mysqli_stmt_fetch($stmt)) {

                        if (password_verify($pass, $hashed_pass)) {
                            $result = mysqli_query($link, $query);
                            $data = mysqli_fetch_array($result);
                            if ($data['estado'] == 1 && $data['rol'] == "Administrador") {
                                /* pass is correct, so start a new session and
                                save the usuario to the session */
                                session_start();
                                $_SESSION['admin'] = array();
                                $_SESSION['admin']["usuario"] = $usuario;
                                $_SESSION['admin']["nombre"] = $data['nombre'];
                                $_SESSION['admin']["apellido"] = $data['apellido'];
                                $_SESSION['admin']["id"] = $data['id'];

                                if (isset($_GET["continue"])) {
                                    header("Location: " . $_GET["continue"]);
                                } else {
                                    header("location: admin/");
                                }
                            } else if ($data['estado'] == 1 && $data['rol'] == "Evaluador") {
                                session_start();
                                $_SESSION['evaluador'] = $usuario;

                                if (isset($_GET["continue"])) {
                                    header("Location: " . $_GET["continue"]);
                                } else {
                                    header("location: evaluador/");
                                }
                            } else if ($data['estado'] == 1 && $data['rol'] == "Gerente") {
                                session_start();
                                $_SESSION['gerente'] = $usuario;

                                if (isset($_GET["continue"])) {
                                    header("Location: " . $_GET["continue"]);
                                } else {
                                    header("location: gerente/");
                                }
                            } else if ($data['estado'] == 2) {

                                header("location: reset_pass.php?usuario=$usuario");
                            } else if ($data['estado'] == 0) {
                                $usuario_err = 'Usuario está inactivo';
                            }
                        } else {
                            $usuario_err = 'Usuario o contraseña incorrecta';
                        }
                    }
                } else {
                    $usuario_err = 'Usuario o contraseña incorrecta';
                }
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
