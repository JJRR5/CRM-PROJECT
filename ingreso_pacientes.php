<?php

$paciente= $_POST['paciente'];
$padecimiento = $_POST['padecimiento'] ;
//////////BD///////////////////////
$servername = "localhost";
$username = "JJRR_JAAA_69523_68530";
$password = "proyecto_final";
$db_name = "DB_Proyecto_2021_JJRR_JAAA";
//CON//
date_default_timezone_set("America/Mexico_City");
$fecha= date("Y:m:d:G:i:s");
//
$conn = new mysqli($servername,$username,$password,$db_name); //conecta con bd
//VERIFICAR ID 

$sql = "select * from PACIENTES_69523_68530  where PACIENTE='".$paciente."'";
$result = $conn->query($sql);


if($conn->connect_error){
    die("Fallo de conexion: ".$conn->connect_error);
}

if($paciente==""){
    echo "<br> NO INGRESASTE EL NOMBRE DEL PACIENTE  </br>";
}
elseif($padecimiento== ""){
    echo "<br> NO INGRESASTE EL PADECIMIENTO </br>";
}
elseif($padecimiento!='' && $paciente!='' && $result->num_rows==0){
    $sql = "insert into PACIENTES_69523_68530 (PACIENTE,PADECIMIENTO,FECHA_HOSPI,ESTADO) values ('".$paciente."','".$padecimiento."','".$fecha."','HOSPITALIZADO')";
    $result = $conn->query($sql);
    echo("<p>PACIENTE HOSPITALIZADO CORRECTAMENTE</p>");
}
elseif($padecimiento!='' && $paciente!='' && $result->num_rows>0){
    $sql = "update PACIENTES_69523_68530 set PADECIMIENTO = '".$padecimiento."',FECHA_HOSPI='".$fecha."',FECHA_ALTA = '0000-00-00 00:00:00',FECHA_MONI = '0000-00-00 00:00:00',USUARIO_ALTA='TODAVIA NO',USUARIO_MONITOREO='TODAVIA NO', ESTADO= 'HOSPITALIZADO'where PACIENTE = '".$paciente."'";
    $conn->query($sql);
    echo "<br>PACIENTE RE-HOSPITALIZADO CORRECTAMENTE </br>";
}




$conn->close();