<?php
// Assuming you have established a database connection
require_once("config.php");
include_once("session.php");
include_once("decrypt.php");

if(!isset($_GET['source']) || decrypt($_GET['source']) !== 'searchFlight_display') {
        echo "Can't access flight details page without inputting submitting form";exit;
}


// Create connection
$conn = mysqli_connect(DB_HOST, DB_USERNAME,DB_PASSWORD,DB_NAME);  


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the flight ID from the URL
$flightID = $_GET['id'];

// SQL query to fetch flight details
$flightQuery = "SELECT f.*, c.Name AS companyName
                FROM flights f
                JOIN company c ON f.company_id = c.ID
                WHERE f.ID = '$flightID'";

$flightResult = $conn->query($flightQuery);

// SQL query to fetch itinerary details
$itineraryQuery = "SELECT i.*
                   FROM itinerary i
                   WHERE i.flight_id = '$flightID'";

$itineraryResult = $conn->query($itineraryQuery);

// Check for SQL errors
if (!$flightResult || !$itineraryResult) {
    die("Error in SQL query: " . $conn->error);
}

// Start HTML output with styling
echo '<html>
        <head>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    font-family: \'Arial\', sans-serif;
                    background: url(\'airplane-wing\') center/cover no-repeat fixed;
                    color: #fff;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                }

                .big-table {
                    width: 60%;
                    margin: 0 auto; /* Center-align the table */
                    border-collapse: collapse;
                }

                .flight-details {
                    padding: 20px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Slight shadow */
                    border-radius: 10px; /* Rounded corners */
                    margin-bottom: 20px;
                    color: #000; /* Black text */
                    background-color: #fff; /* White background */
                }

                .flight-details strong {
                    color: #222222; /* Dark text */
                }

                .itinerary-table {
                    border-collapse: collapse;
                    width: 100%;
                    margin-bottom: 20px;
                    color: #000; /* Black text */
                    background-color: #fff; /* White background */
                    border-radius: 10px; /* Rounded corners */
                }

                .itinerary-table th, .itinerary-table td {
                    border: 0px solid #ddd;
                    padding: 8px;
                    text-align: left;
                }

                .payment-options {
                    display: flex;
                    justify-content: space-between;
                    margin-top: 20px;
                }

                .payment-button, .message-button {
                    background-color: #007BFF; /* Blue button color */
                    color: white;
                    padding: 10px 15px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }

                .payment-button:hover, .message-button:hover {
                    background-color: #0056b3; /* Darker blue on hover */
                }

                .message-button {
                    background-color: #28a745; /* Green button color */
                    margin-top: 20px;
                }

                .message-button:hover {
                    background-color: #218838; /* Darker green on hover */
                }
            </style>
        </head>
        <body>';

if ($flightResult->num_rows > 0) {
    // Output flight details
    echo '<table class="big-table">';
    echo '<tr><td>';
    while ($row = $flightResult->fetch_assoc()) {
        echo '<div class="flight-details">';
        echo "<strong>Flight ID:</strong> " . $row["ID"] . "<br>";
        echo "<strong>Flight Name:</strong> " . $row["Name"] . "<br>";
        echo "<strong>Company Name:</strong> " . $row["companyName"] . "<br>";
        echo "<strong>Start City:</strong> " . $row["start_city"] . "<br>";
        echo "<strong>End City:</strong> " . $row["end_city"] . "<br>";
        echo '</div>';
    }
    echo '</td></tr>';
    echo '<tr><td>';
    // Output itinerary details in a table
    if ($itineraryResult->num_rows > 0) {
        echo '<table class="itinerary-table">';
        echo '<tr>';
        echo '<th>City</th>';
        echo '<th>Arrival Time</th>';
        echo '<th>Departure Time</th>';
        echo '</tr>';

        while ($itineraryRow = $itineraryResult->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $itineraryRow["city"] . '</td>';
            echo '<td>' . $itineraryRow["start_time"] . '</td>';
            echo '<td>' . $itineraryRow["end_time"] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</td></tr>';
        
        // Payment options
        echo '<tr><td>';
        echo '<div class="payment-options">';
        echo '<a href="credit_card_payment.php?flight_id=' . $flightID . '" class="payment-button">Pay from Credit Card</a>';
        echo '<a href="cash_payment.php?flight_id=' . $flightID . '" class="payment-button">Pay with Cash</a>';
        echo '</div>';
        echo '</td></tr>';
        
        // Message button
        echo '<tr><td>';
        echo '<div class="payment-options">';
        echo '<a href="message.php?flight_id=' . $flightID . '" class="message-button">Message the Company</a>';
        echo '</div>';
        echo '</td></tr>';
        echo '</table>';
    } else {
        echo '<p>No itinerary details found for the given flight.</p>';
    }
} else {
    echo "<p>No details found for the given flight.</p>";
}

// Close HTML
echo '</body></html>';

$conn->close();
?>
