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
$Response = array();

// START PROGRAMMING ========
if($link) {
    $GetUsr = mysqli_query($link,"SELECT * FROM view_inter_users");
    if ($GetUsr && mysqli_num_rows($GetUsr) > 0) {
        while ($Usr = mysqli_fetch_array($GetUsr)) {
            $Usr['NAME'] = decrypt($Usr['NAME']);
            $Usr['MAIL'] = decrypt($Usr['MAIL']);
            $Usr['ADDRESS'] = empty($Usr['ADDRESS']) ? '' : decrypt($Usr['ADDRESS']);
            $Usr['B_ADDRESS'] = empty($Usr['B_ADDRESS']) ? '' : decrypt($Usr['B_ADDRESS']);
            $Usr['B_NAME'] = decrypt($Usr['B_NAME']);
            $Usr['DATE'] = date('Y/m/d H:i:s',$Usr['DATE']);
            $Response[] = $Usr;
        }
    }
}
// END PROGRAMMING ========
// Print results in json format ========
header('Content-Type: application/json');
echo json_encode($Response, JSON_PRETTY_PRINT);