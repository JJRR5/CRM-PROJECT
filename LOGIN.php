<?php
$usuario= $_POST['usuario'];
$contrasena= $_POST['contrasena'];
$modulo = $_POST['modulo1'];
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
//FUNCION DATE
date_default_timezone_set("America/Mexico_City");
$fecha=date("Y:m:d:G:i:s");
//LOGIC
$sql = "select NIVEL_USUARIO,ID FROM MODULO_69523_68530  where USUARIO='".$usuario."'and CONTRASEÑA='".$contrasena."'";
$result = $conn->query($sql);
if($modulo == ''){
    echo "<br> NO SELECCIONASTE UN MODULO </br>";
}
if($result-> num_rows>0 && $modulo!=''){
    while($row = $result->fetch_assoc()){
        //USUARIOS///////////////////////////////////////////////////////////////////////////////////////////
        if($row[NIVEL_USUARIO]=="Administrador"&& $modulo =='USUARIOS'){
            header("Location:http://localhost/administrador.html");
        }
        elseif($row[NIVEL_USUARIO]=="Mantenimiento"&& $modulo =='USUARIOS'){
            header("Location:http://localhost/mantenimiento.html");
        }
        elseif($row[NIVEL_USUARIO]=="Enfermeria"&& $modulo =='USUARIOS'){
            header("Location:http://localhost/enfermeria.html");
        }
        elseif($row[NIVEL_USUARIO]=="Operador"&& $modulo =='USUARIOS'){
            header("Location:http://localhost/operador.html");
        }
        //CONTRASEÑA////////////////////////////////////////////////////////////////////////////////////
        elseif($row[NIVEL_USUARIO]=="Administrador"&& $modulo =='CONTRASEÑA'){
            $sql = "update MODULO_69523_68530 set CONSULTA = '".$fecha."' where USUARIO = '".$usuario."'";
            $result = $conn->query($sql);
            header("Location:http://localhost/administrador_c.html");
        }
        elseif($row[NIVEL_USUARIO]=="Mantenimiento"&& $modulo =='CONTRASEÑA'){
            $sql = "update MODULO_69523_68530 set CONSULTA = '".$fecha."' where USUARIO = '".$usuario."'";
            $result = $conn->query($sql);
            header("Location:http://localhost/mantenimiento_c.html");
        }
        elseif($row[NIVEL_USUARIO]=="Enfermeria"&& $modulo =='CONTRASEÑA'){
            $sql = "update MODULO_69523_68530 set CONSULTA = '".$fecha."' where USUARIO = '".$usuario."'";
            $result = $conn->query($sql);
            header("Location:http://localhost/enfermeria_c.html");
        }
        elseif($row[NIVEL_USUARIO]=="Operador"&& $modulo =='CONTRASEÑA'){
            $sql = "update MODULO_69523_68530 set CONSULTA = '".$fecha."' where USUARIO = '".$usuario."'";
            $result = $conn->query($sql);
            header("Location:http://localhost/operador_c.html");
        }
        ///////////////////CONTROL ///////////////////////////////////////////////////////////////////////////////
        elseif($row[NIVEL_USUARIO]=="Administrador"&& $modulo =='CONTROL'){
            header("Location:http://localhost/administrador_control.html");
        }
        elseif($row[NIVEL_USUARIO]=="Mantenimiento"&& $modulo =='CONTROL'){
            header("Location:http://localhost/mantenimiento_control.html");
        }
        elseif($row[NIVEL_USUARIO]=="Enfermeria"&& $modulo =='CONTROL'){
            header("Location:http://localhost/enfermeria_control.html");
        }
        elseif($row[NIVEL_USUARIO]=="Operador"&& $modulo =='CONTROL'){
            header("Location:http://localhost/operador_control.html");
        }
        //METEOROLOGICO/////////////////////////////////////////////////////////////////////////////////////
        elseif($row[NIVEL_USUARIO]=="Administrador"&& $modulo =='METEOROLOGICO'){
            $ID = $row[ID];
            $python = exec("sudo python3 /home/pi/Proyecto_Final_JJRR_JAAA/METEOROLOGICO.py"." ".$ID);
            echo ($python);
        }
        elseif($row[NIVEL_USUARIO]=="Mantenimiento"&& $modulo =='METEOROLOGICO'){
            $ID = $row[ID];
            $python = exec("sudo python3 /home/pi/Proyecto_Final_JJRR_JAAA/METEOROLOGICO.py"." ".$ID);
            echo ($python);
        }
        elseif($row[NIVEL_USUARIO]=="Enfermeria"&& $modulo =='METEOROLOGICO'){
            $ID = $row[ID];
            $python = exec("sudo python3 /home/pi/Proyecto_Final_JJRR_JAAA/METEOROLOGICO.py"." ".$ID);
            echo ($python);
        }
        elseif($row[NIVEL_USUARIO]=="Operador"&& $modulo =='METEOROLOGICO'){
            echo "<br> LOS OPERADORES NO TIENEN PERMITIDO CONSULTAR ESTE MODULO </br>";
        }
        //PACIENTES/////////////////////////////////////////////////////////////////////////////////////////////////
        elseif($row[NIVEL_USUARIO]=="Administrador"  && $modulo =='INGRESO'){
            header("Location:http://localhost/ingreso_pacientes.html");
        }
        elseif($row[NIVEL_USUARIO]=="Enfermeria"  && $modulo =='INGRESO'){
            header("Location:http://localhost/ingreso_pacientes.html");
        }
        elseif($row[NIVEL_USUARIO]=="Administrador" && $modulo =='ALTA'){
            $sql = "update MODULO_69523_68530 set CONSULTA = '".$fecha."' where USUARIO = '".$usuario."'";
            $result = $conn->query($sql);
            header("Location:http://localhost/alta_paciente.html");
        }
        elseif($row[NIVEL_USUARIO]=="Enfermeria" && $modulo =='ALTA'){
            $sql = "update MODULO_69523_68530 set CONSULTA = '".$fecha."' where USUARIO = '".$usuario."'";
            $result = $conn->query($sql);
            header("Location:http://localhost/alta_paciente.html");
        }
        elseif($row[NIVEL_USUARIO]=="Enfermeria" && $modulo =='MONITOREO'){
            $sql = "update MODULO_69523_68530 set CONSULTA = '".$fecha."' where USUARIO = '".$usuario."'";
            $result = $conn->query($sql);
            header("Location:http://localhost/monitoreo_paciente.html");
        }
        elseif($row[NIVEL_USUARIO]=="Administrador" && $modulo =='BUSQUEDA'){
            header("Location:http://localhost/busqueda_paciente.html");
        }
        elseif($row[NIVEL_USUARIO]=="Enfermeria" && $modulo =='BUSQUEDA'){
            header("Location:http://localhost/busqueda_paciente.html");
        }
        elseif($row[NIVEL_USUARIO]=="Administrador" && $modulo =='REPORTE'){
            header("Location:http://localhost/registro_paciente.html");
        }
        elseif($row[NIVEL_USUARIO]=="Enfermeria" && $modulo =='REPORTE'){
            header("Location:http://localhost/registro_paciente.html");
        }
        elseif($row[NIVEL_USUARIO]=="Mantenimiento" or $row[NIVEL_USUARIO]=="Operador"&& $modulo =='INGRESO' or $modulo =='ALTA'or$modulo =='BUSQUEDA'or$modulo =='REPORTE'or$modulo =='MONITOREO'){
            echo "<br> NO TIENES PERMITIDO INGRESAR A ESTE MODULO </br>";
        }
        else{
            echo "<br>Usuario: ".$row[USUARIO]."<br>";
            echo "El nivel que registraste no es un nivel valido";
            echo "<title>".$row[NIVEL_USUARIO]."</title>";
        }
    }
}
elseif($result ->num_rows==0){
    echo "<br> USUARIO O CONTRASEÑA INCORRECTOS </br>";
}
$conn->close();
?>