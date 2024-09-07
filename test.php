


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
</head>
<body>
<?php




// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "logindatabase";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
    echo "Connection was successful<br>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $address = $_POST['address'];

    $peopleCount = $_POST['peopleCount'];
    $roomIDs = $_POST['roomIDs'];
    $rooms = $_POST['rooms'];
    $booktime = $_POST['booktime'];

$sql = "SELECT * FROM `user`";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['username'];
echo $name;
// Find the number of records returned
$num = mysqli_num_rows($result);
echo'loooooop';
echo $row;
while($row = mysqli_fetch_assoc($result)){
    // echo var_dump($row);
    echo $row['username'] .  ". Hello ". $row['gender'] ." Welcome to ". $row['address'];
    echo "<br>";
}
}
?>

    <h2>User Profile</h2>
    <div>
        <h3>Profile Information</h3>
        <form action="user_page.php" method="post">
        <label for="username">Name:<?php echo $name; ?></label>
            <input type="text" id="name" name="name" required>
            <button type="submit" name="editName">Edit</button><br>
        </form>

        <form action="user_page.php" method="post">
            <label for="gender">Gender:</label>
            <input type="text" id="gender" name="gender" required>
            <button type="submit" name="editGender">Edit</button><br>
        </form>

        <form action="user_page.php" method="post">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
            <button type="submit" name="editAge">Edit</button><br>
        </form>

        <form action="user_page.php" method="post">
            <label for="address">Origin Address:</label>
            <input type="text" id="address" name="address" required>
            <button type="submit" name="editAddress">Edit</button><br>
        </form>

        <form action="user_page.php" method="post">
            <label for="peopleCount">No. of People in the Room:</label>
            <input type="number" id="peopleCount" name="peopleCount" required>
            <button type="submit" name="editPeopleCount">Edit</button><br>
        </form>

        <form action="user_page.php" method="post">
            <label for="roomIDs">Room IDs:</label>
            <input type="text" id="roomIDs" name="roomIDs" required>
            <button type="submit" name="editRoomIDs">Edit</button><br>
        </form>

        <form action="user_page.php" method="post">
            <label for="rooms">Room count:</label>
            <input type="text" id="rooms" name="rooms" required>
            <button type="submit" name="editnrooms">Edit</button><br>
        </form>

        <form action="user_page.php" method="post">
            <label for="booktime">Booking time:</label>
            <input type="text" id="booktime" name="booktime" required>
            <button type="submit" name="editbooktime">Edit</button><br>
        </form>

    </div>


    <h2>Available Rooms</h2>
    <div>
        <h3>Room Types</h3>
        <ul>
            <li>Small Room - Price: $100/night (3 available) <button onclick="bookRoom('small')">Book</button></li>
            <li>Medium Room - Price: $150/night (5 available) <button onclick="bookRoom('medium')">Book</button></li>
            <li>Large Room - Price: $200/night (2 available) <button onclick="bookRoom('large')">Book</button></li>
        </ul>
    </div>

    <script>
        function editAttribute(attribute) {
            var newValue = prompt("Enter new value for " + attribute + ":");
            if (newValue !== null && newValue.trim() !== "") {
                document.getElementById(attribute).value = newValue;
            }
        }

        // Function to book a room
        function bookRoom(roomType) {
            // Implement booking logic here
        }
    </script>
</body>
</html>