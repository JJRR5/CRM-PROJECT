<?php
//MANTENIMIENTO//////
$accion_o= $_POST['accion_o'];
$salida_o= $_POST['salida_o'];
$gpio_o= $_POST['gpio_o']; //GPIO
$pwm_o= $_POST['pwm_o']; //VALOR NEVO DEL CAMPO SELECCIONADOs
//DB/////
$servername = "localhost";
$username = "JJRR_JAAA_69523_68530";
$password = "proyecto_final";
$db_name = "DB_Proyecto_2021_JJRR_JAAA";
//CON//
$conn = new mysqli($servername,$username,$password,$db_name); //conecta con bd
$sql = "update GPIO_69523_68530 set TIPO = 'I2C', ESTADO= 'Reservado' where GPIO = '2' and GPIO= '3'";
$conn->query($sql);
if($gpio_o != ''){
    $sql = "select * from MODULO_69523_68530 where USUARIO ='".$gpio_o."'";
    $result = $conn->query($sql);
    if($conn->connect_error){
        die("Fallo de conexion: ".$conn->connect_error);
}
}
//////////////////////////ENFERMERIA////////////////////////////////////
if($accion_o==""){
    echo "<br> NO SELECCIONASTE UNA ACCION </br>";
}
if($result->num_row==0){
    echo "<br> NO EXISTE EL GPIO QUE INGRESASTE </br>";
}
//CONSULTA
elseif($accion_o == "CONSULTAR"  && $gpio_o != ""){
    $sql = "select * from GPIO_69523_68530 where GPIO ='".$gpio_o."'";
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
//MODIFICAR
elseif($accion_o == 'MODIFICAR'){
    $sql = "select * from GPIO_69523_68530 where GPIO ='".$gpio_o."'";
    $result = $conn->query($sql);
    while($row = $result-> fetch_assoc()){
    if($salida_o!='' && $result ->num_rows>0 && $row[TIPO]=="Salida" && $pwm_o==''){
        $sql = "update GPIO_69523_68530 set ESTADO = '".$salida_o."' where GPIO = '".$gpio_o."'";
        $conn->query($sql);
        echo "<br> SALIDA MODIFICADA </br>";
    }
    elseif($pwm_o==''&& $result ->num_rows>0 && $row[TIPO]!="Salida" && $salida_o!=''){
        echo "<br> EL GPIO NO ES UNA SALIDA</br>";
        echo "<br> SOLO PUEDES MODIFICAR PWM Y SALIDAS</br>";
    }
    elseif($pwm_o!=''&& $result ->num_rows>0 && $row[TIPO]=="PWM" && $salida_o=='' && is_numeric($pwm_o)){
        $num=intval($pwm_o);
        if($num<=100 && $num>=0){
            $sql = "update GPIO_69523_68530 set ESTADO = '".$pwm_o."' where GPIO = '".$gpio_o."'";
            $conn->query($sql);
            echo "<br> % PWM MODIFICADO </br>";
        }
        elseif($num>100 or $num<0){
            echo "<br> EL % DE PWM TIENE QUE SER ENTRE 0 Y 100%</br>";
        }
    }
    elseif($pwm_o!=''&& $result ->num_rows>0 && $row[TIPO]!="PWM" && $salida_o==''){
        echo "<br> EL GPIO NO ES DE TIPO PWM </br>";
        echo "<br> SOLO PUEDES MODIFICAR PWM Y SALIDAS</br>";
    }
    elseif(!is_numeric($pwm_o)){
        echo "<br> EL PWM TIENE QUE SER NUMERICO </br>";
    }
}
}
else{
    echo "<br> ERROR MAIN <br>";
}
$conn->close();
?>