<?php

$paciente= $_POST['paciente'];
//////////BD///////////////////////
$servername = "localhost";
$username = "JJRR_JAAA_69523_68530";
$password = "proyecto_final";
$db_name = "DB_Proyecto_2021_JJRR_JAAA";
//CON//
$conn = new mysqli($servername,$username,$password,$db_name); //conecta con bd
//VERIFICAR ID 
$sql = "select * from PACIENTES_69523_68530  where PACIENTE='".$paciente."'";
$result = $conn->query($sql);
///INCERTAR USUARIO EN LA TABLA PACIENTES

if($paciente==""){
    echo "<br> NO INGRESASTE EL NOMBRE DEL PACIENTE  </br>";
}
elseif($result->num_rows==0){
    echo "<br>NO EXISTE EL PACIENTE QUE QUIERES BUSCAR </br>";
}
elseif($result -> num_rows>0 ){
    while($row = $result-> fetch_assoc()){
        echo "<br>ID: ".$row[ID];
        echo "<br>PACIENTE: ".$row[PACIENTE];
        echo "<br>ESTADO: ".$row[ESTADO];
        echo "<br>PADECIMIENTO: ".$row[PADECIMIENTO];
        echo "<br>USUARIO QUE DIO DE ALTA: ".$row[USUARIO_ALTA];
        echo "<br>USUARIO QUE MONITOREO : ".$row[USUARIO_MONITOREO];
        echo "<br>/////////////////////////";
    }    
}




$conn->close();