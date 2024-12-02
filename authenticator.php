<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/UsuarioVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioPermissaoDAO.php';

session_start();
if(!isset($_SESSION["usuarioLogado"])) {
    header("Location: ./login.php");
    die();
} 


function checarAutorizacao($requiredAuthorize) {
    $usuarioLogadoPermissoes = UsuarioPermissaoDAO::getInstance()->listWhere("WHERE idUsuario = :idUsuario", array(0 => ":idUsuario"), array(0 => $_SESSION["usuarioLogado"]->getId()));
    foreach($usuarioLogadoPermissoes as $usuarioLogadoPermissao) {
        if (in_array($usuarioLogadoPermissao->getPermissao(), $requiredAuthorize)) {
            return true;
        }
    }
    // SE CHEGAR AO FIM DO LOOP, SIGNIFICA O USUÁRIO NÃO É AUTORIZADO
    return false;
}

