<?php
//ADMINISTRADOR
$usuario_a= $_POST['usuario_a'];//USUARIO A COSNULTAR
$contr_acutal_a= $_POST['contra_a'];// CONTRASEÑA ACTUAL
$nueva_contra_a= $_POST['nueva_a']; //NUEVA CONTRASEÑA
$nueva_contra2_a= $_POST['nueva2_a']; // NUEVA CONTRASEÑA X2
/////DB////
$servername = "localhost";
$username = "JJRR_JAAA_69523_68530";
$password = "proyecto_final";
$db_name = "DB_Proyecto_2021_JJRR_JAAA";
$conn = new mysqli($servername,$username,$password,$db_name);
if($usuario_a != ''){
    $sql = "select * from MODULO_69523_68530 where USUARIO ='".$usuario_a."'";
    $result = $conn->query($sql);
    if($conn->connect_error){
        die("Fallo de conexion: ".$conn->connect_error);
    }
}
else{
    echo ("<br>NO INGRESASTE EL USUARIO AL CUAL QUIER CAMBIAR LA CONTRASEÑA</br>");
}
//LOGICA PARA CAMBIO DE CONTRASEÑA PROPIA
if( $contr_acutal_a != ''&& $nueva_contra_a != '' && $nueva_contra2_a!='' && $result -> num_rows>0 ){
    while($row = $result-> fetch_assoc()){
    if ($campo_a == "USUARIO"){
    $sql = "update MODULO_69523_68530 set CONTRASEÑA = '".$nueva_contra_a."' where USUARIO = '".$usuario_a."'";
    $result = $conn->query($sql);
    echo("<p>CONTRASEÑA CAMBIADA CORRECTAMENTE</p>");
    }
    }
}
//LOGICA PARA CAMBIO DE CONTRASEÑA DE CUALQUIER OTRO USUARIO 
?>