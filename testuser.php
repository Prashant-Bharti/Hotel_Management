<?php
// <!-- its me Prashant Bharti -->


session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$database = "logindatabase";

// Establish connection to the database
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

// Function to retrieve user information from the database
function getUserInfo($conn, $columnName) {
    $username = $_SESSION['username']; // Assuming you're using session to store username
    $sql = "SELECT `$columnName` FROM `user` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row[$columnName];
    } else {
        return "";
    }
}

// Function to handle form submissions and update data in the database
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>

<h2>User Profile</h2>
<div>
    <h3>Profile Information</h3>
    <!-- Form for Name -->
    <form action="testuser.php" method="post">
        <label for="username">Name:</label>
        <input type="text" id="username" name="username" value="<?php echo getUserInfo($conn, 'username'); ?>" disabled>
        <button type="submit" name="editName">Edit</button><br>
    </form>
    <form action="testuser.php" method="post">
            <label for="gender">Gender:</label>
            <input type="text" id="gender" name="gender" required>
            <button type="submit" name="editGender">Edit</button><br>
        </form>

        <form action="testuser.php" method="post">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
            <button type="submit" name="editAge">Edit</button><br>
        </form>

        <form action="testuser.php" method="post">
            <label for="address">Origin Address:</label>
            <input type="text" id="address" name="address" required>
            <button type="submit" name="editAddress">Edit</button><br>
        </form>

        <form action="testuser.php" method="post">
            <label for="peopleCount">No. of People in the Room:</label>
            <input type="number" id="peopleCount" name="peopleCount" required>
            <button type="submit" name="editPeopleCount">Edit</button><br>
        </form>

        <form action="testuser.php" method="post">
            <label for="roomIDs">Room IDs:</label>
            <input type="text" id="roomIDs" name="roomIDs" required>
            <button type="submit" name="editRoomIDs">Edit</button><br>
        </form>

        <form action="testuser.php" method="post">
            <label for="rooms">Room count:</label>
            <input type="text" id="rooms" name="rooms" required>
            <button type="submit" name="editnrooms">Edit</button><br>
        </form>

        <form action="testuser.php" method="post">
            <label for="booktime">Booking time:</label>
            <input type="text" id="booktime" name="booktime" required>
            <button type="submit" name="editbooktime">Edit</button><br>
        </form>

</div>

</body>
</html>
