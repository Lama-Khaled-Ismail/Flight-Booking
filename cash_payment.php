<?php

include('session.php');

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "flight_booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// todo remove
$passengerID = 5;

// Get the flight ID from the URL
$flightID = $_GET['flight_id'];

// Retrieve passenger details (you might need to adjust the query based on your database structure)
$passengerQuery = "SELECT * FROM passenger WHERE ID = '$passengerID'";
$passengerResult = $conn->query($passengerQuery);

if (!$passengerResult) {
    die("Error in SQL query: " . $conn->error);
}

// Retrieve flight details
$flightQuery = "SELECT * FROM flights WHERE ID = '$flightID'";
$flightResult = $conn->query($flightQuery);

if (!$flightResult) {
    die("Error in SQL query: " . $conn->error);
}

// Display payment form
echo '<html>
        <head>
            <title>Credit Card Payment</title>
            <!-- Add any necessary styles or scripts for the payment form -->
        </head>
        <body>
            <h1>Credit Card Payment</h1>';

if ($passengerResult->num_rows > 0 && $flightResult->num_rows > 0) {
    $passenger = $passengerResult->fetch_assoc();
    $flight = $flightResult->fetch_assoc();

    echo '<p>Passenger Name: ' . $passenger['Name'] . '</p>';
    echo '<p>Flight Details: ' . $flight['Name'] . ' from ' . $flight['start_city'] . ' to ' . $flight['end_city'] . '</p>';

   

        // Update the number of registered passengers in the flight
        $updatedRegisteredPassengers = $flight['PendPassangers'] + 1;
        $updateRegisteredPassengersQuery = "UPDATE flights SET PendPassangers = '$updatedRegisteredPassengers' WHERE ID = '$flightID'";
        $conn->query($updateRegisteredPassengersQuery);

        // Add a new row to the passenger_flight table
        $addPassengerFlightQuery = "INSERT INTO passengerflight (passenger_id, flight_id) VALUES ('$passengerID', '$flightID')";
        $conn->query($addPassengerFlightQuery);

        // Display payment form
        echo 'Please contact the company for cash payments, your registration is pending.';
} else {
    echo '<p>Error: Passenger or flight details not found.</p>';
}

echo '</body></html>';

$conn->close();
?>
