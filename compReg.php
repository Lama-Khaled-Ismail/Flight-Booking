<html>
<body>
<?php
require_once("config.php");
include_once("session.php");
include_once("encrypt.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $conn = mysqli_connect(DB_HOST, DB_USERNAME,DB_PASSWORD,DB_NAME);  
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Fetching the latest ID
    $qry = "SELECT ID FROM company where Name = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("s",$_SESSION['username']);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();
    if ($id) {
        //print_r($_FILES);

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
        $stmt = $conn->prepare("UPDATE company SET Account = ?, Address = ?, Location = ?, Bio=? WHERE ID = ?");
        if (!$stmt) {
            // Prepare failed
            echo "failed";
        } else {
            $stmt->bind_param("ssssi",encrypt($acc), $address, $loc,$_POST['bio'], $id);
            $stmt->execute();
            $stmt->close();

           // $stmt->send_long_data(4, $blob); 
           header('Location: comphome.php');

           exit;

    }
    
    }
    $conn->close();
} else {
}
function isValidNumber($Number) {
    return preg_match("/^[0-9]+$/", $Number) && strlen($Number) ==11;
}

?>
</body>
</html>
