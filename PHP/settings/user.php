<?php

$Usr = $_SESSION['INTERVIEW_2024'];
$UsrMin = explode(' ',decrypt($Usr['NAME']));
$Usr1 = $UsrMin[0][0].$UsrMin[1][0];
define('USR_MIN',$UsrMin[0]);

?>