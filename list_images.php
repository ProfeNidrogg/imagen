<?php
require 'db_connect.php';

$stmt = $pdo->query('SELECT * FROM imagenes ORDER BY fecha_subida DESC');
$imagenes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Imágenes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            width: 100%; /* Ajusta la imagen al ancho de la tarjeta */
            height: 200px; /* Tamaño fijo para la altura de las imágenes */
            object-fit: cover; /* Mantiene la proporción de la imagen y cubre el área del contenedor */
        }
    </style>
</head>
<body>
<?php include ("menu.php"); ?>
    <div class="container mt-5">
        <h1>Imágenes Subidas</h1>
        <div class="row">
            <?php foreach ($imagenes as $imagen): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <a href="#" data-toggle="modal" data-target="#modalImagen" data-imagen="<?= htmlspecialchars($imagen['ruta_archivo']); ?>">
                            <img src="<?= htmlspecialchars($imagen['ruta_archivo']); ?>" class="card-img-top" alt="<?= htmlspecialchars($imagen['nombre_archivo']); ?>">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($imagen['nombre_archivo']); ?></h5>
                            <p class="card-text">Subido el: <?= htmlspecialchars($imagen['fecha_subida']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalImagen" tabindex="-1" role="dialog" aria-labelledby="modalImagenLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalImagenLabel">Previsualización de Imagen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="imagenModal" src="" alt="Imagen" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
