<?php
if (isset($memberOnly) && empty($_SESSION['user'])) {
      header('Location: login.php');
      exit;
    }
?>