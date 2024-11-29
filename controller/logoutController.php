<?php
session_start();
session_unset();
session_destroy();

// REDIRECIONA PARA A INDEX.PHP
header("Location: ../index.php");
exit;

