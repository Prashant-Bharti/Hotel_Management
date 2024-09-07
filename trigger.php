<?php  
// Connect to the Database 
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

// SQL statement to create the trigger if it doesn't exist
$sql = "
CREATE TRIGGER IF NOT EXISTS room_capacity_trigger BEFORE INSERT ON booking
FOR EACH ROW
BEGIN
    DECLARE small_count INT;
    DECLARE medium_count INT;
    DECLARE large_count INT;

    -- Count the number of entries for each room type
    SELECT COUNT(*) INTO small_count FROM booking WHERE roomtype = 'Small';
    SELECT COUNT(*) INTO medium_count FROM booking WHERE roomtype = 'Medium';
    SELECT COUNT(*) INTO large_count FROM booking WHERE roomtype = 'Large';

    -- Check if any room type count exceeds the limit
    IF (small_count >= 5 AND NEW.roomtype = 'Small') OR
       (medium_count >= 5 AND NEW.roomtype = 'Medium') OR
       (large_count >= 5 AND NEW.roomtype = 'Large') THEN
        -- Insert the booking data into waitinguser table
        INSERT INTO logindatabase.waitinguser (userid, username, userpassword, gender, age, roomtype, roomid, booktime, duetime)
        VALUES (NEW.userid, NEW.username, NEW.userpassword, NEW.gender, NEW.age, NEW.roomtype, NEW.roomid, NEW.booktime, NEW.duetime);

        -- Cancel the insertion into booking table
       
    END IF;
END;
";

// Execute the SQL statement
if (mysqli_multi_query($conn, $sql)) {
  //   echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  //   <strong>Success!</strong> TRIGGER CREATED
  //   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  //     <span aria-hidden='true'>×</span>
  //   </button>
  // </div>";
}
 else {
    // echo "Error creating trigger: " . mysqli_error($conn);
}

// Close the database connection



