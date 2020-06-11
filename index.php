<!doctype HTML>
<HTML> 
    <head>
        <meta charset="UTF-8">
        <title>Control de Inventario</title>
        <link rel="icon" type="ico" href="lecam.ico" />
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width,user-scalable=no, initial-scale=1.0,maximun-scale=1.0,minimun-scale=1.0">
    </head>
    <header>
        <?php
        
        ?>
        <h1>Control de Inventario</h1>
        <h3>Lecam 2019 </H3>        
    </header>
    <HR>
    <div class="contenedor">
        <section class="main">
            <?php
            if (isset($_GET['act'])) {
                if ($_GET['act'] == 'A608F') {
                    echo "<h5 align=\"center\"><b>Actividad Registrada Correctamente</b></h5><br><br><br>";
                }
                if ($_GET['act'] == 'F3BB2') {
                    echo "<h5 align=\"center\"><b>NO puede agregar una salida a un Medicamento que no Existe</b></h5><br><br><br>";
                }
                if ($_GET['act'] == 'F5C78') {
                    echo "<h5 align=\"center\"><b>NO Tiene Suficiente Inventario</b></h5><br><br><br>";
                }
            }
            ?>
            <h3>Agregar Salida o Entrada del Medicamento</h3>
            <form name="formulario" method="post" action="captura.php" >
                <INPUT name="medicamento" list="medicamento" placeholder="Medicamento">
                <datalist id="medicamento">
                    <?php
                    $hosta = "db745124056.db.1and1.com";
                    $usera = "dbo745124056";
                    $passa = "/*N4odyp*/";
                    $dba = "db745124056";

                    //$hosta = "127.0.0.1";
                    //$usera = "controlinicio";
                    //$passa = "/*N4odyp*/";
                    //$dba = "cinventario";

                    $enlacea = mysqli_connect($hosta, $usera, $passa) or die("Error al conectar con la base de datos de lista");
                    $basea = mysqli_select_db($enlacea, $dba) or die("Error con la base de datos de lista");
                    $consultaa = "SELECT * FROM medicamento";
                    $resulta = mysqli_query($enlacea, $consultaa) or die("Error en la consulta de base de datos de lista");
                    if ($resulta->num_rows == 0) {
                        echo "error para Enlistar, intentalo de nuevo en unos minutos";
                    } else {
                        while ($rowa = $resulta->fetch_array(MYSQLI_ASSOC)) {
                            $nomlista = $rowa['med'];
                            echo "<option value=\"$nomlista\">";
                        }
                        mysqli_free_result($resulta);
                        mysqli_close($enlacea);
                    }
                    ?>
                </DATALIST>
                </input>
                <br/>
                <br/> 
                Cantidad: <input type="number" name="cantidad" value="1" required min="1" max="999">
                <br/>
                <br/>
                <input type="date" name="fecha" value="2019-01-01" required>
                <br/>
                <br/>
                <input type="text" name="factura" placeholder="FACTURA">
                <br/>
                <br/>
                <INPUT name="cliente" list="cliente" placeholder="Cliente">
                <datalist id="cliente">
                    <?php
                    $hosta = "db745124056.db.1and1.com";
                    $usera = "dbo745124056";
                    $passa = "/*N4odyp*/";
                    $dba = "db745124056";

                    //$hosta = "127.0.0.1";
                    //$usera = "controlinicio";
                    //$passa = "/*N4odyp*/";
                    //$dba = "cinventario";

                    $enlacea = mysqli_connect($hosta, $usera, $passa) or die("Error al conectar con la base de datos de lista");
                    $basea = mysqli_select_db($enlacea, $dba) or die("Error con la base de datos de lista");
                    $consultaa = "SELECT * FROM cliente";
                    $resulta = mysqli_query($enlacea, $consultaa) or die("Error en la consulta de base de datos de lista");
                    if ($resulta->num_rows == 0) {
                        echo "error para Enlistar, intentalo de nuevo en unos minutos";
                    } else {
                        while ($rowa = $resulta->fetch_array(MYSQLI_ASSOC)) {
                            $cliente = $rowa['cliente'];
                            echo "<option value=\"$cliente\">";
                        }
                        mysqli_free_result($resulta);
                        mysqli_close($enlacea);
                    }
                    ?>
                </DATALIST>
                </input>                        
                <br/>
                <br/>
                <INPUT name="laboratorio" list="laboratorio" placeholder="Laboratorio">
                <datalist id="laboratorio">
                    <?php
                    $hosta = "db745124056.db.1and1.com";
                    $usera = "dbo745124056";
                    $passa = "/*N4odyp*/";
                    $dba = "db745124056";

                    //$hosta = "127.0.0.1";
                    //$usera = "controlinicio";
                    //$passa = "/*N4odyp*/";
                    //$dba = "cinventario";

                    $enlacea = mysqli_connect($hosta, $usera, $passa) or die("Error al conectar con la base de datos de lista");
                    $basea = mysqli_select_db($enlacea, $dba) or die("Error con la base de datos de lista");
                    $consultaa = "SELECT * FROM laboratorio";
                    $resulta = mysqli_query($enlacea, $consultaa) or die("Error en la consulta de base de datos de lista");
                    if ($resulta->num_rows == 0) {
                        echo "error para Enlistar, intentalo de nuevo en unos minutos";
                    } else {
                        while ($rowa = $resulta->fetch_array(MYSQLI_ASSOC)) {
                            $lab = $rowa['lab'];
                            echo "<option value=\"$lab\">";
                        }
                        mysqli_free_result($resulta);
                        mysqli_close($enlacea);
                    }
                    ?>
                </DATALIST>
                </input>
                <br/>
                <br/>
                Caducidad: <input type="date" name="caduca" value="2022-01-01" required>
                <br/>
                <br/>
                <input type="text" name="lote" value="" placeholder="Lote">
                <br/>
                <br/>
                <select name="entrada">
                    <option>salida</option>
                    <option>entrada</option>
                </select>
                <br/>
                <br/>
                <input type="submit" value="Aceptar"/>
            </FORM>
            <br/>
        </section>
        <hr>
        <br>
        <hr>
        <SECTION class="main2">
            <?php
            $host = "db745124056.db.1and1.com";
            $user = "dbo745124056";
            $pass = "/*N4odyp*/";
            $db = "db745124056";

            //$host = "127.0.0.1";
            //$user = "controlinicio";
            //$pass = "/*N4odyp*/";
            //$db = "cinventario";

            $enlace = mysqli_connect($host, $user, $pass) or die("Error al conectar con la base de datos");
            $base = mysqli_select_db($enlace, $db) or die("Error con la base de datos");
            $consulta = "SELECT * FROM medicamento";
            $result = mysqli_query($enlace, $consulta) or die("Error en la consulta de base de datos");
            if ($result->num_rows == 0) {
                echo "error En la consulta, intentalo de nuevo en unos minutos";
            } else {
                echo "<table class=\"inventario\">
                      <tr>
                        <th>Producto</th>
                        <th>En Almacen</th>
                      </tr>";
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $nomb = $row['med'];
                    $id = $row['id'];
                    $stock = $row['stock'];
                    $url = "almacen.php";
                    echo "<tr><td><a href=\"$url?producto=$id\">$nomb</a></td><td>$stock </td></tr>";
                }
                echo "</table>";
            }
            mysqli_free_result($result);
            mysqli_close($enlace);
            ?>
        </SECTION>
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