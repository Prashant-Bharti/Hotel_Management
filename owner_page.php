<?php

// <!-- its me Prashant Bharti -->

// INSERT INTO `user` (`bookid`, `userid`, `username`, `booktime`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;
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

 include('trigger.php');

if(isset($_GET['delete'])){
  $bookid = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `booking` WHERE `bookid` = $bookid";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){


if (isset( $_POST['bookidEdit'])){
  // Update the record
    $bookid = $_POST["bookidEdit"];
    $userid = $_POST["useridEdit"];
    $username = $_POST["usernameEdit"];
    $userpassword = $_POST["userpasswordEdit"];
    $gender = $_POST["genderEdit"];
    $age = $_POST["ageEdit"];
    $roomtype = $_POST["roomtypeEdit"];
    $roomid = $_POST["roomidEdit"];
    $booktime = $_POST["booktimeEdit"];
    $duetime = $_POST["duetimeEdit"];
    $duetime = date('Y-m-d H:i:s', strtotime($booktime . ' + 1 month'));
    if(empty($booktime)) {
    $booktime = date("Y-m-d H:i:s");}
    if(empty($duetime)) {
    $duetime = date("Y-m-d H:i:s");
}



  // Sql query to be executed
  $sql = "UPDATE `booking` SET `userid` = '$userid', `username` = '$username', `userpassword` = '$userpassword', `gender` = '$gender', `age` = '$age', `roomtype` = '$roomtype', `roomid` = '$roomid', `booktime` = '$booktime', `duetime` = '$duetime' WHERE `booking`.`bookid` = $bookid";


  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $userid = $_POST["userid"];
    $username = $_POST["username"];
    $userpassword = $_POST["userpassword"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $roomtype = $_POST["roomtype"];
    $roomid = $_POST["roomid"];
    $booktime = $_POST["booktime"];
    $duetime = $_POST["duetime"];

//////////////////////////////////////////////////
    // Validate age
    $age = $_POST["age"];
    if ($age < 18) {
        echo "Age must be 18 or above to book.";
        exit; // Stop further execution
    }
//////////////////////////////////////////////////

  // Sql query to be executed
  $sql = "INSERT INTO `booking` (`userid`, `username`, `userpassword`, `gender`, `age`, `roomtype`, `roomid`, `booktime`, `duetime`)
  VALUES ('$userid', '$username', '$userpassword', '$gender', '$age', '$roomtype', '$roomid', '$booktime', '$duetime')";
  
  $result = mysqli_query($conn, $sql);

         


  if($result){ 
      $insert = true;
  }
  else{
    // 
      echo "The record was not inserted successfully because of this error ---> Rooom Fulll ";
  } 
}
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

   <!-- Link your external CSS file here -->
   <link rel="stylesheet" href="view_style.css">



</head>

<body>
 

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-userid" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/hotelproject/owner_page.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="bookidEdit" id="bookidEdit">
            <div class="form-group">
              <label for="userid">Note userid</label>
              <input type="text" class="form-control" id="useridEdit" name="useridEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="username">Note username</label>
              <textarea class="form-control" id="usernameEdit" name="usernameEdit" rows="3"></textarea>
            </div> 
            <div class="form-group">
              <label for="userpassword">Note userpassword</label>
              <input type="text" class="form-control" id="userpasswordEdit" name="userpasswordEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
    <label for="gender">Note gender</label>
    <select class="form-control" id="genderEdit" name="genderEdit">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>
</div>
            <div class="form-group">
              <label for="age">Note age</label>
              <input type="text" class="form-control" id="ageEdit" name="ageEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
    <label for="roomtype">Note roomtype</label>
    <select class="form-control" id="roomtypeEdit" name="roomtypeEdit">
        <option value="Small">Small</option>
        <option value="Medium">Medium</option>
        <option value="Large">Large</option>
    </select>
</div>
            <div class="form-group">
              <label for="roomid">Note roomid</label>
              <input type="text" class="form-control" id="roomidEdit" name="roomidEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="booktime">Note booktime</label>
              <input type="datetime-local" textarea class="form-control" id="booktimeEdit" name="booktimeEdit" rows="3"></textarea>
            </div> 
            <div class="form-group">
              <label for="duetime">Note duetime</label>
              <input type="datetime-local" textarea class="form-control" id="duetimeEdit" name="duetimeEdit" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="hom.png" height="28px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>

  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4">
    <h2><strong>Book New Record</strong> </h2>
    <hr>
    <form action="/hotelproject/owner_page.php" method="POST">
      <div class="form-group">
        <label for="userid">Note userid</label>
        <input type="text" class="form-control" id="userid" name="userid" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="username">Note username</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="userpassword">Note userpassword</label>
        <input type="text" class="form-control" id="userpassword" name="userpassword" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
    <label for="gender">Note gender</label>
    <select class="form-control" id="gender" name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>
</div>
      <div class="form-group">
        <label for="age">Note age</label>
        <input type="text" class="form-control" id="age" name="age" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
    <label for="roomtype">Note roomtype</label>
    <select class="form-control" id="roomtype" name="roomtype">
        <option value="Small">Small</option>
        <option value="Medium">Medium</option>
        <option value="Large">Large</option>
    </select>
</div>
      <div class="form-group">
        <label for="roomid">Note roomid</label>
        <input type="text" class="form-control" id="roomid" name="roomid" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="booktime">Note booktime</label>
        <input type="datetime-local" class="form-control" id="booktime" name="booktime" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="duetime">Note duetime</label>
        <input type="datetime-local" class="form-control" id="duetime" name="duetime" aria-describedby="emailHelp">
      </div>

      <button type="submit" class="btn btn-primary">Add submit</button>
    </form>
  </div>

  <div class="container my-4">
    <hr>
<h2><strong>Existing Bookings</strong></h2>

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">bookid</th>
          <th scope="col">userid</th>
          <th scope="col">username</th>
          <th scope="col">userpassword</th>
          <th scope="col">gender</th>
          <th scope="col">age</th>
          <th scope="col">roomtype</th>
          <th scope="col">roomid</th>
          <th scope="col">booktime</th>
          <th scope="col">duetime</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `booking`";
          $result = mysqli_query($conn, $sql);
          $bookid = 0;
          while($row = mysqli_fetch_assoc($result)){
            $bookid = $bookid + 1;
            echo "<tr>
            <th scope='row'>". $bookid . "</th>
            <td>". $row['userid'] . "</td>
            <td>". $row['username'] . "</td>
            <td>". $row['userpassword'] . "</td>
            <td>". $row['gender'] . "</td>
            <td>". $row['age'] . "</td>
            <td>". $row['roomtype'] . "</td>
            <td>". $row['roomid'] . "</td>
            <td>". $row['booktime'] . "</td>
            <td>". $row['duetime'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['bookid'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['bookid'].">Delete</button>  </td>
          </tr>";
        } 
          ?>


      </tbody>
    </table>
  </div>
  <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
edits = document.getElementsByClassName('edit');
Array.from(edits).forEach((element) => {
  element.addEventListener("click", (e) => {
    console.log("edit ");
    tr = e.target.parentNode.parentNode;

        userid = tr.getElementsByTagName("td")[0].innerText;
        username = tr.getElementsByTagName("td")[1].innerText;
        userpassword = tr.getElementsByTagName("td")[2].innerText;
        gender = tr.getElementsByTagName("td")[3].innerText;
        age = tr.getElementsByTagName("td")[4].innerText;
        roomtype = tr.getElementsByTagName("td")[5].innerText;
        roomid = tr.getElementsByTagName("td")[6].innerText;
        booktime = tr.getElementsByTagName("td")[7].innerText;
        duetime = tr.getElementsByTagName("td")[8].innerText;
        console.log(userid, username,userpassword,gender,age,roomtype,roomid,booktime,duetime);

        useridEdit.value = userid;
        usernameEdit.value = username;
        userpasswordEdit.value = userpassword;
        genderEdit.value = gender;
        ageEdit.value = age;
        roomtypeEdit.value = roomtype;
        roomidEdit.value = roomid;
        booktimeEdit.value = booktime;
        duetimeEdit.value = duetime;

        bookidEdit.value = e.target.id; // Set bookid before showing modal
    console.log(e.target.id)
    $('#editModal').modal('toggle');
  })
})

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        bookid = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/hotelproject/owner_page.php?delete=${bookid}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>

<script>
    document.getElementById('booktime').addEventListener('change', function() {
        var booktimeValue = new Date(this.value);
        var duetimeValue = new Date(booktimeValue.getFullYear(), booktimeValue.getMonth() + 1, booktimeValue.getDate(), booktimeValue.getHours(), booktimeValue.getMinutes());
        document.getElementById('duetime').value = duetimeValue.toISOString().slice(0, 16);
    });
</script>


<!-- /////////////////////////////////////////////////////////////////////// -->
<div class="container my-4">
    <!-- Other content -->
    <a href="view_room.php" class="redirect-button">VIEW: RoomType</a>
</div>
<div class="container my-4">
    <!-- Other content -->
    <a href="view_day.php" class="redirect-button">VIEW: DaysLeft</a> 
</div>



</body>

</html>
