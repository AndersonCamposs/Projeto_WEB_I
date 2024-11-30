<?php  
include 'authenticator.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioDAO.php';

$usuario = null;

if(isset($_GET["id"])) {
    $usuario = UsuarioDAO::getInstance()->getById($_GET["id"]);
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
                        <div class="d-flex">
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
                            "<div class='mt-2 ps-4'>
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
                                <form method="POST" action="./controller/usuarioController.php" enctype="multipart/form-data">
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
                                            "<input class='form-control' type='text' name='nome' value='"
                                            .($usuario == null ? '' : $usuario->getNome()) . "'>"
                                            ?>
                                            
                                        </div>
                                        <div class="col-6">
                                            E-mail:
                                            <?php
                                            echo
                                            "<input class='form-control' type='text' name='email' placeholder='example@email.com' value='"
                                            .($usuario == null ? '' : $usuario->getEmail()) . "'>"
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            CPF:
                                            <?php
                                            echo
                                            "<input class='form-control' type='text' name='cpf' value='"
                                            .($usuario == null ? '' : $usuario->getCpf()) . "'>"
                                            ?>
                                        </div>
                                        <?php
                                        if($usuario != null){
                                        echo
                                        "
                                        <div class='col-8'>
                                            Foto de perfil:
                                            <input class='form-control' type='file' name='foto'>
                                        </div>
                                        ";
                                        }
                                        ?>
                                        <div class="col-4">
                                            <?php
                                            if($usuario == null) {
                                                echo
                                                "Senha:".
                                                "<input class='form-control' type='password' name='senha'/>";
                                            }
                                            ?>
                                            
                                            
                                        </div>
                                        <div class="col-4">
                                            <?php
                                            if($usuario == null) {
                                                echo
                                                "Repetir Senha:".
                                                "<input class='form-control' type='password' name='repetirSenha'/>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    if($usuario == null){
                                    echo
                                    "<div class='row mb-3'>
                                        <div class='col-8'>
                                            Foto de perfil:
                                            <input class='form-control' type='file' name='foto'>
                                        </div>
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
                                                if($usuario != null) {
                                                    echo
                                                    "<a type='reset' class='btn btn-primary m-1' href='./usuarioAddEdit.php?id=".$usuario->getId()."&protocol=".uniqid()."'>
                                                       Editar Senha <i class='fa-solid fa-lock'></i>
                                                    </a>";
                                                }    
                                                ?>
                                                
                                            </div>
                                        </div>
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
                                Adicionar Consulta".
                            "</div>".
                            "<div class='card-body'>".
                                "<form action='./controller/usuarioController.php' method='POST'>".
                                    "<div class='row mb-3 text-center'>".
                                        "<div class='d-flex justify-content-center'>".
                                            "<div class='col-3 m-1'>".
                                                "Nova senha:
                                                <input class='form-control' type='password' name='novaSenha'/>".
                                            "</div>".
                                            "<div class='col-3 m-1'>".
                                                "Repetir nova senha:
                                                <input class='form-control' type='password' name='repetirNovaSenha'/>".
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
                                </form>
                            </div>";                     
                        }
                        ?>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
