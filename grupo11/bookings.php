<?php
    include("templates/header.html");
?>

<body
style="background: url('assets/bookings.jpg') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;"
>
    <?php
    include("templates/navbar.html")
    ?>
        <div class="container">
        <div class="text_block">
            <h2>Bookings</h2>
            <p>All bookings related consults are here</p>
        </div>
        <div class='search'>
            <h2>Search booking</h2>
            <form action="queries/search_bookings.php" method="$_GET">
                <div class="form_row">
                    <label>Booking code</label>
                    <input type="search" name='booking_code' placeholder="Example: 4456">
                </div>      
                <input id='search_button' type='submit' value='Search'>          
            </form>
        </div>
    </div>
    <script src="script.js"></script>

</body>
</html>