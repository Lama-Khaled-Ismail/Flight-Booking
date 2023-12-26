<html>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $host = 'localhost';
    $user = "root";
    $dbname = 'flight_booking';

    $conn = new mysqli($host, $user,"", $dbname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Fetching the latest ID
    $qry = "SELECT ID FROM passenger ORDER BY ID DESC LIMIT 1";
    $result = $conn->query($qry);
    if ($result->num_rows > 0) {
        //print_r($_FILES);
        if(! isset($_FILES['upload']['name'])){
          //  echo "notset";
        }
        $row = $result->fetch_assoc();
        $id = $row['ID'];
        // $file = $_FILES["upload"];

        // // Read the file
        // $fp = fopen($file["tmp_name"], 'rb');
        // $data = fread($fp, filesize($file["tmp_name"]));
        // fclose($fp);
        // echo $data;

        // Prepare statements to update data
        $stmt = $conn->prepare("UPDATE passenger SET Account = ? WHERE ID = ?");
        if (!$stmt) {
            // Prepare failed
            echo $stmt->error_log;
            echo "failed";
        } else {
           // echo $_POST['acc'];
            $acc = $_POST['acc'];
            $stmt->bind_param('ii',$acc,$id);
             $stmt->execute();
             // $stmt->send_long_data(4, $blob); 
             header('Location: passHomehtml.php');

             exit;

        $stmt->close();
    }
    
    }
    $conn->close();
} else {
}
?>
</body>
</html>
