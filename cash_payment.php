<?php

require_once("config.php");
include_once("session.php");
include_once("encrypt.php");
include_once("decrypt.php");



if ($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['pay_with_cash'])) {
    echo("Choose flight first before payment"); exit;
}
$conn = mysqli_connect(DB_HOST, DB_USERNAME,DB_PASSWORD,DB_NAME);  

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM passenger WHERE Name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$passenger = $result->fetch_assoc();
$passengerID = $passenger['ID'];


// Get the flight ID from the URL
$flightID = $_POST["flight_id"];

// Retrieve passenger details (you might need to adjust the query based on your database structure)
// $passengerQuery = "SELECT * FROM passenger WHERE ID = ?";
// $stmt = $conn->prepare($passengerQuery);
// $stmt->bind_param("i",$passengerID);
// $stmt->execute();
// $passengerResult = $stmt->get_result();

// if (!$passengerResult) {
//     echo $passengerID; exit;
//     die("Error in SQL query: " . $conn->error .$passengerID );
// }

// Retrieve flight details
$flightQuery = "SELECT * FROM flights WHERE ID = ?";
$stmt = $conn->prepare($flightQuery);
$stmt->bind_param("i",$flightID);
$stmt->execute();
$flightResult = $stmt->get_result();

if (!$flightResult) {
    
    die("Error in SQL query: " . $conn->error);
}

// Display payment form
echo '<html>
        <head>
            <title>Cash Payment</title>
            <!-- Add any necessary styles or scripts for the payment form -->
        </head>
        <body>
            <h1>Cash Payment</h1>';

if ($passenger && $flightResult->num_rows > 0) {
    $flight = $flightResult->fetch_assoc();

    echo '<p>Passenger Name: ' . htmlspecialchars($passenger['Name']) . '</p>';
    echo '<p>Flight Details: ' . htmlspecialchars($flight['Name']) . ' from ' . htmlspecialchars($flight['start_city']) . ' to ' . htmlspecialchars($flight['end_city']) . '</p>';

   

        // Update the number of registered passengers in the flight
        $updatedRegisteredPassengers = $flight['PendPassangers'] + 1;
        $updateRegisteredPassengersQuery = "UPDATE flights SET PendPassangers = ? WHERE ID = ?";
        $stmt = $conn->prepare($updateRegisteredPassengersQuery);
        $stmt->bind_param("ii",$updatedRegisteredPassengers,$flightID);
        $stmt->execute();

        // Add a new row to the passenger_flight table
        $addPassengerFlightQuery = "INSERT INTO passengerflight (passenger_id, flight_id, Registered) VALUES (?, ?,0)";
        $stmt = $conn->prepare($addPassengerFlightQuery);
        $stmt->bind_param("ii",$passengerID,$flightID);
        $stmt->execute();
        
        // Display payment form
        echo 'Please contact the company for cash payments, your registration is pending.';
} else {
    echo '<p>Error: Passenger or flight details not found.</p>'.$passengerID;
}

echo '</body></html>';

$conn->close();
?>
