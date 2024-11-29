<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioDAO.php';

$email = $_POST["email"];
$senha = $_POST["senha"];

$usuarioLogin = UsuarioDAO::getInstance()->getByEmail($email);


if(isset($usuarioLogin)) {
    if(password_verify($senha, $usuarioLogin->getSenha())) {
        session_start();
        $_SESSION["loggedUser"] = $usuarioLogin;
        header("Location: ../index.php");
        exit;
        
    } else {
        $_SESSION["login_error"] = "E-mail e/ou senha incorretos";
        header("Location: ../login.php");
        exit;
    }
} else {
    $_SESSION["login_error"] = "E-mail e/ou senha incorretos";
    header("Location: ../login.php");
    exit;
}
