<html>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $host = 'localhost';
    $user = "root";
    $dbname = 'flight_booking';

    $conn = new mysqli($host, $user, "", $dbname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Fetching the latest ID
    $qry = "SELECT ID FROM company ORDER BY ID DESC LIMIT 1";
    $result = $conn->query($qry);
    if ($result->num_rows > 0) {
        print_r($_FILES);
        if(! isset($_FILES['upload']['name'])){
            echo "notset";
        }
        $row = $result->fetch_assoc();
        $id = $row['ID'];
        $file = $_FILES["upload"];

        // Read the file
        $fp = fopen($file["tmp_name"], 'rb');
        $data = fread($fp, filesize($file["tmp_name"]));
        fclose($fp);
        echo $data;

        $address = $_POST['address']; $acc = $_POST['acc'];$loc = $_POST['location'];

        // Prepare statements to update data
        $stmt = $conn->prepare("UPDATE company SET Account = ?, Address = ?, Location = ? WHERE ID = ?");
        if (!$stmt) {
            // Prepare failed
            echo "failed";
        } else {
            $stmt->bind_param("issi",$acc, $address, $loc, $id);
           // $stmt->send_long_data(4, $blob); 


        $stmt->close();
    }
    
    }
    $conn->close();
} else {
}
?>
</body>
</html>
