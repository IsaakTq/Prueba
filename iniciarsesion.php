<?php
session_start();
include('conexion.php');

if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $Usuario = validate($_POST['usuario']);
    $Clave = validate($_POST['clave']);

    if (empty($Usuario)) {
        header("Location: index.php?error=El Usuario es requerido");
        exit();
    } elseif (empty($Clave)) {
        header("Location: index.php?error=La Clave es requerida");
        exit();
    } else {
        $Sql = "SELECT * FROM usuarios WHERE usuario = '$Usuario'";
        $result = mysqli_query($conexion, $Sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                if (password_verify($Clave, $row['clave'])) {
                    $_SESSION['usuario'] = $row['usuario'];
                    $_SESSION['rol'] = $row['rol'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['nombre'] = $row['nombre'];
                
                    // Añade esta condición para redirigir según el rol
                    if ($_SESSION['rol'] == 'administrador') {
                        header("Location: admin.php");
                    } elseif ($_SESSION['rol'] == 'usuario') {
                        header("Location: home.php");
                    }
                } else {
                    header("Location: index.php?error=Clave incorrecta");
                    exit();
                }
            } else {
                header("Location: index.php?error=El Usuario no existe");
                exit();
            }
        } else {
            die('Error en la consulta: ' . mysqli_error($conexion));
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>