<?php  
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioDAO.php';

$usuario = null;

if(isset($_GET["id"])) {
    $usuario = UsuarioDAO::getInstance()->getById($_GET["id"]);
}
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('./head.php'); ?>
    <body class="sb-nav-fixed">
        <?php include("./nav.php") ?>
        <div id="layoutSidenav">
            <?php include "./sideNav.php" ;?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Usuários</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Usuários</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-regular fa-square-plus me-1"></i>
                                Adicionar Usuário
                            </div>
                            <div class="card-body">
                                <form method="POST" action="./controller/usuarioController.php">
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
                                        <div class="col-4">
                                            Senha:
                                            <?php
                                            echo
                                            "<input class='form-control' type='password' name='senha' value='"
                                            .($usuario == null ? '' : $usuario->getSenha()) . "'>"
                                            ?>
                                        </div>
                                        <div class="col-4">
                                            Repetir Senha:
                                            <?php
                                            echo
                                            "<input class='form-control' type='password' name='repetirSenha' value='"
                                            .($usuario == null ? '' : $usuario->getSenha()) . "'>"
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-8">
                                            Foto de perfil:
                                            <?php
                                            echo
                                            "<input class='form-control' type='file' name='foto' value='"
                                            .($usuario == null ? '' : $usuario->getFoto()) . "'>"
                                            ?>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success m-1">
                                                    Salvar  <i class="fa-solid fa-check"></i>
                                                </button>

                                                <button type="reset" class="btn btn-secondary m-1">
                                                    Limpar  <i class="fa-solid fa-rotate-left"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
