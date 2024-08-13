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
    $GetBuss = mysqli_query($link,"SELECT * FROM inter_business");
    if ($GetBuss && mysqli_num_rows($GetBuss) > 0) {
        while ($Buss = mysqli_fetch_array($GetBuss)) {
            $Buss['NAME'] = decrypt($Buss['NAME']);
            $Buss['ADDRESS'] = decrypt($Buss['ADDRESS']);
            $Buss['DATE'] = date('Y/m/d H:i:s',$Buss['DATE']);
            $Response[] = $Buss;
        }
    }
}
// END PROGRAMMING ========
// Print results in json format ========
header('Content-Type: application/json');
echo json_encode($Response, JSON_PRETTY_PRINT);