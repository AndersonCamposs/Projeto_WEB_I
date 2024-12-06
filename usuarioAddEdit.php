<?php  
include 'authenticator.php';

checarLogin();

require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioPermissaoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/PermissaoDAO.php';

$usuario = null;

if(isset($_GET["id"])) {
    if($_GET['id'] != $_SESSION["usuarioLogado"]->getId()) {
        if (!checarAutorizacao(array(PermissaoDAO::getInstance()->getById(1)))) {
            header("Location: ./index.php");
            die();
        }
    }
    $usuario = UsuarioDAO::getInstance()->getById($_GET["id"]);
} else {
    if (!checarAutorizacao(array(PermissaoDAO::getInstance()->getById(1)))) {
        header("Location: ./index.php");
        die();
    }
}
?>

<!DOCTYPE html>
    <?php include('./head.php'); ?>
    <body class="sb-nav-fixed">
        <?php include("./nav.php") ?>
        <div id="layoutSidenav">
            <?php include "./sideNav.php" ;?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center">
                            <div>
                                <h1 class="mt-4">Usuários</h1>
                                <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Usuários</li>
                                </ol>
                            </div>
                            <?php
                            if ($usuario != null && $usuario->getFoto() != null) {
                            echo 
                            "<div class='my-4 ps-4'>
                                <img src = '".$usuario->getFoto()."' id='photoPreview'/>".
                            "</div>";
                            }
                            ?>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-regular fa-square-plus me-1"></i>
                                Adicionar Usuário
                            </div>
                            <div class="card-body">
                                <form id="usuarioAddEditForm" method="POST" action="./controller/usuarioController.php" enctype="multipart/form-data">
                                    <?php
                                        if ($usuario != null) {
                                            echo
                                            "<input type='hidden' name = 'id' value='".$usuario->getId()."'>";
                                       }
                                    ?>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            Nome:
                                            <?php
                                            echo
                                            "<input id='inputNome' class='form-control' type='text' name='nome' value='"
                                            .($usuario == null ? '' : $usuario->getNome()) . "'>"
                                            ?>
                                            
                                        </div>
                                        <div class="col-6">
                                            E-mail:
                                            <?php
                                            echo
                                            "<input id='inputEmail' class='form-control' type='text' name='email' placeholder='example@email.com' value='"
                                            .($usuario == null ? '' : $usuario->getEmail()) . "'>"
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            CPF:
                                            <?php
                                            echo
                                            "<input id='inputCpf'class='form-control' type='text' name='cpf' value='"
                                            .($usuario == null ? '' : $usuario->getCpf()) . "'>"
                                            ?>
                                        </div>
                                        <?php
                                        if($usuario != null){
                                        echo
                                        "
                                        <div class='col-8'>
                                            Foto de perfil:
                                            <input id='inputFoto' class='form-control' type='file' name='foto'>
                                        </div>";
                                        
                                        }
                                        ?>
                                        <div class="col-4">
                                            <?php
                                            if($usuario == null) {
                                                echo
                                                "Senha:".
                                                "<input id='inputSenha' class='form-control' type='password' name='senha'/>";
                                            }
                                            ?>
                                            
                                            
                                        </div>
                                        <div class="col-4">
                                            <?php
                                            if($usuario == null) {
                                                echo
                                                "Repetir Senha:".
                                                "<input id='inputRepetirSenha' class='form-control' type='password' name='repetirSenha'/>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    $usuarioPermissoes = UsuarioPermissaoDAO::getInstance()->listWhere("WHERE idUsuario = :idUsuario", array(0 => ":idUsuario"), array(0 => $_SESSION["usuarioLogado"]->getId()));
                                    if($usuario != null) {

                                    echo
                                    "<div class='row mb-3'>".
                                        "<div class='col-4'>".
                                            "Permissões do usuário:".
                                            "<select class='form-select' name='permissao'>";
                                            foreach ($usuarioPermissoes as $usuarioPermissao) {
                                                echo 
                                                "<option value='".$usuarioPermissao->getPermissao()->getId()."'>".
                                                    $usuarioPermissao->getPermissao()->getNome().
                                                "</option>";
                                            }
                                        echo "</select>".
                                        "</div>
                                    </div>";
                                    }
                                    
                                    
                                    if($usuario == null){
                                    
                                    echo
                                    "<div class='row mb-3'>".
                                        "<div class='col-8'>".
                                            "Foto de perfil:".
                                            "<input id='inputFoto' class='form-control' type='file' name='foto'>".
                                        "</div>".
                                        "<div class='col-4'>".
                                            "Permissões do usuário:".
                                            "<a data-bs-toggle='modal' data-bs-target='#permissoesInfo'>
                                                <i class='fa-solid fa-circle-info'></i>
                                            </a>
                                            <div class='modal fade' id='permissoesInfo' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='exampleModalLabel'>Informações</h5>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        Para adicionar mais de uma permissão ao usuário, após adicioná-lo,
                                                        edite os dados do usuário, adicionando uma nova permissão.
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>".
                                            "<select class='form-select' name='permissao'>";
                                            foreach ($usuarioPermissoes as $usuarioPermissao) {
                                                echo 
                                                "<option value='".$usuarioPermissao->getPermissao()->getId()."'>".
                                                    $usuarioPermissao->getPermissao()->getNome().
                                                "</option>";
                                            }
                                        echo "</select>".
                                        "</div>
                                    </div>";
                                    }
                                    
                                    ?>
                                    <div class="row my-3">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-center">
                                                <?php
                                                echo
                                                "<button type='submit' class='btn btn-success m-1'".(isset($_GET['protocol']) ? 'disabled' : '').">
                                                    Salvar  <i class='fa-solid fa-check'></i>
                                                </button>";
                                                ?>
                                                
                                                <?php
                                                echo
                                                "<button type='reset' class='btn btn-secondary m-1'".(isset($_GET['protocol']) ? 'disabled' : '').">
                                                    Limpar  <i class='fa-solid fa-rotate-left'></i>
                                                </button>";
                                                ?>
                                                
                                                <?php
                                                if($usuario != null && $usuario->getId() == $_SESSION["usuarioLogado"]->getId()) {
                                                    echo
                                                    "<a class='btn btn-primary m-1' href='./usuarioAddEdit.php?id=".$usuario->getId()."&protocol=".uniqid()."'>
                                                       Editar Senha <i class='fa-solid fa-lock'></i>
                                                    </a>";
                                                }    
                                                ?>
                                                
                                                <?php
                                                if($usuario != null && $usuario->getFoto() != null) {
                                                    echo
                                                    "<a class='btn btn-danger m-1' href='./controller/usuarioController.php?id=".$usuario->getId()."&removerFoto=true'>
                                                       Remover foto <i class='fas fa-trash'></i>
                                                    </a>";
                                                }    
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- VALIDATION ERRORS -->
                                    <div id="addEditValidationErrors" class="d-none justify-content-center flex-wrap my-3">

                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                        if (isset($_GET['protocol']) && ($_SESSION['usuarioLogado']->getId() == $usuario->getId())) {
                            echo 
                            "<div class='card mb-4'>".
                            "<div class='card-header'>".
                                "<i class='fa-regular fa-pen-to-square me-1'></i>
                                Alterar Senha".
                            "</div>".
                            "<div class='card-body'>".
                                "<form id='usuarioAlterarSenhaForm' action='./controller/usuarioController.php' method='POST'>".
                                    "<div class='row mb-3 text-center'>".
                                        "<div class='d-flex justify-content-center'>".
                                            "<div class='col-3 m-1'>".
                                                "Senha atual:
                                                <input id='inputSenhaAtual' class='form-control' type='password' name='senhaAtual'/>".
                                            "</div>".
                                            "<div class='col-3 m-1'>".
                                                "Nova senha:
                                                <input id='inputNovaSenha' class='form-control' type='password' name='novaSenha'/>".
                                            "</div>".
                                            "<div class='col-3 m-1'>".
                                                "Repetir nova senha:
                                                <input id='inputRepetirNovaSenha' class='form-control' type='password' name='repetirNovaSenha'/>".
                                            "</div>".
                                        "</div>".
                                    "</div>".
                                    
                                    "<div class='row my-3'>".
                                        "<div class='col-12'>".
                                            "<div class='d-flex justify-content-center'>
                                                <button type='submit'  class='btn btn-success m-1'>
                                                    Salvar  <i class='fa-solid fa-check'></i>
                                                </button>

                                                <a class='btn btn-danger m-1' href='./usuarioAddEdit.php?id=".$_SESSION['usuarioLogado']->getId()."'>
                                                    Cancelar  <i class='fa-solid fa-rotate-left'></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id='alterSenhaValidationErrors' class='d-none justify-content-center flex-wrap my-3'>

                                    </div>
                                </form>
                            </div>";                     
                        }
                        ?>
                    </div>
                </main>
                <?php
                include("./footer.php");
                ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
        <!-- SCRIPT QUE VALIDA O FORMULÁRIO -->
        <script src="./js/globalFormValidator.js" type="module"></script>
    </body>
</html>