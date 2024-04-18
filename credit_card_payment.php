<?php

require_once("config.php");
include_once("session.php");
include_once("encrypt.php");
include_once("decrypt.php");
include("checkexpiry.php");



if ($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['pay_with_card'])) {
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
$flightID = $_POST['flight_id'];


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
            <title>Credit Card Payment</title>
            <!-- Add any necessary styles or scripts for the payment form -->
        </head>
        <body>
            <h1>Credit Card Payment</h1>';

if ($passenger && $flightResult->num_rows > 0) {
    $flight = $flightResult->fetch_assoc();

    echo '<p>Passenger Name: ' . htmlspecialchars($passenger['Name']) . '</p>';
    echo '<p>Flight Details: ' . htmlspecialchars($flight['Name']) . ' from ' . htmlspecialchars($flight['start_city']) . ' to ' . htmlspecialchars($flight['end_city']) . '</p>';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Payment form submitted

        // Validate and process payment (add your payment processing logic here)

        // Update the number of registered passengers in the flight
        $updatedRegisteredPassengers = $flight['PendPassangers'] + 1;
        $updateRegisteredPassengersQuery = "UPDATE flights SET PendPassangers = ? WHERE ID = ?";
        $stmt = $conn->prepare($updateRegisteredPassengersQuery);
        $stmt->bind_param("ii",$updatedRegisteredPassengers,$flightID);
        $stmt->execute();

        // Add a new row to the passenger_flight table
        $addPassengerFlightQuery = "INSERT INTO passengerflight (passenger_id, flight_id,Registered) VALUES (?,?,1)";
        $stmt = $conn->prepare($addPassengerFlightQuery);
        $stmt->bind_param("ii",$passengerID,$flightID);
        $stmt->execute();

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
