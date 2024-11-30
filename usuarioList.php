<?php 
include 'authenticator.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioDAO.php';
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
                        <h1 class="mt-4">Usuários</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Usuários</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Lista de Usuários
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>E-Mail</th>
                                            <th>CPF</th>
                                            <th>Foto</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>E-Mail</th>
                                            <th>CPF</th>
                                            <th>Foto</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $listaUsuarios = UsuarioDAO::getInstance()->listAll();
                                       
                                        foreach ($listaUsuarios as $usuario) {
                                            echo 
                                            "<tr>".
                                                "<td>".$usuario->getId()."</td>".
                                                "<td>".$usuario->getNome()."</td>".
                                                "<td>".$usuario->getEmail()."</td>".
                                                "<td>".$usuario->getCPF()."</td>".
                                                "<td><img id='profilePhoto' src='".$usuario->getFoto()."'/></td>".
                                                "<td class='d-flex'>".
                                                    ($_SESSION["usuarioLogado"]->getId() == $usuario->getId() ? 
                                                    "<a href='./usuarioAddEdit.php?id=".$usuario->getId()."' class='btn btn-outline-warning'><i class='fas fa-pen'></i>Editar</a>
                                                    <a href='./controller/usuarioController.php?id=".$usuario->getId()."' class='btn btn-outline-danger'><i class='fas fa-trash'></i>Apagar</a>"
                                                    :
                                                    "<h6>N/A</h6>"
                                                    )
                                                ."</td>".
                                            "</tr>"
                                                    ;
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
