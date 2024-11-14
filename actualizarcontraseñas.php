<?php
include('conexion.php');

$sql = "SELECT id, clave FROM usuarios";
$result = mysqli_query($conexion, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $claveActual = $row['clave'];

        // Verificar si la contraseña no está cifrada
        if (strlen($claveActual) !== 60) {
            $nuevaClaveCifrada = password_hash($claveActual, PASSWORD_DEFAULT);

            // Actualizar la contraseña cifrada en la base de datos
            $updateSql = "UPDATE usuarios SET clave = '$nuevaClaveCifrada' WHERE id = $id";
            $updateResult = mysqli_query($conexion, $updateSql);

            if (!$updateResult) {
                echo "Error al actualizar la contraseña para el usuario con ID $id: " . mysqli_error($conexion);
            } else {
                echo "Contraseña actualizada correctamente para el usuario con ID $id<br>";
            }
        }
    }
} else {
    echo "Error al obtener los usuarios: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
