<?php
function encrypt($simple_string){

    $ciphering = "AES-128-CTR";

    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    $encryption_iv = '1234567891011121';

    $encryption_key = "GeeksforGeeks";

    $encryption = openssl_encrypt($simple_string, $ciphering,
                $encryption_key, $options, $encryption_iv);

    return $encryption;
}


?>
