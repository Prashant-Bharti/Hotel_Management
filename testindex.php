<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestUserLogin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <?php require 'nav.php' ?>

    <div class="container">
        <h2>Login</h2>
        <!-- // its me Prashant Bharti -->

        <!-- User Login Form -->
        <h3>User Login</h3>
        <form action="testindex.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="customer_username" name="username" required>

            <label for="userpassword">Password:</label>
            <input type="password" id="userpassword" name="userpassword" required>

            <input type="submit" value="Login as User" class="btn" name="enter">
        </form>

        <!-- Link to Owner Login Page -->
        <p>Are you a hotel owner? <a href="login_owner.php">Login here</a>.</p>

        <?php
            session_start(); // Start the session

            $servername = "localhost";
            $db_username = "root";
            $db_password = ""; 
            $database = "logindatabase";

            $conn = mysqli_connect($servername, $db_username, $db_password, $database);
            if (!$conn) { 
                die("Connection failed: " . mysqli_connect_error());
            }

            if(isset($_POST['enter'])){
                $username = $_POST['username'];
                $userpassword = $_POST['userpassword'];

                // Insert into user table
                $user_sql = "INSERT INTO `user` (`username`, `userpassword`) VALUES ('$username', '$userpassword')";
                $user_result = mysqli_query($conn, $user_sql);
                
                if ($user_result) { 
                    // Set username in session for later use
                    $_SESSION['username'] = $username;
                    // Redirect to testuser.php
                    header("Location: testuser.php");
                    exit(); // Make sure no other code is executed after redirection
                } else {
                    echo "Failed!!!!";
                }
            }
        ?>

    </div>
</body>
</html>
