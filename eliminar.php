<?php
include("conexion.php");

// Verificar si se ha proporcionado un ID y una tabla
if (isset($_GET['id']) && isset($_GET['tabla'])) {
    $id = $_GET['id'];
    $tabla = $_GET['tabla'];

    // Eliminar registros dependientes si es necesario
    if ($tabla === 'proveedores') {
        // Eliminar productos asociados al proveedor
        $deleteProductos = "DELETE FROM productos WHERE proveedor_id='$id'";
        mysqli_query($conexion, $deleteProductos);
    }

    // Realizar la eliminación
    $query = "DELETE FROM $tabla WHERE id='$id'";
    if (mysqli_query($conexion, $query)) {
        // Redirigir después de eliminar
        header("Location: index.php?tabla=$tabla");
        exit();
    } else {
        die("Error al eliminar el registro: " . mysqli_error($conexion));
    }
} else {
    die("ID o tabla no definidos en la URL.");
}
?>
