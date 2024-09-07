<!DOCTYPE html>
// <!-- its me Prashant Bharti -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
</head>
<body>
<?php

    session_start(); // Start the session
    // Check if the message is set in the session
    if(isset($_SESSION['message'])) {
        echo "<div class='alert alert-success'>".$_SESSION['message']."</div>";
        // Unset the session variable to remove the message after displaying it
        unset($_SESSION['message']);
    }
    // Rest of your code for user_page.php
?>

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
    echo "Connection is successful<br>";
}

// Function to handle form submissions
function handleFormSubmission($conn, $columnName, $postName) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST[$postName])) {
        $value = $_POST[$postName];
        $username = $_SESSION['username']; // Assuming you're using session to store username
        $sql = "UPDATE `user` SET `$columnName` = '$value' WHERE `username` = '$username'";
        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}

// Handling form submissions for editing user details
handleFormSubmission($conn, "username", "editName");
handleFormSubmission($conn, "gender", "editGender");
handleFormSubmission($conn, "age", "editAge");
handleFormSubmission($conn, "address", "editAddress");
handleFormSubmission($conn, "peopleCount", "editPeopleCount");
handleFormSubmission($conn, "roomIDs", "editRoomIDs");
handleFormSubmission($conn, "rooms", "editnrooms");
handleFormSubmission($conn, "booktime", "editbooktime");

// Function to book a room
function bookRoom($conn, $roomid) {
    $username = $_SESSION['username']; // Assuming you're using session to store username
    $sql = "INSERT INTO `user` (`username`, `roomid`) VALUES ('$username', '$roomid')";
    if (mysqli_query($conn, $sql)) {
        echo "Room booked successfully";
    } else {
        echo "Error booking room: " . mysqli_error($conn);
    }
}
?>

    <h2>User Profile</h2>
    <div>
        <h3>Profile Information</h3>
        <form action="user_page.php" method="post">
        <label for="username">Name:</label>
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


        <!-- Other form fields for editing user details -->

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

</body>
</html>
