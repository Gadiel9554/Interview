<?php

/**
 * Copyright 2024 Gadiel Navarrete.
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at

      http://www.apache.org/licenses/LICENSE-2.0

 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Calling the necessary files ----
require('settings/config.php');
require('settings/connection.php');
require('settings/functions.php');
// Declaring variables ----
$Name = $_POST['name'];
$Mail = strtolower(trim($_POST['mail']));
$Pass = $_POST['pass'];
// Filter variables ----
$CryptMail = crypt($Mail, SALT_KEY); // Crypt email
$EncName = empty($Name) ? '' : encrypt($Name); // Encrypt name
$Pass = empty($Pass) ? '' : password_hash($Pass, PASSWORD_DEFAULT);
$EncMail = encrypt($Mail); // Encrypt Email

// START PROGRAMMING ========
if (!empty($Name) && !empty($Mail) && !empty($Pass)) {
    if ($link) {
        if (filter_var($Mail, FILTER_VALIDATE_EMAIL)) {
            // Search login
            $GetLogin = mysqli_query($link, "SELECT * FROM inter_user_login WHERE MAIL='$CryptMail'");
            if (empty(mysqli_num_rows($GetLogin))) { // New user
                $SerialKey = SerialKey(); // Generate Serial Key
                // Insert login
                $InserLogin = mysqli_query($link, "INSERT INTO inter_user_login (MAIL,STATUS,SERIAL_KEY,PASSWORD) VALUES('$CryptMail','Active','$SerialKey','$Pass')");
                if ($InserLogin) { // Verify if storing is successful
                    // Save user info in Data Base
                    $LoginID = mysqli_insert_id($link); // ID User login
                    $SaveUserInfo = mysqli_query($link, "INSERT INTO inter_user_info (ID_USER,SERIAL_KEY,NAME,EMAIL,LANG,TIME_ZONE,ACTION,DATE) VALUES('$LoginID','$SerialKey','$EncName','$EncMail','$Lng','$Tim','None','$Unix')");
                    if ($SaveUserInfo) { // Insert user info
                        // Save verification key
                        $ID = mysqli_insert_id($link); // ID User
                        $Response = array('ID' => 10, 'Status' => 'Ok', 'Message' => "We welcome you!, now start session");
                    } else { // Can't inser user info
                        $Response = array('ID' => 6, 'Status' => 'error', 'Message' => "We are experiencing some issues, please try again later", 'Reason' => 'Can\'t inser user info' . mysqli_error($link));
                    }
                } else { // Can't insert login info
                    $Response = array('ID' => 5, 'Status' => 'error', 'Message' => "We had an error creating your account, please try again later", 'Reason' => 'Can\'t insert login info - ' . mysqli_error($link));
                }
            } else { // Email exist
                $Response = array('ID' => 4, 'Status' => 'warning', 'Message' => "There's n existing account with this email", 'Reason' => 'Email already exist');
            }
        } else {
            $Response = array('ID' => 3, 'Status' => 'error', 'Message' => "This email is not valid", 'Reason' => 'invalid email');
        }
    } else { // Can't connect to db
        $Response = array('ID' => 2, 'Status' => 'error', 'Message' => "There's an error from our side", 'Reason' => 'can\'t connect ot db - ' . mysqli_connect_error());
    }
} else { // Empty data
    $Response = array('ID' => 1, 'Status' => 'error', 'Message' => "You have to fill all the info", 'Reason' => 'empty data');
}
// END PROGRAMMING ========
// Print results in json format ========
header('Content-Type: application/json');
echo json_encode($Response, JSON_PRETTY_PRINT);
