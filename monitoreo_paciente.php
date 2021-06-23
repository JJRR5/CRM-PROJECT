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
    echo "<br>NO EXISTE EL PACIENTE QUE QUIERES MONITOREAR </br>";
}
elseif ($result -> num_rows>0 ){
while($row = $result-> fetch_assoc()){
if($result->num_rows>0 && $row[ESTADO]=="HOSPITALIZADO"){
    $sql = "update PACIENTES_69523_68530 set FECHA_MONI='".$fecha."',USUARIO_MONITOREO='".$usuario."' where PACIENTE = '".$paciente."'";
    //$sql = "insert into PACIENTES_69523_68530 (ID,PACIENTE,FECHA_HOSPI,FECHA_ALTA,FECHA_MONI,ESTADO,PADECIMIENTO,SPO2,USUARIO_ALTA,USUARIO_MONITOREO) values ('".$row[ID]."','".$paciente."','".$row[FECHA_HOSPI]."','".$row[FECHA_ALTA]."','".$fecha."','".$row[ESTADO]."','".$row[PADECIMIENTO]."','".$row[SPO2]."','".$row[USUARIO_ALTA]."','".$usuario."')";
    $conn->query($sql);
    $pi= exec("sudo python3 /home/pi/Proyecto_Final_JJRR_JAAA/MAX30100/SPO2.py"." ".$paciente);
    echo($pi);
}
elseif($result->num_rows>0 && $row[ESTADO]=="ALTA"){
    echo "<br> SOLO PUEDES MONITOREAR USUARIOS HOSPITALIZADOS</br>";
}
}

}
else{
    echo "<p> ERROR";
}



$conn->close();