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
?>