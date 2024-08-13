<?php
// Function to encrypt data -------------------------------------------------->>
    function encrypt ($data) {
    $encryption_key = base64_decode(ECRYPTION_KEY);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}
// --------------------------------------------------------------------------->>
// Function to decrypt data -------------------------------------------------->>
function decrypt ($data) {
    $encryption_key = base64_decode(ECRYPTION_KEY);
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}
// --------------------------------------------------------------------------->>
// Function to generate user serial keys ------------------------------------->>
function SerialKey($Table='inter_user_login'){
    global $link;
    $Serial = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    while (true) {
        $ArrayKey = array_rand($Serial, 12);
        $Part1 = $Serial[$ArrayKey[0]].$Serial[$ArrayKey[3]].$Serial[$ArrayKey[6]].$Serial[$ArrayKey[9]];
        $Part2 = $Serial[$ArrayKey[1]].$Serial[$ArrayKey[4]].$Serial[$ArrayKey[7]].$Serial[$ArrayKey[10]];
        $Part3 = $Serial[$ArrayKey[2]].$Serial[$ArrayKey[5]].$Serial[$ArrayKey[8]].$Serial[$ArrayKey[11]];
        $Key = "IN-".$Part1."-".$Part2."-".$Part3;
        $SearchKey = mysqli_query($link,"SELECT * FROM $Table WHERE SERIAL_KEY='$Key'");
        $NumKeys = mysqli_num_rows($SearchKey);
        if ( empty($NumKeys) ) {
            break;
        }
    }
    return $Key;
  }
// --------------------------------------------------------------------------->>
// Function to filter string ------------------------------------------------->>
function Filter($str) {
    $str = mb_strtolower( $str, 'UTF-8' );
    $str = str_replace( array('á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'), array('a', 'e', 'i', 'o', 'u', 'u', 'n'), $str );
    $str = preg_replace( '/[^a-z0-9]/', '', $str );
    return $str;
}
//---------------------------------------------------------------------------->>
?>