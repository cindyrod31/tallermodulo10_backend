<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CND BOOTSTARP-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/datos.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    
    <title>Tabla de Usuarios</title>
    <script>
        $(document).ready(function() {
            var tabla = $('#tablaUsuarios').DataTable();

            $('#tablaUsuarios tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Buscar ' + title + '" />');
            });

            tabla.columns().every(function() {
                var that = this;

                $('input', this.footer()).on('keyup change', function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        });
    </script>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mi_proyecto";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Construir la consulta SQL sin parámetros de búsqueda
    $sql = "SELECT * FROM usuarios";

    // Ejecutar la consulta
    $result = $conn->query($sql);
    ?>
    
    <h2>Tabla de Usuarios</h2>
    <table id="tablaUsuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            // Construir la tabla HTML con los datos obtenidos
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>'.$row['id'].'</td>';
                    echo '<td>'.$row['nombre'].'</td>';
                    echo '<td>'.$row['apellido'].'</td>';
                    echo '<td>'.$row['cedula'].'</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="4">No se encontraron resultados</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <?php
    // Cerrar la conexión
    $conn->close();
    ?>
</body>
</html>
