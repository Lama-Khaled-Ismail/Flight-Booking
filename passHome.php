<?php
 include('session.php');
 $host = 'localhost';
 $user = 'root';
 $pass = '';
 $db = 'flight_booking';

 $conn = mysqli_connect($host, $user, $pass, $db);

 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

 $username = $_SESSION['username'];
 //$username ='pass';
 $sql = "SELECT * FROM passenger WHERE Name='pass'";
 $result = mysqli_query($conn, $sql);

 if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

 $row = mysqli_fetch_assoc($result);
 $email =$row['email'];
 $tel =$row['tel'];
 $photo =$row['photo'];
 $base64Image = base64_encode($photo);
 $imageMimeType = 'image/jpeg';
 $id=$row['ID'];

 $sql ="SELECT * FROM passengerflight WHERE passenger_id=$id";
 $result = mysqli_query($conn, $sql);
 if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$flightArray = array(); 
while( $row = mysqli_fetch_assoc($result)){
    $flight_id=$row['flight_id'];
    $sql_flight="SELECT * FROM flights WHERE Completed=1 AND ID =flight_id";
    $result_flight=mysqli_query($conn, $sql_flight);
    if (!$result_flight) {
        die("Query failed: " . mysqli_error($conn));
    }
    $row_flight = mysqli_fetch_assoc($result_flight);
    $flightArray[] = $row_flight;
}







 mysqli_close($conn);
?>
