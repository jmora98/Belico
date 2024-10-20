<?php
include("conexion.php");

if (isset($_GET['id']) && isset($_GET['tabla'])) {
    $id = $_GET['id'];
    $tabla = $_GET['tabla'];

    $query = mysqli_query($conexion, "SELECT * FROM $tabla WHERE id='$id'");
    if ($query) {
        $registro = mysqli_fetch_assoc($query);
    } else {
        die("Error al obtener el registro: " . mysqli_error($conexion));
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $campos = [];
        foreach ($_POST as $key => $value) {
            if ($key !== 'id' && $key !== 'tabla') {
                $campos[] = "$key='" . mysqli_real_escape_string($conexion, $value) . "'";
            }
        }

        $update_query = "UPDATE $tabla SET " . implode(", ", $campos) . " WHERE id='$id'";
        if (mysqli_query($conexion, $update_query)) {
            header("Location: index.php?tabla=$tabla");
            exit();
        } else {
            die("Error al actualizar: " . mysqli_error($conexion));
        }
    }

    $columnas_query = mysqli_query($conexion, "SHOW COLUMNS FROM $tabla");
    if (!$columnas_query) {
        die("Error al obtener las columnas: " . mysqli_error($conexion));
    }
    $columnas = [];
    while ($fila = mysqli_fetch_assoc($columnas_query)) {
        $columnas[] = $fila['Field'];
    }
} else {
    die("ID o tabla no definidos en la URL.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar <?php echo ucfirst($tabla); ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Editar <?php echo ucfirst($tabla); ?></h2>
    <form method="POST">
        <?php foreach ($columnas as $columna): ?>
            <?php if ($columna !== 'id'):?>
                <div class="form-group">
                    <label for="<?php echo $columna; ?>"><?php echo ucfirst($columna); ?></label>
                    <input type="text" class="form-control" name="<?php echo $columna; ?>" value="<?php echo $registro[$columna]; ?>" required>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="tabla" value="<?php echo $tabla; ?>">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>
