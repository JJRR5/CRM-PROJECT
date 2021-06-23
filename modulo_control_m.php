<?php
//MANTENIMIENTO//////
$accion_m= $_POST['accion_m'];
$salida_m= $_POST['salida_m'];
$gpio_m= $_POST['gpio_m']; //GPIO
$pwm_m= $_POST['pwm_m']; 
$tipo_a = $_POST['tipo_a'] ;//VALOR NEVO DEL CAMPO SELECCIONADO
$servername = "localhost";
$username = "JJRR_JAAA_69523_68530";
$password = "proyecto_final";
$db_name = "DB_Proyecto_2021_JJRR_JAAA";
//CON//
$gpios= array("0","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27");
$conn = new mysqli($servername,$username,$password,$db_name); //conecta con bd
///PINES RESTRINGIDOS
$sql = "update GPIO_69523_68530 set TIPO = 'I2C', ESTADO= 'Reservado' where GPIO = '2' and GPIO= '3'";
$conn->query($sql);
//LOGICA/////////////////////
if($gpio_m != '' && $accion_m != "ALTA"){
    $sql = "select * from MODULO_69523_68530 where USUARIO ='".$gpio_m."'";
    $result = $conn->query($sql);
    if($conn->connect_error){
        die("Fallo de conexion: ".$conn->connect_error);
}
}
//////////////////////////ADMINISTRADOR////////////////////////////////////
//ALTA
if($accion_m==""){
    echo "<br> NO SELECCIONASTE UNA ACCION </br>";
}
elseif($gpio_m == ""){
    echo "<br> NO INGRESASTE EL GPIO </br>";
}
elseif(!is_numeric($gpio_m)){
    echo "<br> EL GPIO NO ES NUMERICO </br>";
}
elseif($accion_m == "ALTA" &&  $gpio_m != '' && in_array($gpio_m,$gpios,true)){
    if(is_numeric($gpio_m) && $tipo_m=="Sin uso"){
        $sql = "insert into GPIO_69523_68530 (GPIO,TIPO,ESTADO) values ('".$gpio_m."','".$tipo_m."','Nulo')";
        $result = $conn->query($sql);
        echo("<p>GPIO SIN USO INCERTADO CORRECTAMENTE</p>");
        }
        elseif(is_numeric($gpio_m) && $tipo_m=="Entrada"){
            $sql = "insert into GPIO_69523_68530 (GPIO,TIPO,ESTADO) values ('".$gpio_m."','".$tipo_m."','Cerrado')";
            $result = $conn->query($sql);
            echo("<p>GPIO ENTRADA INCERTADO CORRECTAMENTE</p>");
        }
        elseif(is_numeric($gpio_m) && $tipo_m=="PWM"){
            $sql = "insert into GPIO_69523_68530 (GPIO,TIPO,ESTADO) values ('".$gpio_m."','".$tipo_m."','0')";
            $result = $conn->query($sql);
            echo("<p>GPIO PWM INCERTADO CORRECTAMENTE</p>");
        }
        elseif(is_numeric($gpio_m) && $tipo_m=="Salida"){
            $sql = "insert into GPIO_69523_68530 (GPIO,TIPO,ESTADO) values ('".$gpio_m."','".$tipo_m."','APAGADO')";
            $result = $conn->query($sql);
            echo("<p>GPIO SALIDA INCERTADO CORRECTAMENTE</p>");
        }
}
elseif($accion_m == "ALTA" &&  $gpio_m != '' && !in_array($gpio_m,$gpios)){
    echo "<br> NO EXISTE EL GPIO </br>";
    echo "<br> SOLO SE PUEDEN REGISTRAR LOS GPIOS: 0,2-27 </br>";
}
//MODIFICACION //REVISAR POR QUE NO ENTRA AL ELSEIF
elseif($accion_m == 'MODIFICAR'){
    $sql = "select * from GPIO_69523_68530 where GPIO ='".$gpio_m."'";
    $result = $conn->query($sql);
    while($row = $result-> fetch_assoc()){
    if($salida_m!='' && $result ->num_rows>0 && $row[TIPO]=="Salida" && $pwm_m==''){ //revisa esto por que esta fallando 
        $sql = "update GPIO_69523_68530 set ESTADO = '".$salida_m."' where GPIO = '".$gpio_m."'";
        $conn->query($sql);
        echo "<br> SALIDA MODIFICADA </br>";
    }
    elseif($pwm_m==''&& $result ->num_rows>0 && $row[TIPO]!="Salida" && $salida_m!=''){
        echo "<br> EL GPIO NO ES UNA SALIDA</br>";
        echo "<br> SOLO PUEDES MODIFICAR PWM Y SALIDAS</br>";
    }
    elseif($pwm_m!=''&& $result ->num_rows>0 && $row[TIPO]=="PWM" && $salida_m=='' && is_numeric($pwm_m)){
        $num=intval($pwm_m);
        if($num<=100 && $num>=0){
            $sql = "update GPIO_69523_68530 set ESTADO = '".$pwm_m."' where GPIO = '".$gpio_m."'";
            $conn->query($sql);
            echo "<br> % PWM MODIFICADO </br>";
        }
        elseif($num>100 or $num<0){
            echo "<br> EL % DE PWM TIENE QUE SER ENTRE 0 Y 100%</br>";
        }
    }
    elseif($pwm_m!=''&& $result ->num_rows>0 && $row[TIPO]!="PWM" && $salida_m==''){
        echo "<br> EL GPIO NO ES DE TIPO PWM </br>";
        echo "<br> SOLO PUEDES MODIFICAR PWM Y SALIDAS</br>";
    }
    elseif(!is_numeric($pwm_m) && $pwm_m !=''){
        echo "<br> EL PWM TIENE QUE SER NUMERICO </br>";
    }
    else{
        echo "<br> ESTAS AQUI </br>";
    }
}
}
//CONSULTA
elseif($accion_m == "CONSULTAR"  && $gpio_m != ""){
    $sql = "select * from GPIO_69523_68530 where GPIO ='".$gpio_m."'";
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