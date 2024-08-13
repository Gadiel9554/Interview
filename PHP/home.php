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
$Gender = array();
$Business = array();
$Single = array();

// START PROGRAMMING ========
if($link) {
    // Get total gender ----
    $GetUsr = mysqli_query($link,"SELECT GENDER, COUNT(*) AS UserCount FROM inter_users GROUP BY GENDER");
    if($GetUsr && mysqli_num_rows($GetUsr) > 0) {
        while ($Us = mysqli_fetch_array($GetUsr)) {
            if(empty($Us['GENDER'])) {
                $Gender['labels'][] = "None";
            } else {
                $Gender['labels'][] = $Us['GENDER'];
            }
            $Gender['series'][] = (int)$Us['UserCount'];
        }
    } else {
        $Gender = array('labels'=>array(),'series'=>array());
    }
    // Get total business ----
    $GetBuss = mysqli_query($link,"SELECT B_NAME, COUNT(*) AS USERS FROM view_inter_users GROUP BY B_ID");
    if($GetBuss && mysqli_num_rows($GetBuss) > 0) {
        while ($Us = mysqli_fetch_array($GetBuss)) {
            $Business['labels'][] = decrypt($Us['B_NAME']);
            $Business['series'][] = (int)$Us['USERS'];
        }
    } else {
        $Business = array('labels'=>array(),'series'=>array());
    }
    // Just business ----
    $GetSinBuss = mysqli_query($link,"SELECT STATUS, COUNT(*) AS TOTAL FROM inter_business GROUP BY STATUS");
    if($GetSinBuss && mysqli_num_rows($GetSinBuss) > 0) {
        while ($Us = mysqli_fetch_array($GetSinBuss)) {
            $Single['labels'][] = $Us['STATUS'];
            $Single['series'][] = (int)$Us['TOTAL'];
        }
    } else {
        $Single = array('labels'=>array(),'series'=>array());
    }
}
$Response = array('business'=>$Business,'gender'=>$Gender,'single'=>$Single);
// END PROGRAMMING ========
// Print results in json format ========
header('Content-Type: application/json');
echo json_encode($Response, JSON_PRETTY_PRINT);