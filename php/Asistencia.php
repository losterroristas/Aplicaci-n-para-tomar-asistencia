<?php
// Leer alumnos desde el archivo
$alumnosFile = __DIR__ . "/../Archivos/Alumnos.txt";
$alumnos = [];

if (file_exists($alumnosFile)) {
    $lineas = file($alumnosFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        list($legajo, $nombre, $apellido) = explode("|", $linea);
        $alumnos[] = [
            'legajo' => $legajo,
            'nombre' => $nombre,
            'apellido' => $apellido
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Asistencia</title>
</head>
<body>
    <h2>SISTEMA DE ASISTENCIA</h2>

    <form action="../GeneraArchivo.php" method="post">
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" required>
        <br><br>

        <table border="1" cellpadding="5">
            <tr>
                <th>Nro. de Legajo</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Asistencia</th>
            </tr>

            <?php foreach ($alumnos as $alumno): ?>
            <tr>
                <td><?= $alumno['legajo'] ?></td>
                <td><?= $alumno['nombre'] ?></td>
                <td><?= $alumno['apellido'] ?></td>
                <td>
                    <input type="checkbox" name="asistencia[<?= $alumno['legajo'] ?>]" value="P" checked>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <button type="submit">Confirmar</button>
        <button type="reset">Borrar</button>
    </form>
</body>
</html>
