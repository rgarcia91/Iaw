<?php
header("Content-Type: text/html; charset=UTF-8");

include("recupera.php");

$inicio = 50;
$fin = 60;

$colores = ["#ffffe0", "#ffdead"];

$num1 = recupera("num1");
$num2 = recupera("num2");

if (!is_numeric($num1) || !is_numeric($num2)
    || $num1 < 1 || $num1 > 10 || $num2 < 10 || $num2 > 20)
{
    print "Valores no válidos. <a href=\"tabla1.html\">Volver al formulario</a>";
    exit;
}

$num1 = (int) $num1;
$num2 = (int) $num2;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Divisores del <?php print $inicio; ?> al <?php print $fin; ?></title>
    <style>
        table { border-collapse: collapse; border: 2px solid green; }
        th, td { border: 2px solid green; padding: 4px 8px; min-width: 22px; }
        th { background-color: #dda0dd; }
        th.fila { font-weight: normal; }
        th.esquina { background-color: #6495ed; }
    </style>
</head>
<body>
    <table>
        <tr>
            <th class="esquina"></th>
<?php
for ($n = $inicio; $n <= $fin; $n++)
    print "            <th>$n</th>\n";
?>
        </tr>
<?php
for ($d = $num1; $d <= $num2; $d++)
{
    $color = $colores[($d - $num1) % 2];
    print "        <tr style=\"background-color: $color\">\n";
    print "            <th class=\"fila\">$d</th>\n";
    for ($n = $inicio; $n <= $fin; $n++)
    {
        if ($n % $d == 0)
            print "            <td>*</td>\n";
        else
            print "            <td>-</td>\n";
    }
    print "        </tr>\n";
}
?>
    </table>
    <p><a href="tabla1.html">Volver al formulario</a></p>
</body>
</html>
