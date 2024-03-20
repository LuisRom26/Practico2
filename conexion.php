<?php
function connect(){
    $server = "localhost";
    $user = "root";
    $password = "1234";
    $db = "test2";
    $conn = new mysqli($server,$user,$password,$db);
    if($conn->connect_errno){
        echo "Error: No se puede conectar a MySQL";
        exit;
    }
    return $conn;
    
}