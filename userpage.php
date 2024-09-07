<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserLogin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!-- Navbar -->
<?php require 'nav.php' ?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->



    <div class="container">
    <h2>Login</h2>
    
    <!-- User Login Form -->
    <h3>User Login</h3>
    <form action="update_user.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $user_row['name']; ?>">

                <label for="gender">Gender:</label>
                <input type="text" id="gender" name="gender" value="<?php echo $user_row['gender']; ?>">

                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="<?php echo $user_row['age']; ?>">

                <label for="origin_address">Origin Address:</label>
                <input type="text" id="origin_address" name="origin_address" value="<?php echo $user_row['origin_address']; ?>">

                <label for="people_in_room">No. of People in the Room:</label>
                <input type="number" id="people_in_room" name="people_in_room" value="<?php echo $user_row['people_in_room']; ?>">

                <label for="room_ids">Room IDs:</label>
                <input type="text" id="room_ids" name="room_ids" value="<?php echo $user_row['room_ids']; ?>">

                <label for="room_count">Room Count:</label>
                <input type="number" id="room_count" name="room_count" value="<?php echo $user_row['room_count']; ?>">

                <label for="booking_time">Booking Time:</label>
                <input type="text" id="booking_time" name="booking_time" value="<?php echo $user_row['booking_time']; ?>">

                <input type="submit" value="Update">
            </form>

    <!-- Link to Owner Login Page -->
<p>Are you a hotel owner? <a href="login_owner.php">Login here</a>.</p>


    <!-- Hotel Owner Login Form
    <h3>Hotel Owner Login</h3>
    <form action="owner_page.php" method="post">
        <label for="ownername">Ownername:</label>
        <input type="text" id="ownername" name="ownername" required>

        <label for="ownerpassword">Password:</label>
        <input type="password" id="ownerpassword" name="ownerpassword" required>
        <input type="submit" value="Login as Hotel Owner">
    </form> -->

<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

<?php


    $servername = "localhost";
    $db_username = "root";
    $db_password = ""; 
    $database = "logindatabase";

    $conn = mysqli_connect($servername, $db_username, $db_password, $database);
    if (!$conn) { 
        die("Connection failed: " . mysqli_connect_error());
    }
else {echo  "connecteded......";}
?>

    <?php
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     echo "<div class='error-message'>";
    //     echo "Invalid username or password. Please try again.";
    //     echo "</div>";
    // }
    ?>

<?php
    session_start(); // Start the session
    if(isset($_POST['enter'])){
        
        $username = $_POST['username'];
        $userpassword = $_POST['userpassword'];

        // Insert into user table
        $user_sql = "INSERT INTO `user` (`username`, `userpassword`) VALUES ('$username', '$userpassword')";
        $user_result = mysqli_query($conn, $user_sql);
        
        if ($user_result) { 
            $_SESSION['message'] = "Data inserted successfully!";
            // Redirect to user_page.php
            header("Location: user_page.php");
            exit(); // Make sure no other code is executed after redirection
        } else {
            echo "Failed!!!!";
        }


}
?>



</div>
</body>
</html>



<form action="update_user.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $user_row['name']; ?>">

                <label for="gender">Gender:</label>
                <input type="text" id="gender" name="gender" value="<?php echo $user_row['gender']; ?>">

                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="<?php echo $user_row['age']; ?>">

                <label for="origin_address">Origin Address:</label>
                <input type="text" id="origin_address" name="origin_address" value="<?php echo $user_row['origin_address']; ?>">

                <label for="people_in_room">No. of People in the Room:</label>
                <input type="number" id="people_in_room" name="people_in_room" value="<?php echo $user_row['people_in_room']; ?>">

                <label for="room_ids">Room IDs:</label>
                <input type="text" id="room_ids" name="room_ids" value="<?php echo $user_row['room_ids']; ?>">

                <label for="room_count">Room Count:</label>
                <input type="number" id="room_count" name="room_count" value="<?php echo $user_row['room_count']; ?>">

                <label for="booking_time">Booking Time:</label>
                <input type="text" id="booking_time" name="booking_time" value="<?php echo $user_row['booking_time']; ?>">

                <input type="submit" value="Update">
            </form>
