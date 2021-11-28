<?php 
      if (!isset($_SESSION)) session_start(); 
      setcookie("user", "", time()-3600);
      session_destroy();
      header("Location: login.php");
      exit;
?>