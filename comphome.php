<?php
session_start();


$comname = "com";
$bio = "bio";
$dbname = 'flight_booking';
$conn = new mysqli('localhost', "root", "", $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//print_r($_SESSION); //echo $comname;
if (isset($_SESSION['username'])) {
  $comname = $_SESSION['username'];
  //echo $comname;
}
 $sql = "SELECT * FROM company WHERE Name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$crow = $result->fetch_assoc();
$comname = $_SESSION['username'];
   $bio = $crow['Bio'];
$logo = $crow['Logo'];
//   echo $comname;
$sql = "SELECT ID FROM flights WHERE company_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $crow['ID']);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

/* Full height image header */
.bgimg-1 {
  background-position: center;
  background-size: cover;
  background-image: url("highlight-1-1500w.png");
  min-height: 100%;
}

.w3-bar .w3-button {
  padding: 16px;
}
ul { 
    list-style-type: none; 
    width: 40%;  
    font-weight: bold;
    margin:auto; margin-bottom:4%;
     height: auto; 
} 
ul li { 
    padding: 10px 0; 
    border-bottom: 1px solid #add8e6; 
    text-align: left; 
    transition: padding-left 0.3s linear, font-weight 0.2s linear, color 0.3s linear; 
    -webkit-transition: padding-left 0.3s linear, font-weight 0.2s linear, color 0.3s linear; 
    -moz-transition: padding-left 0.3s linear, font-weight 0.2s linear, color 0.3s linear; 
    -o-transition: padding-left 0.3s linear, font-weight 0.2s linear, color 0.3s linear; 
    -ms-transition: padding-left 0.3s linear, font-weight 0.2s linear, color 0.3s linear; 
} 
ul li:first-child { 
    border-top: 1px solid #909; 
} ul li:hover { 
    padding-left: 20px; 
    color: #add8e6; 
}
</style>
<body>


<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a href="#home" class="w3-bar-item w3-button w3-wide"><?php echo $logo;  ?></a>
    <div class="w3-right w3-hide-small">
      <a href="#team" class="w3-bar-item w3-button"><i class="fa fa-user"></i> PROFILE</a>
      <a href="#contact" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> MESSAGES</a>
    </div>

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT</a>
  <a href="#team" onclick="w3_close()" class="w3-bar-item w3-button">TEAM</a>
  <a href="#work" onclick="w3_close()" class="w3-bar-item w3-button">WORK</a>
  <a href="#pricing" onclick="w3_close()" class="w3-bar-item w3-button">PRICING</a>
  <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT</a>
</nav>

<header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
  <div class="w3-display-left w3-text-white" style="padding:48px">
    <span class="w3-jumbo w3-hide-small"><?php echo $comname; ?></span><br>
    <span class="w3-xxlarge w3-hide-large w3-hide-medium"><?php echo $comname; ?></span><br>
    <span class="w3-large"><?php echo $bio; ?></span>
    <p><a href="#about" class="w3-button w3-white w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">Add Flight</a></p>
  </div> 
  <div class="w3-display-bottomleft w3-text-grey w3-large" style="padding:24px 48px">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
</header>
<h3 class="w3-center" style="margin-top:5%;">FLIGHTS</h3>
<ul class="item1">
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<li><a href='flightdetails.php?cid=" . urlencode($crow['ID']) . "&fid=" . urlencode($row['ID']) . "'>" . htmlspecialchars($row['ID']) . "</a></li>";
        }
    } 
    ?>
</ul>

<div class="w3-container" style="padding:128px 16px" id="about">
  <h3 class="w3-center">ABOUT THE COMPANY</h3>
  <p class="w3-center w3-large">Key features of our company</p>
  <div class="w3-row-padding w3-center" style="margin-top:64px">
    <div class="w3-quarter">
      <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center"></i>
      <p class="w3-large">Responsive</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-heart w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Passion</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-diamond w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Design</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-cog w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Support</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>
  </div>
</div>


<footer class="w3-center w3-black w3-padding-64">
  <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <div class="w3-xlarge w3-section">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
</footer>
 
<script>
// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}


// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
  } else {
    mySidebar.style.display = 'block';
  }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

</body>
</html>
