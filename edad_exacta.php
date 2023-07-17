<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CND BOOTSTARP-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/calculadora_edad1.css">
    <title>¿Quieres saber tu edad exacta?</title>
</head>
<body>
    <a href="index.html#section-respuestas">
        <img class="home" src="img/hogar.png" alt="">
    </a>
    
    <div class="main-frame-cal">
    <!-- Corrección: Se corrigió el atributo action y method del formulario -->
    <form action="" method="POST">
        <div class="form-group">
            <label for="exampleFormControlInput1">Seleccione su fecha de nacimiento:</label>
            <input type="date" name="f_n" class="form-control" id="exampleFormControlInput1">
        </div>
        
        <!-- Corrección: Se corrigió el atributo type del botón -->
        <button type="submit" name="verificar" class="btn btn-outline-info">Enviar</button>
    </form>

    <?php
    if (isset($_POST['verificar'])) {
        $f_n = new DateTime($_POST['f_n']);
        $date2 = new DateTime(date("Y-m-d")); // Corrección: Se cambió 'y' por 'Y' para obtener el año de 4 dígitos

        $diff = $f_n->diff($date2);

        $edad_actual = $diff->y;
        $edad_meses = $diff->m;
        $edad_dias = $diff->d;

        // Cálculo de los días faltantes para el próximo cumpleaños
        $proximo_cumple = new DateTime(date("Y") . "-" . $f_n->format("m-d")); // Próximo cumpleaños en el año actual
        if ($proximo_cumple < $date2) {
            $proximo_cumple->modify("+1 year"); // Si ya pasó el cumpleaños en este año, sumamos 1 año al próximo cumpleaños
        }

        $dias_faltantes = $date2->diff($proximo_cumple)->days;

        echo "años: " . $edad_actual . " meses: " . $edad_meses . " días: " . $edad_dias . "<br>";
        echo "Días faltantes para el próximo cumpleaños: " . $dias_faltantes;
    }
    ?>

    </div>
</body>
</html>
