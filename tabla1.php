<?php
$inicio = 50;
$fin = 60;
$maxDivisor = 10;
$colores = ["#ffffaa", "#ffd9b3"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Divisores del <?php echo $inicio; ?> al <?php echo $fin; ?></title>
    <style>
        table { border-collapse: separate; border-spacing: 3px; }
        th, td { border: 1px solid #333; padding: 4px 8px; min-width: 22px; }
        th { background-color: #ccaaff; font-weight: normal; }
        th.esquina { background-color: #7a7aff; }
    </style>
</head>
<body>
    <table>
        <tr>
            <th class="esquina"></th>
            <?php
            for ($n = $inicio; $n <= $fin; $n++) {
                echo "<th>$n</th>";
            }
            ?>
        </tr>
        <?php
        for ($d = 1; $d <= $maxDivisor; $d++) {
            $color = $colores[($d - 1) % 2];
            echo "<tr style=\"background-color: $color\">";
            echo "<th>$d</th>";
            for ($n = $inicio; $n <= $fin; $n++) {
                if ($n % $d == 0) {
                    echo "<td>*</td>";
                } else {
                    echo "<td>-</td>";
                }
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

