<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN </title>
    <h3>GENERA RESERVAS INMEDIATAMENTE </h3>

    <form id="detalles_reserva" action="marto.php" method = "POST">
        <laber> Nombre ciudad origen </label>
        <select name='ciudad_origen' id='select-ori' required>
        <option value = ""> Seleccione Origen</option>
        <?php
            require("config/config.php");

                            
        
            $query = "SELECT nombre_ciudad FROM ciudad;";// Crear la consulta
            
            $result = $db -> prepare($query);
            $result -> execute();
            
            $data = $result -> fetchAll();
            echo $data[0];
            foreach ($data as $d) {
                echo "<option value=$d[0] >$d[0]</option>";
            }
        ?>
        </select><br></br>
        <laber> Nombre ciudad destino </label>
        <select name='ciudad_destino' id='select-des' required>
        <option value = ""> Seleccione destino</option>
        <?php
            require("config/config.php");

                            
        
            $query = "SELECT nombre_ciudad FROM ciudad;";// Crear la consulta
            
            $result = $db -> prepare($query);
            $result -> execute();
            
            $data = $result -> fetchAll();
            echo $data[0];
            foreach ($data as $d) {
                echo "<option value= $d[0]>$d[0]</option>";
            }
        ?>
        </select><br></br>
        <label> Fecha de despegue </label>
        <input type="date" name="fecha_despegue" placeholder="formato dd/mm/yyyy" step="1" required >

        <br></br>

        <input type="submit" name="btn_enviar" value="Desplegar vuelos">
    </form>
    
    <?php
        if(isset($_POST['btn_enviar'])){require("config/config.php");

        $data = array();

        
        // $query = "SELECT *
        $origen = $_POST['ciudad_origen'];
        $destino = $_POST['ciudad_destino'];
        $fecha = $_POST['fecha_despegue'];

        $query = "SELECT salida.id, salida.codigo_vuelo, llegada.fecha_llegada
        FROM (SELECT vuelos.id, vuelos.estado, vuelos.codigo_vuelo, aerodromo.nombre_ciudad, vuelos.fecha_salida FROM vuelos, aerodromo WHERE vuelos.estado = 'aceptado' AND vuelos.aerodromo_salida_id = aerodromo.aerodromo_id) as salida, 
        (SELECT vuelos.id, vuelos.estado, vuelos.codigo_vuelo, aerodromo.nombre_ciudad, vuelos.fecha_llegada FROM vuelos, aerodromo WHERE vuelos.estado = 'aceptado' AND vuelos.aerodromo_llegada_id = aerodromo.aerodromo_id) as llegada 
        WHERE :ciudad_salida = salida.nombre_ciudad AND :ciudad_llegada = llegada.nombre_ciudad AND salida.id = llegada.id AND :fecha = date(salida.fecha_salida);"; // Crear la consulta
        $result = $db -> prepare($query);
        $result -> execute([ 'ciudad_salida' => $origen , 'ciudad_llegada' => $destino, 'fecha' => $fecha ]);

        $data2 = $result -> fetchAll();
    }
        
    ?>
    <div class ='table_container'>
        <table >
            <thead>
            <tr>
                <th>   </th>
                <th> id_vuelo  </th>
                <th> Flight Code </th>
                <th> Fecha de llegada </th>
                
                
            </tr>
            </thead>
        <tbody>
            <?php
            if (empty($data2)) {
                echo "<tr>
                <td></td>
                <td align='center'>No results</td>
                <td align='center'>No results</td>
                <td align='center'>No results</td>
                
            </tr>";
            } else {
                foreach ($data2 as $d) {
                    echo "<tr>
                            <td align='center'> <a class='show' href=registration.php?id_vuelo=$d[0]> Reservar</a></td>
                            <td align='center'>$d[0]</td>
                            <td align='center'>$d[1]</td>
                            <td align='center'>$d[2]</td>
                        
                        </tr>";
                }
            }
            ?>
        </tbody>
        </table>
    </div>


</head>
<body>


</body>
</html>




