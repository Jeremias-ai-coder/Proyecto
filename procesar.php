<?php
// Verificamos que los datos hayan llegado por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Recibir y sanitizar los datos
    
    // trim(): Elimina espacios en blanco al principio y al final.
    // htmlspecialchars(): Convierte caracteres especiales en entidades HTML (evita inyecciones de código XSS).
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    
    // filter_var() con FILTER_SANITIZE_EMAIL: Elimina todos los caracteres ilegales de un correo.
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    
    $direccion = htmlspecialchars(trim($_POST['direccion']));
    
    // filter_var() con FILTER_SANITIZE_NUMBER_INT: Deja solo los números, eliminando letras o símbolos.
    $edad = filter_var($_POST['edad'], FILTER_SANITIZE_NUMBER_INT);
    
    $usuario = htmlspecialchars(trim($_POST['usuario']));
    
    // Las contraseñas NO se sanitizan modificando sus caracteres porque podríamos alterarlas.
    // Solo le sacamos los espacios accidentales al inicio/fin. En la vida real, acá se encriptan (ej: password_hash).
    $contrasena = trim($_POST['contrasena']);
    $repetir_contrasena = trim($_POST['repetir_contrasena']);

    // 2. Pequeña validación extra en PHP
    if ($contrasena !== $repetir_contrasena) {
        die("Error: Las contraseñas no coinciden. Vuelve atrás e inténtalo de nuevo.");
    }

    // 3. Mostrar los resultados limpios para la exposición
    echo "<h2>¡Usuario procesado con éxito!</h2>";
    echo "<p><strong>Datos recibidos y sanitizados:</strong></p>";
    echo "<ul>";
    echo "<li><strong>Nombre:</strong> " . $nombre . "</li>";
    echo "<li><strong>E-mail:</strong> " . $email . "</li>";
    echo "<li><strong>Dirección:</strong> " . $direccion . "</li>";
    echo "<li><strong>Edad:</strong> " . $edad . "</li>";
    echo "<li><strong>Usuario:</strong> " . $usuario . "</li>";
    echo "</ul>";
    
    echo "<p><em>Nota: Las contraseñas coinciden y están listas para ser encriptadas.</em></p>";

} else {
    // Si alguien intenta entrar a procesar.php directamente por la URL, lo rebotamos.
    echo "Acceso no permitido.";
}
?>