<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!-- Navbar -->
<?php require 'nav.php' ?>

<!-- // its me Prashant Bharti -->

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $ownername = $_POST['ownername'];
    $ownerpassword = $_POST['ownerpassword'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = ""; 
    $database = "logindatabase";

    $conn = mysqli_connect($servername, $db_username, $db_password, $database);
    if (!$conn) { 
        die("Connection failed: " . mysqli_connect_error());
    }
    else {
        // Insert into user table
        $user_sql = "INSERT INTO `user` (`username`, `user_password`) VALUES ('$username', '$user_password')";
        $user_result = mysqli_query($conn, $user_sql);

        // Insert into owner table
        $owner_sql = "INSERT INTO `owner` (`ownername`, `ownerpassword`) VALUES ('$ownername', '$ownerpassword')";
        $owner_result = mysqli_query($conn, $owner_sql);

        if ($user_result && $owner_result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> Your entry has been submitted successfully!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> We are facing some technical issue and your entry was not submitted successfully! We regret the inconvenience caused!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>';
        }
    }
}
?>

<div class="container">
    <h2>Login</h2>
    
    <!-- User Login Form -->
    <h3>User Login</h3>
    <form action="user_page.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="customer_username" name="username" required>

        <label for="user_password">Password:</label>
        <input type="password" id="user_password" name="user_password" required>
        <input type="submit" value="Login as User">
    </form>

    <!-- Hotel Owner Login Form -->
    <h3>Hotel Owner Login</h3>
    <form action="owner_page.php" method="post">
        <label for="ownername">Ownername:</label>
        <input type="text" id="ownername" name="ownername" required>

        <label for="ownerpassword">Password:</label>
        <input type="password" id="ownerpassword" name="ownerpassword" required>
        <input type="submit" value="Login as Hotel Owner">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<div class='error-message'>";
        echo "Invalid username or password. Please try again.";
        echo "</div>";
    }
    ?>
</div>
</body>
</html>

<!-- // /////////////////////////////////////////////////////////////////////// -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Page</title>
</head>
<body>
    <h2>Booking Details</h2>
    <table>
        <thead>
            <tr>
                <th>Room ID</th>
                <th>Username</th>
                <th>Age</th>
                <th>Sex</th>
                <th>Origin Address</th>
                <th>Room Type</th>
                <th>Price Paid</th>
                <th>Entry Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connect to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "logindatabase";

            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch booking details from the database
            $sql = "SELECT * FROM bookings";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["room_id"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["age"] . "</td>";
                    echo "<td>" . $row["sex"] . "</td>";
                    echo "<td>" . $row["origin_address"] . "</td>";
                    echo "<td>" . $row["room_type"] . "</td>";
                    echo "<td>" . $row["price_paid"] . "</td>";
                    echo "<td>" . $row["entry_time"] . "</td>";
                    echo "<td>";
                    echo "<button onclick='editBooking()'>Edit</button>";
                    echo "<button onclick='deleteBooking()'>Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No bookings found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <h2>Room Prices</h2>
    <div>
        <h3>Room Type</h3>
        <p>Small Room - Price: $100</p>
        <button onclick="changePrice('small')">Change Price</button>

        <h3>Room Type</h3>
        <p>Medium Room - Price: $150</p>
        <button onclick="changePrice('medium')">Change Price</button>

        <h3>Room Type</h3>
        <p>Large Room - Price: $200</p>
        <button onclick="changePrice('large')">Change Price</button>
    </div>

    <!-- JavaScript functions for handling owner actions -->
    <script>
        function editBooking() {
            // Implement functionality to edit booking details
            alert("Edit booking functionality will be implemented here.");
        }

        function deleteBooking() {
            // Implement functionality to delete booking
            alert("Delete booking functionality will be implemented here.");
        }

        function changePrice(roomType) {
            // Implement functionality to change room price
            alert("Change price for " + roomType + " room functionality will be implemented here.");
        }
    </script>
</body>
</html>
