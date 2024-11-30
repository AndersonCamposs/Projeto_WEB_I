<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioDAO.php';
session_start();

$email = $_POST["email"];
$senha = $_POST["senha"];

$usuarioLogin = UsuarioDAO::getInstance()->getByEmail($email);

$erro = false;

var_dump($erro);
if(isset($usuarioLogin)) {
    echo "usuário existe";
    if(password_verify($senha, $usuarioLogin->getSenha())) {
        
        $_SESSION["usuarioLogado"] = $usuarioLogin;
        header("Location: ../index.php");
        exit;
        
    } else {
        echo "senha errada";
        $erro = true;
    }
} else {
    $erro = true;
    echo "usuário não existe";
}
var_dump($erro);
if ($erro) {
    $_SESSION["emailInformado"] = $email;
    $_SESSION["senhaInformada"] = $senha;
    $_SESSION["loginErro"] = "E-mail e/ou senha incorretos";
    header("Location: ../login.php");
    exit;
}