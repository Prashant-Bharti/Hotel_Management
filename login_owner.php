<?php
    $servername = "localhost";
    $db_username = "root";
    $db_password = ""; 
    $database = "logindatabase";

    $conn = mysqli_connect($servername, $db_username, $db_password, $database);
    if (!$conn) { 
        die("Connection failed: " . mysqli_connect_error());
    }
// else {echo  "connecteded......";}
?>

    <?php
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     echo "<div class='error-message'>";
    //     echo "Invalid username or password. Please try again.";
    //     echo "</div>";
    // }
    ?>
<!-- its me Prashant Bharti -->

<?php
    session_start(); // Start the session
    if(isset($_POST['submit'])){
        
        $ownername = $_POST['ownername'];
        $ownerpassword = $_POST['ownerpassword'];

        
// Check if owner credentials exist in the owner table
$owner_sql = "SELECT * FROM `owner` WHERE `ownername` = '$ownername' AND `ownerpassword` = '$ownerpassword'";
$owner_result = mysqli_query($conn, $owner_sql);

if (mysqli_num_rows($owner_result) == 1) {
    // echo"redirect  happened";
    // Redirect to owner_page.php if owner credentials are correct
    $_SESSION['ownername'] = $ownername; // Store ownername in session for later use
    header("Location: owner_page.php");
    
    exit();
} else {
   

    // If owner credentials are incorrect, display error message
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Invalid ownername or password. Please try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OwnerLogin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            background-image: url('hom.png'); /* Specify the path to your background image */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            opacity: 1; /* Adjust the opacity value to make the image translucent */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
<?php require 'nav.php' ?>
<!-- /////////////////////////////////////////////////////////////////////////////////// -->

<div class="container">
    <h2><span style="color: red; font-weight: bold;">Welcome to</span><br><span style="color: blue; font-weight: bold;">Gautam Vistar !!!</span></h2>    
    <!-- User Login Form
    <h3>User Login</h3>
    <form action="user_page.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="customer_username" name="username" required>

        <label for="user_password">Password:</label>
        <input type="password" id="user_password" name="user_password" required>
        <input type="submit" value="Login as User">
    </form> -->

    <!-- Hotel Owner Login Form -->
    <h3>Hotel Owner Login</h3>
    <form action="login_owner.php" method="post">
        <label for="ownername">Ownername:</label>
        <input type="text" id="ownername" name="ownername" required>

        <label for="ownerpassword">Password:</label>
        <input type="password" id="ownerpassword" name="ownerpassword" required>

        <input type="submit" value="Login as Hotel Owner" name = "submit">
    </form>

    <!-- Link to Owner Login Page -->
    <!-- <p>Are you a Customer? <a href="index.php">Login here</a>.</p> -->

<!-- ///////////////////////////////////////////////////////////////////////////////////// -->

<!-- //////////////////////////////////////////////////////////////////// -->



</div>
</body>
</html>
