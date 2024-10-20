<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Almacén de Ropa</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
        <!-- SAVE Usuarios -->
        <?php
  
    include("conexion.php");

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tipo = $_POST['tipo']; 

        switch ($tipo) {
            case 'Usuario': 
                $nombre = $_POST['nombre'];
                $email = $_POST['email'];
                $contraseña = $_POST['contraseña'];

                $sql = "INSERT INTO usuarios (nombre, email, contraseña) 
                        VALUES ('$nombre', '$email', '$contraseña')";
                break;

            case 'Proveedor': 
                $nombre = $_POST['nombre_proveedor'];
                $direccion = $_POST['direccion_proveedor'];
                $telefono = $_POST['telefono_proveedor'];

                $sql = "INSERT INTO proveedores (nombre, direccion, telefono) 
                        VALUES ('$nombre', '$direccion', '$telefono')";
                break;

            case 'Cliente': 
                $nombre = $_POST['nombre_cliente'];
                $direccion = $_POST['direccion_cliente'];
                $telefono = $_POST['telefono_cliente'];

                $sql = "INSERT INTO clientes (nombre, direccion, telefono) 
                        VALUES ('$nombre', '$direccion', '$telefono')";
                break;

            case 'Local': 
                $nombre = $_POST['nombre_local'];
                $direccion = $_POST['direccion_local'];
                $telefono = $_POST['telefono_local'];

                $sql = "INSERT INTO locales (nombre, direccion, telefono) 
                        VALUES ('$nombre', '$direccion', '$telefono')";
                break;

            case 'Producto': 
                $nombre = $_POST['nombre_producto'];
                $precio = $_POST['precio_producto'];
                $categoria = $_POST['categoria_producto'];

                $sql = "INSERT INTO productos (nombre, precio, categoria) 
                        VALUES ('$nombre', '$precio', '$categoria')";
                break;

            case 'Inventario': 
                $producto = $_POST['producto_inventario'];
                $cantidad = $_POST['cantidad_inventario'];
                $local = $_POST['local_inventario'];

                $sql = "INSERT INTO inventario (producto, cantidad, local) 
                        VALUES ('$producto', '$cantidad', '$local')";
                break;

            default:
                echo "Tipo de formulario no reconocido.";
                exit();
        }

       
        $resultado = mysqli_query($conexion, $sql);

       
        if ($resultado) {
            echo "<script language='JavaScript'>
                  alert('Los datos fueron ingresados correctamente a la BD');
                  location.assign('index.php');
                  </script>";
        } else {
            echo "<script language='JavaScript'>
                  alert('Los datos NO fueron ingresados correctamente a la BD');
                  location.assign('index.php');
                  </script>";
        }

       
        mysqli_close($conexion);
    }
?>


    <div class="container">
        <h2>Formulario de Almacén de Ropa</h2>

      
        <details class="my-3">
            <summary class="bg-primary text-white p-2 rounded">Usuarios</summary>
            <div class="p-3 bg-light">
                <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="tipo" value="Usuario">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="contraseña">Contraseña:</label>
                        <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                    </div>
                   
                    <button type="submit" class="btn btn-success" name="guardar_usuario">Guardar Usuario</button>
                </form>
            </div>
        </details>

       
        <details class="my-3">
            <summary class="bg-primary text-white p-2 rounded">Proveedores</summary>
            <div class="p-3 bg-light">
                <form action=<?=$_SERVER['PHP_SELF']?> method="POST">
                    <input type="hidden" name="tipo" value="Proveedor">
                    <div class="form-group">
                        <label for="nombre_proveedor">Nombre:</label>
                        <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion_proveedor">Dirección:</label>
                        <input type="text" class="form-control" id="direccion_proveedor" name="direccion_proveedor" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_proveedor">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono_proveedor" name="telefono_proveedor" required>
                    </div>
                    <button type="submit" class="btn btn-success" name="guardar_proveedor">Guardar Proveedor</button>
                </form>
            </div>
        </details>

       
        <details class="my-3">
            <summary class="bg-primary text-white p-2 rounded">Clientes</summary>
            <div class="p-3 bg-light">
                <form action=<?=$_SERVER['PHP_SELF']?> method="POST">
                    <input type="hidden" name="tipo" value="Cliente">
                    <div class="form-group">
                        <label for="nombre_cliente">Nombre:</label>
                        <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion_cliente">Dirección:</label>
                        <input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_cliente">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente" required>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar Cliente</button>
                </form>
            </div>
        </details>


        <details class="my-3">
            <summary class="bg-primary text-white p-2 rounded">Locales</summary>
            <div class="p-3 bg-light">
                <form action="guardar.php" method="POST">
                    <input type="hidden" name="tipo" value="Local">
                    <div class="form-group">
                        <label for="nombre_local">Nombre:</label>
                        <input type="text" class="form-control" id="nombre_local" name="nombre_local" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion_local">Dirección:</label>
                        <input type="text" class="form-control" id="direccion_local" name="direccion_local" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_local">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono_local" name="telefono_local" required>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar Local</button>
                </form>
            </div>
        </details>

        
        <details class="my-3">
            <summary class="bg-primary text-white p-2 rounded">Productos</summary>
            <div class="p-3 bg-light">
                <form action="guardar.php" method="POST">
                    <input type="hidden" name="tipo" value="Producto">
                    <div class="form-group">
                        <label for="nombre_producto">Nombre:</label>
                        <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required>
                    </div>
                    <div class="form-group">
                        <label for="precio_producto">Precio:</label>
                        <input type="number" class="form-control" id="precio_producto" name="precio_producto" required>
                    </div>
                    <div class="form-group">
                        <label for="categoria_producto">Categoría:</label>
                        <input type="text" class="form-control" id="categoria_producto" name="categoria_producto" required>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar Producto</button>
                </form>
            </div>
        </details>

        
        <details class="my-3">
            <summary class="bg-primary text-white p-2 rounded">Inventario</summary>
            <div class="p-3 bg-light">
                <form action="guardar.php" method="POST">
                    <input type="hidden" name="tipo" value="Inventario">
                    <div class="form-group">
                        <label for="producto_inventario">Producto:</label>
                        <input type="text" class="form-control" id="producto_inventario" name="producto_inventario" required>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_inventario">Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad_inventario" name="cantidad_inventario" required>
                    </div>
                    <div class="form-group">
                        <label for="local_inventario">Local:</label>
                        <input type="text" class="form-control" id="local_inventario" name="local_inventario" required>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar Inventario</button>
                </form>
            </div>
        </details>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <a href="index.php">Regresar</a>
</body>
</html>


