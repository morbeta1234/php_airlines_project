<?php
    include("templates/header.html");
?>

<body
style="background: url('assets/flights.jpg') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;"
>
    <?php
    include("templates/navbar.html")
    ?>
    <div class="cover">
        <div class="text_block">
            <h2>Flights</h2>
            <p>All airlines related consults are here</p>
        </div>
        <div class="search">
        <div>
                <h2>Show flights pending approval from the DGAC</h2>
                <form action="queries/pending_flights.php" method="$_POST">
                    <input id='search_button' type='submit' value='Search'>          
                </form>
            </div>
        <div>
            <h2>Search approved flights from airport and airline</h2>
            <form action="queries/available_flights_from_airport_airline.php" method="$_GET">
                <div class="form_row">
                    <label>Destination airport's ICAO</label>
                    <select name='icao' id='select-icao'>
                        <option> Select airport</option>
                    <?php
                            require("config/conection.php");

                            // $query = "SELECT *
                            $query = "SELECT DISTINCT(codigo_icao)
                                      FROM aerodromos;"; // Crear la consulta
                            $result = $db -> prepare($query);
                            $result -> execute();
                        
                            $data = $result -> fetchAll();
                        
                            foreach ($data as $d) {
                                echo "<option>$d[0]</option>";
                            }
                        ?>
                    </select>
                </div>    
                <div class="form_row">
                    <label>Airline</label>
                    <select name='airline' id='select-airline'>
                    <option> Select airline</option>
                    <?php
                            require("config/conection.php");

                            // $query = "SELECT *
                            $query = "SELECT DISTINCT(nombre)
                                      FROM aerolineas;"; // Crear la consulta
                            $result = $db -> prepare($query);
                            $result -> execute();
                        
                            $data = $result -> fetchAll();
                        
                            foreach ($data as $d) {
                                echo "<option>$d[0]</option>";
                            }
                        ?>
                    </select>
                </div>       
                <input id='search_button' type='submit' value='Search'>          
            </form>
        </div>
        <div>
            <h2>Search count of flights status from an airline</h2>
            <form action="queries/flights_from_airline.php" method="$_GET">  
                <div class="form_row">
                    <label>Airline</label>
                    <select name='airline' id='select-airline'>
                        <option>Select airline</option>
                        <?php

                        ?>
                        <?php
                            require("config/conection.php");

                            // $query = "SELECT *
                            $query = "SELECT DISTINCT(nombre)
                                      FROM aerolineas;"; // Crear la consulta
                            $result = $db -> prepare($query);
                            $result -> execute();
                        
                            $data = $result -> fetchAll();
                        
                            foreach ($data as $d) {
                                echo "<option>$d[0]</option>";
                            }
                        ?>
                    </select>
                </div>       
                <input id='search_button' type='submit' value='Search'>          
            </form>
        </div>
    </div>
    </div>
    <script src="script.js"></script>

</body>
</html>