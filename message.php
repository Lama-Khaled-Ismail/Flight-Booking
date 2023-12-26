<?php
// Assuming you have established a database connection
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

// Get the flight ID from the URL
$flightID = $_GET['flight_id'];

// Fetch company details based on the flight ID
$companyQuery = "SELECT c.Name AS companyName
                 FROM flights f
                 JOIN company c ON f.company_id = c.ID
                 WHERE f.ID = '$flightID'";

$companyResult = $conn->query($companyQuery);

// Check for SQL errors
if (!$companyResult) {
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

                .message-form {
                    width: 60%;
                    margin: 0 auto; /* Center-align the form */
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Slight shadow */
                    border-radius: 10px; /* Rounded corners */
                    padding: 20px;
                    background-color: #fff; /* White background */
                    color: #000; /* Black text */
                }

                .message-form label {
                    display: block;
                    margin-bottom: 10px;
                    color: #222222; /* Dark text */
                }

                .message-form textarea {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 20px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                }

                .submit-button {
                    background-color: #007BFF; /* Blue button color */
                    color: white;
                    padding: 10px 15px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }

                .submit-button:hover {
                    background-color: #0056b3; /* Darker blue on hover */
                }
            </style>
        </head>
        <body>';

if ($companyResult->num_rows > 0) {
    // Output message form
    $row = $companyResult->fetch_assoc();
    $companyName = $row["companyName"];
    echo '<form class="message-form" action="process_message.php" method="post">';
    echo '<h2>Send a Message to ' . $companyName . '</h2>';
    echo '<input type="hidden" name="flight_id" value="' . $flightID . '">';
    echo '<label for="message">Your Message:</label>';
    echo '<textarea id="message" name="message" rows="4" required></textarea>';
    echo '<br>';
    echo '<input type="submit" class="submit-button" value="Send Message">';
    echo '</form>';
} else {
    echo "<p>No details found for the given flight.</p>";
}

// Close HTML
echo '</body></html>';

$conn->close();
?>
