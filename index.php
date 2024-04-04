<?php
$output = ""; // Variable para almacenar la salida
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['codigo'])) {
    $codigo = $_POST['codigo'];

    // Guarda el código en un archivo temporal
    $nombreArchivo = tempnam(sys_get_temp_dir(), 'lisp');
    file_put_contents($nombreArchivo, $codigo);

    // Ejecuta el archivo y captura la salida
    // Asegúrate de reemplazar 'sbcl --script' con el comando adecuado para tu intérprete
    $output = shell_exec('sbcl --script ' . escapeshellarg($nombreArchivo) . ' 2>&1');

    // Elimina el archivo temporal
    unlink($nombreArchivo);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejecutar código Lisp</title>
    <!-- CodeMirror -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/scheme/scheme.min.js"></script>
    <!-- CloseBrackets Addon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/edit/closebrackets.min.js"></script>

    <!-- Bootstrap CSS para el estilo general (opcional) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://codemirror.net/5/theme/dracula.css">
    <style>
        .CodeMirror {
            border: 1px solid #eee;
            height: 300px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Ejecutar código Lisp</h2>
    <form method="post">
        <textarea id="codigo" name="codigo" rows="10"></textarea>
        <button type="submit" class="btn btn-primary mt-2">Ejecutar</button>
        <button type="button" id="descargar" class="btn btn-secondary mt-2">Descargar</button>

    </form>
    <?php if (!empty($output)): ?>
        <div class="alert alert-secondary mt-4">
            <pre><?php echo htmlspecialchars($output); ?></pre>
        </div>
    <?php endif; ?>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editor = CodeMirror.fromTextArea(document.getElementById('codigo'), {
            mode: "scheme",
            theme: "dracula",
            lineNumbers: true,
            autoCloseBrackets: true
        });

        // Encuentra el formulario
        var form = document.querySelector('form');
        form.addEventListener('submit', function() {
            // Asegúrate de actualizar el textarea antes de enviar el formulario
            document.getElementById('codigo').value = editor.getValue();
        });

        <?php if (!empty($codigo)): ?>
        // Carga el valor enviado previamente al editor
        editor.setValue(<?php echo json_encode($codigo); ?>);
        <?php endif; ?>
        // Manejador para el botón de descarga
        document.getElementById('descargar').addEventListener('click', function() {
            var contenido = editor.getValue();
            var elemento = document.createElement('a');
            elemento.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(contenido));
            elemento.setAttribute('download', 'codigo.txt');

            elemento.style.display = 'none';
            document.body.appendChild(elemento);

            elemento.click();

            document.body.removeChild(elemento);
        });
    });
</script>
<!-- Bootstrap y dependencias -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
