<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('airplane-wing') center/cover no-repeat fixed;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            backdrop-filter: blur(10px);
            background: rgba(0, 0, 0, 0);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            width: 60%;
        }

        h2 {
            color: #222222; /* White text */
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #222222; /* White text */
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f0f0f0; /* Light gray background */
            color: #333; /* Dark text */
        }

        button {
            background-color: rgba(70, 130, 180, 0.8); /* Blue button color */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color:  #007BFF; /* Darker blue on hover */
        }

        #searchResults a {
            color: #007BFF; /* Blue link color */
            text-decoration: none;
        }

        #searchResults a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <?php
        // Database connection
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "flight_booking";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error . "<br>");
        }
        // Fetch cities from flights table
        $sql = "SELECT DISTINCT start_city, end_city FROM flights";
        $result = $conn->query($sql);

        $cities = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cities[] = $row['start_city'];
                $cities[] = $row['end_city'];
            }
        }

        // Close connection
        $conn->close();
    ?>

    <form action="searchFlight_display.php" method="get">
        <h2>Flight Search</h2>

        <label for="from">From:</label>
        <select id="from" name="from" required>
            <?php
                // the from cities
                foreach (array_unique($cities) as $city) {
                    echo "<option value='$city'>$city</option>";
                }
            ?>
        </select>

        <label for="to">To:</label>
        <select id="to" name="to" required>
            <?php
                // the to cities
                foreach (array_unique($cities) as $city) {
                    echo "<option value='$city'>$city</option>";
                }
            ?>
        </select>

        <button type="submit">Search Flights</button>
    </form>

</body>
</html>
