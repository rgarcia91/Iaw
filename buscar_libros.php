<?php
require_once 'cabecera.php';

$conn = mysqli_connect($servidor, $userBD, $passwdBD, $nomBD);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (!isset($_POST['puntuacion']) || $_POST['puntuacion'] === "") {
    $consulta = "SELECT * FROM libros";
    $puntuacion_buscada = "";
} else {
    $puntuacion_buscada = (int)$_POST['puntuacion'];
    $consulta = "SELECT * FROM libros WHERE puntuacion = $puntuacion_buscada";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Libros - Biblioteca</title>
</head>
<body>
    <h2>Listado y Búsqueda de Libros</h2>

    <form action="buscar_libros.php" method="POST">
        <table border="1" cellpadding="5" cellspacing="0">
            <tr style="background-color: #f2f2f2;">
                <th>Nombre</th>
                <th>Autor</th>
                <th>ISBN</th>
                <th>Puntuación</th>
                <th>Género</th>
                <th>Acción</th>
            </tr>

            <tr>
                <td><input type="text" name="b_nombre" disabled placeholder="..."></td>
                <td><input type="text" name="b_autor" disabled placeholder="..."></td>
                <td><input type="text" name="b_isbn" disabled placeholder="..."></td>
                <td>
                    <input type="number" name="puntuacion" value="<?php echo htmlspecialchars($puntuacion_buscada); ?>">
                </td>
                <td><input type="text" name="b_genero" disabled placeholder="..."></td>
                <td><input type="submit" value="Buscar"></td>
            </tr>

            <?php
            $resultado = mysqli_query($conn, $consulta);

            if ($resultado && mysqli_num_rows($resultado) > 0) {
                while ($fila = mysqli_fetch_array($resultado)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['autor']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['isbn']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['puntuacion']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['genero']) . "</td>";
                    echo "<td></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center;'>No hay resultados.</td></tr>";
            }
            ?>
        </table>
    </form>

    <br>
    <a href="FormLibros.html">Añadir nuevo libro</a> | <a href="login.html">Volver al Login</a>
</body>
</html>
<?php
mysqli_close($conn);
?>
