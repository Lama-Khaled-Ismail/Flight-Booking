<html>
<body>
<?php
//phpinfo( );
//echo"fff";
include('session.php');
function checkCredentials($conn, $entity, $name, $pass) {
    $sql = "SELECT * FROM $entity WHERE Name=? AND password=?";  

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $pass);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        //echo "found $entity<br>";
        $_SESSION['username'] = $name;

        $stmt->close();
        return true;
    }

    $stmt->close();
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST["username"]) ? $_POST["username"] : 'Not set';
    $host = 'localhost';  $user ='root';   $dbname = 'flight_booking';  

    $conn = mysqli_connect($host, $user,"",$dbname);  
    if(!$conn){  

        die('Could not connect: '.mysqli_connect_error());  
      
      }  
      
      //echo 'Connected successfully<br/>';  
      $name = $_POST['username']; $pass = $_POST['password']; //echo $name; echo $pass;
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
          echo $name; echo $pass;

          $Cstmt->close();
          $conn->close();  
      }      

} else {
    echo "Form not submitted";
}

?>
</body>
</html>