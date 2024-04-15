<?php
function decrypt($encryption){

    $ciphering = "AES-128-CTR";
    $options = 0;

    $decryption_iv = '1234567891011121';

    $decryption_key = "GeeksforGeeks";

    $decryption=openssl_decrypt ($encryption, $ciphering, 
            $decryption_key, $options, $decryption_iv);

    return $decryption;
}

?>