<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belico Medellin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            display: flex;
        }

        .sidebar {
            background-color: #000;
            color: #fff;
            width: 200px;
            padding: 20px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            display: block;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #007bff;
        }

        .content {
            flex: 1;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
        }

        table {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }

        .btn-custom {
            margin: 5px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2; 
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #e6e6e6; 
        }
    </style>
</head>

<body>

    <?php
    include("conexion.php");

    // Verificar si se ha seleccionado una tabla
    $tablaSeleccionada = isset($_GET['tabla']) ? $_GET['tabla'] : '';

    // Inicializar resultados
    $resultado = [];
    if ($tablaSeleccionada) {
        switch ($tablaSeleccionada) {
            case 'usuarios':
                $resultado = mysqli_query($conexion, "SELECT * FROM usuarios");
                break;
            case 'proveedores':
                $resultado = mysqli_query($conexion, "SELECT * FROM proveedores");
                break;
            case 'clientes':
                $resultado = mysqli_query($conexion, "SELECT * FROM clientes");
                break;
            case 'locales':
                $resultado = mysqli_query($conexion, "SELECT * FROM locales");
                break;
            case 'productos':
                $resultado = mysqli_query($conexion, "SELECT * FROM productos");
                break;
            case 'inventario':
                $resultado = mysqli_query($conexion, "SELECT i.id,p.nombre,l.nombre AS Localname,i.cantidad,i.fecha_actualizacion 
                FROM inventario as i 
                Inner join productos as p ON p.id = i.producto_id
                Inner join locales as l ON l.id = i.producto_id               
                ");
                break;

        }
    }
    ?>

    <div class="sidebar">
        <h4>Menú</h4>
        <a href="#" onclick="mostrarTabla('usuarios')">Usuarios</a>
        <a href="#" onclick="mostrarTabla('proveedores')">Proveedores</a>
        <a href="#" onclick="mostrarTabla('clientes')">Clientes</a>
        <a href="#" onclick="mostrarTabla('locales')">Locales</a>
        <a href="#" onclick="mostrarTabla('productos')">Productos</a>
        <a href="#" onclick="mostrarTabla('inventario')">Inventario</a>
        <a href="agregar.php" class="btn btn-primary btn-custom">Agregar Nuevo</a>
    </div>

    <div class="content">
        <h2>Belico Medellin</h2>
        <div id="tabla-info">
            <h4>Seleccione una tabla para ver los datos.</h4>
            <?php if ($tablaSeleccionada): ?>
                <a href="agregar.php">Nuevo</a><br><br>
                <h4><?php echo ucfirst($tablaSeleccionada); ?> Actuales</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>

                        
                            <th>Id</th>

                        <?php if($tablaSeleccionada != 'inventario'): ?>
                            <th><?php echo ($tablaSeleccionada == 'usuarios' ? 'Nombre Completo' : 'Nombre'); ?></th>
                        <?php endif; ?>

                        <?php if($tablaSeleccionada != 'productos' && $tablaSeleccionada != 'inventario'): ?>
                            <th><?php echo ($tablaSeleccionada == 'usuarios' ? 'Email' : 'Teléfono'); ?></th>
                        <?php endif; ?>

                      

                        <?php if($tablaSeleccionada == 'productos'): ?>
                                    <th><?php echo ('descripcion'); ?></th>
                                    <th><?php echo ('precio'); ?></th>
                                    <th><?php echo ('categoria_id'); ?></th>
                                    <th><?php echo ('proveedor_id'); ?></th>
                                    <th><?php echo ('fecha_ingreso'); ?></th>
                        <?php endif; ?>

                        <?php if($tablaSeleccionada == 'inventario'): ?>
                                    <th><?php echo ('Producto'); ?></th>
                                    <th><?php echo ('local'); ?></th>
                                    <th><?php echo ('cantidad'); ?></th>
                                    <th><?php echo ('fecha_actualizacion'); ?></th>
                        <?php endif; ?>
                        
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($filas = mysqli_fetch_assoc($resultado)) : ?>
                            <tr>
                                <td><?php echo $filas['id']; ?></td>

                                <?php if($tablaSeleccionada != 'inventario'): ?>
                                    <td><?php echo $filas['nombre']; ?></td>
                                <?php endif; ?>

                                <?php if($tablaSeleccionada == 'productos'): ?>
                                    <td><?php echo $filas['descripcion']; ?></td>
                                    <td><?php echo $filas['precio']; ?></td>
                                    <td><?php echo $filas['categoria_id']; ?></td>
                                    <td><?php echo $filas['proveedor_id']; ?></td>
                                    <td><?php echo $filas['fecha_ingreso']; ?></td>
                                <?php endif; ?>
                                
                                <?php if($tablaSeleccionada != 'productos' && $tablaSeleccionada != 'inventario'): ?>
                                <td><?php echo $tablaSeleccionada == 'usuarios' ? $filas['email'] : $filas['telefono']; ?></td>
                                <?php endif; ?>
                               


                                <?php if($tablaSeleccionada == 'inventario'): ?>
                                    <td><?php echo $filas['nombre']; ?></td>
                                    <td><?php echo $filas['Localname']; ?></td>
                                    <td><?php echo $filas['cantidad']; ?></td>
                                    <td><?php echo $filas['fecha_actualizacion']; ?></td>
                                    
                                <?php endif; ?> 

                                <td>                         
                                <a href="editar.php?id=<?php echo $filas['id']; ?>&tabla=<?php echo $tablaSeleccionada; ?>" class="btn btn-warning btn-custom">EDITAR</a>
                                <a href='eliminar.php?id=<?php echo $filas['id']; ?>&tabla=<?php echo $tablaSeleccionada; ?>' 
                                    class='btn btn-danger btn-custom' 
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');">ELIMINAR</a>
                                </td>

                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function mostrarTabla(tabla) {
            // Redirigir a la misma página con la tabla seleccionada
            window.location.href = "?tabla=" + tabla;
        }
    </script>

    <?php
    mysqli_close($conexion);
    ?>

    <script src="https://code.jquery.com/jquery-3.5.2.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
