<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/movimientos.css">
    <title>Movimientos</title>
</head>
<body>

    <div class="header">
        <img src="src/img/logo.png" alt="Logo">
        <button onclick="openRegistroMovimientos()">+</button>
    </div>

    <div class="movimientos-container">
        <h2>Movimientos</h2>

        <?php include 'movimientos_logic.php'; ?>

        <?php if (!empty($movimientos)) : ?>
            <!-- Mostrar los movimientos en una tabla -->
            <table>
                <tr>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Valor</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($movimientos as $movimiento) : ?>
                    <tr>
                        <td><?php echo $movimiento["date_bill"]; ?></td>
                        <td><?php echo $movimiento["observation"]; ?></td>
                        <td><?php echo ($movimiento["type"] == 1) ? abs($movimiento["value"]) : -$movimiento["value"]; ?></td>
                        <td>
                            <button onclick="openConsultaMovimiento(<?php echo $movimiento['id']; ?>)">Consulta</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>No hay movimientos disponibles.</p>
        <?php endif; ?>
    </div>

    <script>
        function openRegistroMovimientos() {
            window.open('registro_movimientos.html', '_blank');
        }

        function openConsultaMovimiento(idMovimiento) {
            window.open('consulta_movimiento.php?id=' + idMovimiento, '_blank');
        }
    </script>

</body>
</html>

