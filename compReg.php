<html>
<body>
<?php
require_once("config.php");
include_once("session.php");
include_once("encrypt.php");
echo($_POST);
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['compreg'])) {

    $conn = mysqli_connect(DB_HOST, DB_USERNAME,DB_PASSWORD,DB_NAME);  
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    if(!isset($_SESSION['registration_data'])){
        echo "Register name password email first";exit;
    }
    $name = $_SESSION['registration_data']['username'];
    $email = $_SESSION['registration_data']['email'];
    $pass = $_SESSION['registration_data']['password'];
    $tel = $_SESSION['registration_data']['telephone'];
    // Fetching the latest ID
    // $qry = "SELECT ID FROM company where Name = ?";
    // $stmt = $conn->prepare($qry);
    // $stmt->bind_param("s",$_SESSION['username']);
    // $stmt->execute();
    // $stmt->bind_result($id);
    // $stmt->fetch();
    // $stmt->close();
    //     //print_r($_FILES);

        if(! isset($_FILES['upload']['name'])){
            echo "notset";
        }
        $file = $_FILES["upload"];

        // Read the file
        $fp = fopen($file["tmp_name"], 'rb');
        $data = fread($fp, filesize($file["tmp_name"]));
        fclose($fp);
        //echo $data;

        $address = $_POST['address']; $acc = $_POST['acc'];$loc = $_POST['location'];

        if(!isValidNumber($acc)){
            echo "Not valid Account number must be of 11 digits\n";
            exit;
        }

        // Prepare statements to update data
        $stmt = $conn->prepare("INSERT INTO company (Name,email,password,tel,Account, Address , Location , Bio) VALUES (?,?,?,?,?, ?,?,?) ");
        if (!$stmt) {
            // Prepare failed
            echo "failed";
        } else {
            $stmt->bind_param("ssssssss",$name, $email, $pass, $tel,encrypt($acc), $address, $loc,$_POST['bio']);
            $stmt->execute();
            $stmt->close();
            $_SESSION['username']=encrypt(validateAndSanitize($name));
            $_SESSION['login_time'] =time();
            unset($_SESSION['registration_data']);

           // $stmt->send_long_data(4, $blob); 
           header('Location: comphome.php');

           exit;

    }
    
    
    $conn->close();
} 

function isValidNumber($Number) {
    return preg_match("/^[0-9]+$/", $Number) && strlen($Number) ==11;
}
function validateAndSanitize($input) {
    // Trim whitespace from the beginning and end of the input
    $input = trim($input);
    // Remove any HTML tags and encode special characters
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    if (empty($input)) {
        return null; // Validation failed
    }
    return $input;
}

?>
</body>
</html>
