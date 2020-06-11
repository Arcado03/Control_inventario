<!doctype HTML>
<HTML> 
    <head>
        <meta charset="UTF-8">
        <title>Control de Inventario</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width,user-scalable=no, initial-scale=1.0,maximun-scale=1.0,minimun-scale=1.0">
    </head>
    <header>
        <h1>Control de Inventario</h1>
        <h3>Design by </H3>
    </header>
    <HR>
    <div class="contenedor">
        <section class="main">
            <?php
            $host = "db745124056.db.1and1.com";
            $user = "dbo745124056";
            $pass = "/*N4odyp*/";
            $db = "db745124056";

            //$host = "127.0.0.1";
            //$user = "controlinicio";
            //$pass = "/*N4odyp*/";
            //$db = "cinventario";

            $prod = $_GET['producto'];

            $enlace = mysqli_connect($host, $user, $pass) or die("Error al conectar con la base de datos");
            $base = mysqli_select_db($enlace, $db) or die("Error con la base de datos");
            $consult = "select * FROM control where id='$prod'";
            $result = mysqli_query($enlace, $consult) or die("Error en la consulta de base de datos");
            if ($result->num_rows == 0) {
                echo "error En la consulta, intentalo de nuevo en unos minutos";
            } else {
                echo "<table class=\"inventario\">
                                <tr>
                                    <th>Factura</th>
                                    <th>Tipo</th>
                                    <th>Cliente</th>
                                    <th>Cantidad</th>
                                    <th>Fecha</th>
                                    <th>Lote</th>
                                    <th>Caducidad</th>
                                </tr>";
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $fac = $row['factura'];
                    $tip = $row['entsal'];
                    $cli = $row['cliente'];
                    $can = $row['cantidad'];
                    $fec = $row['fecha'];
                    $lot = $row['lote'];
                    $cad = $row['caducidad'];
                    echo "<tr><td>$fac</td><td>$tip</td><td>$cli</td><td>$can</td><td>$fec</td><td>$lot</td><td>$cad</td></tr>";
                }
                echo "</table>";
            }
            ?>               
        </section>
        <a href="index.php">Regresar al menu principal</a>
    </div>
    <FOOTER>
        <div class="foot">
            <p>
                Este sistema esta intervenido por la seguridad informatica
                de todo el mundo
                y sobre todo de la empresa
                nosotros
                Conocenos
            </p>
        </DIV>
    </FOOTER>
</HTML>