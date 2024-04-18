<?php
    include('session.php');
    include('sanitize.php');
    require_once('config.php');
    include("checkexpiry.php");
 
    $comname = decrypt($_SESSION['username']);
     
   
    if(isset($_POST['submit']))
    {
        
       var_dump($_POST);
        
        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            $errors = [];

            // Validaiting and SANTIZING INPUT
            $name = isset($_POST['name']) ? sanitize_input($_POST["name"]) : '';

            if (empty($name)) {
                $errors[] = "Name is required";
            }
            
            $cities = $_POST["city"];

            if (isset($cities) && is_array($cities) && count($cities) > 0) {
                $valid_cities = [];
                
                
                foreach ($cities as $city) {
                    // Sanitize
                    $validated_city = sanitize_input($city);
                    
                    // Check if the city is valid
                    if (!empty($validated_city)) {
                        // Add the validated city to the list of valid cities
                        $valid_cities[] = $validated_city;
                    } 
                }
                
                // $valid_cities contains the sanitized and validated cities
                
                $cities = $valid_cities;
            } else {
                
                $errors[] = "No cities provided or invalid data format.";
            }

            if(empty($cities)){

                $errors[] = "No cities provided or invalid data format.";
            }

            $startTimes = $_POST["startTime"];

            if (isset($startTimes) && is_array($startTimes) && count($startTimes) > 0) {
                $valid_start_times = [];
                
                
                foreach ($startTimes as $start_time) {
                    // Apply validation rules using regular expression
                    if (preg_match('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/', $start_time)) {
                        // Add the validated start time to the list of valid values
                        $valid_start_times[] = $start_time;
                    } 
                }
                
                //$valid_start_times contains the validated start time values
                
                $startTimes=$valid_start_times;
            } else {
               
                $errors[] =  "No start time values provided or invalid data format.";
            }

            if(empty($startTimes)){
                $errors[] =  "No start time values provided or invalid data format.";
            }

            $endTimes = $_POST["endTime"];

            if (isset($endTimes) && is_array($endTimes) && count($endTimes) > 0) {
                $valid_end_times = [];
                
                
                foreach ($endTimes as $end_time) {
                    // Apply validation rules using regular expression
                    if (preg_match('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/', $end_time)) {
                        // Add the validated end time to the list of valid values
                        $valid_end_times[] = $end_time;
                    } 
                }
                
                //$valid_end_times contains the validated end time values
                
                $endTimes=$valid_end_times;
            } else {
               
                $errors[] =  "No end time values provided or invalid data format.";
            }

           if(empty($endTimes)){
                $errors[] =  "No end time values provided or invalid data format.";
            }


            $fees =isset($_POST["fees"]) ? filter_var($_POST['fees'], FILTER_SANITIZE_NUMBER_INT):'';
            if(empty($fees) ||  filter_var($fees, FILTER_VALIDATE_INT) === false){
                $errors[] =  "Invalid Fees";
            }

            $passengers = isset($_POST["passengers"])? filter_var($_POST['passengers'], FILTER_SANITIZE_NUMBER_INT):'';
            if(empty($passengers) ||  filter_var($passengers, FILTER_VALIDATE_INT) === false){
                $errors[] =  "Invalid passengers number";
            }
            
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
                
                exit();
            }
        }

        if (empty($name)) {
            die("Name is required");
        }

        if (!is_numeric($fees) || $fees < 0) {
            die("Invalid fees value");
        }
    
    
   
    $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
   
    if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }

   // Prepare the statement to select company ID
$sql = "SELECT ID FROM company WHERE Name=?";
$stmt_company = mysqli_prepare($conn, $sql);

if ($stmt_company) {
    // Bind parameters for company selection
    mysqli_stmt_bind_param($stmt_company, "s", $comname);

    // Execute the company statement
    mysqli_stmt_execute($stmt_company);

    // Bind the result for company ID
    mysqli_stmt_bind_result($stmt_company, $id);

    // Fetch the company ID
    mysqli_stmt_fetch($stmt_company);

    // Close the company statement
    mysqli_stmt_close($stmt_company);

    // Check if the company ID was fetched successfully
    if ($id !== null) {
        // Prepare the statement to insert flight
        $sql_insert_flight = "INSERT INTO flights (Name, Completed, passengers_no, RegPassangers, PendPassangers, fees, company_id, start_city, end_city) VALUES (?, 0, ?, 0, 0, ?, ?, '', '')";
        $stmt_insert_flight = mysqli_prepare($conn, $sql_insert_flight);

        if ($stmt_insert_flight) {
            // Bind parameters for flight insertion
            mysqli_stmt_bind_param($stmt_insert_flight, "siii", $name, $passengers, $fees, $id);

            // Execute the flight insertion statement
            $result_insert_flight = mysqli_stmt_execute($stmt_insert_flight);

            if ($result_insert_flight) {
                echo "Flight insertion successful.";

                // Prepare the statement to select flight ID
                $sql_select_flight_id = "SELECT ID FROM flights WHERE Name=?";
                $stmt_select_flight_id = mysqli_prepare($conn, $sql_select_flight_id);

                if ($stmt_select_flight_id) {
                    // Bind parameters for flight ID selection
                    mysqli_stmt_bind_param($stmt_select_flight_id, "s", $name);

                    // Execute the flight ID selection statement
                    mysqli_stmt_execute($stmt_select_flight_id);

                    // Bind the result for flight ID
                    mysqli_stmt_bind_result($stmt_select_flight_id, $flight_id);

                    // Fetch the flight ID
                    mysqli_stmt_fetch($stmt_select_flight_id);

                    // Close the flight ID selection statement
                    mysqli_stmt_close($stmt_select_flight_id);

                    // Check if the flight ID was fetched successfully
                    if ($flight_id !== null) {
                        // Proceed with itinerary insertion and other operations
                    } else {
                        echo "Flight ID fetch failed.";
                    }
                } else {
                    echo "Flight ID selection statement preparation failed.";
                }
            } else {
                echo "Flight insertion failed: " . mysqli_stmt_error($stmt_insert_flight);
            }

            // Close the flight insertion statement
            mysqli_stmt_close($stmt_insert_flight);
        } else {
            echo "Flight insertion statement preparation failed.";
        }
    } else {
        echo "Company ID fetch failed.";
    }
} else {
    echo "Company selection statement preparation failed.";
}

// Close the MySQLi connection
mysqli_close($conn);


        
        
    }
    else {
        echo "Form not submitted or submit button not clicked.";
    }
    header("location: comphome.php");

    



 ?>
