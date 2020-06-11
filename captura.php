<?php

$host = "db745124056.db.1and1.com";
$user = "dbo745124056";
$pass = "/*N4odyp*/";
$db = "db745124056";

//$host = "127.0.0.1";
//$user = "controlinicio";
//$pass = "/*N4odyp*/";
//$db = "cinventario";

$medica = $_POST['medicamento'];
$laboratorio = $_POST['laboratorio'];

$cantidad = $_POST['cantidad'];
$fecha = $_POST['fecha'];
$tipo = $_POST['entrada'];
$fact = $_POST['factura'];
$clien = $_POST['cliente'];
$lote = $_POST['lote'];
$caduca = $_POST['caduca'];


$enlace = mysqli_connect($host, $user, $pass) or die("Error al conectar con la base de datos");
$base = mysqli_select_db($enlace, $db) or die("Error con la base de datos");

//REVISA MEDICAMENTO
$consult = "select * FROM medicamento where med='$medica'";
$result = mysqli_query($enlace, $consult) or die("Error en la consulta de base de datos");
if ($result->num_rows == 0) {
    if ($tipo == 'entrada') {
        $ingresa = "insert into medicamento (med,stock) values ('$medica','$cantidad');";
        if (!mysqli_query($enlace, $ingresa)) {
            echo "Salio mal la insercion de datos";
        } else {
            mysqli_free_result($result);
        }
    } else {
        mysqli_free_result($result);
        mysqli_close($enlace);
        //header('Location:/Control_Inventario/index.php?act=F3BB2');
        header ('Location: https://inventario.lecam.mx?act=F3BB2'); 
    }
} else {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $total = $row['stock'];
    }
    if ($tipo == 'salida') {
        $total = $total - $cantidad;
        if ($total < 0) {
            mysqli_free_result($result);
            mysqli_close($enlace);
            //header('Location:/Control_Inventario/index.php?act=F5C78');
            header ('Location: https://inventario.lecam.mx?act=F5C78');             
        } else {
            $actual = "Update medicamento Set stock='$total' where med='$medica'";
            if (!mysqli_query($enlace, $actual)) {
                echo "Salio mal la actualizacion";
            } else {
                
            }
        }
    }
    if ($tipo == 'entrada') {
        $total = $total + $cantidad;
        $actual = "Update medicamento Set stock='$total' where med='$medica'";
        if (!mysqli_query($enlace, $actual)) {
            echo "Salio mal la actualizacion";
        } else {
            
        }
    }

    mysqli_free_result($result);
}

//REVISA laboratorio
$consult = "select * FROM laboratorio where lab='$laboratorio'";
$result = mysqli_query($enlace, $consult) or die("Error en la consulta de base de datos");
if ($result->num_rows == 0) {
    $ingresa = "insert into laboratorio (lab) values ('$laboratorio');";
    if (!mysqli_query($enlace, $ingresa)) {
        echo "Salio mal";
    } else {
        mysqli_free_result($result);
    }
} else {
    
}

//REVISA CLIENTE
$consult = "select * FROM cliente where cliente='$clien'";
$result = mysqli_query($enlace, $consult) or die("Error en la consulta de base de datos");
if ($result->num_rows == 0) {
    $ingresa = "insert into cliente (cliente) values ('$clien');";
    if (!mysqli_query($enlace, $ingresa)) {
        echo "Salio mal";
    } else {
        mysqli_free_result($result);
    }
} else {
    
}


// INGRESA EL MOVIMIENTO DE SALIDA O ENTRADA
$consult = "select * FROM medicamento where med='$medica'";
$result = mysqli_query($enlace, $consult) or die("Error en la consulta de base de datos");
if ($result->num_rows == 0) {
    echo "error En la consulta, intentalo de nuevo en unos minutos";
} else {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $id = $row['id'];
    }
    $ingresa = "insert into control (id,cantidad,factura,cliente,fecha,entsal,completo,lote,caducidad) values ('$id','$cantidad','$fact','$clien','$fecha','$tipo',0,'$lote','$caduca');";
    if (!mysqli_query($enlace, $ingresa)) {
        echo "Salio mal";
    } else {
        mysqli_free_result($result);
        mysqli_close($enlace);
        //header('Location:/Control_Inventario/index.php?act=A608F');
        header ('Location: https://inventario.lecam.mx?act=A608F');
    }
}
?>