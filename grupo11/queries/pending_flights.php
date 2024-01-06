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

        // $query = "SELECT *
        $query = "SELECT id, codigo_vuelo, codigo_aerolinea, estado
                  FROM vuelos
                  WHERE lower(estado) = 'pendiente' ORDER BY id;"; // Crear la consulta
        $result = $db -> prepare($query);
        $result -> execute();

        $data = $result -> fetchAll();
    ?>
<div class ='table_container'>
    <table >
        <thead>
        <tr>
            <th> Flight ID </th>
            <th> Flight Code </th>
            <th> Airline Code </th>
            <th> Status </th>
        </tr>
        </thead>
    <tbody>
        <?php
            foreach ($data as $d) {
                echo "<tr>
                        <td align='center'>$d[0]</td>
                        <td align='center'>$d[1]</td>
                        <td align='center'>$d[2]</td>
                        <td align='center'>$d[3]</td>
                      </tr>";
            }
        ?>
    </tbody>
    </table>
</div>
</body>

</html>
