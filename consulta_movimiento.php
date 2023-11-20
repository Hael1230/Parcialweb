<?php
// Verificar si se proporcionó un ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idMovimiento = $_GET['id'];

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

    // Consulta SQL para obtener la información del movimiento
    $sql = "SELECT * FROM bill WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idMovimiento);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $movimiento = $result->fetch_assoc();
    } else {
        // Redirigir a movimientos.php si no se encuentra el movimiento
        header("Location: movimientos.php");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirigir a movimientos.php si no se proporcionó un ID válido
    header("Location: movimientos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/consulta_movimiento.css">
    <title>Consulta de Movimiento</title>
</head>
<body>

    <div class="consulta-container">
        <h2>Consulta de Movimiento</h2>

        <table>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Tipo de Gasto</th>
                <th>Valor</th>
            </tr>
            <tr>
                <td><?php echo $movimiento["date_bill"]; ?></td>
                <td><?php echo $movimiento["observation"]; ?></td>
                <td><?php echo ($movimiento["type"] == 1) ? 'Ingreso' : 'Gasto'; ?></td>
                <td><?php echo ($movimiento["type"] == 1) ? abs($movimiento["value"]) : -$movimiento["value"]; ?></td>
            </tr>
        </table>

        <div class="acciones-container">
            <button onclick="cancelarConsulta()">Cancelar</button>
            <button onclick="eliminarMovimiento(<?php echo $movimiento['id']; ?>)">Eliminar</button>
        </div>
    </div>

    <script>
        function cancelarConsulta() {
            window.close();
        }

        function eliminarMovimiento(idMovimiento) {
            // Puedes implementar aquí la lógica para eliminar el movimiento de la base de datos
            alert('Implementa la lógica para eliminar el movimiento con ID ' + idMovimiento);
        }
    </script>

</body>
</html>
