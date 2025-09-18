<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['fecha'])) {
        die("Error: Debe seleccionar una fecha.");
    }

    $fecha = $_POST['fecha']; // viene como YYYY-MM-DD
    $asistencias = $_POST['asistencia'] ?? [];

    // Convertir a formato 
    $fechaLatina = date("d_m_Y", strtotime($fecha));
    $nombreArchivo = $fechaLatina . ".txt";
    $rutaArchivo = __DIR__ . "/../Archivos/" . $nombreArchivo;

    // Leer alumnos
    $alumnosFile = __DIR__ . "/../Archivos/Alumnos.txt";
    $lineas = file($alumnosFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $contenido = "Fecha: " . date("d/m/Y", strtotime($fecha)) . PHP_EOL; // encabezado con la fecha
    foreach ($lineas as $linea) {
        list($legajo, $nombre, $apellido) = explode("|", $linea);
        $presente = isset($asistencias[$legajo]) ? "P" : "A";
        $contenido .= $legajo . "|" . $presente . PHP_EOL;
    }

    // Guardar archivo
    file_put_contents($rutaArchivo, $contenido);

    echo "Archivo generado: " . htmlspecialchars($nombreArchivo);
    echo "<br><a href='Asistencia.php'>Volver</a>";
}
