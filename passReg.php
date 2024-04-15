<html>
<body>
<?php
include_once("db.php");
include_once("session.php");
include_once("encrypt.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $conn = new mysqli($host, $user,$pass, $dbname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Fetching the latest ID

    
    $qry = "SELECT ID FROM passenger where name = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("s",$_SESSION['username']);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();
    if ($id) {
        echo "ID: " . $id . "<br>";
        echo "Name: " . $_SESSION['username'] . "<br>";

        // Prepare statements to update data
        $stmt = $conn->prepare("UPDATE passenger SET Account = ? WHERE ID = ?");
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

            $stmt->bind_param('si',encrypt($acc),$id);
             $stmt->execute();
             // $stmt->send_long_data(4, $blob); 
             $stmt->close();
             $conn->close();

             header('Location: passHomehtml.php');

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
