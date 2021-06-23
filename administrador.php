<?php
//USUARIO QUE CONSULTA
$usuario = $_GET['usuario'];
//ADMINISTRADOR
$accion_a= $_POST['accion_a'];
$campo_a= $_POST['campo_a'];
$valor_a= $_POST['usuario_a']; //USUARIO 
$valor2_a= $_POST['valor_a']; // VALOR
//MANTENIMIENTO
$accion_m= $_POST['accion_m'];
$campo_m= $_POST['campo_m'];
$valor_m= $_POST['valor_m'];
/////DB////S
$servername = "localhost";
$username = "JJRR_JAAA_69523_68530";
$password = "proyecto_final";
$db_name = "DB_Proyecto_2021_JJRR_JAAA";
//CON//
$conn = new mysqli($servername,$username,$password,$db_name);
//SQL PARA VERIFICAR QUE EXISTA EL USUARIO QUE SE QUIERE MODIFCAR
$sql = "select * from MODULO_69523_68530 where USUARIO ='".$valor_a."'";
$result = $conn->query($sql);
if($conn->connect_error){
    die("Fallo de conexion: ".$conn->connect_error);
    
}
if($accion_a == "ALTA" &&  $valor2_a != ''){
    $sql = "insert into MODULO_69523_68530 (USUARIO) values ('".$valor2_a."')";
    $result = $conn->query($sql);
    echo("<p>USUARIO INCERTADO CORRECTAMENTE</p>");
}
elseif($accion_a == "BAJA"&& $campo_a !="" && $result -> num_rows>0 && $valor_a!=""){
    while($row = $result-> fetch_assoc()){
    if ($campo_a == "USUARIO"){
    $sql = "update MODULO_69523_68530 set USUARIO = '' where USUARIO = '".$valor_a."'";
    $result = $conn->query($sql);
    echo("<p>USUARIO ELIMINADO CORRECTAMENTE</p>");
    }
    elseif ($campo_a == "ID"){
    $sql = "update MODULO_69523_68530 set ID = '' where USUARIO = '".$valor_a."'";
    $result = $conn->query($sql);
    echo("<p>ID ELIMINADO CORRECTAMENTE</p>");
    }
    elseif ($campo_a == "NOMBRE COMPLETO"){
    $sql =  "update MODULO_69523_68530 set NOMBRE_COMPLETO = '' where USUARIO = '".$valor_a."'";
    $result = $conn->query($sql);
    echo("<p>NOMBRE ELIMINADO CORRECTAMENTE</p>");
    }
    elseif ($campo_a == "DOMICILIO"){
    $sql =  "update MODULO_69523_68530 set DOMICILIO = '' where USUARIO = '".$valor_a."'";
    $result = $conn->query($sql);
    echo("<p>DOMICILIO ELIMINADO CORRECTAMENTE</p>");
    }
    elseif ($campo_a == "TELEFONO"){
    $sql =  "update MODULO_69523_68530 set TELEFONO = '' where USUARIO = '".$valor_a."'";
    $result = $conn->query($sql);
    echo("<p>TELEFONO ELIMINADO CORRECTAMENTE</p>");
    }
    elseif ($campo_a == "CONTACTO"){
    $sql =  "update MODULO_69523_68530 set CONTACTO = '' where USUARIO = '".$valor_a."'";
    $result = $conn->query($sql);
    echo("<p>CONTACTO ELIMINADO CORRECTAMENTE</p>");
    }
    elseif ($campo_a == "NIVEL DE USUARIO"){
    $sql =  "update MODULO_69523_68530 set NIVEL_USUARIO = '' where USUARIO = '".$valor_a."'";
    $result = $conn->query($sql);
    echo("<p>NIVEL DE USUARIO ELIMINADO CORRECTAMENTE</p>");
    }
    elseif ($campo_a == "TURNO"){
    $sql =  "update MODULO_69523_68530 set TURNO = '' where USUARIO = '".$valor_a."'";
    $result = $conn->query($sql);
    echo("<p>TURNO ELIMINADO CORRECTAMENTE</p>");
    }
    else{
        echo("<p> ERROR </p>");
    }

}
}
elseif($accion_a == "MODIFICAR" && $campo_a !="" && $valor_a!="" && $result -> num_rows>0 && $valor2_a!=""){
    while($row = $result-> fetch_assoc()){
        if ($campo_a == "USUARIO"){
            $sql = "update MODULO_69523_68530 set USUARIO = '".$valor2_a."' where USUARIO = '".$valor_a."'";
            $result = $conn->query($sql);
            echo("<p>USUARIO MODIFICADO CORRECTAMENTE</p>");
        }
        elseif ($campo_a == "ID"){
            $sql = "update MODULO_69523_68530 set ID = '".$valor2_a."' where USUARIO= '".$valor_a."'";
            $result = $conn->query($sql);
            echo("<p>ID  MODIFICADO CORRECTAMENTE</p>");
        }
        elseif ($campo_a == "NOMBRE COMPLETO"){
            $sql = "update MODULO_69523_68530 set NOMBRE_COMPLETO = '".$valor2_a."' where USUARIO= '".$valor_a."'";
            $result = $conn->query($sql);
            echo("<p>NOMBRE  MODIFICADO CORRECTAMENTE</p>");
        }
        elseif ($campo_a == "DOMICILIO"){
            $sql = "update MODULO_69523_68530 set DOMICILIO = '".$valor2_a."' where USUARIO = '".$valor_a."'";
            $result = $conn->query($sql);
            echo("<p>DOMICILIO MODIFICADO CORRECTAMENTE</p>");
        }
        elseif ($campo_a == "TELEFONO"){
            $sql = "update MODULO_69523_68530 set TELEFONO = '".$valor2_a."' where USUARIO = '".$valor_a."'";
            $result = $conn->query($sql);
            echo("<p>TELEFONO MODIFICADO CORRECTAMENTE</p>");
        }
        elseif ($campo_a == "CONTACTO"){
            $sql = "update MODULO_69523_68530 set CONTACTO = '".$valor2_a."' where USUARIO = '".$valor_a."'";
            $result = $conn->query($sql);
            echo("<p>CONTACTO MODIFICADO CORRECTAMENTE</p>");
        }
        elseif ($campo_a == "NIVEL DE USUARIO"){
            $sql = "update MODULO_69523_68530 set NIVEL_USUARIO = '".$valor2_a."' where USUARIO = '".$valor_a."'";
            $result = $conn->query($sql);
            echo("<p>NIVEL DE USUARIO MODIFICADO CORRECTAMENTE</p>");
        }
        elseif ($campo_a == "TURNO"){
            $sql = "update MODULO_69523_68530 set TURNO = '".$valor2_a."' where USUARIO = '".$valor_a."'";
            $result = $conn->query($sql);
            echo("<p>TURNO MODIFICADO CORRECTAMENTE</p>");
        }
        else{
            echo("<br> ERROR </br>");
        }
}
}
elseif($accion_a == "CONSULTAR"  && $valor_a != ""){
    $sql = "select * from MODULO_69523_68530 where USUARIO ='".$valor_a."'";
    $result = $conn->query($sql);
    if($result -> num_rows>0 ){
        while($row = $result-> fetch_assoc()){
            echo "<br>ID: ".$row[ID];
            echo "<br>USUARIO: ".$row[USUARIO];
            echo "<br>CONTRASEÑA: ".$row[CONTRASEÑA];
            echo "<br>NOMBRE_COMPLETO: ".$row[NOMBRE_COMPLETO];
            echo "<br>DOMICILIO: ".$row[DOMICILIO];
            echo "<br>TELEFONO: ".$row[TELEFONO];
            echo "<br>CONTACTO: ".$row[CONTACTO];
            echo "<br>NIVEL_USUARIO: ".$row[NIVEL_USUARIO];
            echo "<br>TURNO: ".$row[TURNO];
            echo "<br>/////////////////////////";
        }    
    }
    else{
        echo "Sin registros";
    }
}
/*
//MANTENIMIENTO
//SQL PARA VERIFICAR QUE EXISTA EL USUARIO QUE SE QUIERE MODIFCAR
$sql = "select * from MODULO_69523_68530 where USUARIO ='".$valor_a."' or ID ='".$valor_a."' or CONTRASEÑA ='".$valor_a."'or NOMBRE_COMPLETO ='".$valor_a."'or DOMICILIO ='".$valor_a."'or TELEFONO ='".$valor_a."'or CONTACTO ='".$valor_a."'or NIVEL_USUARIO ='".$valor_a."'or TURNO ='".$valor_a."'";
$result = $conn->query($sql);
if($conn->connect_error){
    die("Fallo de conexion: ".$conn->connect_error);
}
if($accion_a == "ALTA"&& $campo_a == "USUARIO" && $valor_a != ''){
    $sql = "insert into MODULO_69523_68530 (USUARIO) values ('".$valor_a."')";
    $result = $conn->query($sql);
    echo("<p>USUARIO INCERTADO CORRECTAMENTE</p>");
}
elseif($accion_a == "BAJA"&& $campo_a == "USUARIO" && $result -> num_rows>0 && $valor2_a!=""){
    $sql = "delete from MODULO_69523_68530 where USUARIO='".$valor2_a."'";
    $result = $conn->query($sql);
    echo("<p>USUARIO ELIMINADO CORRECTAMENTE</p>");
}
elseif($accion_a == "MODIFICAR" && $campo_a == "USUARIO" && $valor_a!="" && $result -> num_rows>0 && $valor2_a!=""){
    $sql = "update MODULO_69523_68530 set USUARIO = '".$valor_a."' where USUARIO = '".$valor2_a."'";
    $result = $conn->query($sql);
    echo("<p>USUARIO MODIFICADO CORRECTAMENTE</p>");
}
elseif($accion_a == "CONSULTAR"  && $valor_a != "" && $campo_a != ""){
    $sql = "select * from MODULO_69523_68530 where USUARIO ='".$valor_a."' or ID ='".$valor_a."' or CONTRASEÑA ='".$valor_a."'or NOMBRE_COMPLETO ='".$valor_a."'or DOMICILIO ='".$valor_a."'or TELEFONO ='".$valor_a."'or CONTACTO ='".$valor_a."'or NIVEL_USUARIO ='".$valor_a."'or TURNO ='".$valor_a."'";
    $result = $conn->query($sql);
    if($result -> num_rows>0 ){
        while($row = $result-> fetch_assoc()){
            if ($row[NIVEL_USUARIO]== 'Administrador'){
            echo "<br>ID: ".$row[ID];
            echo "<br>USUARIO: ".$row[USUARIO];
            echo "<br>CONTRASEÑA: ".$row[CONTRASEÑA];
            echo "<br>NOMBRE_COMPLETO: ".$row[NOMBRE_COMPLETO];
            echo "<br>DOMICILIO: ".$row[DOMICILIO];
            echo "<br>TELEFONO: ".$row[TELEFONO];
            echo "<br>CONTACTO: ".$row[CONTACTO];
            echo "<br>NIVEL_USUARIO: ".$row[NIVEL_USUARIO];
            echo "<br>TURNO: ".$row[TURNO];
            echo "<br>/////////////////////////";
            }
        }   
    }
    else{
        echo "Sin registros";
    }
}*/
else{
    echo("<p>ALGO SALIO MAL</p>");
    if($conn->connect_error){
        die("Fallo de conexion: ".$conn->connect_error);
        echo "<br>FALLO DE CONEXIÓN</br>";
        
    }
}

$conn->close();

?>