<?php
include('session.php');
include('sanitize.php');
require_once('config.php');

$companyName = $_SESSION['username'];

if(isset($_POST['submit']))
{
    //var_dump($_POST);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validaiting and SANTIZING INPUT
        $name = isset($_POST['name']) ? sanitize_input($_POST["name"]) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
        $tel = isset($_POST['tel']) ? filter_var($_POST['tel'], FILTER_SANITIZE_NUMBER_INT) : '';
        

        $errors = [];
        if (empty($name)) {
            $errors[] = "Name is required";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
        if (empty($password)) {
            $errors[] = "Password is required";
        }
        if(empty($email)){
            $errors[] = "email is required";
        }
        if(!(isValidPhoneNumber($tel))){
            $errors[] = "Invalid telephone number";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
                
                exit();
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        // Process image upload
        $imageData = $_POST["image"];

        $decodedImageData = base64_decode($imageData);

        $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // escape input
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);
        $tel = mysqli_real_escape_string($conn, $tel);
        $companyName = mysqli_real_escape_string($conn, $companyName);


        

        // PREPARED STATMENT
        $stmt = $conn->prepare("UPDATE company SET Name=?, email=?, password=?, tel=? WHERE Name=?");

        // Bind parameters
        $stmt->bind_param('sssss', $name, $email, $password, $tel, $companyName);

        $stmt->execute();

        if ($stmt->errno) {
            die("Query failed: " . $stmt->error);
        } 

        $stmt -> close();

       

        $_SESSION['username'] = $name;
        $companyName = $_SESSION['username'];

        if (isset($_POST["image"])) {
            $data = $_POST["image"];
            $decodedData = base64_decode($data);

            if($decodedData !== false){

                if (getimagesizefromstring($decodedData) !== false){

                    // Escape and quote the binary data
                    $escapedData = $conn->real_escape_string($decodedData);

                    // Update user photo in the database 
                    $sql = "UPDATE company SET logo=? WHERE Name=?";

                    // Prepare the statement
                    $stmt = $conn->prepare($sql);

                    // Bind parameters
                    $stmt->bind_param("ss", $decodedData, $companyName );

                    // Execute the statement
                    if ($stmt->execute()) {
                        echo "Record updated successfully";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }                   
                }

            }

           
        }


        mysqli_close($conn);
    }
    else {
        echo "No data received.";
   }
}

header("Location: comphome.php");
?>
