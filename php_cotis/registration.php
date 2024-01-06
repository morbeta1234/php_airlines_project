<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de Pasajeros | PHP</title>
</head>
<body>
    <?php
    if(count($_GET) > 0 and $_GET['id_vuelo']){
        $id_vuelo = $_GET['id_vuelo'];
        
    }elseif($_POST['id_vuelo']){
        $id_vuelo = $_POST['id_vuelo'];
        
    }
    ?>

<div>
    <form action= "registration.php" method= "post">
        <div class="container">
            <h1>Ingreso de Pasajeros</h1>
            <p>Rellene con pasaportes de los pasajeros</p>
            <label for = "pasaporte1"><b>Pasaporte Pasajero 1</b></label>
            <input type="text" name = "pasaporte1" required>

            <label for = "pasaporte2"><b>Pasaporte Pasajero 2</b></label>
            <input type="text" name = "pasaporte2" >

            <label for = "pasaporte3"><b>Pasaporte Pasajero 3</b></label>
            <input type="text" name = "pasaporte3" >
            <input type="hidden"  name="id_vuelo" value= <?php echo $id_vuelo?>>
            <input type="submit" name = "create" value= "Sign Up"> 
        </div>

    </form>
    
</div>
<div>
    <?php
    if(isset($_POST['create'])){
        if (!empty($_POST['pasaporte1']) || !empty($_POST['pasaporte2']) || !empty($_POST['pasaporte3'])) {
            // $comprador = $_SESSION['id'];
            $pasaporte1 = trim(htmlspecialchars($_POST['pasaporte1']));
            $pasaporte2 = trim(htmlspecialchars($_POST['pasaporte2']));
            $pasaporte3 = trim(htmlspecialchars($_POST['pasaporte3']));
            
            require("config/config.php");
            // if(!empty($pasaporte2) and empty($pasaporte3)){
            //     $query = "SELECT reservas('$pasaporte1','',1,58);";
            // };
            // if(empty($pasaporte2) and empty($pasaporte3)){
            //     $query = "SELECT reservas('$pasaporte1','','',1,58);";
            // };
            // if(empty($pasaporte2) and !empty($pasaporte3)){
            //     $query = "SELECT reservas('$pasaporte1','','$pasaporte3',1,58);";
            // };
            // if(empty($pasaporte2) and !empty($pasaporte3)){
            //     $query = "SELECT reservas('$pasaporte1','$pasaporte2','$pasaporte3',1,58);";
            // };
            $query = "SELECT reserva(:pasaporte1,:pasaporte2,:pasaporte3,:comprador,:id_v);";
            
            
            $query = "SELECT reserva(:pasaporte1,:pasaporte2,:pasaporte3,1,:id_v);";
            $result = $db -> prepare($query);
            // $result -> execute(['pasaporte1' => $pasaporte1, 'pasaporte2' => $pasaporte2, 'pasaporte3' => $pasaporte3 , 'comprador' => $comprador]);
            $result -> execute(['pasaporte1' => $pasaporte1, 'pasaporte2' => $pasaporte2, 'pasaporte3' => $pasaporte3, 'id_v' => $id_vuelo,'comprador' => $comprador]);
            $data = $result -> fetchAll();
            echo "<br>";
            echo $data[0]['reserva'];
            
            
        };
    }

    ?>

</div>
</body>
</html>