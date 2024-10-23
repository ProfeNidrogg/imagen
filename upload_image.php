<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagen'])) {
    $nombre_archivo = basename($_FILES['imagen']['name']);
    $ruta_destino = "uploads/" . $nombre_archivo;

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
        $stmt = $pdo->prepare('INSERT INTO imagenes (nombre_archivo, ruta_archivo) VALUES (?, ?)');
        $stmt->execute([$nombre_archivo, $ruta_destino]);
        echo "<div class='alert alert-success'>Imagen subida exitosamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al subir la imagen.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #preview {
            margin-top: 20px;
            max-width: 100%;
            height: auto;
            display: none;
            border: 1px solid #ddd;
            padding: 5px;
        }
    </style>
</head>
<body>
<?php include ("menu.php"); ?>
    <div class="container mt-5">
        <h1>Subir Nueva Imagen</h1>
        <form action="upload_image.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="imagen">Seleccionar Imagen</label>
                <input type="file" name="imagen" id="imagen" class="form-control-file" accept="image/*" required onchange="previewImage(event)">
            </div>
            <img id="preview" src="" alt="Vista previa de la imagen">
            <button type="submit" class="btn btn-primary mt-3">Subir Imagen</button>
        </form>
    </div>

</body>
</html>

