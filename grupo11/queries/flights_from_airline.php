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

        if (count($_GET) == 1) {
        // $query = "SELECT *
        $airlinee = $_GET["airline"];

        $query = "SELECT vuelos.estado, COUNT(vuelos.estado)
        FROM vuelos JOIN aerolineas ON (vuelos.codigo_aerolinea = aerolineas.codigo AND aerolineas.nombre = :airline) 
        GROUP BY vuelos.estado;"; // Crear la consulta
        $result = $db -> prepare($query);
        $result -> execute(['airline' => $airlinee ]);

        $data = $result -> fetchAll();
        }
    ?>
<div class ='table_container'>
    <table >
        <thead>
        <tr>
            <th> Airline </th>
            <th> Status </th>
            <th> Flight Count </th>
        </tr>
        </thead>
    <tbody>
        <?php
        if (empty($data)) {
            echo "<tr>
            <td align='center'>No results</td>
            <td align='center'>No results</td>
            <td align='center'>No results</td>
          </tr>";
        } else {
            foreach ($data as $d) {
                echo "<tr>
                        <td align='center'>$airlinee</td>
                        <td align='center'>$d[0]</td>
                        <td align='center'>$d[1]</td>
                      </tr>";
            }
        }
        ?>
    </tbody>
    </table>
</div>
</body>

</html>
