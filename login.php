<html>
<body>
<?php
//phpinfo( );
//echo"fff";
include('session.php');
include('sanitize.php');
include('decrypt.php');
require_once ('config.php');

function checkCredentials($conn, $entity, $name, $pass) {
    $sql = "SELECT password FROM $entity WHERE Name=? ";  

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        
        //echo "found $entity<br>";
        $password = null;
        $stmt->bind_result($password);
        $stmt->fetch();

        
        // COMPARING WITH THE HASHED PASSWORD IN DB 
        if(password_verify($pass,$password)){
            // TO AVOID SESSION FIXATION
            session_regenerate_id(true);
            $_SESSION['username'] = $name;
            $_SESSION['login_time'] = time();


            $stmt->close();
            return true;
        }
        
    }

    $stmt->close();
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST["username"]) ? $_POST["username"] : 'Not set';
     

    $conn = mysqli_connect(DB_HOST, DB_USERNAME,DB_PASSWORD,DB_NAME);  
    if(!$conn){  

        die('Could not connect: '.mysqli_connect_error());  
      
      }  
      
      //echo 'Connected successfully<br/>';  
      $name = $_POST['username']; $pass = $_POST['password']; //echo $name; echo $pass;

      
      // FILTER AND SANITIZE USERNAME AND PASSWORD INPUT
      // Filter_SANITIZE_STRING IS DECREPATED BUT STILL WORKS
      $name = sanitize_input($name);
      $pass = sanitize_input($pass);

      if (checkCredentials($conn, 'passenger', $name, $pass)) {
        // Redirect if a passenger is found
        header('Location: passHomehtml.php');
        exit;
    } elseif (checkCredentials($conn, 'company', $name, $pass)) {
        // Redirect if a company is found
        header('Location: comphome.php');
        exit;
    }
     else {
          echo "USER NOT FOUND";
        //echo $name; echo $pass;

          $stmt->close();
          $conn->close();  
      }      

} else {
    echo "Form not submitted";
}

?>
</body>
</html>