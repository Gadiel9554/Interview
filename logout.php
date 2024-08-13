<?php

  session_start();

  unset ($_SESSION['INTERVIEW_2024']);
  session_destroy();
  header('Location: ./');

?>
