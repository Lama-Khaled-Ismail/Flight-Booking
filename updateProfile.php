<?php
    include('session.php');
    $username = $_SESSION['username'];
     //for testing purposes
    $username='menna hussein';
    
   
    if(isset($_POST['submit']))
    {
        
        var_dump($_POST);
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $name=$_POST["name"];
            $password=$_POST["password"];
            $email=$_POST["email"];
            $tel=$_POST["tel"];
            // Process image upload
            $imageData = $_POST["image"];

            // Process passport image upload
            $passportImageData = $_POST["passportImage"];

            $decodedImageData = base64_decode($imageData);

            $decodedPassportImageData = base64_decode($passportImageData);

            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $db = 'flight_booking';
       
            $conn = mysqli_connect($host, $user, $pass, $db);
       
        if (!$conn) {
           die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "UPDATE passenger SET Name='$name', email='$email', password='$password' ,tel=$tel  WHERE Name='$username'";
        
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo 1;
           die("Query failed: " . mysqli_error($conn));
       }
       $_SESSION['username'] = $name;
       $username=$_SESSION['username'];
       if (isset( $_POST["image"])){
            $data = $_POST["image"];
            $decodedData = base64_decode($data);

    // Escape and quote the binary data
        $escapedData = $conn->real_escape_string($decodedData);

    // Update user photo in the database directly using variable interpolation
        $sql = "UPDATE passenger SET photo='$escapedData' WHERE Name='$username'";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        

       }

       if (isset($_POST["passportImage"]) ){
       
    $data = $_POST["passportImage"];
    $decodedData = base64_decode($data);

    // Escape and quote the binary data
    $escapedData = $conn->real_escape_string($decodedData);

    // Update user photo in the database directly using variable interpolation
    $sql = "UPDATE passenger SET passport='$escapedData' WHERE Name='$username'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "No data received.";
       }
       
   
       mysqli_close($conn);
            
        }

        

    }

    //header("Location:passHomehtml.php");

?>
