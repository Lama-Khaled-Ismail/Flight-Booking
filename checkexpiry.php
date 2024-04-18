<?php
    $exp_time = 10*60;
 if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time']) > $exp_time) {
    header("Location: logout.php");
    exit;
  }
?>