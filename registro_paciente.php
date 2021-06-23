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
    echo "<br>NO EXISTE EL PACIENTE NI SU REPORTE</br>";
}
elseif($result -> num_rows>0 ){
    while($row = $result-> fetch_assoc()){
        echo "<p> REPORTE DE PACIENTE </p>";
        echo "<br>PACIENTE: ".$row[PACIENTE];
        echo "<br>FECHA DE HOSPITALIZACIÓN: ".$row[FECHA_HOSPI];
        if ($row[FECHA_ALTA] == "0000-00-00 00:00:00"){
            echo "<br> EL PACIENTE AUN NO HA SIDO DADO DE ALTA </br>";
        }
        else{
            echo "<br>FECHA DE ALTA : ".$row[FECHA_ALTA];
        }
        echo "<br>SPO2: ".$row[SPO2];
        echo "<br>/////////////////////////";
    }    
}




$conn->close();