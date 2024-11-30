<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/UsuarioVO.php';

session_start();
if(!isset($_SESSION["usuarioLogado"])) {
    header("Location: ./login.php");
    die();
} 


