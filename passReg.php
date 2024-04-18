<html>
<body>
<?php
include_once("session.php");
include_once("encrypt.php");
require_once ('config.php');


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['passreg'])) {

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
    
        // Prepare statements to update data
        $stmt = $conn->prepare("INSERT INTO passenger (Name,email,password,tel,Account) VALUES (?,?,?,?,?)");
        if (!$stmt) {
            // Prepare failed
            echo $stmt->error_log;
            echo "failed";
        } else {
           // echo $_POST['acc'];
            $acc = $_POST['acc'];
            if(!isValidNumber($acc)){
                echo "Not valid Account number must be of 11 digits\n";
                exit;
            }

            $stmt->bind_param('sssss',$name,$email,$pass,$tel,encrypt($acc));
             $stmt->execute();
             // $stmt->send_long_data(4, $blob); 
             $stmt->close();
             $conn->close();
             $_SESSION['username']=encrypt(validateAndSanitize($name));
             $_SESSION['login_time'] =time();
             unset($_SESSION['registration_data']);
 
             header('Location: passHomehtml.php');

             exit;

    }
    
    
    $conn->close();
} else {
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
