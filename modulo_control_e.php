<?php
//MANTENIMIENTO//////
$accion_e= $_POST['accion_e'];
$gpio_e= $_POST['gpio_e']; //GPIO
//DB
$servername = "localhost";
$username = "JJRR_JAAA_69523_68530";
$password = "proyecto_final";
$db_name = "DB_Proyecto_2021_JJRR_JAAA";
//CON//
$conn = new mysqli($servername,$username,$password,$db_name); //conecta con bd
if($gpio_e != ''){
    $sql = "select * from MODULO_69523_68530 where USUARIO ='".$gpio_e."'";
    $result = $conn->query($sql);
    if($conn->connect_error){
        die("Fallo de conexion: ".$conn->connect_error);
}
}
else{
    echo "<br> NO INGRESASTE EL GPIO </br>";
}
//////////////////////////ENFERMERIA////////////////////////////////////
if($accion_e==""){
    echo "<br> NO SELECCIONASTE UNA ACCION </br>";
}
//CONSULTA
elseif($accion_e == "CONSULTAR"  && $gpio_e != ""){
    $sql = "select * from GPIO_69523_68530 where GPIO ='".$gpio_e."'";
    $result = $conn->query($sql);
    if($result -> num_rows>0 ){
        while($row = $result-> fetch_assoc()){
            echo "<br>ESTADO: ".$row[ESTADO];
            echo "<br>/////////////////////////";
        }    
    }
    else{
        echo "Sin registros";
    }
}
else{
    echo "<br> ERROR MAIN <br>";
}

$conn->close();
?>