<?php

$paciente= $_POST['paciente'];
//////////BD///////////////////////
$servername = "localhost";
$username = "JJRR_JAAA_69523_68530";
$password = "proyecto_final";
$db_name = "DB_Proyecto_2021_JJRR_JAAA";
//CON//
date_default_timezone_set("America/Mexico_City");
$fecha= date("Y:m:d:H:i:s");
//
$conn = new mysqli($servername,$username,$password,$db_name); //conecta con bd
//VERIFICAR ID 
$sql = "select * from PACIENTES_69523_68530  where PACIENTE='".$paciente."'";
$result = $conn->query($sql);
///INCERTAR USUARIO EN LA TABLA PACIENTES
$sql2 = "select USUARIO FROM MODULO_69523_68530 ORDER BY CONSULTA DESC";
$result2 = $conn->query($sql2);
$row = $result2-> fetch_assoc();
$usuario=$row[USUARIO];
if($paciente==""){
    echo "<br> NO INGRESASTE EL NOMBRE DEL PACIENTE  </br>";
}
elseif($result->num_rows==0){
    echo "<br>NO EXISTE EL PACIENTE QUE QUIERES DAR DE ALTA </br>";
}
elseif($result->num_rows>0){
    $sql = "update PACIENTES_69523_68530 set ESTADO = 'ALTA',FECHA_ALTA='".$fecha."',USUARIO_ALTA='".$usuario."' where PACIENTE = '".$paciente."'";
    $conn->query($sql);
    echo "<br>PACIENTE DADO DE ALTA EXITOSAMENTE </br>";
}




$conn->close();