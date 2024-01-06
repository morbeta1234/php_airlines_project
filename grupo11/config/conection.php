<?php
    try {
        require('data.php');
        $db = new PDO("pgsql:dbname=$db_name;host=localhost;port=5432;user=$user;");
    } catch (Exception $e){
        echo "No se pudo conectar a la base de datos: $e";  
    }
?>