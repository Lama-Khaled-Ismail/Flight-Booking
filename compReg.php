<html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';  $user ="root";  $pass = 'menna2003';  $dbname = 'flight_booking';  

    $conn = mysqli_connect($host, $user, $pass,$dbname);  
    if(!$conn){  

        die('Could not connect: '.mysqli_connect_error());  
      
      }  
      
      echo 'Connected successfully<br/>';  


    // Bind parameters (s for string)
    $qry="SELECT Top 1 ID FROM company Order By ID Desc"; 
    $id = $conn->query($qry);echo $id;
    $account = $_POST['acc']; $address=$_POST['address']; $loc = $_POST['location'];
    $qry = "UPDATE passenger SET Account = {$account}  WHERE passenger ID = {$id}";
    $result = $conn->query($qry);
    $qry = "UPDATE passenger SET Address = {$address}  WHERE passenger ID = {$id}";
    $result = $conn->query($qry);
    $qry = "UPDATE passenger SET Location = {$loc}  WHERE passenger ID = {$id}";
    $result = $conn->query($qry);
    
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
    echo "Form not submitted";
}


?>
</html>



