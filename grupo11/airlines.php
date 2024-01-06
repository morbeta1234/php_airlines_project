<?php
    include("templates/header.html");
?>

<body
style="background: url('assets/aeroline.jpg') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;"
  >
    <?php
    include("templates/navbar.html")
    ?>
    <div class="container">
        <div class="text_block">
            <h2>Airlines</h2>
            <p>All airlines related consults are here</p>
        </div>
    </div>
    <div class='search'>
            <div>
                <h2>Show airline with most approved flights</h2>
                <form action="queries/approved_flights.php", method="$_POST">
                    <input id='search_button' type='submit' value='Search'>          
                </form>
            </div>
            <div>
                <h2>Find the customer who has bought the most tickets at the airline</h2>
                <form action="">       
                    <input id='search_button' type='submit' value='Search'>          
                </form>
            </div>
            
        </div>
    <script src="script.js"></script>

</body>
</html>