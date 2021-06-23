<?php
//VARIABLES ////////
//ADMINSITRADOR///////
$accion_a= $_POST['accion_a'];
$campo_a= $_POST['campo_a'];
$gpio_a= $_POST['gpio_a']; //GPIO
$valor_a= $_POST['valor_a']; //VALOR NEVO DEL CAMPO SELECCIONADO
//MANTENIMIENTO//////
$accion_m= $_POST['accion_m'];
$campo_m= $_POST['campo_m'];
$gpio_m= $_POST['gpio_m']; //GPIO
$valor_m= $_POST['valor_m']; //VALOR NEVO DEL CAMPO SELECCIONADO
//ENFERMERIA////////
$accion_e= $_POST['accion_e'];
$campo_e= $_POST['campo_e'];
$gpio_e= $_POST['gpio_e']; //GPIO
//OPERADOR//////////
$accion_o= $_POST['accion_o'];
$campo_o= $_POST['campo_o'];
$gpio_o= $_POST['gpio_o']; //GPIO
$valor_o= $_POST['valor_o']; //VALOR NEVO DEL CAMPO SELECCIONADO
//////////BD///////////////////////
$servername = "localhost";
$username = "JJRR_JAAA_69523_68530";
$password = "proyecto_final";
$db_name = "DB_Proyecto_2021_JJRR_JAAA";
//CON//
$conn = new mysqli($servername,$username,$password,$db_name); //conecta con bd
//VERIFICA SI EL USUARIO EXISTE CUANDO NO ES ALTA 
if($valor_a == '' && $accion_a != "ALTA"){
    if($accion_a==""){
        echo "<br> NO SELECCIONASTE UNA ACCION </br>";
    }
    elseif($gpio_a == ""){
        echo "<br> NO INGRESASTE EL GPIO </br>";
    }
    else{
    $sql = "select * from MODULO_69523_68530 where USUARIO ='".$valor_a."'";
    $result = $conn->query($sql);
    if($conn->connect_error){
        die("Fallo de conexion: ".$conn->connect_error);
    }
}
}
//////////////////////////ADMINISTRADOR////////////////////////////////////
//ALTA

if($accion_a == "ALTA" &&  $gpio_a != ''){
    if(is_numeric($gpio_a)){
    $sql = "insert into GPIO_69523_68530 (GPIO) values ('".$gpio_a."')";
    $result = $conn->query($sql);
    echo("<p>GPIO INCERTADO CORRECTAMENTE</p>");
    }
    else{
        echo "<br> LOS GPIO SOLO PUEDEN SER NUMERICOS </br>";
    }
}
//BAJA
elseif($accion_a == "BAJA" && $result -> num_rows>0 && $gpio_a!=""){
    $sql = "delete from GPIO_69523_68530 where GPIO='".$gpio_a."'";
    $result = $conn->query($sql);
    echo("<p>GPIO ELIMINADO CORRECTAMENTE</p>");    
} 
//MODIFICACION
/*
elseif($accion_a == "MODIFICAR" && $result -> num_rows>0 && $gpio_a!="" && $valor_a!=''){
    $sql = "delete from GPIO_69523_68530 where GPIO='".$gpio_a."'";
    $result = $conn->query($sql);
    echo("<p>GPIO ELIMINADO CORRECTAMENTE</p>");    
} */
//CONSULTA
elseif($accion_a == "CONSULTAR"  && $gpio_a != ""){
    $sql = "select * from GPIO_69523_68530 where GPIO ='".$gpio_a."'";
    $result = $conn->query($sql);
    if($result -> num_rows>0 ){
        while($row = $result-> fetch_assoc()){
            echo "<br>ID: ".$row[ID];
            echo "<br>GPIO: ".$row[GPIO];
            echo "<br>TIPO: ".$row[TIPO];
            echo "<br>DESCRIPCION: ".$row[DESCRIPCION];
            echo "<br>UBICACION: ".$row[UBICACION];
            echo "<br>ESTADO: ".$row[ESTADO];
            echo "<br>/////////////////////////";
        }    
    }
    else{
        echo "Sin registros";
    }
}
$conn->close();
?>