<<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <!-- <div>
        <h2>Search approved flights from airport and airline</h2>
        <form action="queries/available_flights_from_airport_airline.php" method="$_GET">
             
            <div class="form_row">
                <label>Airline</label>
                <select name='airline' id='select-airline'>
                <option> Select airline</option>
               
                </select>
            </div>       
            <input id='search_button' type='submit' value='Search'>          
        </form>
    </div> -->
    
    <div class="form_row">
        <label>Destination airport's ICAO</label>
        <select name='icao' id='select-icao'>
            <option> Select airport</option>
        <?php
            require("config/config.php");

            // $query = "SELECT *
            $query = "SELECT vuelo_id
                        FROM reservas;"; // Crear la consulta
            $result = $db -> prepare($query);
            $result -> execute();
            
            $data = $result -> fetchAll();
            echo $data[0];
            foreach ($data as $d) {
                echo "<option>$d[0]</option>";
            }
        ?>
        </select>
    </div>   
</div>
    </body>
</html>