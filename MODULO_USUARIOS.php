<?php
$usuario= $_POST['usuario'];
$contrasena= $_POST['contrasena'];
//ADMINISTRADOR
$accion_a= $_POST['accion_a'];
//$columna_a= $_POST['columna_a'];
$valor_a= $_POST['valor_a'];
//MANTENIMIENTO
$accion_m= $_POST['accion_m'];
//$columna_m= $_POST['columna_m'];
$valor_m= $_POST['valor_m'];
//ENFERMERIA
$accion_e= $_POST['accion_e'];
//$columna_e= $_POST['columna_e'];
$valor_e= $_POST['valor_e'];
//OPERADOR
$accion_o= $_POST['accion_o'];
//$columna_o= $_POST['columna_o'];
$valor_o= $_POST['valor_o'];
/////DB////
$servername = "localhost";
$username = "JJRR_JAAA_69523_68530";
$password = "proyecto_final";
$db_name = "DB_Proyecto_2021_JJRR_JAAA";
//CON//
$conn = new mysqli($servername,$username,$password,$db_name);
if($conn->connect_error){
    die("Fallo de conexion: ".$conn->connect_error);
}
//LOGIC
$sql = "select NIVEL_USUARIO FROM MODULO_69523_68530  where USUARIO='".$usuario."'and CONTRASEÑA='".$contrasena."'";
$result = $conn->query($sql);
if($result-> num_rows>0){
    while($row = $result->fetch_assoc()){
        if($row[NIVEL_USUARIO]=="Administrador"){
            header("Location:http://localhost/administrador.html");
        }
        elseif($row[NIVEL_USUARIO]=="Mantenimiento"){
            header("Location:http://localhost/mantenimiento.html");
        }
        elseif($row[NIVEL_USUARIO]=="Enfermeria"){
            header("Location:http://localhost/enfermeria.html");
        }
        elseif($row[NIVEL_USUARIO]=="Operador"){
            header("Location:http://localhost/operador.html");
        }
        else{
            echo "<br>Usuario: ".$row[USUARIO]."<br>";
            echo "El nivel que registraste no es un nivel valido";
            echo "<title>".$row[NIVEL_USUARIO]."</title>";
        }
    }
}
else{
    echo "USER NO EXISTENTE, INTENTA DE NUEVO";
    echo "<title>USER NOT FOUND</title>";
}
$conn->close();
?>