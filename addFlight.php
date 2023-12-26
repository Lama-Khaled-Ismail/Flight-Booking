<?php
    include('session.php');
    $comname = $_SESSION['username'];
     //for testing purposes
    //$comname='root1';
   
    if(isset($_POST['submit']))
    {
        var_dump($_POST);
       
        
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
    
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'flight_booking';
   
    $conn = mysqli_connect($host, $user, $pass, $db);
   
    if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }
   //get company id
   
   $sql ="SELECT ID FROM company WHERE Name='$comname'";
   $result = mysqli_query($conn, $sql);
   if (!$result) {
    die("Query failed: " . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result);
    $id =$row['ID'];
    
    // insert into flights
    $sql = "INSERT INTO flights (Name, Completed,passengers_no,RegPassangers,PendPassangers	, fees,company_id,start_city,end_city) VALUES ('$name',0, $passengers,0,0, $fees,$id,'','')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $sql ="SELECT ID FROM flights WHERE Name='$name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $flight_id =$row['ID'];
    

    $first_city= mysqli_real_escape_string($conn, $cities[0]);
    for ($i = 0; $i < count($cities); $i++) {
        $last_city = mysqli_real_escape_string($conn, $cities[$i]);
        $city = mysqli_real_escape_string($conn, $cities[$i]);
        $startTime =  $startTimes[$i];
        $endTime =  $endTimes[$i];

        echo $city;
        echo $startTime;

        // Assuming 'cities' is the name of your table
        $sql = "INSERT INTO itinerary (flight_id,city, start_time, end_time) VALUES ( $flight_id,'$city','$startTime', '$endTime')";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
    }
     $sql = "UPDATE  flights SET start_city='$first_city' , end_city='$last_city'  WHERE ID=$flight_id";
     $result = mysqli_query($conn, $sql);
     if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    mysqli_close($conn);
        
        
    }
    else {
        echo "Form not submitted or submit button not clicked.";
    }

    



 ?>
