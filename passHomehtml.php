

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            background: whitesmoke;
        }

        #profile {
            width: 20%;
            background-color: #689CC1;
            
            padding: 20px;
            box-shadow: 0 0 10px #81a9c7;
        }
        #content {
            flex: 1;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            line-height: 1.6;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px; /* Adjust the margin as needed */
        }
        th, td {
            border: 1px  #dddddd;
            text-align: left;
            padding: 8px;
        }

.search-container {
position: fixed;
top: 10px;
right: 10px;
display: flex;
}

#searchInput {
padding: 5px;
border: 1px solid #ccc;
}

button {
padding: 5px 10px;
background-color: #4CAF50;
color: white;
border: none;
cursor: pointer;
}


    </style>
    <title>Home</title>
</head>
<body>
    <?php
    
        include('passHome.php');
    ?>

    <div id="profile">
    
    

    
        <center><img src="data:<?php echo htmlspecialchars($imageMimeType); ?>;base64,<?php echo htmlspecialchars($base64Image); ?>" alt="Profile Picture" style="max-width: 100%; border-radius: 50%;"></center>
        <a href="passProfile.php" style="text-align: center; display: block;">
        <h1>Profile</h1></a>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Tel:</strong><?php echo htmlspecialchars($tel); ?></p>
        <button onclick="redirectTologin()" name="logout" style="margin-top: 60px; vertical-align: middle;">Logout</button>
        <script>
            function redirectTologin() {
                // Replace 'targetPage.html' with the URL of the page you want to redirect to
                window.location.href = 'logout.php';
            }
        </script>
    </div>
    <div id="content">
        <h2>Past Flights<h2>
        <table border="1">
        <tr>
            <th>Flight ID</th>
            <th>Flight Name</th>
            <th>Flight Fees</th>
        </tr>

        <?php
        // Loop over the array and create a table row for each flight
        if(isset($flightArray)){
            foreach ($flightArray as $flight) {
                echo "<tr>
                         <td>" . htmlspecialchars($flight['ID']) . "</td>
                         <td>" . htmlspecialchars($flight['Name']) . "</td>
                         <td>" . htmlspecialchars($flight['fees']) . "</td>
                    </tr>";
            }
        }
        
        ?>  
        </table>

        <h2>Current Flights<h2>
            <table border="1">
            <tr>
                <th>Flight ID</th>
                <th>Flight Name</th>
                <th>Flight Fees</th>
            </tr>

        <?php
        // Loop over the array and create a table row for each flight
        foreach ($flightArray as $flight) {
            echo "<tr>
            <td>" . htmlspecialchars($flight['ID']) . "</td>
            <td>" . htmlspecialchars($flight['Name']) . "</td>
            <td>" . htmlspecialchars($flight['fees']) . "</td>
     </tr>";
        }
        ?>

    </table>
    </div>

    <div class="search-container">
    <button onclick="redirectToPage()">Search Flights</button>
    


<script>
  function redirectToPage() {
    // Replace 'targetPage.html' with the URL of the page you want to redirect to
    window.location.href = 'searchFlight.php';
  }
</script>
    </div>
    

   
    
</body>
</html>