<?php
require_once 'cabecera.php';

echo "<h3>Datos recibidos por POST (Modo Desarrollo):</h3>";
echo "<pre>";
print_r($_POST);
echo "</pre><hr>";

$conn = mysqli_connect($servidor, $userBD, $passwdBD, $nomBD);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (isset($_POST['isbn'])) {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $autor = mysqli_real_escape_string($conn, $_POST['autor']);
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $puntuacion = (int)$_POST['puntuacion'];
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);

    $consulta_comprobar = sprintf("SELECT id FROM libros WHERE isbn='%s'", $isbn);

    echo "<p>Consulta comprobación: <code>$consulta_comprobar</code></p>";

    $resultado = mysqli_query($conn, $consulta_comprobar);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        echo "<h3 style='color:red;'>Error: Ya existe un libro en la base de datos con el ISBN $isbn.</h3>";
    } else {
        $consulta_insertar = sprintf(
            "INSERT INTO libros (nombre, autor, isbn, puntuacion, genero) VALUES ('%s', '%s', '%s', %d, '%s')",
            $nombre, $autor, $isbn, $puntuacion, $genero
        );

        echo "<p>Consulta inserción: <code>$consulta_insertar</code></p>";

        if (mysqli_query($conn, $consulta_insertar)) {
            echo "<h3 style='color:green;'>Libro '$nombre' añadido correctamente a la biblioteca.</h3>";
        } else {
            echo "<h3 style='color:red;'>Error al guardar: " . mysqli_error($conn) . "</h3>";
        }
    }
} else {
    echo "<p>No se han recibido los datos del formulario.</p>";
}

echo "<br><a href='FormLibros.html'>Añadir otro libro</a>";

mysqli_close($conn);
?>
