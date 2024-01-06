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

        if (count($_GET) == 1 && is_numeric($_GET['booking_code'])) {
        // $query = "SELECT *
        $code = $_GET["booking_code"];

        $query = "SELECT reservas.numero_ticket, personas.nombre, valores.valor 
        FROM vuelos 
        JOIN reservas ON (reservas.id = :code AND reservas.vuelo_id = vuelos.id) 
        JOIN pasajeros ON (pasajeros.id = reservas.pasajero_id) 
        JOIN personas ON (personas.id = pasajeros.persona_id)
        JOIN aeronaves ON (aeronaves.codigo = vuelos.codigo_aeronave)
        JOIN valores ON (valores.ruta_id = vuelos.ruta_id AND valores.peso = aeronaves.pesa);"; // Crear la consulta
        $result = $db -> prepare($query);
        $result -> execute(['code' => $code]);

        $data = $result -> fetchAll();
        }
    ?>
<div class ='table_container'>
    <table >
        <thead>
        <tr>
            <th> Ticket Number </th>
            <th> 
                Passenger Name </th>
            <th> Cost </th>
            <th>   </th>
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
                          </tr>";
                }
            }
        ?>
    </tbody>
    </table>
</div>
</body>

</html>
