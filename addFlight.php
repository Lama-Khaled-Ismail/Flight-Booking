<?php
    include('session.php');
    if(isset($_POST['submit']))
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = $_POST["name"];
            $cities = $_POST["city"];
            $startTimes = $_POST["startTime"];
            $endTimes = $_POST["endTime"];
            $fees =$_POST["fees"];
            $passengers = $_POST["passengers"];
        }

        if (empty($name)) {
            die("Name is required");
        }

        if (!is_numeric($fees) || $fees < 0) {
            die("Invalid fees value");
        }
    }
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'flight_booking';
   
    $conn = mysqli_connect($host, $user, $pass, $db);
   
    if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }
   
 ?>
