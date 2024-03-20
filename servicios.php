<?php
    include('conexion.php');
    function login($user, $password){
        $con = connect();
        $token = 'NULL';
        $password = md5($password);
        $query = 'SELECT * FROM usuarios WHERE Usuario = "'.$user.'" AND contrasenia = "'.$password.'" LIMIT 1';
        $result  = $con->query($query);
        if($result) {
            date_default_timezone_set('America/Mexico_City');
            $fecha_nueva = date("Y-m-d H:i:s"); 
            $user = ('Usuario');
            $password = ('contrasenia   ');
            $id = ('id');   
            $token = md5($user.$password.$fecha_nueva);
            $query = "UPDATE usuarios SET Token = '$token', Fecha_Sesion = '$fecha_nueva' WHERE id=$id";
            $result2 = $con->query($query);
            if($result2)return $token;
        }
        return $token;
    }

    if($user = "Luis" && $pass = "Luis"){
        $token = login($_GET["user"], $_GET["pass"]);
        echo $token;
    }else{
        echo "El usuario o la contraseña son incorrectos";
    }

    function consulta($token, $tabla){
        if($token){
            $con = connect();
            $query = 'SELECT * FROM usuarios WHERE Token = "'.$token.'" LIMIT 1';
            $result  = $con->query($query);
            $fila = $result->fetch_assoc();
            if($fila){
                $query2 = 'SELECT * FROM '.$tabla;
                $result2  = $con->query($query2);
                if(!$result2)return 'No existen registros';
                $fila2 = $result2->fetch_assoc();
                if($fila2)return $fila2;
                return 'No existen registros de esta tabla: '.$tabla;
            }
            return 'El token no es valido';
        }
        return  'No se ha enviado el token';
    }
    function logout($token){   
    }