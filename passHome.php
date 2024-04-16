<?php
 include('session.php');
 require_once ('config.php');

 $conn = mysqli_connect(DB_HOST, DB_USERNAME,DB_PASSWORD,DB_NAME);  

 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

 $username = $_SESSION['username'];
 //$username ='pass';
 $sql = "SELECT * FROM passenger WHERE Name=?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param( "s", $username);
 $stmt->execute();
 $result = $stmt->get_result();
 
 if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

 $row =$result->fetch_assoc();
 $email =$row['email'];
 $tel =$row['tel'];
 $photo =$row['photo'];
 $base64Image = base64_encode($photo);
 $imageMimeType = 'image/png';
 $id=$row['ID'];

 $sql ="SELECT * FROM passengerflight WHERE passenger_id=?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param( "i", $id);
 $stmt->execute();
 $result = $stmt->get_result();

 if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$flightArray = array(); 
while( $row = $result->fetch_assoc()){
    $flight_id=$row['flight_id'];
    $sql_flight="SELECT * FROM flights WHERE Completed=0 AND ID =?";
    $stmt = $conn->prepare($sql_flight);
    $stmt->bind_param( "i", $flight_id);
    $stmt->execute();
    $result_flight = $stmt->get_result();
   
    if (!$result_flight) {
        die("Query failed: " . mysqli_error($conn));
    }
    $row_flight =  $result_flight->fetch_assoc();
    $flightArray[] = $row_flight;
}







 mysqli_close($conn);
?>
