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
        $query = "SELECT t1.nombre, t1.codigo, ROUND((CAST(t2.count as DECIMAL) / t1.count) * 100, 2) as p
        FROM (
            SELECT aerolineas.nombre, aerolineas.codigo, COUNT(vuelos.id) 
            FROM aerolineas 
            JOIN vuelos ON (vuelos.codigo_aerolinea = aerolineas.codigo) 
            GROUP BY aerolineas.codigo) as t1 
        JOIN (
            SELECT aerolineas.nombre, aerolineas.codigo, COUNT(vuelos.id) 
            FROM aerolineas 
            JOIN vuelos ON (vuelos.codigo_aerolinea = aerolineas.codigo AND vuelos.estado = 'aceptado') 
            GROUP BY aerolineas.codigo) as t2 ON (t1.codigo = t2.codigo)
            ORDER BY p DESC
            LIMIT 1;"; // Crear la consulta
        $result = $db -> prepare($query);
        $result -> execute();

        $data = $result -> fetchAll();
    ?>
<div class ='table_container'>
    <table >
        <thead>
        <tr>
            <th> Airline Name </th>
            <th> Airline Code </th>
            <th> Approved Flights % </th>
        </tr>
        </thead>
    <tbody>
        <?php
            foreach ($data as $d) {
                echo "<tr>
                        <td align='center'>$d[0]</td>
                        <td align='center'>$d[1]</td>
                        <td align='center'>$d[2]</td>
                      </tr>";
            }
        ?>
    </tbody>
    </table>
</div>
</body>

</html>
