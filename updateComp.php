<?php
include('session.php');

$companyName = $_SESSION['username'];

if(isset($_POST['submit']))
{
    var_dump($_POST);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $tel = $_POST["tel"];
        
        // Process image upload
        $imageData = $_POST["image"];
        $decodedImageData = base64_decode($imageData);


        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'flight_booking';

        $conn = mysqli_connect($host, $user, $pass, $db);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "UPDATE company SET Name='$name', email='$email', password='$password', tel=$tel WHERE Name='$companyName'";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo 1;
            die("Query failed: " . mysqli_error($conn));
        }

        $_SESSION['username'] = $name;
        $companyName = $_SESSION['username'];

        if (isset($_POST["image"])) {
            $data = $_POST["image"];
            $decodedData = base64_decode($data);

            // Escape and quote the binary data
            $escapedData = $conn->real_escape_string($decodedData);

            // Update company photo in the database directly using variable interpolation
            $sql = "UPDATE company SET Logo='$escapedData' WHERE Name='$companyName'";

            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }


        mysqli_close($conn);
    }
}

header("Location: comphome.php");
?>
