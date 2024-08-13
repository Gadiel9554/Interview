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
session_start();
require('settings/config.php');
require('settings/connection.php');
require('settings/functions.php');
require('settings/user.php');
// Declaring variables ----
$ID = $_POST['ID'];
$Name = $_POST['NAME'];
$Mail = $_POST['MAIL'];
$Addr = $_POST['ADDRESS'];
$Salary = $_POST['SALARY'];
$Blood = $_POST['BLOOD'];
$Federal = $_POST['FEDERAL_ID'];
$Busi = $_POST['B_ID'];
$Gender = $_POST['GENDER'];
$Filter = crypt($Mail, SALT_KEY);
// Encrypt data ---
$CryName = empty($Name) ? '' : encrypt($Name);
$CryMail = empty($Mail) ? '' : encrypt($Mail);
$CryAddr = empty($Addr) ? '' : encrypt($Addr);

// START PROGRAMMING ========
if(!empty($Name) && !empty($Mail) && !empty($Salary) && !empty($Busi)) {
    if(filter_var($Mail, FILTER_VALIDATE_EMAIL)) {
        if($link) {
            // Search business ----
            $GetUsr = mysqli_query($link,"SELECT * FROM inter_users WHERE FILTER='$Filter' AND ID!='$ID'");
            if ($GetUsr && empty(mysqli_num_rows($GetUsr))) {
                $Update = mysqli_query($link,"UPDATE inter_users SET FILTER='$Filter',NAME='$CryName',MAIL='$CryMail',ADDRESS='$CryAddr',BUSINESS='$Busi',SALARY='$Salary',BLOOD='$Blood',FEDERAL_ID='$Federal',GENDER='$Gender' WHERE ID='$ID'");
                if ($Update) {
                    $Response = array('ID' => 6, 'Status' => 'Ok', 'Message' => 'The user information got updated');
                } else { // Error saving
                    $Response = array('ID' => 5, 'Status' => 'error', 'Message' => 'We got an error while updating the user information, please try again later', 'Reason' => 'error - ' . mysqli_error($link));
                }
            } else { // Duplicated name
                $Response = array('ID' => 4, 'Status' => 'warning', 'Message' => "There's a user with the same email, please use a different one", 'Reason' => 'duplicated name - ' . mysqli_error($link));
            }
        } else { // Can't connect to server
            $Response = array('ID' => 3, 'Status' => 'error', 'Message' => "We are having some issues from our side", 'Reason' => 'Can\'t connect to server - ' . mysqli_connect_error());
        }
    } else {
        $Response = array('ID' => 2, 'Status' => 'error', 'Message' => "This is not a valid email", 'Reason' => 'invalid email');
    }
} else { // Empty data
    $Response = array('ID' => 1, 'Status' => 'warning', 'Message' => "You have to fill all the information", 'Reason' => 'empty data');
}
// END PROGRAMMING ========
// Print results in json format ========
header('Content-Type: application/json');
echo json_encode($Response, JSON_PRETTY_PRINT);