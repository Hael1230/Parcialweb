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
    $descripcion = $_POST['descripcion'];
    $tipo_ingreso = $_POST['tipo_ingreso'];
    $valor = $_POST['valor'];

    // Si el tipo de ingreso es gasto, hacer el valor negativo
    if ($tipo_ingreso == 'gasto') {
        $valor = -$valor;
    }

    // Consulta SQL para insertar el nuevo movimiento
    $sql = "INSERT INTO bill (date_bill, user_id, value, type, observation) VALUES (NOW(), 1, ?, 1, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $valor, $descripcion);

    if ($stmt->execute()) {
        // Movimiento registrado con éxito
        header("Location: movimientos.php");
        exit();
    } else {
        // Error al registrar el movimiento
        echo "Error al registrar el movimiento. Inténtalo de nuevo.";
    }

    $stmt->close();
}

$conn->close();
?>
