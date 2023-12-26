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

$sql = "SELECT * FROM passenger WHERE Name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$crow = $result->fetch_assoc();
$passengerID = $crow['ID'];

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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Payment form submitted

        // Validate and process payment (add your payment processing logic here)

        // Update the number of registered passengers in the flight
        $updatedRegisteredPassengers = $flight['RegPassangers'] + 1;
        $updateRegisteredPassengersQuery = "UPDATE flights SET RegPassangers = '$updatedRegisteredPassengers' WHERE ID = '$flightID'";
        $conn->query($updateRegisteredPassengersQuery);

        // Add a new row to the passenger_flight table
        $addPassengerFlightQuery = "INSERT INTO passengerflight (passenger_id, flight_id,Registered) VALUES ('$passengerID', '$flightID',1)";
        $conn->query($addPassengerFlightQuery);

        echo '<p>Payment successful! Thank you for your reservation.</p>';
    } else {
        // Display payment form
        echo '<form action="credit_card_payment.php?flight_id=' . $flightID . '" method="post">
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" required><br>

                <label for="expiry_date">Expiry Date:</label>
                <input type="text" id="expiry_date" name="expiry_date" required><br>

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" required><br>

                <input type="submit" value="Submit Payment">
            </form>';
    }
} else {
    echo '<p>Error: Passenger or flight details not found.</p>';
}

echo '</body></html>';

$conn->close();
?>
