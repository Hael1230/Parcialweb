<?php
// Configuración de la base de datos
$servername = "fanny.db.elephantsql.com";
$username = "jnvgnqqv";
$password = "aTo0Yykrx9nCmRavmYFsikv_usQtfOen";
$dbname = "jnvgnqqv";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recuperar datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar las credenciales (usando parámetros preparados para evitar SQL injection)
    $sql = "SELECT * FROM users WHERE username=? AND pass=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Inicio de sesión exitoso
        echo "Inicio de sesión exitoso. ¡Bienvenido!";
    } else {
        // Credenciales incorrectas
        echo "Nombre de usuario o contraseña incorrectos. Inténtalo de nuevo.";
    }

    $stmt->close();
}

$conn->close();
?>
