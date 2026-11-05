<?php
require_once 'cabecera.php';

$conn = mysqli_connect($servidor, $userBD, $passwdBD, $nomBD);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (isset($_POST['usuario']) && isset($_POST['clave'])) {

    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);

    $clave_md5 = md5($_POST['clave']);

    $consulta = sprintf("SELECT * FROM usuarios WHERE nombre='%s' AND clave='%s'", $usuario, $clave_md5);

    $resultado = mysqli_query($conn, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        echo "<h3>¡Autenticación correcta! Bienvenido, " . htmlspecialchars($usuario) . ".</h3>";
    } else {
        echo "<h3 style='color:red;'>Usuario o contraseña incorrectos.</h3>";
        echo "<a href='login.html'>Volver a intentar</a>";
    }
} else {
    echo "No se han recibido los datos del formulario.";
}

mysqli_close($conn);
?>
