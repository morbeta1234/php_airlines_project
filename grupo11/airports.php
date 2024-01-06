<?php
    include("templates/header.html");
?>

<body
style="background: linear-gradient( rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2) ), url('assets/airport.jpg') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;"
  >
    <?php
    include("templates/navbar.html")
    ?>
        <div class="container">
        <div class="text_block">
            <h2>Airports</h2>
            <p>All airports related consults are here</p>
        </div>
    </div>
    <div class='search_block1'>
            <h2>Search available flights from airport and airline</h2>
            <form action="">
                <div class="form_row">
                    <label>Destination airport's ICAO</label>
                    <select name='icao' id='select-icao'>
                        <?php

                        ?>
                        <option>MIA</option>
                        <option>SCL</option>
                    </select>
                </div>    
                <div class="form_row">
                    <label>Airline</label>
                    <select name='airline' id='select-airline'>
                        <?php

                        ?>
                        <option>Latam</option>
                        <option>Sky</option>
                    </select>
                </div>       
                <input id='search_button' type='submit' value='Search'>          
            </form>
        </div>
    <script src="script.js"></script>

</body>

</html>