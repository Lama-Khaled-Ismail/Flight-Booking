<html>
<body>
<?php
//echo"fff";
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once ('config.php');
include_once("session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST["username"]) ? $_POST["username"] : 'Not set';

    $conn = mysqli_connect(DB_HOST, DB_USERNAME,DB_PASSWORD,DB_NAME);  
    if(!$conn){  
        echo "FSILED";
        die('Could not connect: '.mysqli_connect_error());  
      
      }  
      
      //echo 'Connected successfully<br/>';  
      $name = isset($_POST["username"]) ?  $_POST["username"] : null;
      $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : null;
      $pass = isset($_POST['password']) ? $_POST['password'] : null;
      $tel = isset($_POST['tel']) ? $_POST['tel'] : null;
    
      if (!($name && $email && $pass && $tel && isValidPhoneNumber($tel))){
        echo "Invalid Input ". $name," " ,$email," ",$pass," ",$tel;
       
        exit;
      }


            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $redirectPage = ($_POST['type'] == 'passenger') ? 'passReg.html' : 'compReg.html';
            $_SESSION['registration_data'] = array(
                'username' => $name,
                'email' => $email,
                'password' => $pass,
                'telephone' => $tel
            );
                
            header('Location: '.$redirectPage);
            // if($_POST['type'] == 'passenger')
            //         $sql = 'INSERT INTO passenger(name,email,password,tel) VALUES (?, ?, ?, ?)';  
            // else
            //         $sql = 'INSERT INTO company(Name,email,password,tel) VALUES (?, ?, ?, ?)'; 
            // $stmt = $conn->prepare($sql);
            // session_regenerate_id();

            // // Bind parameters (s for string)
            // $stmt->bind_param("ssss", $name, $email, $pass, $tel);
            // $_SESSION['username']=validateAndSanitize($name);

            // // Execute the prepared statement
            // $stmt->execute();

            // if($_POST['type']=='passenger'){
            //     mysqli_close($conn);  

            //     header('Location: passReg.html');


            //     exit;
            // }
            // else{
            //     mysqli_close($conn);  
            //     header('Location: compReg.html');
            //     exit;

            // }
            
            

         

}
function isValidPhoneNumber($phoneNumber) {
    return preg_match("/^[0-9]+$/", $phoneNumber) && strlen($phoneNumber) <=11;
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