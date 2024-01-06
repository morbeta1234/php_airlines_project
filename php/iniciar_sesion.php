<?php
    include_once 'database.php';
    session_start();
    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }
    if(isset($_SESSION['rol'])){
        switch($_SESSION['rol']){
            case 1:
                header('location: admin.php');
            break;

            case 2:
                header('location: compania.php');

                break;
            case 3:
                header('location: cliente.php');
            default;
        }
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new Database();
        $query = $db->connect()->prepare('SELECT * FROM usuarios WHERE username = :username AND password = :password');
        $query->execute(['username' =>$username, 'password' => $password]);

        $row = $query->fetch(PDO::FETCH_NUM);
        if($row == true){
            //valida rol
            $rol = $row[3];
            $_SESSION['username'] = $username;
            $_SESSION['rol'] = $rol;
            switch($_SESSION['rol']){
                case 1:
                    header('location: admin.php');
                break;
    
                case 2:
                    header('location: compania.php');
    
                    break;
                case 3:
                    header('location: cliente.php');
                default;
            }
        }
        else{
            echo "El usuario o contraseña es incorrecto";
        }

    }






?> 