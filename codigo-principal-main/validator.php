<?php
    session_start();
    
    if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM' || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
      header('Location: login.php?login=erro2');
      exit();
  }
  // Validação do cliente
?>