<?php
function sanitize_input($input) {
    // Remove leading/trailing whitespace
    $input = trim($input);
    // Remove HTML tags
    $input = strip_tags($input);
    // Escape special characters
    $input = htmlspecialchars($input);
    return $input;
}

function isValidPhoneNumber($phoneNumber) {
    return preg_match("/^[0-9]+$/", $phoneNumber) && strlen($phoneNumber) <=11;
}
?>