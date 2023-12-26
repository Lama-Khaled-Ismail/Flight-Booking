<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
         body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('board') center/cover no-repeat fixed;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            
        }

        form {
            backdrop-filter: blur(10px);
            background: rgba(0, 0, 0, 0);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            width:  60%;;
        }

        h2 {
            color: #222222; /* White text */
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #222222; /* White text */
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f0f0f0; /* Light gray background */
            color: #333; /* Dark text */
        }

        .button-like ,button {
            background-color:rgba(70, 130, 180, 0.8); /* Blue button color */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 150px;
            text-align: center;
            
        }
        .button-like{
            line-height: 1.5;
            display: block; /* Ensures margin auto works for block-level elements */
            margin: 0 auto;
        }

        .button-like:hover ,button:hover {
            background-color:  #007BFF; /* Darker blue on hover */
        }
    </style>
</head>
<body>


<?php 
 include("session.php");
 $host = 'localhost';
 $user = 'root';
 $pass = '';
 $db = 'flight_booking';

 $conn = mysqli_connect($host, $user, $pass, $db);

 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$username=$_SESSION['username'];
$username='menna hussein';
$sql = "SELECT * FROM passenger WHERE Name ='$username'";
$result = mysqli_query($conn, $sql);

if (!$result) {
   die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$pemail =$row['email'];
$ptel =$row['tel'];
$pphoto =$row['photo'];
$ppassword=$row['password'];
$ppassport=$row['passport'];
$base64Image_1 = base64_encode($pphoto);
$base64Image_2 = base64_encode($ppassport);
$imageMimeType = 'image/jpeg';

?>


<form action="updateProfile.php" method="post">
    <h2>Edit Profile</h2>
    <!-- Name -->
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $username; ?>"required>
    <br>

    <!-- Email -->
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $pemail; ?>" required>
    <br>

    <!-- Email -->
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="<?php echo $ppassword; ?>" >
    <br>

    <!-- Image -->
    <label for="image">Image:</label>
    <?php
    if (isset($pphoto)) {
    echo '<img src="data:' . $imageMimeType . ';base64,' . $base64Image_1 . '" alt="Profile Picture" style="max-width: 100%; border-radius: 50%;"><br>';
    }
    ?>
    
    <input type="file" id="image" name="image" accept="image/*">
    <br>

    <!-- Tel -->
    <label for="tel">Tel:</label>
    <input type="tel" id="tel" name="tel" value="<?php echo $ptel; ?>">
    <br>

    <!-- Passport Image -->
    <label for="passportImage">Passport Image:</label>
    <?php
    if (isset($ppassport)) {
    echo '<img src="data:' . $imageMimeType . ';base64,' . $base64Image_2 . '" alt="Profile Picture" style="max-width: 100%; border-radius: 50%;"><br>';
    }
    ?>
    <input type="file" id="passportImage" name="passportImage" accept="image/*">
    <br>

    <!-- Submit Button -->
    <input type="submit" name="submit" id="submit" value="Save" class="button-like" >
</form>

</body>
</html>
