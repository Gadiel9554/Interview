<?php

// System URL ---------------------------------------------------------------->>
    if (!empty($_SERVER['SERVER_NAME'])) {
        $SystemURL = "https://" . $_SERVER['SERVER_NAME'] . "/";
    } else { // From command line
        $SystemURL = "https://yourdomain.com/"; // Set here the domain where you are puttinng this test software
    }
    define('SYSTEM_URL',$SystemURL);
// Name of the sistem -------------------------------------------------------->>
    define('NAME_SYSTEM',"Interview");
    define('COMPANY',"Gadiel Navarrete");
// Encryption Key ------------------------------------------------------------>>
    define('ECRYPTION_KEY','*:bRuD5WYw5wd0rdHR9yLlM6w/t2vte-uiniQBqE70nAuhU=//**');
// Salt Key ------------------------------------------------------------------>>
    define('SALT_KEY','$6$rounds=5000$interview$');
// Current Page -------------------------------------------------------------->>
    if(isset($_SERVER['SERVER_NAME'])){
        if($_SERVER['SERVER_NAME'] == "localhost") {
            $ServerPHP = explode("/",$_SERVER["PHP_SELF"]);
            $CurrL = empty(end($ServerPHP)) ? "index.php": end($ServerPHP);
        }
    } else { $CurrL = "index.php"; }
    define('CURRENT_PAGE',$CurrL);
// Date & Time --------------------------------------------------------------->>
    $DateTime = date('Y-m-d H:i:s');
    $Date = date('Y-m-d');
    $Time = date('H:i:s');
    $Year = date('Y');
    $Month = date('m');
    $Day = date('d');
    $Hour = date('H');
    $Minute = date('i');
    $Second = date('s');
    $Unix = time();

?>