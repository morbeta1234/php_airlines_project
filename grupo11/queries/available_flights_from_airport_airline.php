<?php
    include("../templates/header_queries.html");
?>

<body
style="background: url('../assets/flights.jpg') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;">
<?php
    include("../templates/navbar_queries.html");
?>

<?php
        require("../config/conection.php");

        $data = array();

        if (count($_GET) == 2) {
        // $query = "SELECT *
        $airport = $_GET["icao"];
        $airlinee = $_GET["airline"];

        $query = "SELECT  vuelos.codigo_vuelo, vuelos.estado, aerodromos.nombre, aerolineas.nombre
        FROM vuelos 
        JOIN aerodromos ON (vuelos.estado = 'aceptado' AND vuelos.aerodromo_llegada_id = aerodromos.id AND aerodromos.codigo_icao = :airport) 
        JOIN aerolineas ON (aerolineas.codigo = vuelos.codigo_aerolinea AND vuelos.estado = 'aceptado' AND aerolineas.nombre = :airline);"; // Crear la consulta
        $result = $db -> prepare($query);
        $result -> execute([ 'airport' => $airport, 'airline' => $airlinee ]);

        $data = $result -> fetchAll();
        }
    ?>
<div class ='table_container'>
    <table >
        <thead>
        <tr>
            <th> Flight Code </th>
            <th> Approved Flights  </th>
            <th> Airline Name </th>
            <th> Arrival Airport </th>
        </tr>
        </thead>
    <tbody>
        <?php
        if (empty($data)) {
            echo "<tr>
            <td align='center'>No results</td>
            <td align='center'>No results</td>
            <td align='center'>No results</td>
            <td align='center'>No results</td>
          </tr>";
        } else {
            foreach ($data as $d) {
                echo "<tr>
                        <td align='center'>$d[0]</td>
                        <td align='center'>$d[1]</td>
                        <td align='center'>$d[2]</td>
                        <td align='center'>$d[3]</td>
                      </tr>";
            }
        }
        ?>
    </tbody>
    </table>
</div>
</body>

</html>
