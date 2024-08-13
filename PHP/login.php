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

// Calling the necessary files ----
require('settings/config.php');
require('settings/connection.php');
require('settings/functions.php');
// Declaring variables ----
$Mail = strtolower($_POST['mail']);
$Pass = $_POST['pass'];
// Encrypt data ----
$CryptMail = crypt($Mail, SALT_KEY);

// START PROGRAMMING ========
if (!empty($Mail) && !empty($Pass)) { // All right
    if (filter_var($Mail, FILTER_VALIDATE_EMAIL)) { // Valid email
        if ($link) { // Connect
            // Search login info ----
            $Search = mysqli_query($link, "SELECT * FROM inter_user_login WHERE MAIL='$CryptMail'");
            if ($Search && mysqli_num_rows($Search) > 0) { // Account exist
                // Get login info
                $Login = mysqli_fetch_array($Search);
                if (password_verify($Pass, $Login['PASSWORD'])) { // Compare passwords
                    // Check User Status
                    switch ($Login['STATUS']) {
                        case 'Confirm Mail':
                            $Response = array('ID' => 8, 'Status' => 'warning', 'Message' => $i18n['6'], 'Reason' => 'account has don\'t be confirmed yet');
                            break;
                        case 'Locked':
                            $Response = array('ID' => 7, 'Status' => 'error', 'Message' => $i18n['5'], 'Reason' => 'account has bloqued');
                            break;
                        case 'Active':
                            // Update last login date
                            mysqli_query($link, "UPDATE inter_user_login SET LAST_LOGIN='$Unix' WHERE ID='$Login[0]'");
                            session_start();
                            $GetUsrInfo = mysqli_query($link, "SELECT * FROM view_inter_user WHERE SERIAL_KEY='$Login[SERIAL_KEY]'");
                            $PermNum = mysqli_num_rows($GetUsrInfo);
                            $_SESSION['INTERVIEW_2024'] = mysqli_fetch_array($GetUsrInfo);
                            $Response = array('ID' => 6, 'Status' => 'Ok', 'Message' => "Welcome");
                            break;
                    }
                } else { // Invalid password
                    $Response = array('ID' => 5, 'Status' => 'error', 'Message' => "Wrong email or password", 'Reason' => 'invalid credencials');
                }
            } else { // Account doens't exist
                $Response = array('ID' => 4, 'Status' => 'error', 'Message' => "There's not an account with this email", 'Reason' => 'account doesn\'t exists - ' . mysqli_error($link));
            }
        } else { // Can't connect to server
            $Response = array('ID' => 3, 'Status' => 'error', 'Message' => "We are having some issues from our side", 'Reason' => 'Can\'t connect to server - ' . mysqli_connect_error());
        }
    } else { // Invalid email
        $Response = array('ID' => 2, 'Status' => 'error', 'Message' => "This is not a valid email", 'Reason' => 'invalid email');
    }
} else { // Empty data
    $Response = array('ID' => 1, 'Status' => 'warning', 'Message' => "You have to fill all the information", 'Reason' => 'empty data');
}
// END PROGRAMMING ========
// Print results in json format ========
header('Content-Type: application/json');
echo json_encode($Response, JSON_PRETTY_PRINT);
