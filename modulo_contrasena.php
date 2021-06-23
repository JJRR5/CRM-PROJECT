<?php
//ADMINISTRADOR
$usuario_a= $_POST['usuario_a'];//USUARIO A COSNULTAR
$contr_acutal_a= $_POST['contra_a'];// CONTRASEÑA ACTUAL
$nueva_contra_a= $_POST['nueva_a']; //NUEVA CONTRASEÑA
$nueva_contra2_a= $_POST['nueva2_a']; // NUEVA CONTRASEÑA X2
//MANTENIMIENTO
$usuario_m= $_POST['usuario_m'];//USUARIO A COSNULTAR
$contr_acutal_m= $_POST['contra_m'];// CONTRASEÑA ACTUAL
$nueva_contra_m= $_POST['nueva_m']; //NUEVA CONTRASEÑA
$nueva_contra2_m= $_POST['nueva2_m']; // NUEVA CONTRASEÑA X2
//ENFERMERIA
$usuario_e= $_POST['usuario_e'];//USUARIO A COSNULTAR
$contr_acutal_e= $_POST['contra_e'];// CONTRASEÑA ACTUAL
$nueva_contra_e= $_POST['nueva_e']; //NUEVA CONTRASEÑA
$nueva_contra2_e= $_POST['nueva2_e']; // NUEVA CONTRASEÑA X2
//OPERADOR
$usuario_o= $_POST['usuario_o'];//USUARIO A COSNULTAR
$contr_acutal_o= $_POST['contra_o'];// CONTRASEÑA ACTUAL
$nueva_contra_o= $_POST['nueva_o']; //NUEVA CONTRASEÑA
$nueva_contra2_o= $_POST['nueva2_o']; // NUEVA CONTRASEÑA X2
/////DB////
$servername = "localhost";
$username = "JJRR_JAAA_69523_68530";
$password = "proyecto_final";
$db_name = "DB_Proyecto_2021_JJRR_JAAA";
$conn = new mysqli($servername,$username,$password,$db_name);
if($usuario_a != '' or $usuario_m != ''or $usuario_e!='' or $usuario_o!=''){
    $sql = "select * from MODULO_69523_68530 where USUARIO ='".$usuario_a."' or USUARIO = '".$usuario_m."' or USUARIO= '".$usuario_e."' or USUARIO= '".$usuario_o."'";
    $result = $conn->query($sql); 
    if($conn->connect_error){
        die("Fallo de conexion: ".$conn->connect_error);
    }
}
else{
    echo ("<br>NO INGRESASTE EL USUARIO AL CUAL SE QUIERE CAMBIAR LA CONTRASEÑA</br>");
}
if($contr_acutal_a != '' or $contr_acutal_m != '' or $contr_acutal_e!='' or $contr_acutal_o!='' or $nueva_contra_e!=''or $nueva_contra_o!=''){
    $sql2 = "select USUARIO,CONTRASEÑA FROM MODULO_69523_68530 ORDER BY CONSULTA DESC";
    $result2 = $conn->query($sql2);
    if($conn->connect_error){
        die("Fallo de conexion: ".$conn->connect_error);
        echo "<br> ERROR </br>";
    }
}
else{
    echo "<br> no se esta metiendo </br>";
}
//ADMINISTRADOR
//LOGICA PARA CAMBIO DE CONTRASEÑA PROPIA
if( $contr_acutal_a != ''&& $nueva_contra_a != '' && $nueva_contra2_a!='' && $result -> num_rows>0 ){
    $row = $result2-> fetch_assoc();
    if ($nueva_contra_a== $nueva_contra2_a && $row[CONTRASEÑA]==$contr_acutal_a){
    $sql = "update MODULO_69523_68530 set CONTRASEÑA = '".$nueva_contra_a."' where USUARIO = '".$usuario_a."'";
    $result = $conn->query($sql);
    echo("<p>CONTRASEÑA PROPIA CAMBIADA CORRECTAMENTE A</p>");
    }
    else{
        echo "<br> LA CONTRASEÑA ACTUAL PROPIA NO COINCIDE </br>";
    }
}
//LOGICA PARA CAMBIO DE CONTRASEÑA DE CUALQUIER OTRO USUARIO 
elseif($nueva_contra2_a==$nueva_contra_a&& $nueva_contra2_a !='' && $nueva_contra_a!=''){
    $sql = "update MODULO_69523_68530 set CONTRASEÑA = '".$nueva_contra_a."' where USUARIO = '".$usuario_a."'";
    $result = $conn->query($sql);
    echo("<p>CONTRASEÑA CAMBIADA CORRECTAMENTE</p>");
    }

//MANTENIMIENTO////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//LOGICA PARA CAMBIO DE CONTRASEÑA PROPIA 
elseif( $contr_acutal_m != ''&& $nueva_contra_m != '' && $nueva_contra2_m!='' && $result -> num_rows>0 ){
    $row = $result2-> fetch_assoc();
    if ($nueva_contra_m== $nueva_contra2_m && $row[CONTRASEÑA]==$contr_acutal_m){
    $sql = "update MODULO_69523_68530 set CONTRASEÑA = '".$nueva_contra_m."' where USUARIO = '".$usuario_m."'";
    $result = $conn->query($sql);
    echo("<p>CONTRASEÑA PROPIA CAMBIADA CORRECTAMENTE M</p>");
    }
    else{
        echo "<br> LA CONTRASEÑA ACTUAL PROPIA NO COINCIDE </br>";
    }
}
// CAULQUIER OTRO USUARIO
elseif($nueva_contra2_m==$nueva_contra_m&& $nueva_contra2_m !='' && $nueva_contra_m!=''&& $result -> num_rows>0 ){
    while($row = $result-> fetch_assoc()){
    if($row[NIVEL_USUARIO]!='Administrador'){
    $sql = "update MODULO_69523_68530 set CONTRASEÑA = '".$nueva_contra_m."' where USUARIO = '".$usuario_m."'";
    $result = $conn->query($sql);
    echo("<p>CONTRASEÑA CAMBIADA CORRECTAMENTE</p>");
    }
    elseif($row[NIVEL_USUARIO]=="Administrador"){
        echo "<br> NO PUEDES CAMBIAR LA CONTRASEÑA DE UN ADMINISTRADOR</br>";
        }
    }
}
////ENFERMERIA /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
elseif( $nueva_contra_e != '' && $nueva_contra2_e!='' && $contr_acutal_e!='' && $result -> num_rows>0 ){
    $row = $result2-> fetch_assoc();
    if ($nueva_contra_e== $nueva_contra2_e && $row[CONTRASEÑA]==$contr_acutal_e && $contr_acutal_e!= ''){
    $sql = "update MODULO_69523_68530 set CONTRASEÑA = '".$nueva_contra_e."' where USUARIO = '".$usuario_e."'";
    $result = $conn->query($sql);
    echo("<p>CONTRASEÑA PROPIA CAMBIADA CORRECTAMENTE E</p>");
    } 
    else{
        echo "<br> LA CONTRASEÑA ACTUAL NO COINCIDE </br>";
    }
}
elseif($nueva_contra2_e==$nueva_contra_e&& $nueva_contra2_e !='' && $nueva_contra_e!=''&& $result -> num_rows>0 ){
    $row = $result2-> fetch_assoc();
    if($row[NIVEL_USUARIO]!=$usuario_e){
        echo "<br> NO PUEDES CAMBIAR LA CONTRASEA DE NINGUN OTRO USUARIO, SOLO LA TUYA </br>";
    }
}
//OPERADOR ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
elseif( $nueva_contra_o != '' && $nueva_contra2_o!=''&& $contr_acutal_o!='' && $result -> num_rows>0 ){
    $row = $result2-> fetch_assoc();
    if ($nueva_contra_o== $nueva_contra2_o && $row[CONTRASEÑA]==$contr_acutal_o &&$contr_acutal_o!= ''){
    $sql = "update MODULO_69523_68530 set CONTRASEÑA = '".$nueva_contra_o."' where USUARIO = '".$usuario_o."'";
    $result = $conn->query($sql);
    echo("<p>CONTRASEÑA PROPIA CAMBIADA CORRECTAMENTE O</p>");
    }
    else{
        echo "<br> LA CONTRASEÑA ACTUAL NO COINCIDE </br>";
    }
}
elseif($nueva_contra2_o==$nueva_contra_o && $nueva_contra2_o !='' && $nueva_contra_o!=''&& $result -> num_rows>0 ){
    $row = $result2-> fetch_assoc();
    if($row[NIVEL_USUARIO]!=$usuario_o){
        echo "<br> NO PUEDES CAMBIAR LA CONTRASEA DE NINGUN OTRO USUARIO, SOLO LA TUYA </br>";
    }
}
else{
    echo "<p> ERROR  </p>";
}

$conn->close();
?>