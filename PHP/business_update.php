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
$Addr = $_POST['ADDRESS'];
$Status = $_POST['STATUS'];
$Filter = Filter($Name);
// Encrypt data ---
$CryName = empty($Name)?'':encrypt($Name);
$CryAddr = empty($Addr)?'':encrypt($Addr);

// START PROGRAMMING ========
if(!empty($Name) && !empty($Addr)) {
    if($link) {
        // Search business ----
        $GetBuss = mysqli_query($link,"SELECT * FROM inter_business WHERE FILTER='$Filter' AND ID!='$ID'");
        if ($GetBuss && empty(mysqli_num_rows($GetBuss))) {
            $Update = mysqli_query($link,"UPDATE inter_business SET FILTER='$Filter',NAME='$CryName',ADDRESS='$CryAddr',STATUS='$Status' WHERE ID='$ID'");
            if ($Update) {
                $Response = array('ID' => 5, 'Status' => 'Ok', 'Message' => 'Your business got updated');
            } else { // Error saving
                $Response = array('ID' => 4, 'Status' => 'error', 'Message' => 'We got an error while updating your business, please try again later', 'Reason' => 'error - ' . mysqli_error($link));
            }
        } else { // Duplicated name
            $Response = array('ID' => 3, 'Status' => 'warning', 'Message' => "There's a business with the same name, please use a different one", 'Reason' => 'duplicated name - ' . mysqli_error($link));
        }
    } else { // Can't connect to server
        $Response = array('ID' => 2, 'Status' => 'error', 'Message' => "We are having some issues from our side", 'Reason' => 'Can\'t connect to server - ' . mysqli_connect_error());
    }
} else { // Empty data
    $Response = array('ID' => 1, 'Status' => 'warning', 'Message' => "You have to fill all the information", 'Reason' => 'empty data');
}
// END PROGRAMMING ========
// Print results in json format ========
header('Content-Type: application/json');
echo json_encode($Response, JSON_PRETTY_PRINT);