<?php
//VARIABLES ////////
//ADMINSITRADOR///////
$accion_a= $_POST['accion_a'];
$salida_a= $_POST['salida_a'];
$gpio_a= $_POST['gpio_a']; //GPIO
$pwm_a= $_POST['pwm_a'];
$tipo_a = $_POST['tipo_a'] ;
//////////BD///////////////////////
$servername = "localhost";
$username = "JJRR_JAAA_69523_68530";
$password = "proyecto_final";
$db_name = "DB_Proyecto_2021_JJRR_JAAA";
//CON//
$gpios= array("0","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27");
$conn = new mysqli($servername,$username,$password,$db_name); //conecta con bd
//VERIFICA SI EL USUARIO EXISTE CUANDO NO ES ALTA 
if($gpio_a != '' && $accion_a != "ALTA"){
    $sql = "select * from GPIO_69523_68530 where GPIO='".$gpio_a."'";
    $result = $conn->query($sql);
    if($conn->connect_error){
        die("Fallo de conexion: ".$conn->connect_error);
}
}
//////////////////////////ADMINISTRADOR////////////////////////////////////
//ALTA
if($accion_a==""){
    echo "<br> NO SELECCIONASTE UNA ACCION </br>";
}
elseif($gpio_a == ""){
    echo "<br> NO INGRESASTE EL GPIO </br>";
}
elseif(!is_numeric($gpio_a)){
    echo "<br> EL GPIO NO ES NUMERICO </br>";
}
//ALTA////////////////////////////////////////////////////////////////////////////////////////////////
elseif($accion_a == "ALTA" &&  $gpio_a != ''&& in_array($gpio_a,$gpios) && $tipo_a!=''){
    if(is_numeric($gpio_a) && $tipo_a=="Sin uso"){
    $sql = "insert into GPIO_69523_68530 (GPIO,TIPO,ESTADO) values ('".$gpio_a."','".$tipo_a."','Nulo')";
    $result = $conn->query($sql);
    echo("<p>GPIO SIN USO INCERTADO CORRECTAMENTE</p>");
    }
    elseif(is_numeric($gpio_a) && $tipo_a=="Entrada"){
        $sql = "insert into GPIO_69523_68530 (GPIO,TIPO,ESTADO) values ('".$gpio_a."','".$tipo_a."','Cerrado')";
        $result = $conn->query($sql);
        echo("<p>GPIO ENTRADA INCERTADO CORRECTAMENTE</p>");
    }
    elseif(is_numeric($gpio_a) && $tipo_a=="PWM"){
        $sql = "insert into GPIO_69523_68530 (GPIO,TIPO,ESTADO) values ('".$gpio_a."','".$tipo_a."','0')";
        $result = $conn->query($sql);
        echo("<p>GPIO PWM INCERTADO CORRECTAMENTE</p>");
    }
    elseif(is_numeric($gpio_a) && $tipo_a=="Salida"){
        $sql = "insert into GPIO_69523_68530 (GPIO,TIPO,ESTADO) values ('".$gpio_a."','".$tipo_a."','APAGADO')";
        $result = $conn->query($sql);
        echo("<p>GPIO SALIDA INCERTADO CORRECTAMENTE</p>");
    }
}
elseif($accion_a == "ALTA" &&  $gpio_a != ''&& in_array($gpio_a,$gpios) && $tipo_a==''){
    echo "<br> NO SE SELECCIONO EL TIPO DE GPIO QUE SE QUIERE DAR DE ALTA </br>";
}
elseif($accion_a == "ALTA" &&  $gpio_a != ''&& !in_array($gpio_a,$gpios)){
    echo "<p> EL GPIO QUE INGRESASTE NO ES UN PIN FISICO DISPONIBLE </p>";
}
////////////////////////////////////////////////////////////////////////////////////////////////////////
//BAJA
elseif($accion_a == "BAJA" && $result -> num_rows>0 && $gpio_a!=""){
    $sql = "delete from GPIO_69523_68530 where GPIO='".$gpio_a."'";
    $result = $conn->query($sql);
    echo("<p>GPIO ELIMINADO CORRECTAMENTE</p>");    
} 
elseif($accion_a == 'MODIFICAR'){
    $sql = "select * from GPIO_69523_68530 where GPIO ='".$gpio_a."'";
    $result = $conn->query($sql);
    while($row = $result-> fetch_assoc()){
    if($salida_a!='' && $result ->num_rows>0 && $row[TIPO]=="Salida" && $pwm_a==''){ //revisa esto por que esta fallando 
        $sql = "update GPIO_69523_68530 set ESTADO = '".$salida_a."' where GPIO = '".$gpio_a."'";
        $conn->query($sql);
        echo "<br> SALIDA MODIFICADA </br>";
    }
    elseif($pwm_a==''&& $result ->num_rows>0 && $row[TIPO]!="Salida" && $salida_a!=''){
        echo "<br> EL GPIO NO ES UNA SALIDA</br>";
        echo "<br> SOLO PUEDES MODIFICAR PWM Y SALIDAS</br>";
    }
    elseif($pwm_a!=''&& $result ->num_rows>0 && $row[TIPO]=="PWM" && $salida_a=='' && is_numeric($pwm_a)){
        $num=intval($pwm_a);
        if($num<=100 && $num>=0){
            $sql = "update GPIO_69523_68530 set ESTADO = '".$pwm_a."' where GPIO = '".$gpio_a."'";
            $conn->query($sql);
            echo "<br> % PWM MODIFICADO </br>";
        }
        elseif($num>100 or $num<0){
            echo "<br> EL % DE PWM TIENE QUE SER ENTRE 0 Y 100%</br>";
        }
    }
    elseif($pwm_a!=''&& $result ->num_rows>0 && $row[TIPO]!="PWM" && $salida_a==''){
        echo "<br> EL GPIO NO ES DE TIPO PWM </br>";
        echo "<br> SOLO PUEDES MODIFICAR PWM Y SALIDAS</br>";
    }
    elseif(!is_numeric($pwm_a) && $pwm_a !=''){
        echo "<br> EL PWM TIENE QUE SER NUMERICO </br>";
    }
    else{
        echo "<br> ERROR";
    }
}
}
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
else{
    echo "<br> ERROR MAIN <br>";
}
$conn->close();
?>