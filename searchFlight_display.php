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

// Get the user's input from the form
$from = $_GET['from'];
$to = $_GET['to'];

// sql query
$sql = "SELECT f.*, c.Name AS companyName
        FROM flights f
        JOIN company c ON f.company_id = c.ID
        WHERE f.start_city = '$from' AND f.end_city = '$to'";

$result = $conn->query($sql);

// Check for SQL errors
if (!$result) {
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

                table {
                    border-collapse: collapse;
                    width: 50%;
                    border-radius: 10px;
                    overflow: hidden; 
                    background-color: #fff; 
                    border: 2px solid #ddd; 
                }

                .flight-info {
                    padding: 20px;
                    width: 70%;
                    margin-bottom: 20px;
                    color: #000; /* Black text */
                }

                .flight-info strong {
                    color: #222222; /* Dark text */
                }

                .details-button {
                    text-align: center;
                }

                .details-button a {
                    color: white; /* White font color */
                    text-decoration: none; /* Remove underline */
                    display: inline-block; /* Make button inline */
                    background-color: #007BFF; /* Blue button color */
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    padding: 10px 15px; 
                }

                .details-button a:hover {
                    background-color: #0056b3; /* Darker blue on hover */
                    text-decoration: none;
                }

                .table-row {
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Slight shadow */
                    border-bottom: 2px solid #ddd;
                }
            </style>
        </head>
        <body>';

if ($result->num_rows > 0) {
    // Output data of each row
    echo '<table>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr class="table-row">';
        echo '<td class="flight-info">';
        echo "<strong>Flight ID:</strong> " . $row["ID"] . "<br>";
        echo "<strong>Flight Name:</strong> " . $row["Name"] . "<br>";
        echo "<strong>Company Name:</strong> " . $row["companyName"] . "<br>";
        echo "<strong>Start City:</strong> " . $row["start_city"] . "<br>";
        echo "<strong>End City:</strong> " . $row["end_city"] . "<br>";
        echo '</td>';

        // Add the "View Details" button
        echo '<td class="details-button">';
        echo '<a href="flight_details.php?id=' . $row["ID"] . '">View Details</a>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo "<p>No flights found for the given cities.</p>";
}

// Close HTML
echo '</body></html>';

$conn->close();
?>
