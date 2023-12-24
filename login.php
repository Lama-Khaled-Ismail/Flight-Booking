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
      $name = $_POST['username']; $pass = $_POST['password']; //echo $name; echo $pass;
      $Psql = 'SELECT * FROM passenger WHERE Name=? AND password=?';  

      $Pstmt = $conn->prepare($Psql);
      
      // Bind parameters (s for string)
      $Pstmt->bind_param("ss", $name, $pass);
      
      // Execute the prepared statement
      $Pstmt->execute();
      
      // Store the result so you can check the number of rows
      $Pstmt->store_result();
      
      if ($Pstmt->num_rows > 0) {
          echo "found passenger";
          $Pstmt->close();
          $conn->close();  
          //header('Location: passReg.html');
          exit;
      }
      
      $Csql = 'SELECT * FROM company WHERE Name=? AND password=?';  
      
      $Cstmt = $conn->prepare($Csql);
      
      // Bind parameters (s for string)
      $Cstmt->bind_param("ss", $name, $pass);
      
      // Execute the prepared statement
      $Cstmt->execute();
      
      // Store the result so you can check the number of rows
      $Cstmt->store_result();
      
      if ($Cstmt->num_rows > 0) {
          echo "found company";
          $Cstmt->close();
          $conn->close();  
          //header('Location: compReg.html');
          exit;
      } else {
          echo "USER NOT FOUND";
          $Cstmt->close();
          $conn->close();  
      }      

} else {
    echo "Form not submitted";
}

?>
</body>
</html>