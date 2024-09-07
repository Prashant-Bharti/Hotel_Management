<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <style>
        /* Animation for table rows */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        tbody tr {
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Custom styling for table */
        .table {
            background-color: #f8f9fa; /* Light gray background */
        }

        .table thead th {
            background-color: #343a40; /* Dark gray header */
            color: #fff; /* White text */
            border-color: #343a40; /* Matching border */
        }

        .table tbody tr:nth-of-type(odd) {
            background-color: #e9ecef; /* Alternate row color */
        }
    </style>
    <title>Booking Days Passed</title>
</head>

<body>

<!-- Display the Booking Days Passed -->
<div class="container my-4">
    <h2>Number of Days Passed Since Booking</h2>
    <hr>
    <?php
    // Connect to the Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "logindatabase";

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Die if connection was not successful
    if (!$conn) {
        die("Sorry we failed to connect: " . mysqli_connect_error());
    }

    // Query the view_days_passed view
    $sql = "SELECT * FROM `view_days_passed`";
    $result = mysqli_query($conn, $sql);

    // Display the view results
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'>Book ID</th>";
    echo "<th scope='col'>Days Passed</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['bookid'] . "</td>";
        echo "<td>" . $row['days_passed'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

    // Close the database connection
    mysqli_close($conn);
    ?>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.7.0/dist/umd/popper.min.js"
        integrity="sha384-uDcXezR1QXsf+c0PhOTOnhFJC0y0Ec9S+Mif5J9zQVJye26Bqum6e6U7KdFHaR+Q"
        crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous">
</script>
</body>

</html>
