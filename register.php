<html>
<body>
<?php
//phpinfo( );
//echo"fff";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST["username"]) ? $_POST["username"] : 'Not set';
    $host = 'localhost';  $user ='root';   $dbname = 'flight_booking';  

    $conn = mysqli_connect($host, $user,"",$dbname);  
    if(!$conn){  

        die('Could not connect: '.mysqli_connect_error());  
      
      }  
      
      //echo 'Connected successfully<br/>';  
      $email = $_POST['email']; $pass = $_POST['password']; $tel = $_POST['tel'];
      if($_POST['type'] == 'passenger')
            $sql = 'INSERT INTO passenger(name,email,password,tel) VALUES (?, ?, ?, ?)';  
      else
            $sql = 'INSERT INTO company(Name,email,password,tel) VALUES (?, ?, ?, ?)'; 
    $stmt = $conn->prepare($sql);

    // Bind parameters (s for string)
    $stmt->bind_param("ssss", $name, $email, $pass, $tel);

    // Execute the prepared statement
    $stmt->execute();

    if($_POST['type']=='passenger'){
        mysqli_close($conn);  

        header('Location: passReg.html');


        exit;
    }
    else{
        mysqli_close($conn);  

        header('Location: compReg.html');

        exit;

    }
      
      

} else {
   // echo "Form not submitted";
}

?>
</body>
</html>