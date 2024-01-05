<?php
include("Conexion.php");
$conexion = conectar();

$sql = "SELECT * FROM calificaciones";

if (isset($_GET['searchBoleta'])) {
    $boletaABuscar = mysqli_real_escape_string($conexion, $_GET['searchBoleta']);
    $sql .= " WHERE boleta_alumno LIKE '%$boletaABuscar%'";
}

$query = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarpa</title>
    <link rel="stylesheet" href="./CSS/Estilos.css">
    <link rel="icon" href="../assets/img/Logo.png">
</head>

<body>

    <header>
        <div class="contenedor">
            <img src="../assets/img/Sarpa.png" alt="fondo" class="imglogo">
            <h2 class="LogoT">Administrador - Materias y Calificaciones</h2>
            <nav>
                <a href="./Admin.php">Información General</a>
                <a href="#" class="activo">Materias - Calificaciones</a>
                <a href="../formulario_gestion.html">Cerrar Sesión</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="principal">
            <div class="contenedor">
                <h3 class="titulo">Tabla de usuarios</h3>

                <form action="" method="GET">
                    <label for="searchBoleta">Buscar por Boleta:</label>
                    <input type="text" id="searchBoleta" name="searchBoleta" value="<?php echo isset($_GET['searchBoleta']) ? $_GET['searchBoleta'] : ''; ?>">
                </form>
            <br><br>
                <table>
                    <thead>
                        <tr>
                            <th>Boleta</th>
                            <th>Materia</th>
                            <th>Calificación Parcial 1</th>
                            <th>Calificación Parcial 2</th>
                            <th>Calificación Parcial 3</th>
                            <th>Asignar-Editar Materia</th>
                            <th>Eliminar Materia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($query)): ?>
                            <tr>
                                <th><?= $row['boleta_alumno']; ?></th>
                                <th>
                                    <?php
                                    $id_materia = $row['id_materia'];
                                    $query_materia_nombre = mysqli_query($conexion, "SELECT nombre FROM materias WHERE id_materia = $id_materia");
                                    $row_materia_nombre = mysqli_fetch_array($query_materia_nombre);
                                    echo $row_materia_nombre['nombre'];
                                    ?>
                                </th>
                                <th><?= $row['calificacion_parcial1']; ?></th>
                                <th><?= $row['calificacion_parcial2']; ?></th>
                                <th><?= $row['calificacion_parcial3']; ?></th>
                                <th><a class="neon" href="../Vistas/FormGestor.php?boleta_alumno=<?= $row['boleta_alumno'] ?>">Asignar</a></th>
                                <th><a class="neonE" href="../php/Eliminar_m.php?boleta_alumno=<?= $row['boleta_alumno'] ?>">Eliminar</a></th>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <a href="../Vistas/FormGestor.php">
                    <button>Ir a la Ruta</button>
                </a>
            </div>
        </div>
    </main>

    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script>
        document.getElementById('searchBoleta').addEventListener('input', function () {
            updateTable();
        });

        function updateTable() {
        var searchBoleta = document.getElementById('searchBoleta').value;
        console.log('Valor de búsqueda:', searchBoleta);

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'actualizar_tabla.php?searchBoleta=' + encodeURIComponent(searchBoleta), true);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                console.log('Respuesta del servidor:', xhr.responseText);
                document.getElementById('table').innerHTML = xhr.responseText;
            } else {
                console.error('Error en la solicitud AJAX');
            }
        };
        xhr.send();
        }

    </script>
    <script src="js/main.js"></script>
</body>

</html>
