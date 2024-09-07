<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Type and User Count</title>
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
</head>
<body>

<div class="container my-4">
    <?php
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

    // SQL query to fetch data from the view
    $sql_fetch_view = "SELECT * FROM view_roomtype";

    // Execute the query to fetch data from the view
    $result = mysqli_query($conn, $sql_fetch_view);
    ?>

    <h2 class="mb-4">VIEW : Room Type and User Count</h2>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">Room Type</th>
            <th scope="col">Number of Users</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['roomtype'] . "</td>";
            echo "<td>" . $row['user_count'] . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <?php
    // Close the connection
    mysqli_close($conn);
    ?>
</div>

</body>
</html>
