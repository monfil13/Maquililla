<?php
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["create"])) {

        // Si nombre de prenda, color de prenda y precio no están vacíos
        if (!empty($_POST["nombrePrenda"]) && !empty($_POST["colorPrenda"]) && !empty($_POST["precio"])) {
            // Validar que el precio no exceda los 100 pesos
            if ($_POST["precio"] <= 100) {
                createPrenda($_POST["nombrePrenda"], $_POST["colorPrenda"], $_POST["precio"]);
            } else {
                // Imprimir alerta si el precio excede los 100 pesos
                echo "<script>alert('El precio no puede exceder los 100 pesos');</script>";
            }
        } else {
            // Imprimir alerta si algún campo está vacío
            echo "<script>alert('Nombre de prenda, color de prenda y precio son requeridos');</script>";
        }
       
    } elseif (isset($_POST["update"])) {

        // Si id, nombre de prenda, color de prenda y precio no están vacíos
        if (!empty($_POST["id"]) && !empty($_POST["nombrePrenda"]) && !empty($_POST["colorPrenda"]) && !empty($_POST["precio"])) {
            // Validar que el precio no exceda los 100 pesos
            if ($_POST["precio"] <= 100) {
                updatePrenda($_POST["id"], $_POST["nombrePrenda"], $_POST["colorPrenda"], $_POST["precio"]);
            } else {
                // Imprimir alerta si el precio excede los 100 pesos
                echo "<script>alert('El precio no puede exceder los 100 pesos');</script>";
            }
        } else {
            // Imprimir alerta si algún campo está vacío
            echo "<script>alert('ID, nombre de prenda, color de prenda y precio son requeridos');</script>";
        }

    } elseif (isset($_POST["delete"])) {
        
        // Si id no está vacío
        if (!empty($_POST["id"])) {
            deletePrenda($_POST["id"]);
        } else {
            // Imprimir alerta si el ID está vacío
            echo "<script>alert('ID es requerido');</script>";
        }
    }
}

// Obtener todas las prendas
function getPrendas() {
    global $mysqli;
    $result = $mysqli->query("SELECT id, nombrePrenda, colorPrenda, precio FROM prendas");
    return $result->fetch_all(MYSQLI_ASSOC);
}

$prendas = getPrendas();
?>


<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Prendas</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .registro-prenda {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .registro-prenda img {
            max-width: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }
        h1 {
            text-align: center;
            font-size: 28px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>👕 Registro de Prendas 👖</h1>
        <img src="https://frigorificosarcosa.com/wp-content/uploads/2023/04/Maquila-2-escalado.jpg" alt="Maquila" style="border-radius: 50%; max-width: 200px; display: block; margin: 20px auto;">

        <div class="row">
            <div class="col">
                <div class="registro-prenda">
                    <h2>Agregar prenda</h2>
                    <form method="post" class="mb-4">
                        <div class="form-group">
                            <label>Nombre Prenda: <input type="text" name="nombrePrenda" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label>Color Prenda:
                                <select name="colorPrenda" class="form-control">
                                    <option value="amarillo">Amarillo</option>
                                    <option value="azul">Azul</option>
                                    <option value="rojo">Rojo</option>
                                    <option value="verde">Verde</option>
                                    <option value="blanco">Blanco</option>
                                    <option value="negro">Negro</option>
                                </select>
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Precio: <input type="number" step="0.01" name="precio" class="form-control"></label>
                        </div>
                        <button type="submit" name="create" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</button>
                    </form>
                </div>
            </div>

            <div class="col">
                <div class="registro-prenda">
                    <h2>Actualizar prenda</h2>
                    <form method="post" class="mb-4">
                        <div class="form-group">
                            <label>ID: <input type="number" name="id" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label>Nombre Prenda: <input type="text" name="nombrePrenda" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label>Color Prenda:
                                <select name="colorPrenda" class="form-control">
                                    <option value="amarillo">Amarillo</option>
                                    <option value="azul">Azul</option>
                                    <option value="rojo">Rojo</option>
                                    <option value="verde">Verde</option>
                                    <option value="blanco">Blanco</option>
                                    <option value="negro">Negro</option>
                                </select>
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Precio: <input type="number" step="0.01" name="precio" class="form-control"></label>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-pencil"></i> Actualizar</button>
                    </form>
                </div>
            </div>

            <div class="col">
                <div class="registro-prenda">
                    <h2>Eliminar prenda</h2>
                    <form method="post" class="mb-4">
                        <div class="form-group">
                            <label>ID: <input type="number" name="id" class="form-control"></label>
                        </div>
                        <button type="submit" name="delete" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button>
                    </form>
                </div>
            </div>
        </div>

        <h2>Lista de prendas</h2>
        <div class="row">
            <?php foreach ($prendas as $prenda): ?>
                <div class="col-md-4">
                    <div class="registro-prenda">
                        <p>ID: <?php echo $prenda["id"]; ?></p>
                        <p>Nombre Prenda: <?php echo $prenda["nombrePrenda"]; ?></p>
                        <p>Color Prenda: <?php echo $prenda["colorPrenda"]; ?></p>
                        <p>Precio: <?php echo $prenda["precio"]; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>