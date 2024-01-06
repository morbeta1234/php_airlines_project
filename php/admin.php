<?php
    session_start();
    if(!isset($_SESSION['rol'])){
        header('location: logout.php');
        // header('location: ../index.html');
    }else{
        if($_SESSION['rol'] !=1){
            header('location: logout.php');
            // header('location: ../index.html');
        }
        
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN </title>
    <h3>Bienvenido admin <?php echo $_SESSION['username'];?> </h3>
</head>
<body>
    
    
</body>
</html>